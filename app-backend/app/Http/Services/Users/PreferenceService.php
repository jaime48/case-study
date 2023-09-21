<?php

namespace App\Http\Services\Users;

use App\Models\User;
use App\Models\UserPreference;
use Illuminate\Support\Collection;

class PreferenceService
{
    /**
     * @param User $user
     * @param Collection $preferences
     * @return void
     */
    public function setPreference(User $user, Collection $preferences): void
    {
        if ($preferences->has('categories')) {
            $settings['category'] = implode(',', $preferences->get('categories'));
        }
        if ($preferences->has('sources')) {
            $settings['source'] = implode(',', $preferences->get('sources'));
        }
        if ($preferences->has('authors')) {
            $settings['author'] = implode(',', $preferences->get('authors'));
        }

        if (isset($settings)) {
            UserPreference::updateOrCreate(
                [
                    'user_id' => $user->id
                ],
                $settings
            );
        }
    }

    /**
     * @param User $user
     * @param Collection $news
     * @return Collection
     */
    public function filterByPreference(User $user, Collection $news): Collection
    {
        $preferences = $user->userPreference;
        return $news->filter(function ($item) use ($preferences) {
            if ($preferences?->category and !in_array($item->category, explode(',', $preferences->category))) {
                return false;
            }
            if ($preferences?->source and !in_array($item->source, explode(',', $preferences->source))) {
                return false;
            }
            if ($preferences?->author and !in_array($item->author, explode(',', $preferences->author))) {
                return false;
            }
            return true;
        });
    }
}
