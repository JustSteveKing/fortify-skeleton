<?php

declare(strict_types=1);

namespace App\Models;

use Carbon\CarbonInterface;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Fortify\TwoFactorAuthenticatable;

/**
 * @property string $id
 * @property string $name
 * @property string $email
 * @property string $password
 * @property null|string $remember_token
 * @property null|string $avatar
 * @property null|string $two_factor_secret
 * @property null|string $two_factor_recovery_codes
 * @property null|CarbonInterface $two_factor_confirmed_at
 * @property null|CarbonInterface $email_verified_at
 * @property null|CarbonInterface $created_at
 * @property null|CarbonInterface $updated_at
 * @property null|CarbonInterface $deleted_at
 * @property Collection<Account> $accounts
 * @property Collection<Member> $memberships
 */
final class User extends Authenticatable implements MustVerifyEmail
{
    use HasFactory;
    use HasUuids;
    use Notifiable;
    use SoftDeletes;
    use TwoFactorAuthenticatable;

    /** @var array<int,string> */
    protected $fillable = [
        'name',
        'email',
        'password',
        'remember_token',
        'avatar',
        'two_factor_secret',
        'two_factor_recovery_codes',
        'two_factor_confirmed_at',
        'email_verified_at',
    ];

    /** @var array<int,string> */
    protected $hidden = [
        'password',
        'remember_token',
        'two_factor_secret',
        'two_factor_recovery_codes',
    ];

    /** @return HasMany */
    public function accounts(): HasMany
    {
        return $this->hasMany(
            related: Account::class,
            foreignKey: 'user_id',
        );
    }

    /** @return HasMany */
    public function memberships(): HasMany
    {
        return $this->hasMany(
            related: Member::class,
            foreignKey: 'user_id',
        );
    }

    public function image(): string
    {
        return $this->avatar ?? $this->defaultAvatar();
    }

    protected function defaultAvatar(): string
    {
        $name = trim(collect(explode(' ', $this->name))->map(fn ($segment) => mb_substr($segment, 0, 1))->join(' '));

        return 'https://ui-avatars.com/api/?name=' . urlencode($name) . '&color=7F9CF5&background=EBF4FF';
    }

    /** @return array<string,string> */
    protected function casts(): array
    {
        return [
            'two_factor_confirmed_at' => 'datetime',
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }
}
