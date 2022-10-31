<?php

namespace App\Helper;

use App\Interface\UrlCacheInterface;
use Illuminate\Support\Facades\Cache;

class UrlCache implements UrlCacheInterface
{

    public function retrieve(string $key, string $page): mixed
    {
        try {
            return Cache::tags($page)->get($key, null);
        } catch (\BadMethodCallException $th) {
            return Cache::get($key, null);
        } catch (\Throwable $e) {
            report($e);
        }
    }
    public function set(string $key, mixed $item, string $page): bool
    {
        try {
            Cache::tags($page)->put($key, $item);
            return true;
        } catch (\BadMethodCallException $th) {

            $list = [];
            if (Cache::has('page_' . $page)) {
                $list = Cache::get('page_' . $page, []);
            }

            $list[] = $key;
            Cache::put('page_' . $page, $list);

            Cache::put($key, $item);
            return true;
        } catch (\Throwable $e) {
            report($e);
        }
    }
    public function clear(string $page): void
    {
        try {
            Cache::tags($page)->flush();
        } catch (\BadMethodCallException $th) {
            if (!Cache::has('page_' . $page)) {
                Cache::flush();
            }
            foreach (Cache::get('page_' . $page, []) as $url) {
                Cache::forget($url);
            }
        } catch (\Throwable $th) {
            report($th);
        }
    }
}
