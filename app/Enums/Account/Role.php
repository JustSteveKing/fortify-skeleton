<?php

declare(strict_types=1);

namespace App\Enums\Account;

enum Role: string
{
    case Member = 'member';
    case Admin = 'admin';
}
