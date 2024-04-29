@props([
    'title',
    'src',
])

<div class="h-full flex items-center justify-between space-x-5 px-2 sm:px-6 lg:px-8">
    <div class="flex items-center space-x-5">
        <div class="flex-shrink-0">
            <div class="relative">
                <x-ui.avatar src="{{ $src }}" alt="{{ $title }}" />
                <span class="absolute inset-0 rounded-full shadow-inner" aria-hidden="true"></span>
            </div>
        </div>
        <div>
            <h1 class="text-2xl font-bold">{{ $title }}</h1>
        </div>
    </div>
    <div class="mt-6 flex flex-col-reverse justify-stretch space-y-4 space-y-reverse sm:flex-row-reverse sm:justify-end sm:space-x-3 sm:space-y-0 sm:space-x-reverse md:mt-0 md:flex-row md:space-x-3">
        <button type="button" class="inline-flex items-center justify-center rounded-md bg-white px-3 py-2 text-sm font-semibold text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 hover:bg-gray-50">Disqualify</button>
        <button type="button" class="inline-flex items-center justify-center rounded-md bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Advance to offer</button>
    </div>
</div>
