<?php

namespace App\Http\Services\News\Providers;

use App\Http\Interfaces\SyncNewsInterface;
use Illuminate\Http\Client\RequestException;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Http;

class NyTimesApiService implements SyncNewsInterface
{
    private string $url = 'https://api.nytimes.com/svc/mostpopular/v2/viewed/1.json';

    private string $apiKey = '7SMOARdodJP4NcaEYIDvjjLGIcmFuiTl';

    /**
     * @throws RequestException
     */
    public function fetchNews()
    {
        $queryParams = [
            'api-key' => $this->apiKey,
        ];
        $response = Http::get($this->url, $queryParams);
        $response->throwUnlessStatus(Response::HTTP_OK);
        return $response->object()->results;
    }

    public function saveNews(object $news): void
    {
        collect($news)->each(function($new){

        });
    }
}
