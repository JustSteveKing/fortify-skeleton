<?php

use App\Livewire\Auth\LoginForm;
use Livewire\Livewire;

it('renders successfully', function () {
    Livewire::test(LoginForm::class)
        ->assertStatus(200);
});
