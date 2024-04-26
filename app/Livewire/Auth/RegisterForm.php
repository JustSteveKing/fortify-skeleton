<?php

declare(strict_types=1);

namespace App\Livewire\Auth;

use function event;

use Filament\Forms\Components\TextInput;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Form;
use Illuminate\Auth\AuthManager;
use Illuminate\Auth\Events\Registered;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Laravel\Fortify\Contracts\CreatesNewUsers;
use Livewire\Component;

/**
 * @property Form $form
 */
final class RegisterForm extends Component implements HasForms
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
            TextInput::make('name')
                ->label('Name')
                ->placeholder('Jon Snow')
                ->required()
                ->string()
                ->maxLength(255),
            TextInput::make('email')
                ->label('Email Address')
                ->placeholder('jon.snow@thewall.dev')
                ->required()
                ->email()
                ->maxLength(255),
            TextInput::make('password')
                ->label('Password')
                ->placeholder('super-secret-password')
                ->required()
                ->password()
                ->revealable()
                ->maxLength(255),
            TextInput::make('password_confirmation')
                ->label('Password Confirmation')
                ->placeholder('super-secret-password')
                ->required()
                ->password()
                ->revealable()
                ->maxLength(255),
        ])->statePath(
            path: 'data'
        );
    }

    public function submit(CreatesNewUsers $action, AuthManager $auth): void
    {
        $user = $action->create(
            input: $this->form->getState(),
        );

        event(new Registered($user));

        $auth->login(
            user: $user,
        );

        $this->redirect(
            url: route('pages:home'),
        );
    }

    public function render(Factory $factory): View
    {
        return $factory->make(
            view: 'livewire.auth.register-form',
        );
    }
}
