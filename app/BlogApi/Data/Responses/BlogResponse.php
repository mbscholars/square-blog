<?php

namespace App\BlogApi\Data\Responses;

use App\BlogApi\Data\Data;

class BlogResponse extends Data
{
    /**
     * Total Count of blog posts 
     *
     * @var string
     */
    public string $status;

    /**
     * Total Count of blog posts 
     *
     * @var string
     */
    public string $count;

    /**
     * Array of articles
     *
     * @var array
     */
    public array $articles;
}
