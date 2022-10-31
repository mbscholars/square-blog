<?php

namespace App\BlogApi\Adapters;

use App\BlogApi\Contracts\BlogApiAdapterContract;
use App\BlogApi\Traits\InteractsWithApi;
use App\Exceptions\CouldNotConnectToApiService;

class BlogApiAdapter implements BlogApiAdapterContract
{
    use InteractsWithApi;

    public function getPosts(): array
    {
        $response = $this->httpGet($endpoint = "api.php");

        if (!$response->ok()) {
            throw new CouldNotConnectToApiService();
        }

        return $response->json();
    }
}
