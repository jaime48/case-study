<?php

namespace App\Http\Controllers;

use App\Enum\Sources;
use App\Http\Resources\NewsResource;
use App\Models\News;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class NewsController
{
    public function list(Request $request): AnonymousResourceCollection
    {
        //todo add proper paginate
        return NewsResource::collection(News::limit(20)->get());
    }

    public function getCategories(Request $request)
    {
        return News::unique('category');
    }

    public function getSources(Request $request)
    {
        return Sources::cases();
    }
}
