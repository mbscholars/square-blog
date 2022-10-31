<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Models\BlogFeed;

class BlogFeedTest extends TestCase
{
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function test_can_get_unprocessed_data()
    {
        BlogFeed::factory(5)->createQuietly([
            'status' => BlogFeed::UNPROCESSED
        ]);

        BlogFeed::factory(2)->createQuietly([
            'status' => BlogFeed::PROCESSED
        ]);


        $this->assertTrue(BlogFeed::isUnprocessed()->count() == 5);
        $this->assertTrue(BlogFeed::isProcessed()->count() == 2);
    }
    public function test_can_update_feed_status_flag()
    {
        $raw = BlogFeed::factory()->createQuietly([
            'status' => BlogFeed::UNPROCESSED
        ]);

        $raw->processed();

        $this->assertEquals('processed', $raw->refresh()->status);
    }
}
