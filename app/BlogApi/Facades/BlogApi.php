<?php

namespace App\BlogApi\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @method static return int import() 
 * 
 */
class BlogApi extends Facade
{

    protected static function getFacadeAccessor(): string
    {
        return 'BlogApi';
    }
}
