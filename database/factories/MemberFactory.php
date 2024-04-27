<?php

declare(strict_types=1);

namespace Database\Factories;

use App\Enums\Account\Role;
use App\Models\Account;
use App\Models\Member;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Database\Eloquent\Model;

final class MemberFactory extends Factory
{
    /** @var class-string<Model> */
    protected $model = Member::class;

    /** @return array<string,mixed> */
    public function definition(): array
    {
        return [
            'role' => $this->faker->randomElement(Role::cases()),
            'account_id' => Account::factory(),
            'user_id' => User::factory(),
        ];
    }
}
