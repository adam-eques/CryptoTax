@props(['active'])
@php
$classes = ($active ?? false)
            ? 'rounded-full px-4 py-2 text-sm xl:text-base gap-1 xl:gap-2 bg-white text-primary inline-flex'
            : 'rounded-full px-4 py-2 text-sm xl:text-base gap-1 xl:gap-2 text-white inline-flex hover:text-primary hover:bg-white';
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</a>
