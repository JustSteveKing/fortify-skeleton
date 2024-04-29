<x-app title="Your Account | {{ $account->name }}">
    <section id="header" aria-labelledby="header" class="w-full h-32">
        <x-ui.header
            title="{{ $account->name }}"
            src="{{ $account->image() }}"
        />
    </section>

    <x-ui.container>
        <livewire:accounts.member-list
            account="{{ $account->id }}"
        />
    </x-ui.container>
</x-app>
