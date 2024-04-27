<?php

declare(strict_types=1);

namespace App\Livewire\Account;

use App\Models\User;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Model;
use Livewire\Attributes\Computed;
use Livewire\Attributes\On;
use Livewire\Component;

final class UserMenu extends Component
{
    #[Computed]
    public function user(): Model|User
    {
        return User::query()->with([
            'memberships.account',
        ])->find(
            id: auth()->id(),
        );
    }

    #[On('profile-updated')]
    public function refresh(): void
    {
        $this->reset();
    }

    public function logout(): void
    {
        auth()->logout();

        $this->redirect(
            url: route('login'),
        );
    }

    public function render(Factory $factory): View
    {
        return $factory->make(
            view: 'livewire.account.user-menu',
        );
    }
}
