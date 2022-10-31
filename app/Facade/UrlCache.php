<?php

namespace App\Facade;

use Illuminate\Support\Facades\Facade;


/**
 *  @method static mixed retrieve(string $key, string $page)
 *  @method static bool set(string $key, mixed $item, string $page)
 *  @method static void clear(string $page)
 */

class UrlCache extends Facade
{

    protected static function getFacadeAccessor(): string
    {
        return 'UrlCache';
    }
}
