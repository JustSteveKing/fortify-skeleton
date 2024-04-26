<?php

declare(strict_types=1);

namespace App\Livewire\Settings;

use Filament\Forms\Components\TextInput;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Form;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Laravel\Fortify\Contracts\UpdatesUserPasswords;
use Livewire\Component;

/**
 * @property Form $form
 */
final class PasswordForm extends Component implements HasForms
{
    use InteractsWithForms;

    public array $data = [];

    public function mount(): void
    {
        $this->form->fill();
    }

    public function form(Form $form): Form
    {
        return $form->schema([
            TextInput::make('current_password')->label('Current Password')->password()->required()->maxLength(255)->revealable(),
            TextInput::make('password')->label('New Password')->password()->required()->maxLength(255)->revealable(),
            TextInput::make('password_confirmation')->label('Confirm New Password')->password()->required()->maxLength(255)->revealable(),
        ])->statePath(
            path: 'data',
        );
    }

    public function submit(UpdatesUserPasswords $action): void
    {
        $action->update(
            user: auth()->user(),
            input: $this->form->getState(),
        );

        $this->redirect(
            url: route('pages:settings:profile'),
        );
    }

    public function render(Factory $factory): View
    {
        return $factory->make(
            view: 'livewire.settings.password-form',
        );
    }
}
