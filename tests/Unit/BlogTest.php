<?php

namespace Tests\Unit;

use App\Enums\PostStatus;
use App\Facade\Blog;
use App\Models\Post;
use App\Models\User;
use Illuminate\Pagination\LengthAwarePaginator;
use Tests\TestCase;

class BlogTest extends TestCase
{


    public function test_blog_posts_can_be_fetched()
    {

        $posts = Blog::index('blog');

        $this->assertInstanceOf(LengthAwarePaginator::class, $posts, "Blog Index returns a valid response");
    }

    // public function test_blog_posts_can_be_searched()
    // {
    //     # code...
    // }

    public function test_blog_posts_can_be_created()
    {
        $data = [
            'title' => 'This is a post',
            'description' => 'This is a paragraph and a content',
            'category' => 'Automobiles',
            'status' => PostStatus::PUBLISHED
        ];

        $this->actingAs(User::first());

        $post = Blog::storePost($data);

        $this->assertDatabaseHas('posts', ['title' => $data['title']]);

        $this->assertDatabaseHas('categories', ['name' => 'Automobiles']);

        $this->assertEquals($post->status, $data['status']);
    }

    public function test_posts_cannot_be_duplicated()
    {
        $data = [
            'title' => 'This is a post dear',
            'description' => 'This is a paragraph and a content',
            'category' => 'Automobiles',
            'status' => PostStatus::PUBLISHED
        ];

        $this->actingAs(User::first());

        Blog::storePost($data);
        Blog::storePost($data);
        Blog::storePost($data);
        Blog::storePost($data);

        $this->assertDatabaseCount('posts', 1);
    }

    public function test_post_can_be_viewed()
    {
        $data = [
            'title' => 'This is a post dear',
            'description' => 'This is a paragraph and a content',
            'category' => 'Automobiles',
            'status' => PostStatus::PUBLISHED
        ];
        $post = Blog::storePost($data);
        $postData = Blog::viewPost($post->slug);

        $this->assertIsObject($postData);
        $this->assertInstanceOf(Post::class, $post);
    }
}
