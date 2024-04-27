<?php

declare(strict_types=1);

namespace App\Livewire\Accounts;

use App\Livewire\Concerns\HasUser;
use App\Models\Account;
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
final class CreateForm extends Component implements HasForms
{
    use HasUser;
    use InteractsWithForms;

    public array $data = [];

    public function mount(): void
    {
        $this->form->fill();
    }

    public function form(Form $form): Form
    {
        return $form->schema([
            TextInput::make('name')->label('Account Name')->required()->string()->maxLength(255),
        ])->statePath(
            path: 'data',
        );
    }

    public function submit(): void
    {
        Account::query()->create(array_merge(
            $this->form->getState(),
            [
                'user_id' => $this->user()->id,
            ],
        ));

        $this->redirect(
            url: route('pages:home'),
        );
    }

    public function render(Factory $factory): View
    {
        return $factory->make(
            view: 'livewire.accounts.create-form',
        );
    }
}
