@props(['label' => '', 'balance' => 0.00, 'selected' => false])
@php
    $att = $attributes->merge([
        'class' => 'relative flex items-center justify-between px-4 py-2 space-x-2 lg:py-4 lg:px-6 hover:bg-gray-100'
    ]);
@endphp

<button {{ $att }}>
    <div class="grid items-center w-2/3 grid-cols-2 gap-3">
        <img src="{{ asset('assets/img/exchange_icon/' . $label . '.svg' ) }}" class="h-auto col-span-1 pl-4 w-36"/>
        <div class="col-span-1 space-y-1 text-left">
            <h3 class="font-semibold text-gray-700 xl:text-lg">{{ $label }}</h3>
            {{ $slot }}
        </div>
    </div>
    <p class="font-semibold text-gray-700 xl:text-xl">${{ $balance }}</p>
    @if ($selected)
        <div
            class="absolute right-0 w-2 h-full rounded-tr-sm rounded-br-sm bg-secondary-500"
            x-transition
        ></div>
    @endif
</button>