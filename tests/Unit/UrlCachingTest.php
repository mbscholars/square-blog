<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Facade\UrlCache;

class UrlCachingTest extends TestCase
{
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function test_can_set_retrieve_and_clear_cache()
    {
        UrlCache::set('blog_page_1', 'this is a value', 'blog');

        $item = UrlCache::retrieve('blog_page_1', 'blog');

        $this->assertEquals($item, 'this is a value');

        UrlCache::clear('blog');

        $item2 = UrlCache::retrieve('blog_page_1', 'blog');

        $this->assertTrue($item2 == null);
    }
}
