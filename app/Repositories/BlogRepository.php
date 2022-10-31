<?php

namespace App\Repositories;

use App\Enums\CachedPages;
use App\Facade\UrlCache;
use Illuminate\Pagination\LengthAwarePaginator;
use App\Models\Post;
use Illuminate\Pipeline\Pipeline;
use App\Http\Filters\Post\{
    AuthorFilter,
    CategoryFilter,
    IDFilter,
    Sort,
    StatusFilter
};

class BlogRepository extends PostRepository
{
    public function index($cacheKey): LengthAwarePaginator
    {

        $key = cached_url_identifier($cacheKey);

        $posts = UrlCache::retrieve($key, $cacheKey);

        if ($posts != null) {
            return $posts;
        }

        $posts =  app(Pipeline::class)
            ->send(Post::query()->with('category'))
            ->through([
                AuthorFilter::class,
                CategoryFilter::class,
                IDFilter::class,
                StatusFilter::class,
                Sort::class,
                /** Leave for future sorting logic */
            ])->thenReturn()
            ->orderBy('created_at', 'desc')
            ->paginate(config('square-blog.per-page'));

        UrlCache::set($key, $posts, $cacheKey);

        return $posts;
    }
}
