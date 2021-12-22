@php
    $transactios = [
        [
            'name' => 'Binance Coin', 'type' => 'Buy', 'balance' => '$2356', 'time' => 'Today 13,59 pm', 'icon' => 'bitcoin'
        ],
        [
            'name' => 'Lite Coin', 'type' => 'Sell', 'balance' => '$2356', 'time' => 'Today 13,59 pm', 'icon' => 'litecoin'
        ],
        [
            'name' => 'Tether', 'type' => 'Buy', 'balance' => '$2356', 'time' => 'Today 13,59 pm', 'icon' => 'tether'
        ],
    ]
@endphp
<div class="bg-white shadow-md rounded-md p-5 h-full">
    <div class="flex items-center space-x-2">
        <x-icon name="transaction" class="w-10 h-10"/>
        <p class="mr-3 text-lg font-extrabold">{{ __('Recent Transaction') }}</p>
    </div>
    <div class="overflow-auto mt-5">
        <div class="space-y-1 min-w-cmd">
            @foreach ($transactios as $item)                
                <div class="flex items-center justify-between border p-4 rounded-lg {{ $item['type'] == 'Buy'?'bg-lightgreen':' bg-lightpink' }}">
                    <div class="flex items-center justify-between space-x-6">
                        <div class="w-14 h-14 rounded-lg">
                            <x-icon name="{{ $item['icon'] }}" class="h-full w-full"/>
                        </div>
                        <div>
                            <p class="text-xl font-bold">{{ $item['name'] }} </p>
                            <p class="text-gray-400">{{ $item['type'] }}</p>
                        </div>
                    </div>
                    <div>
                        <p>{{ $item['balance'] }}</p>
                        <p>{{ $item['time'] }}</p>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>
