@props(['title' => config('app.name')])

<x-page title="{{ $title }}">
    <div class="h-full" x-data="{ open: false }" @keydown.window.escape="open = false">
        <div x-show="open" class="relative z-50 lg:hidden" x-ref="dialog" aria-modal="true" x-cloak>
            <div x-show="open" x-transition:enter="transition-opacity ease-linear duration-300" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100" x-transition:leave="transition-opacity ease-linear duration-300" x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0" class="fixed inset-0 bg-slate-50/80 dark:bg-slate-900/80" x-cloak></div>
            <div class="fixed inset-0 flex">
                <div x-show="open" x-transition:enter="transition ease-in-out duration-300 transform" x-transition:enter-start="-translate-x-full" x-transition:enter-end="translate-x-0" x-transition:leave="transition ease-in-out duration-300 transform" x-transition:leave-start="translate-x-0" x-transition:leave-end="-translate-x-full" class="relative mr-16 flex w-full max-w-xs flex-1" @click.away="open = false" x-cloak>
                    <div x-show="open" x-transition:enter="ease-in-out duration-300" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100" x-transition:leave="ease-in-out duration-300" x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0" class="absolute left-full top-0 flex w-16 justify-center pt-5" x-cloak>
                        <button type="button" class="-m-2.5 p-2.5" @click="open = false">
                            <span class="sr-only">Close sidebar</span>
                            <x-icons.close class="h-6 w-6" />
                        </button>
                    </div>
                    <div class="flex grow flex-col gap-y-5 overflow-y-hidden bg-slate-50 dark:bg-slate-900 px-6 pb-2 ring-1 ring-slate-900/10 dark:ring-slate-50/10">
                        <div class="flex h-16 shrink-0 items-center">
                            <x-icons.code class="h-8 w-auto" />
                        </div>
                        <nav class="flex flex-1 flex-col">
                            <ul role="list" class="-mx-2 flex-1 space-y-1">
                                <li class="hover:bg-slate-100 dark:hover:bg-slate-800">
                                    <a href="#" class="group flex gap-x-3 rounded-md p-2 text-sm leading-6 font-semibold">
                                        <x-icons.home class="h-6 w-6 shrink-0" />
                                        Dashboard
                                    </a>
                                </li>
                            </ul>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
        <div class="hidden lg:fixed lg:inset-y-0 lg:left-0 lg:z-50 lg:block lg:w-20 lg:overflow-y-hidden lg:bg-slate-50 dark:lg:bg-slate-900 lg:pb-4 border-r border-slate-200 dark:border-slate-950">
            <div class="flex h-16 shrink-0 items-center justify-center">
                <x-icons.code class="h-8 w-auto" />
            </div>
            <nav class="h-full my-24">
                <ul role="list" class="flex flex-col items-center h-full space-y-16">
                    <x-text.nav-link href="pages:home">
                        <x-icons.home class="h-6 w-6 shrink-0" />
                        <span class="sr-only">Dashboard</span>
                    </x-text.nav-link>
                </ul>
            </nav>
        </div>
        <div class="lg:pl-20">
            <div class="sticky top-0 z-40 flex h-16 shrink-0 items-center gap-x-4 border-b border-slate-200 dark:border-slate-950 bg-slate-50 dark:bg-slate-900 px-4 shadow-sm sm:gap-x-6 sm:px-6 lg:px-8">
                <button type="button" class="-m-2.5 p-2.5 lg:hidden" @click="open = true">
                    <span class="sr-only">Open sidebar</span>
                    <x-icons.menu class="h-6 w-6" />
                </button>
                <div class="h-6 w-px bg-slate-900/10 dark:bg-slate-50/10 lg:hidden" aria-hidden="true"></div>
                <div class="flex flex-1 gap-x-4 self-stretch lg:gap-x-6">
                    <div class="relative flex flex-1"></div>
                    <div class="flex items-center gap-x-4 lg:gap-x-6">
                        <div class="hidden lg:block lg:h-6 lg:w-px lg:bg-slate-900/10 dark:lg:bg-slate-50/10" aria-hidden="true"></div>
                        <livewire:account.user-menu />
                    </div>
                </div>
            </div>

            <main>
                {{ $slot }}
            </main>
        </div>
    </div>

    <livewire:command-palette />
</x-page>
