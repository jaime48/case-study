<?php

namespace App\Http\Services\News\Sources;

use App\Enum\Sources;
use App\Http\Interfaces\SyncNewsInterface;
use App\Models\News;
use Illuminate\Http\Client\RequestException;
use Illuminate\Http\Response;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Http;

class GuardianApiService implements SyncNewsInterface
{
    private string $url;

    private string $apiKey;

    public function __construct()
    {
        $this->url = config('news.'.Sources::GUARDIAN->value.'.url');
        $this->apiKey = config('news.'.Sources::GUARDIAN->value.'.api_key');
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
        return collect($response->object()->response->results);
    }

    public function saveNews(Collection $news): void
    {
        $news->each(function($item) {
            News::create([
                'title' => $item->webTitle,
                'category' => $item->sectionId,
                'content' => $item->webUrl,
                'date' => $item->webPublicationDate,
                'source' => Sources::GUARDIAN
            ]);
        });
    }
}
