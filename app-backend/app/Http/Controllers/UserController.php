<?php

namespace App\Http\Controllers;

use App\Http\Requests\PreferenceSettingRequest;
use App\Http\Services\Users\PreferenceService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController
{
    /**
     * @param PreferenceSettingRequest $request
     * @param PreferenceService $preferenceService
     * @return void
     */
    public function setUserPreference(PreferenceSettingRequest $request, PreferenceService $preferenceService): void
    {
        $user = Auth::guard('sanctum')->user();
        $preferenceService->setPreference($user, collect($request->all()));
    }
}
