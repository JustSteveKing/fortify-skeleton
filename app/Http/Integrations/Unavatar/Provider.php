<?php

declare(strict_types=1);

namespace App\Http\Integrations\Unavatar;

enum Provider: string
{
    case DeviantArt = 'deviantart';
    case Dribbble = 'dribbble';
    case DuckDuckGo = 'duckduckgo';
    case Email = 'email';
    case GitHub = 'github';
    case Google = 'google';
    case Gravatar = 'gravatar';
    case Instagram = 'instagram';
    case Microlink  = 'microlink';
    case ReadCV = 'readcv';
    case Reddit = 'reddit';
    case SoundCloud = 'soundcloud';
    case Substack = 'substack';
    case Telegram = 'telegram';
    case Twitter = 'twitter';
    case YouTube = 'youtube';
}
