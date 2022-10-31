<?php

namespace Tests;

use Illuminate\Support\Facades\Http;

trait BlogApiHttpMocks
{
    public static function setupMocks()
    {
        $apiResponse =
            [
                "status" => "ok",
                "count" => 20,
                "articles" =>
                [
                    [
                        "id" => 12,
                        "title" => "DSM: Net Asset Value(s)",
                        "description" => "Downing Strategic Micro-Cap Investment Trust Plc LEI Code: 213800QMYPUW4POFFX69 Net Asset Values The Company announces the following, all of which is",
                        "publishedAt" => "2022-08-31T10:01:00Z"
                    ]
                ]

            ];


        Http::preventStrayRequests();
        $testingUrl = config('square-blog.api_url');

        Http::fake([
            "{$testingUrl}/api.php" => Http::response($apiResponse)
        ]);
    }
}
