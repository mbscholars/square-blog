<?php

namespace App\Interface;

interface UrlCacheInterface
{
    public function retrieve(string $key, string $page): mixed;
    public function set(string $key, mixed $item, string $page): bool;
    public function clear(string $page): void;
}
