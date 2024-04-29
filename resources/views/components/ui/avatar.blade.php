@props([
    'src',
    'alt',
])

<img
    {!! $attributes->merge([
        'class' => "h-16 w-auto rounded-full"
    ]) !!}
    src="{{ $src }}"
    alt="{{ $alt }}"
/>
