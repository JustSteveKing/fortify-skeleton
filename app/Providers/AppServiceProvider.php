<?php

declare(strict_types=1);

namespace App\Providers;

use App\Http\Integrations\Unavatar\Unavatar;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\ServiceProvider;

final class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->singleton(
            abstract: Unavatar::class,
            concrete: fn (): Unavatar => new Unavatar(
                url: 'https://unavatar.io',
            ),
        );
    }

    public function boot(): void
    {
        Model::shouldBeStrict();
    }
}
