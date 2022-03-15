@php
$overview_data = [
    [
        'type' => 'Deposit',
        'amount' => $deposits_num,
        'icon' => 'fluentui-building-retail-money-24-o',
    ],
    [
        'type' => 'Withdrawal',
        'amount' => $withdrawal_num,
        'icon' => 'uni-money-withdrawal-o',
    ],
    [
        'type' => 'Trades',
        'amount' => $trades_num,
        'icon' => 'polaris-major-exchange',
    ],
    [
        'type' => 'Needs Review',
        'amount' => $reviews_num,
        'icon' => 'gmdi-rate-review-o',
    ],
    [
        'type' => 'Exchanges',
        'amount' => $exchange_num,
        'icon' => 'ri-exchange-funds-line',
    ],
]    
@endphp

<div>
    <x-customers.customer-header-bar icon="grommet-transaction" name="Transactions">
        <x-button variant="white" class="my-2 border-primary">{{ __('Download CSV') }}</x-button>
        <x-button variant="white" class="border-primary">{{ __('Add transaction') }}</x-button>
        <x-button tag="a" href="{{ route('customer.account.new') }}">
            <x-icon name="bx-add-to-queue" class="w-5 h-5 mr-2"/>
            {{ __('Add Account') }}
        </x-button>
    </x-customers.customer-header-bar>
    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-5 gap-x-0 sm:gap-x-4 gap-y-4 sm:gap-y-0 my-9">
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
</div>
