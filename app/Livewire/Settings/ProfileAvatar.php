<?php

declare(strict_types=1);

namespace App\Livewire\Settings;

use App\Livewire\AvatarManager;

final class ProfileAvatar extends AvatarManager
{
    public function submit(): void
    {
        auth()->user()->update([
            'avatar' => $this->avatar,
        ]);

        $this->dispatch('profile-updated');

        $this->reset();
    }
}
