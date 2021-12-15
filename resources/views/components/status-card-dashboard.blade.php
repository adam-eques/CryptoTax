@props([
    'id',
    'amount',
    'title',
    'increase',
    'incdecamount'
])

<div class="border rounded-lg">
    <div class="w-full px-3 py-2">
        <div class="flex items-center space-x-2 justify-between">
            <h1 class="text-2xl text-black font-extrabold">${{ $amount }}</h1>
            @if ($increase)                
                <x-badge variant="success" size='sm' type='rounded'>+{{ $incdecamount }}%</x-badge>               
            @else
                <x-badge variant="danger" size='sm' type='rounded'>-{{ $incdecamount }}%</x-badge>
            @endif
        </div>
        <p class="text-sm text-gray-700">{{ $title }}</p>
    </div>
    <div id="{{ $id }}" class="-mt-5 -mb-5"></div>
</div>