<?php

use App\Livewire\Settings\PasswordForm;
use Livewire\Livewire;

it('renders successfully', function () {
    Livewire::test(PasswordForm::class)
        ->assertStatus(200);
});
