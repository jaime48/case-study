<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;

class FetchNews extends Command
{
    /**
     * Sync news from different sources
     *
     * @var string
     */
    protected $signature = 'app:fetch-news';

    /**
     * @var string
     */
    protected $description = 'Command description';

    private array $syncNewsServices;

    /**
     * @return void
     */
    public function __construct(array $syncNewsServices)
    {
        parent::__construct();
        $this->syncNewsServices = $syncNewsServices;
    }

    public function handle(): void
    {
        foreach ($this->syncNewsServices as $syncNewsService) {
            try{
                $news = $syncNewsService->fetchNews();
                $syncNewsService->saveNews($news);
            } catch (\Exception $e) {
                Log::error($e);
            }
        }
    }
}
