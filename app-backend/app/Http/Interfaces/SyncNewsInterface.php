<?php

namespace App\Http\Interfaces;

use Illuminate\Support\Collection;

interface SyncNewsInterface
{
    public function fetchNews();

    public function saveNews(Collection $news);
}
