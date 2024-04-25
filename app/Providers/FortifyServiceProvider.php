<?php

declare(strict_types=1);

namespace App\Providers;

use App\Actions\Fortify\CreateNewUser;
use App\Actions\Fortify\ResetUserPassword;
use App\Actions\Fortify\UpdateUserPassword;
use App\Actions\Fortify\UpdateUserProfileInformation;
use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Str;
use Laravel\Fortify\Fortify;

final class FortifyServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        $this->registerViews();
        $this->registerActions();
    }

    protected function registerViews(): void
    {
        Fortify::loginView(
            view: 'pages.auth.login',
        );
        Fortify::registerView(
            view: 'pages.auth.register',
        );
        Fortify::verifyEmailView(
            view: 'pages.auth.email',
        );
        Fortify::resetPasswordView(
            view: 'pages.auth.passwords.reset',
        );
        Fortify::requestPasswordResetLinkView(
            view: 'pages.auth.passwords.reset-link',
        );
        Fortify::confirmPasswordView(
            view: 'pages.auth.passwords.confirm',
        );
        Fortify::twoFactorChallengeView(
            view: 'pages.auth.two-factor-challenge',
        );
    }

    protected function registerActions(): void
    {
        Fortify::createUsersUsing(
            callback: CreateNewUser::class,
        );
        Fortify::updateUserProfileInformationUsing(
            callback: UpdateUserProfileInformation::class,
        );
        Fortify::updateUserPasswordsUsing(
            callback: UpdateUserPassword::class,
        );
        Fortify::resetUserPasswordsUsing(
            callback: ResetUserPassword::class,
        );
    }
}
