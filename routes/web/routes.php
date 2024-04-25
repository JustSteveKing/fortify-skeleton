<?php

declare(strict_types=1);

use Illuminate\Support\Facades\Route;

Route::as('pages:')->group(static function (): void {
    Route::middleware(['auth'])->group(static function (): void {
        Route::view('/', 'pages.index')->name('home');
    });

    Route::middleware(['guest'])->group(static function (): void {
    });
});

