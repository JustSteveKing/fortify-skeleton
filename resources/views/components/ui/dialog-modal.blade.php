@props([
    'id' => null,
    'maxWidth' => null
])

<x-ui.modal :id="$id" :maxWidth="$maxWidth" {{ $attributes }}>
    <div class="px-6 py-4">
        <div class="text-lg font-medium">
            {{ $title }}
        </div>

        <div class="mt-4 text-sm">
            {{ $content }}
        </div>
    </div>

    <div class="flex flex-row justify-end px-6 py-4 bg-slate-50 dark:bg-slate-900 text-end">
        {{ $footer }}
    </div>
</x-ui.modal>
