<?php

namespace App\BlogApi\Traits;



use Illuminate\Http\Client\Response;
use Illuminate\Support\Facades\Http;

trait InteractsWithApi
{
    /** @param  string  $endpoint
     * @return Response
     */
    protected static function httpGet(string $endpoint): Response
    {
        return Http::blogApi()->get($endpoint);
    }

    /**
     * @param  string  $endpoint
     * @param  array  $data
     * @return Response
     */
    protected static function httPost(string $endpoint, array $data): Response
    {
        return Http::blogApi()->post($endpoint, $data);
    }
}
