<?php

namespace App\Http\Controllers;

use App\Enum\Sources;
use App\Http\Requests\NewsListRequest;
use App\Http\Resources\NewsResource;
use App\Models\News;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class NewsController
{
    /**
     * @param NewsListRequest $request
     * @return AnonymousResourceCollection
     */
    public function list(NewsListRequest $request): AnonymousResourceCollection
    {
        $query = News::query();
        if ($request->category) {
            $query = $query->category($request->category);
        }
        if ($request->keyword) {
            $query = $query->keyword($request->keyword);
        }
        if ($request->source) {
            $query = $query->source($request->source);
        }
        if ($request->date) {
            $query = $query->date($request->date);
        }

        //todo add proper paginate
        return NewsResource::collection($query->limit(20)->get());
    }

    public function getCategories()
    {
        return News::distinct('category')->whereNotNull('category')->pluck('category');
    }

    public function getSources(Request $request)
    {
        return Sources::cases();
    }
}
