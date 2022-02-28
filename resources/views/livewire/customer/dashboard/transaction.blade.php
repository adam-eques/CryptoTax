@php
    $transactios = [
        [
            'name' => 'Binance Coin', 'type' => 'Buy', 'balance' => '$2356', 'time' => 'Today 13,59 pm', 'icon' => 'coins.btc'
        ],
        [
            'name' => 'Lite Coin', 'type' => 'Sell', 'balance' => '$2356', 'time' => 'Today 13,59 pm', 'icon' => 'coins.eth'
        ],
        [
            'name' => 'Tether', 'type' => 'Buy', 'balance' => '$2356', 'time' => 'Today 13,59 pm', 'icon' => 'coins.cro'
        ],
    ]
@endphp
<div class="h-full p-5 bg-white rounded-md shadow-md">
    <div class="flex items-center justify-between">
        <div class="flex items-center space-x-2">
            <x-icon name="grommet-transaction" class="w-8 h-8"/>
            <p class="mr-3 text-lg font-semibold">{{ __('Recent Transaction') }}</p>
        </div>
        <x-button variant="primary" tag="a" href="{{ route('customer.transactions') }}">{{ __('View all') }}</x-button>
    </div>
    <div class="overflow-auto mt-7">
        <div class="space-y-4 min-w-cmd">
            @foreach ($transactios as $item)
                <div class="flex items-center justify-between p-5 border rounded-lg">
                    <div class="flex items-center justify-between space-x-6">
                        <div class="w-12 h-12 rounded-lg">
                            <x-icon name="{{ $item['icon'] }}" class="w-full h-full"/>
                        </div>
                        <div>
                            <p class="text-lg font-bold">{{ $item['name'] }} </p>
                            <x-badge type="square" class="mt-2">{{ $item['type'] }}</x-badge>
                        </div>
                    </div>
                    <div>
                        <h5 class="text-lg font-bold">{{ $item['balance'] }}</h5>
                        <p class="mt-2 text-sm text-gray-400">{{ $item['time'] }}</p>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>
