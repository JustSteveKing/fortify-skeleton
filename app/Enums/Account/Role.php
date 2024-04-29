<?php

declare(strict_types=1);

namespace App\Enums\Account;

use Filament\Support\Contracts\HasColor;
use Filament\Support\Contracts\HasLabel;

enum Role: string implements HasLabel, HasColor
{
    case Member = 'member';
    case Admin = 'admin';

    public function getLabel(): ?string
    {
        return match ($this) {
            self::Member => __('member'),
            self::Admin => __('admin'),
        };
    }

    public function getColor(): string|array|null
    {
        return match ($this) {
            self::Member => 'primary',
            self::Admin => 'info',
        };
    }
}
