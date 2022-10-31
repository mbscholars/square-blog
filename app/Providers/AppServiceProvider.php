<?php

namespace App\Providers;

use App\BlogApi\BlogApiService;
use App\Repositories\BlogRepository;
use Illuminate\Support\Facades\Http;

use Illuminate\Support\ServiceProvider;
use App\BlogApi\Adapters\BlogApiAdapter;
use App\BlogApi\Contracts\BlogApiAdapterContract;
use App\Helper\UrlCache;
use App\Interface\UrlCacheInterface;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(BlogApiAdapterContract::class, BlogApiAdapter::class);

        $this->app->bind('BlogApi', function () {
            return new BlogApiService(
                app(BlogApiAdapterContract::class)
            );
        });


        $this->app->bind('Blog', function () {
            return new BlogRepository();
        });

        /** HANDLE PAGE CACHING FOR SPECIFIED URLS */
        $this->app->bind(UrlCacheInterface::class, UrlCache::class);

        $this->app->singleton('UrlCache', UrlCacheInterface::class);
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerHttpMacros();
    }

    public function registerHttpMacros()
    {
        $apiUrl = config('square-blog.api_url');

        Http::macro('blogApi', function () use ($apiUrl) {
            return Http::withoutVerifying()->baseUrl("{$apiUrl}");
        });
    }
}
