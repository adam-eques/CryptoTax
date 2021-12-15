@props(['active'])

@php
$classes = ($active ?? false)
            ? 'border py-2 px-4 text-sm font-bold bg-primary hover:bg-primary text-white hover:text-white relative'
            : 'border py-2 px-4 text-sm font-bold bg-white hover:bg-primary text-primary hover:text-white relative';
@endphp

<button {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
    @if ($active)        
        <img src="{{ asset('assets/img/icon/dashboard/arrow.png') }}" class="w-7 h-5 absolute top-7 left-3"/>
    @endif
</button>