<?php

declare(strict_types=1);

namespace App\Livewire;

use App\Http\Integrations\Unavatar\Provider;
use App\Http\Integrations\Unavatar\Unavatar;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Form;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Livewire\Component;

/**
 * @property Form $form
 */
abstract class AvatarManager extends Component implements HasForms
{
    use InteractsWithForms;

    public ?string $avatar = null;

    public array $data = [];

    abstract public function submit(): void;

    public function mount(): void
    {
        $this->form->fill(
            state: [
                'provider' => Provider::Email,
                'identifier' => null,
            ],
        );
    }

    public function form(Form $form): Form
    {
        return $form->schema([
            TextInput::make('identifier')->label('Identifier')->required()->columnSpan(1),
            Select::make('provider')->label('Avatar Provider')->options(Provider::class)->required(),
        ])->statePath('data');
    }

    public function preview(): void
    {
        $state = $this->form->getState();

        $this->avatar = resolve(Unavatar::class)->for(
            provider: $state['provider'],
        )->get(
            identifier: $state['identifier'],
        );
    }

    public function render(Factory $factory): View
    {
        return $factory->make(
            view: 'livewire.avatar-manager',
        );
    }
}
