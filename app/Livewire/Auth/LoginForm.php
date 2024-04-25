<?php

declare(strict_types=1);

namespace App\Livewire\Auth;

use Filament\Forms\Components\TextInput;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Form;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Validation\ValidationException;
use Livewire\Component;

/**
 * @property Form $form
 */
final class LoginForm extends Component implements HasForms
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
            TextInput::make('email')
                ->label('Email Address')
                ->placeholder('jon.snow@thewall.dev')
                ->email()
                ->required()
                ->maxLength(255),
            TextInput::make('password')
                ->label('Password')
                ->placeholder('super-secret-password')
                ->password()
                ->required()
                ->maxLength(255),
        ])->statePath(
            path: 'data',
        );
    }

    public function submit(): void
    {
        if ( ! auth()->attempt($this->form->getState(), true)) {
            throw ValidationException::withMessages([
                'email' => 'Invalid credentials.',
            ]);
        }

        $this->redirect(
            url: route('pages:home'),
        );
    }

    public function render(Factory $factory): View
    {
        return $factory->make(
            view: 'livewire.auth.login-form',
        );
    }
}
