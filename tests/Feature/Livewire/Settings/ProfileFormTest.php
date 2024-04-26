<?php

use App\Livewire\Settings\ProfileForm;
use Livewire\Livewire;

it('renders successfully', function () {
    Livewire::test(ProfileForm::class)
        ->assertStatus(200);
});
