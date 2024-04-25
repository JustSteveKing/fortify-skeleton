<?php

namespace App\Actions\Fortify;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Validation\Rules\Password;

trait PasswordValidationRules
{
    /** @return array<int,ValidationRule|array|string> */
    protected function passwordRules(): array
    {
        return ['required', 'string', Password::default(), 'confirmed'];
    }
}
