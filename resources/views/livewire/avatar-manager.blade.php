<div class="grid grid-cols-4 md:grid-cols-8 gap-x-4">
    <form class="col-span-3 md:col-span-6 space-y-6" wire:submit.prevent="submit">
        {{ $this->form }}

        <div class="w-full flex items-center justify-between space-x-4">
            <a wire:click.prevent="preview" href="#" class="flex w-full justify-center rounded-md bg-indigo-600 px-3 py-1.5 text-sm font-semibold leading-6 text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">
                Preview
            </a>
            <button type="submit" class="flex w-full justify-center rounded-md bg-indigo-600 px-3 py-1.5 text-sm font-semibold leading-6 text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">
                Save
            </button>
        </div>
    </form>

    @if ($avatar)
        <div class="col-span-1 md:col-span-2">
            <img src="{{ $avatar }}" alt="Your avatar" />
        </div>
    @endif
</div>
