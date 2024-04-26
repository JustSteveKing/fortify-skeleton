<?php

declare(strict_types=1);

namespace App\Livewire\Settings;

use Filament\Forms\Components\TextInput;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Form;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Laravel\Fortify\Contracts\UpdatesUserProfileInformation;
use Livewire\Component;

/**
 * @property Form $form
 */
final class ProfileForm extends Component implements HasForms
{
    use InteractsWithForms;

    public array $data = [];

    public function mount(): void
    {
        $this->form->fill([
            'name' => auth()->user()->name,
            'email' => auth()->user()->email,
        ]);
    }

    public function form(Form $form): Form
    {
        return $form->schema([
            TextInput::make('name')->label('Name')->required()->maxLength(255),
            TextInput::make('email')->label('Email')->required()->email()->maxLength(255),
        ])->statePath(
            path: 'data',
        );
    }

    public function submit(UpdatesUserProfileInformation $action): void
    {
        $action->update(
            user: auth()->user(),
            input: $this->form->getState(),
        );

        $this->dispatch('profile-updated');
    }

    public function render(Factory $factory): View
    {
        return $factory->make(
            view: 'livewire.settings.profile-form',
        );
    }
}
