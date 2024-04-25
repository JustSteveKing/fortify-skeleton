<?php

declare(strict_types=1);

namespace App\Http\Integrations\Unavatar;

final class Unavatar
{
    public function __construct(
        private readonly string $url,
        private Provider $provider = Provider::Email,
    ) {
    }

    public function for(Provider $provider): Unavatar
    {
        $this->provider = $provider;

        return $this;
    }

    public function get(string $identifier): ?string
    {
        $url = sprintf(
            '%s/%s/%s',
            $this->url,
            $this->provider->value,
            $identifier
        );

        $response = Http::head(
            url: $url,
        );

        return $response->successful() ? $url : null;
    }
}
