<?php

namespace App\Http\Services\News\Sources;

use App\Enum\Sources;
use App\Http\Interfaces\SyncNewsInterface;
use App\Models\News;
use Illuminate\Http\Client\RequestException;
use Illuminate\Http\Response;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Http;

class NyTimesApiService implements SyncNewsInterface
{
    private string $url;

    private string $apiKey;

    public function __construct()
    {
        $this->url = config('news.'.Sources::NYTIMES->value.'.url');
        $this->apiKey = config('news.'.Sources::NYTIMES->value.'.api_key');
    }

    /**
     * @throws RequestException
     */
    public function fetchNews(): Collection
    {
        $queryParams = [
            'api-key' => $this->apiKey,
        ];
        $response = Http::timeout(5)->get($this->url, $queryParams);
        $response->throwUnlessStatus(Response::HTTP_OK);
        return collect($response->object()->results);
    }

    public function saveNews(Collection $news): void
    {
        $news->each(function($item) {
            News::create([
                'title' => $item->title,
                'category' => $item->section,
                'author' => $item->byline,
                'content' => $item->abstract,
                'date' => $item->published_date,
                'source' => Sources::NYTIMES
            ]);
        });
    }
}
