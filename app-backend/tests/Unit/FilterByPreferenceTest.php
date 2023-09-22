<?php

namespace Tests\Unit;

use App\Http\Services\Users\PreferenceService;
use App\Models\User;
use App\Models\UserPreference;
use Mockery;
use Tests\TestCase;

class FilterByPreferenceTest extends TestCase
{
    public function tearDown(): void
    {
        parent::tearDown();
        Mockery::close();
    }

    /**
     * @dataProvider newsDataProvider
     */
    public function test_filter_by_preference($userCategories, $userSources, $userAuthors, $expectedCategories)
    {
        $user = Mockery::mock(User::class);
        $userPreference = new UserPreference();
        $user->shouldReceive('getAttribute')->with('userPreference')->andReturn($userPreference);
        $user->userPreference->category = $userCategories;
        $user->userPreference->source = $userSources;
        $user->userPreference->author = $userAuthors;

        $news = collect([
            (object)['category' => 'Sports', 'source' => 'CNN', 'author' => 'JohnDoe'],
            (object)['category' => 'Technology', 'source' => 'BBC', 'author' => 'JaneDoe'],
            (object)['category' => 'Politics', 'source' => 'NY Times', 'author' => 'JohnSmith'],
        ]);

        $service = new PreferenceService();
        $filteredNews = $service->filterByPreference($user, $news);

        $filteredCategories = $filteredNews->pluck('category')->toArray();

        $this->assertEquals($expectedCategories, $filteredCategories);
    }

    public static function newsDataProvider(): array
    {
        return [
            ["Sports,Technology", "CNN,BBC", "JohnDoe,JaneDoe", ["Sports", "Technology"]],
            ["Sports", "CNN", "JohnDoe", ["Sports"]],
            ["Technology", "BBC", "JaneDoe", ["Technology"]],
            ["Politics", "NY Times", "JohnSmith", ["Politics"]],
        ];
    }
}
