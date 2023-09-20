<?php

namespace App\Providers;

use App\Console\Commands\FetchNews;
use App\Http\Interfaces\SyncNewsInterface;
use App\Http\Services\News\Sources\GuardianApiService;
use App\Http\Services\News\Sources\NewsApiService;
use App\Http\Services\News\Sources\NyTimesApiService;
use Illuminate\Support\Facades\App;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(SyncNewsInterface::class, function () {
            return [
                new NewsApiService(),
                new NyTimesApiService(),
                new GuardianApiService(),
            ];
        });

        $this->app->bind(FetchNews::class, function() {
            return new FetchNews(App::make(SyncNewsInterface::class));
        });
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
