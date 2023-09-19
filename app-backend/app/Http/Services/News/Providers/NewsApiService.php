<?php

namespace App\Http\Services\News\Providers;

use App\Http\Interfaces\SyncNewsInterface;
use Illuminate\Http\Client\RequestException;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Http;

class NewsApiService implements SyncNewsInterface
{
    private string $url = 'https://newsapi.org/v2/top-headlines';

    private string $apiKey = '94e61e3d9bc243b4bb3d19942e22c5bc';

    /**
     * @throws RequestException
     */
    public function fetchNews()
    {
        $queryParams = [
            'country' => 'us',
            'apiKey' => $this->apiKey,
        ];
        $response = Http::get($this->url, $queryParams);
        $response->throwUnlessStatus(Response::HTTP_OK);
        return $response->object()->articles;
    }

    public function saveNews(object $news): void
    {
        collect($news)->each(function($new){

        });
    }
}
