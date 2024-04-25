<?php

declare(strict_types=1);

use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;

use function Laravel\Prompts\info;

Artisan::command(
    signature: 'inspire',
    callback: static fn () => info(Inspiring::quote()),
)->purpose(
    description: 'Display an inspiring quote',
)->hourly();
