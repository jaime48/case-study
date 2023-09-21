<?php

namespace App\Http\Controllers;

use App\Enum\Sources;
use App\Http\Requests\NewsListRequest;
use App\Http\Resources\NewsResource;
use App\Http\Services\Users\PreferenceService;
use App\Models\News;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Support\Facades\Auth;

class NewsController
{
    /**
     * @param NewsListRequest $request
     * @param PreferenceService $preferenceService
     * @return AnonymousResourceCollection
     */
    public function list(NewsListRequest $request, PreferenceService $preferenceService): AnonymousResourceCollection
    {
        $query = News::query();
        if ($request->categories) {
            $query = $query->category($request->categories);
        }
        if ($request->keyword) {
            $query = $query->keyword($request->keyword);
        }
        if ($request->sources) {
            $query = $query->source($request->sources);
        }
        if ($request->date) {
            $query = $query->date($request->date);
        }

        //todo add proper paginate
        $news = $query->limit(10)->get();

        if (Auth::guard('sanctum')->check()) {
            $user = Auth::guard('sanctum')->user();
            $news = $preferenceService->filterByPreference($user, $news);
        }

        return NewsResource::collection($news);
    }

    /**
     * @return JsonResponse
     */
    public function getCategories(): JsonResponse
    {
        $categories = News::distinct('category')->whereNotNull('category')->pluck('category');
        return response()->json(['categories' => $categories]);
    }

    /**
     * @return JsonResponse
     */
    public function getAuthors(): JsonResponse
    {
        $authors = News::distinct('author')->whereNotNull('author')->pluck('author');
        return response()->json(['authors' => $authors]);
    }

    /**
     * @return JsonResponse
     */
    public function getSources(): JsonResponse
    {
        return response()->json(['sources' => Sources::cases()]);
    }
}
