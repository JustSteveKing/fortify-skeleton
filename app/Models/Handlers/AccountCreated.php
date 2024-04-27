<?php

declare(strict_types=1);

namespace App\Models\Handlers;

use App\Enums\Account\Role;
use App\Jobs\Accounts\AddUserAsMember;
use App\Models\Account;

final class AccountCreated
{
    public function __construct(Account $account)
    {
        dispatch(new AddUserAsMember(
            account: $account->id,
            user: $account->user_id,
            role: Role::Admin,
        ));
    }
}
