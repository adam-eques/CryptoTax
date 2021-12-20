@php
    $transactios = [
        [
            'name' => 'Binance Coin', 'type' => 'Buy', 'balance' => '$2356', 'time' => 'Today 13,59 pm', 'icon' => [ 'color' => 'bg-gray-400' ]
        ],
        [
            'name' => 'Lite Coin', 'type' => 'Sell', 'balance' => '$2356', 'time' => 'Today 13,59 pm', 'icon' => ['color' => 'bg-secondary']
        ],
        [
            'name' => 'Cardano Coin', 'type' => 'Buy', 'balance' => '$2356', 'time' => 'Today 13,59 pm', 'icon' => ['color' => 'bg-third']
        ],
    ]
@endphp
<div class="bg-white shadow-md rounded-md p-5 h-full">
    <div class="flex items-center space-x-2">
        <x-icon name="transaction" class="w-8 h-8"/>
        <p class="mr-3 text-lg font-extrabold">Recent Transaction</p>
    </div>
    <div class="overflow-auto mt-5">
        <div class="space-y-1 min-w-cmd">
            @foreach ($transactios as $item)                
                <div class="flex items-center justify-between border p-4 rounded-lg {{ $item['type'] == 'Buy'?'bg-lightgreen':' bg-lightpink' }}">
                    <div class="flex items-center justify-between space-x-6">
                        <div class="w-14 h-14 rounded-lg flex justify-center items-center  {{ $item['icon']['color'] }}">
                            <x-icon name="bitcoin" class="h-8 w-8 text-white"/>
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
