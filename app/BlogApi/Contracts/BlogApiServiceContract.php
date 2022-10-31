<?php

namespace App\BlogApi\Contracts;

use App\Models\BlogFeed;

interface BlogApiServiceContract
{
    /**
     * Imports Blog Posts from external api to blog feeds
     *
     * @return void
     */
    public function import(): BlogFeed;
    /**
     *Processes from feed to post
     *and count of posts processed
     * @return int 
     */
    public function process(): int;
}
