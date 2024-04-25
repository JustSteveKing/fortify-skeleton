@props(['href','title'])

<a {{ $attributes->merge(['class' => 'font-semibold leading-6 text-indigo-600 hover:text-indigo-500']) }} href="{{ $href }}" title="{{ $title }}">
    {{ $slot }}
</a>
