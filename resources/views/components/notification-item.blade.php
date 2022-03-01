@props([
    'type' => 'success',
    'title' => '',
    'content' => ''
])

@php
    switch($type) {
        case 'success': $icon = 'bi-check-circle'; $typeClass = 'bg-success-50'; $iconClass = 'text-success'; break;
        case 'warning': $icon = 'fluentui-warning-24-o'; $typeClass = 'bg-warning-50'; $iconClass = 'text-warning'; break;
        case 'inform': $icon = 'fluentui-info-20-o'; $typeClass = 'bg-green-50'; $iconClass = 'text-green-700'; break;
        case 'error': $icon = 'radix-cross-circled'; $typeClass = 'bg-danger-50'; $iconClass = 'text-danger'; break;
    }

@endphp

<div {{ $attributes->merge(['class' => 'w-full flex items-center border rounded-lg justify-between ']) }}>
    <div class="flex items-center">
        <div class="h-full sm:rounded-l-lg py-6 px-6 {{ $typeClass }}">
            <x-icon name='{{ $icon }}' class="{{ $iconClass }} w-6 h-6"/>
        </div>
        <p class="ml-6 text-gray-400"><span class="mr-2 font-bold text-primary">{{ __($title) }}</span>{{ __($content) }}</p>
    </div>
    <button class="mr-4">
        <x-icon name='ri-close-circle-fill' class="w-5 h-5 text-gray-300 hover:text-primary"/>
    </button>
</div>