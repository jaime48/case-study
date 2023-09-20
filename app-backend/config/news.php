<?php

use App\Enum\Sources;

return [
   Sources::GUARDIAN->value => [
       'url' => 'https://content.guardianapis.com/search',
       'api_key' => '6b6a2903-c641-4420-81e4-b04c5fce12fa'
    ],
    Sources::NEWSAPI->value => [
        'url' => 'https://newsapi.org/v2/top-headlines',
        'api_key' => '94e61e3d9bc243b4bb3d19942e22c5bc'
    ],
    Sources::NYTIMES->value => [
        'url' => 'https://api.nytimes.com/svc/mostpopular/v2/viewed/1.json',
        'api_key' => '7SMOARdodJP4NcaEYIDvjjLGIcmFuiTl'
    ],
];
