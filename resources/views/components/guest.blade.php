@props(['title' => config('app.name'), 'message','actions'])

<x-page :title="$title">
    <div class="flex min-h-full flex-1 flex-col justify-center py-12 sm:px-6 lg:px-8">
        <div class="w-full flex items-center justify-center space-x-4">
            <x-icons.code class="h-10 w-auto" />
            <x-text.h2>{{ $message }}</x-text.h2>
        </div>

        <div class="mt-10 sm:mx-auto sm:w-full sm:max-w-2xl">
            <div class="px-6 py-12 sm:px-12">
                {{ $slot }}
            </div>

            @isset($actions)
                <div class="mt-10 text-center text-sm">
                    {{ $actions }}
                </div>
            @endisset
        </div>
    </div>
</x-page>
