@props([
    'type' => 'success',
    'title' => '',
    'content' => ''
])

@php
    switch($type) {
        case 'success': $icon = 'success'; $typeClass = 'bg-success-50'; $iconClass = 'text-success'; break;
        case 'warning': $icon = 'warning'; $typeClass = 'bg-warning-50'; $iconClass = 'text-warning'; break;
        case 'inform': $icon = 'inform'; $typeClass = 'bg-green-50'; $iconClass = 'text-green-700'; break;
        case 'error': $icon = 'cross-circle'; $typeClass = 'bg-danger-50'; $iconClass = 'text-danger'; break;
    }

@endphp

<div {{ $attributes->merge(['class' => 'w-full flex items-center border rounded-lg justify-between ']) }}>
    <div class="flex items-center">
        <div class="h-full border-r rounded-l-lg py-6 px-6 {{ $typeClass }}">
            <x-icon name='{{ $icon }}' class="{{ $iconClass }} w-6 h-6"/>
        </div>
        <p class="text-gray-400 ml-6"><span class="font-bold text-primary mr-2">{{ __($title) }}</span>{{ __($content) }}</p>
    </div>
    <button class="mr-4">
        <x-icon name='close' class="text-gray-300 hover:text-primary w-5 h-5"/>
    </button>
</div>