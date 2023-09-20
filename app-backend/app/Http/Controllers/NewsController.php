<?php

namespace App\Http\Controllers;

use App\Enum\Sources;
use App\Http\Requests\NewsListRequest;
use App\Http\Resources\NewsResource;
use App\Models\News;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Support\Facades\Auth;

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

        $news = $query->limit(20)->get();

        if (Auth::guard('sanctum')->check()) {
            $user = Auth::guard('sanctum')->user();
            //todo filter by preferences
        }
        //todo add proper paginate
        return NewsResource::collection($news);
    }

    public function getCategories(): JsonResponse
    {
        $categories = News::distinct('category')->whereNotNull('category')->pluck('category');
        return response()->json(['categories' => $categories]);
    }

    public function getAuthors(): JsonResponse
    {
        $authors = News::distinct('author')->whereNotNull('author')->pluck('author');
        return response()->json(['authors' => $authors]);
    }

    public function getSources(): JsonResponse
    {
        return response()->json(['sources' => Sources::cases()]);
    }
}
