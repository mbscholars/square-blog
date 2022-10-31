<?php

namespace App\BlogApi\Contracts;


interface BlogApiAdapterContract
{
    /**
     * Returns post
     * @return array|null
     */
    public function getPosts(): ?array;
}
