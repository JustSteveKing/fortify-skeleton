<x-guest
    title="Register"
    message="Create a free account"
>
    <livewire:auth.register-form />

    <x-slot:actions>
        Have an account?
        <x-text.link wire:navigate href="{{ route('login') }}" title="Sign into your account">
            Sign into your account
        </x-text.link>
    </x-slot:actions>
</x-guest>
