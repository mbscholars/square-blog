<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\BlogFeed;
use App\BlogApi\Facades\BlogApi;
use App\Models\Post;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ExternalBlogApiTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_it_can_import_posts()
    {
        $response = BlogApi::import();
        $this->assertInstanceOf(BlogFeed::class, $response);
    }

    public function test_it_can_process_imports()
    {
        $response = BlogApi::import();
        $this->assertEquals($response->refresh()->status, 'processed');
        $this->assertGreaterThan(0, Post::count());
    }
}
