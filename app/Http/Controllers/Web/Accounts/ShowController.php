<?php

declare(strict_types=1);

namespace App\Http\Controllers\Web\Accounts;

use App\Http\Controllers\Concerns\HasView;
use App\Models\Account;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

final class ShowController
{
    use HasView;

    public function __invoke(Request $request, Account $account): View
    {
        // is this user a member of this account

        return $this->factory->make(
            view: 'pages.accounts.show',
            data: [
                'account' => $account,
            ],
        );
    }
}
