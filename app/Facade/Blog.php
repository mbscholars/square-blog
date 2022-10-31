<?php

namespace App\Facade;

use Illuminate\Support\Facades\Facade;


/**
 * @method static Illuminate\Pagination\LengthAwarePaginator index($cachedPage)
 * @method static Illuminate\Pagination\LengthAwarePaginator searchPosts()
 * @method static App\Models\Post storePost(array $post)
 * @method static App\Models\Post editPost(Post $post, array $data)
 * @method static deletePost(Post $post)
 * @method static App\Models\Post viewPost(string $slug)
 */

class Blog extends Facade
{

    protected static function getFacadeAccessor(): string
    {
        return 'Blog';
    }
}
