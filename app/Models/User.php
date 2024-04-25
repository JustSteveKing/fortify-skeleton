<?php

declare(strict_types=1);

namespace App\Models;

use Carbon\CarbonInterface;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

/**
 * @property string $id
 * @property string $name
 * @property string $email
 * @property string $password
 * @property null|string $remember_token
 * @property null|string $two_factor_secret
 * @property null|string $two_factor_recovery_codes
 * @property null|CarbonInterface $two_factor_confirmed_at
 * @property null|CarbonInterface $email_verified_at
 * @property null|CarbonInterface $created_at
 * @property null|CarbonInterface $updated_at
 * @property null|CarbonInterface $deleted_at
 */
final class User extends Authenticatable
{
    use HasFactory;
    use HasUuids;
    use Notifiable;
    use SoftDeletes;

    /** @var array<int,string> */
    protected $fillable = [
        'name',
        'email',
        'password',
        'remember_token',
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
