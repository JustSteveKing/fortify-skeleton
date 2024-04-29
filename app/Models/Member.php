<?php

declare(strict_types=1);

namespace App\Models;

use App\Enums\Account\Role;
use Carbon\CarbonInterface;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @property string $id
 * @property Role $role
 * @property string $account_id
 * @property string $user_id
 * @property null|CarbonInterface $created_at
 * @property null|CarbonInterface $updated_at
 * @property Account $account
 * @property User $user
 */
final class Member extends Model
{
    use HasFactory;
    use HasUuids;

    /** @var array<int,string> */
    protected $fillable = [
        'role',
        'account_id',
        'user_id',
    ];

    public function account(): BelongsTo
    {
        return $this->belongsTo(
            related: Account::class,
            foreignKey: 'account_id',
        );
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(
            related: User::class,
            foreignKey: 'user_id',
        );
    }

    public function isAdmin(): bool
    {
        return Role::Admin === $this->role;
    }

    /** @return array<string,class-string> */
    protected function casts(): array
    {
        return [
            'role' => Role::class,
        ];
    }
}
