<?php

namespace Tests;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\BlogApiHttpMocks;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;

abstract class TestCase extends BaseTestCase
{
    use RefreshDatabase;
    use CreatesApplication;

    use BlogApiHttpMocks;


    protected function setUp(): void
    {
        parent::setUp();

        if (config('square-blog.use_mocks')) {
            self::setupMocks();
        }

        $this->artisan('db:seed');
    }
}
