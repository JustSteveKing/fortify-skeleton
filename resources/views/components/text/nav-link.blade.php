@props([
    'href'
])

<li @class([
    'bg-slate-200 dark:bg-slate-700 rounded-md' => request()->routeIs($href),
    'hover:bg-slate-100 dark:hover:bg-slate-800 rounded-md' => ! request()->routeIs($href),
])>
    <a wire:navigate href="{{ route($href) }}" class="group flex gap-x-3 rounded-md p-3 text-sm leading-6 font-semibold">
        {{ $slot }}
    </a>
</li>
