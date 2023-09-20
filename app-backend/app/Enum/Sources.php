<?php

namespace App\Enum;
enum Sources: string
{
    case GUARDIAN = 'guardian';
    case NEWSAPI = 'newsApi';
    case NYTIMES = 'NyTimes';
}
