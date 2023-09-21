<?php

namespace App\Http\Interfaces;

use Illuminate\Support\Collection;

interface SyncNewsInterface
{
    public function fetchNews() : Collection;

    public function saveNews(Collection $news) : void;
}
