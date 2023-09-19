<?php

namespace App\Http\Services\News\Providers;

use App\Http\Interfaces\SyncNewsInterface;
use Illuminate\Http\Client\RequestException;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Http;

class GuardianApiService implements SyncNewsInterface
{
    private string $url = 'https://content.guardianapis.com/search';

    private string $apiKey = '6b6a2903-c641-4420-81e4-b04c5fce12fa';

    /**
     * @throws RequestException
     */
    public function fetchNews(): ?object
    {
        $queryParams = [
            'api-key' => $this->apiKey,
        ];
        $response = Http::timeout(5)->get($this->url, $queryParams);
        $response->throwUnlessStatus(Response::HTTP_OK);
        return $response->object();
    }

    public function saveNews(object $news)
    {
    }
}
