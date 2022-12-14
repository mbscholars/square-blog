<?php

namespace App\BlogApi\Data\Responses;

use App\Enums\PostStatus;
use App\BlogApi\Data\Data;
use App\Models\User;

class Article extends Data
{
    /**
     * Article Title
     *
     * @var string
     */
    public string $title;
    /**
     * Article Description
     *
     * @var string
     */
    public string $description;
    /**
     * Creator ID
     *
     * @var integer
     */
    public int $user_id;
    /**
     * Publication status
     *
     * @var string
     */
    public string $status = PostStatus::PUBLISHED;
    /**
     * Publication Time
     * @var string
     */
    public string $created_at;
}
