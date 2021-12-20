@props([
    'id',
    'amount',
    'title',
    'increase',
    'incdecamount'
])

<div class="border rounded-lg my-3 sm:my-0">
    <div class="w-full px-3 py-2">
        <div class="flex items-center space-x-2 justify-between">
            <h1 class="text-xl text-primary font-extrabold">${{ $amount }}</h1>
            @if ($increase)                
                <x-badge variant="success" size='sm' type='rounded'>+{{ $incdecamount }}%</x-badge>               
            @else
                <x-badge variant="danger" size='sm' type='rounded'>-{{ $incdecamount }}%</x-badge>
            @endif
        </div>
        <p class="text-xs text-primary">{{ $title }}</p>
    </div>
    <div id="{{ $id }}" class="-mt-4 -mb-5"></div>
</div>