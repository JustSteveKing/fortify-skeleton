@props([
    'title' => config('app.name'),
    'message',
])

<x-app title="{{ $title }}">
    <div class="grid max-w-7xl grid-cols-1 gap-x-8 gap-y-10 px-4 py-16 sm:px-6 md:grid-cols-3 lg:px-8">
        <div>
            <h2 class="text-base font-semibold leading-7">
                {{ $title }}
            </h2>
            <p class="mt-1 text-sm leading-6">
                {{ $message }}
            </p>
        </div>

        <main class="md:col-span-2">
            {{ $slot }}
        </main>
    </div>
</x-app>
