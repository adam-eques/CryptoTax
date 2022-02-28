@props([
    'tag' => ''
])

@php
    $att = $attributes->merge([
        'class' => ''
    ]);
@endphp

<{{ $tag }} {{ $att }}>
</{{ $tag }}>