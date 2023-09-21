<?php

namespace App\Http\Controllers;

use App\Http\Services\Users\PreferenceService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController
{
    /**
     * @param Request $request
     * @param PreferenceService $preferenceService
     * @return void
     */
    public function setUserPreference(Request $request, PreferenceService $preferenceService): void
    {
        $user = Auth::guard('sanctum')->user();
        $preferenceService->setPreference($user, collect($request->all()));
    }
}
