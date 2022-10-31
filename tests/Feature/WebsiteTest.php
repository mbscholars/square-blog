<?php

namespace Tests\Feature;

use App\Models\Post;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class WebsiteTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */

    protected function setUp(): void
    {
        parent::setUp();
        $this->artisan('blog:setup');
    }
    public function test_blog_is_accessible()
    {

        $response = $this->get('/');
        $response->assertStatus(200);
    }



    public function test_blog_page_works()
    {
        Post::factory()->create();
        $response = $this->get(route('blog.show', ['slug' => Post::inRandomOrder()->first()->slug]));
        $response->assertStatus(200);
    }
}
