<section id="two-factor-form" aria-labelledby="two-factor-form" class="space-y-6">
    <x-text.h3 class="text-left">
        @if ($this->enabled)
            @if ($showingConfirmation)
                {{ __('Finish enabling two factor authentication.') }}
            @else
                {{ __('You have enabled two factor authentication.') }}
            @endif
        @else
            {{ __('You have not enabled two factor authentication.') }}
        @endif
    </x-text.h3>

    <div class="mt-3 max-w-xl text-sm">
        <p>
            {{ __('When two factor authentication is enabled, you will be prompted for a secure, random token during authentication. You may retrieve this token from your phone\'s Google Authenticator application.') }}
        </p>
    </div>

    @if ($this->enabled)
        @if ($showingQrCode)
            <div class="mt-4 max-w-xl text-sm">
                <p class="font-semibold">
                    @if ($showingConfirmation)
                        {{ __('To finish enabling two factor authentication, scan the following QR code using your phone\'s authenticator application or enter the setup key and provide the generated OTP code.') }}
                    @else
                        {{ __('Two factor authentication is now enabled. Scan the following QR code using your phone\'s authenticator application or enter the setup key.') }}
                    @endif
                </p>
            </div>

            <div class="mt-4 p-2 inline-block bg-white dark:bg-black">
                {!! $this->user->twoFactorQrCodeSvg() !!}
            </div>

            <div class="mt-4 max-w-xl text-sm">
                <p class="font-semibold">
                    {{ __('Setup Key') }}: {{ decrypt($this->user->two_factor_secret) }}
                </p>
            </div>

            @if ($showingConfirmation)
                <div class="mt-4">
                    <x-forms.label for="code" value="{{ __('Code') }}" />

                    <input
                        id="code"
                        type="text"
                        name="code"
                        class="block mt-1 w-1/2"
                        inputmode="numeric"
                        autofocus
                        autocomplete="one-time-code"
                        wire:model="code"
                        wire:keydown.enter="confirmTwoFactorAuthentication"
                    />

                    <x-forms.error for="code" class="mt-2" />
                </div>
            @endif
        @endif

            @if ($showingRecoveryCodes)
                <div class="mt-4 max-w-xl text-sm">
                    <p class="font-semibold">
                        {{ __('Store these recovery codes in a secure password manager. They can be used to recover access to your account if your two factor authentication device is lost.') }}
                    </p>
                </div>

                <div class="grid gap-1 max-w-xl mt-4 px-4 py-4 font-mono text-sm bg-slate-100 dark:bg-slate-900 rounded-lg">
                    @foreach (json_decode(decrypt($this->user->two_factor_recovery_codes), true) as $code)
                        <div>{{ $code }}</div>
                    @endforeach
                </div>
            @endif
    @endif

    <div class="mt-5">
        @if (! $this->enabled)
            <x-confirms-password wire:then="enableTwoFactorAuthentication">
                <x-ui.button type="button" wire:loading.attr="disabled">
                    {{ __('Enable') }}
                </x-ui.button>
            </x-confirms-password>
        @else
            @if ($showingRecoveryCodes)
                <x-confirms-password wire:then="regenerateRecoveryCodes">
                    <x-ui.button class="me-3">
                        {{ __('Regenerate Recovery Codes') }}
                    </x-ui.button>
                </x-confirms-password>
            @elseif ($showingConfirmation)
                <x-confirms-password wire:then="confirmTwoFactorAuthentication">
                    <x-ui.button type="button" class="me-3" wire:loading.attr="disabled">
                        {{ __('Confirm') }}
                    </x-ui.button>
                </x-confirms-password>
            @else
                <x-confirms-password wire:then="showRecoveryCodes">
                    <x-ui.button class="me-3">
                        {{ __('Show Recovery Codes') }}
                    </x-ui.button>
                </x-confirms-password>
            @endif

            @if ($showingConfirmation)
                <x-confirms-password wire:then="disableTwoFactorAuthentication">
                    <x-ui.button wire:loading.attr="disabled">
                        {{ __('Cancel') }}
                    </x-ui.button>
                </x-confirms-password>
            @else
                <x-confirms-password wire:then="disableTwoFactorAuthentication">
                    <x-ui.button wire:loading.attr="disabled">
                        {{ __('Disable') }}
                    </x-ui.button>
                </x-confirms-password>
            @endif

        @endif
    </div>
</section>
