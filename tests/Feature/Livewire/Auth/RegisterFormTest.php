<?php

use App\Livewire\Auth\RegisterForm;
use Livewire\Livewire;

it('renders successfully', function () {
    Livewire::test(RegisterForm::class)
        ->assertStatus(200);
});
