<?php

declare(strict_types=1);

namespace App\Livewire;

use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Livewire\Attributes\On;
use Livewire\Component;

final class CommandPalette extends Component
{
    public bool $open = false;

    #[On('command-palette')]
    public function toggle(): void
    {
        $this->open = ! $this->open;
    }

    public function render(Factory $factory): View
    {
        return $factory->make(
            view: 'livewire.command-palette',
        );
    }
}
