<x-guest
    title="Login"
    message="Sign into your account"
>
    <livewire:auth.login-form />

    <x-slot:actions>
        Not a member?
        <x-text.link wire:navigate href="{{ route('register') }}" title="Create a free account">
            Create a free account
        </x-text.link>
    </x-slot:actions>
</x-guest>
