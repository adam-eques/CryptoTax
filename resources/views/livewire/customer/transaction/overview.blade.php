@php
$overview_data = [
    [
        'type' => 'Deposit',
        'amount' => '1056',
        'icon' => 'fluentui-building-retail-money-24-o',
    ],
    [
        'type' => 'Withdrawal',
        'amount' => '263',
        'icon' => 'uni-money-withdrawal-o',
    ],
    [
        'type' => 'Trades',
        'amount' => '1056',
        'icon' => 'polaris-major-exchange',
    ],
    [
        'type' => 'Needs Review',
        'amount' => '09',
        'icon' => 'gmdi-rate-review-o',
    ],
    [
        'type' => 'Exchanges',
        'amount' => '11',
        'icon' => 'ri-exchange-funds-line',
    ],
]    
@endphp


<div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-5 gap-x-0 sm:gap-x-4 gap-y-4 sm:gap-y-0">
    @foreach ($overview_data as $item)
        <div class="flex items-start justify-between w-full p-8 border rounded-lg">
            <div>
                <p> {{ $item['type'] }}</p>
                <p class="mt-1 text-3xl font-bold">{{ $item['amount'] }}</p>
            </div>
            <x-icon name="{{ $item['icon'] }}" class="w-14 h-14" />
        </div>
    @endforeach
</div>
