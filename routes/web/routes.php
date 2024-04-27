<?php

declare(strict_types=1);

use App\Http\Controllers\Web;
use Illuminate\Support\Facades\Route;

Route::as('pages:')->group(static function (): void {
    Route::middleware(['auth'])->group(static function (): void {
        Route::view('/', 'pages.index')->name('home');

        Route::prefix('settings')->as('settings:')->group(static function (): void {
            Route::view('/', 'pages.settings.profile')->name('profile');
            Route::view('avatar', 'pages.settings.avatar')->name('avatar');
            Route::view('password', 'pages.settings.password')->name('password');
            Route::view('two-factor', 'pages.settings.two-factor')->name('two-factor');
        });

        Route::prefix('accounts')->as('accounts:')->group(static function (): void {
            Route::view('/', 'pages.accounts.index')->name('index');
            Route::view('create', 'pages.accounts.create')->name('create');
            Route::get('{account}', Web\Accounts\ShowController::class)->name('show');
        });
    });

    Route::middleware(['guest'])->group(static function (): void {
    });
});

