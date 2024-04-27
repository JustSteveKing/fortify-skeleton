<?php

declare(strict_types=1);

namespace App\Jobs\Accounts;

use App\Enums\Account\Role;
use App\Models\Member;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Database\DatabaseManager;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

final class AddUserAsMember implements ShouldQueue
{
    use Dispatchable;
    use InteractsWithQueue;
    use Queueable;
    use SerializesModels;

    public function __construct(
        public readonly string $account,
        public readonly string $user,
        public readonly Role $role,
    ) {
    }

    public function handle(DatabaseManager $database): void
    {
        $database->transaction(
            callback: fn () => Member::query()->create([
                'role' => $this->role,
                'account_id' => $this->account,
                'user_id' => $this->user,
            ]),
            attempts: 3,
        );
    }
}
