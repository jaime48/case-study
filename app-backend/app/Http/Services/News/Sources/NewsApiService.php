<?php

namespace App\Http\Services\News\Sources;

use App\Enum\Sources;
use App\Http\Interfaces\SyncNewsInterface;
use App\Models\News;
use Illuminate\Http\Client\RequestException;
use Illuminate\Http\Response;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Http;

class NewsApiService implements SyncNewsInterface
{
    private string $url;

    private string $apiKey;

    public function __construct()
    {
        $this->url = config('news.'.Sources::NEWSAPI->value.'.url');
        $this->apiKey = config('news.'.Sources::NEWSAPI->value.'.api_key');
    }

    /**
     * @return Collection
     * @throws RequestException
     */
    public function fetchNews(): Collection
    {
        $queryParams = [
            'country' => 'us',
            'language' => 'en',
            'apiKey' => $this->apiKey,
        ];
        $response = Http::timeout(5)->get($this->url, $queryParams);
        $response->throwUnlessStatus(Response::HTTP_OK);
        return collect($response->object()->articles);
    }

    /**
     * @param object $news
     * @return void
     */
    public function saveNews(object $news): void
    {
        $news->each(function ($item) {
            News::create([
                'title' => $item->title,
                'author' => $item->author,
                'content' => $item->content,
                'date' => $item->publishedAt,
                'source' => Sources::NEWSAPI
            ]);
        });
    }
}
