<?php

declare(strict_types=1);

namespace App\Livewire\Concerns;

use App\Models\User;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Computed;
use Livewire\Component;

/**
 * @mixin Component
 */
trait HasUser
{
    #[Computed]
    public function user(): User|Authenticatable
    {
        return Auth::user();
    }
}
