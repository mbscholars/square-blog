<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use App\Facade\UrlCache;
use App\Enums\PostStatus;
use App\Enums\CachedPages;
use App\Models\Post;
use Illuminate\Support\Str;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Cache;

class CachingTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */

    public function setUp(): void
    {
        parent::setUp();
        $this->artisan("blog:setup");
    }

    public function test_cache_is_set_on_blog_page()
    {
        $response = $this->get('/');
        $response->assertStatus(200);

        $key = (cached_url_identifier());
        $posts = UrlCache::retrieve($key, CachedPages::BLOG);

        $this->assertEquals($key, CachedPages::BLOG);

        $this->assertInstanceOf(LengthAwarePaginator::class, $posts);
    }

    public function test_paginated_and_queried_pages_for_blog_are_also_cached()
    {
        $query = [
            'page' => 2,
        ];

        $response = $this->get('/', $query);
        $response->assertStatus(200);

        $key = (cached_url_identifier());
        $posts = UrlCache::retrieve($key, CachedPages::BLOG);

        $this->assertInstanceOf(LengthAwarePaginator::class, $posts);
    }

    public function test_only_blog_page_cache_clears_when_a_new_post_is_created()
    {
        /** Access a given url first to cache the posts */
        $query = [
            'page' => 1,
        ];
        $response = $this->get('/', $query);
        $response->assertStatus(200);
        $key = cached_url_identifier();
        $cacheBefore = UrlCache::retrieve($key, CachedPages::BLOG);
        /** Assert cache is created  */
        $this->assertNotEquals($cacheBefore, null);
        $this->assertInstanceOf(LengthAwarePaginator::class, $cacheBefore);

        /** Create a new post  */
        $data = [
            'title' => 'This is a post',
            'description' => 'This is a paragraph and a content',
            'category' => 'Automobiles',
            'status' => PostStatus::PUBLISHED
        ];
        $this->actingAs($user = User::first());
        $response2 = $this->post(route('dashboard.store'), $data);
        /** Assert record was actually created  */
        $this->assertDatabaseHas('posts', [
            'user_id' => $user->id,
            'title' => $data['title'],
            'slug' => $slug = Str::slug($data['title']),
            'description' => $data['description']
        ]);

        /** Acess the newly created post to cache it */

        $response3 = $this->get(route('blog.show', ['slug' => $slug]));

        $post = Cache::get($slug);


        /** Assert cache for blog page is cleared */
        $cacheAfter = UrlCache::retrieve($key, CachedPages::BLOG);

        $this->assertEquals($cacheAfter, null);
        $this->assertInstanceOf(Post::class, $post, "");
    }
}
