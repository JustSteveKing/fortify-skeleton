@props(['title' => config('app.name')])

<x-app title="{{ $title }}">
    <x-ui.container>
        <div class="lg:grid lg:grid-cols-12 lg:gap-x-5">
            <aside class="px-2 py-12 sm:px-6 lg:col-span-3 lg:px-0 lg:py-12">
                <nav class="space-y-1">
                    <a
                        wire:navigate
                        href="{{ route('pages:settings:profile') }}"
                        @class([
                            'hover:bg-slate-200 dark:hover:bg-slate-700 group flex items-center rounded-md px-3 py-2 text-sm font-medium' => ! request()->routeIs('pages:settings:profile'),
                            'bg-slate-200 dark:bg-slate-700 group flex items-center rounded-md px-3 py-2 text-sm font-medium' => request()->routeIs('pages:settings:profile'),
                        ])
                    >
                        <x-icons.info class="group-hover:text-indigo-500 -ml-1 mr-3 h-6 w-6 flex-shrink-0" />
                        <span class="truncate">Profile</span>
                    </a>
                    <a
                        wire:navigate
                        href="{{ route('pages:settings:avatar') }}"
                        @class([
                            'hover:bg-slate-200 dark:hover:bg-slate-700 group flex items-center rounded-md px-3 py-2 text-sm font-medium' => ! request()->routeIs('pages:settings:avatar'),
                            'bg-slate-200 dark:bg-slate-700 group flex items-center rounded-md px-3 py-2 text-sm font-medium' => request()->routeIs('pages:settings:avatar'),
                        ])
                    >
                        <x-icons.user class="group-hover:text-indigo-500 -ml-1 mr-3 h-6 w-6 flex-shrink-0" />
                        <span class="truncate">Avatar</span>
                    </a>
                    <a
                        wire:navigate
                        href="{{ route('pages:settings:password') }}"
                        @class([
                            'hover:bg-slate-200 dark:hover:bg-slate-700 group flex items-center rounded-md px-3 py-2 text-sm font-medium' => ! request()->routeIs('pages:settings:password'),
                            'bg-slate-200 dark:bg-slate-700 group flex items-center rounded-md px-3 py-2 text-sm font-medium' => request()->routeIs('pages:settings:password'),
                        ])
                    >
                        <x-icons.security class="group-hover:text-indigo-500 -ml-1 mr-3 h-6 w-6 flex-shrink-0" />
                        <span class="truncate">Password</span>
                    </a>
                    <a
                        wire:navigate
                        href="{{ route('pages:settings:two-factor') }}"
                        @class([
                            'hover:bg-slate-200 dark:hover:bg-slate-700 group flex items-center rounded-md px-3 py-2 text-sm font-medium' => ! request()->routeIs('pages:settings:two-factor'),
                            'bg-slate-200 dark:bg-slate-700 group flex items-center rounded-md px-3 py-2 text-sm font-medium' => request()->routeIs('pages:settings:two-factor'),
                        ])
                    >
                        <x-icons.phone class="group-hover:text-indigo-500 -ml-1 mr-3 h-6 w-6 flex-shrink-0" />
                        <span class="truncate">Two-Factor Auth</span>
                    </a>
                </nav>
            </aside>

            <div {!! $attributes->merge(['class' => 'space-y-6 sm:px-6 lg:col-span-9 lg:px-0 py-12']) !!}>
                {{ $slot }}
            </div>
        </div>
    </x-ui.container>
</x-app>
