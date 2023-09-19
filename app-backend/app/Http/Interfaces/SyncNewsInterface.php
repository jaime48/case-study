<?php

namespace App\Http\Interfaces;

interface SyncNewsInterface
{
    public function fetchNews();

    public function saveNews(object $news);
}
