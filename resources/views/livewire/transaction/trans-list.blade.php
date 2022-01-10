@php
    $transactions = [
        [
            'icon' => '',
            'name' => 'Bitpanda BTC wallet',
            'amount' => '- 0.003321456 BTC',
            'balance' => '0.001311 BTC'
        ],
        [
            'icon' => '',
            'name' => 'Bitpanda BTC wallet',
            'amount' => '- 0.003321456 BTC',
            'balance' => '0.001311 BTC'
        ],

    ]
@endphp

<div>
    <div class="bg-gray-100 border rounded-sm p-4">
        <div class="grid grid-cols-1 md:grid-cols-12 gap-x-0 md:gap-x-2 gap-y-2 md:gap-y-0">
            <div class="col-span-1 md:col-span-4 bg-white px-6 py-4 rounded-md">
                <div class="w-full relative">
                    <input class="border-0 outline-none w-full" placeholder="Filter transactions">
                    <div class="absolute right-0 top-1 border-l-2 pl-4">
                        <button>
                            <x-icon name="fas-search" class="w-4 h-4"></x-icon>
                        </button>
                    </div>
                </div>
            </div>
            <div class="col-span-1 md:col-span-2">
                <div class="grid grid-cols-6 h-full gap-x-3">
                    <div class="col-span-2">
                        <button class="rounded-md w-full h-full text-white bg-primary hover:bg-secondary-400">
                            {{ __('All') }}
                        </button>
                    </div>
                    <div class="col-span-4 w-full h-full">
                        <select class="w-full h-full bg-white rounded-md">
                            <option value="" disabled selected hidden>{{ __('Order By') }}</option>
                        </select>
                    </div>
                </div>
            </div>
            <select class="h-full bg-white rounded-md col-span-1 md:col-span-2">
                <option value="" disabled selected hidden>{{ __('Transaction type') }}</option>
            </select>
            <div class="col-span-1 md:col-span-3">
                <div class="grid grid-cols-7 h-full gap-x-3">
                    <select class="col-span-3 h-full w-full bg-white rounded-md">
                        <option value="" disabled selected hidden>{{ __('Wallet') }}</option>
                    </select>
                    <select class="col-span-4 h-full w-full bg-white rounded-md">
                        <option value="" disabled selected hidden>{{ __('Exchange') }}</option>
                    </select>
                </div>
            </div>
        </div>
    </div>
    <div class="mt-10 border rounded-sm p-9">
        @foreach ($transactions as $item)            
            <div class="grid grid-cols-1 md:grid-cols-3 p-4">
                <div class="flex justify-start items-center">
                    <input type="checkbox">
                    <x-icon name="kucoin-token" class="w-16 h-16 ml-7"/>
                    <div class="w-full ml-7 space-y-1">
                        <p>{{ $item['name'] }} </p>
                        <p class="font-bold text-lg">{{ $item['amount'] }} </p>
                        <p>View Transactions</p>
                        <p>{{ $item['balance'] }} </p>
                    </div>
                </div>
                <div class="flex justify-start items-center">
                    <button class="p-3 bg-gray-100 border rounded-lg">
                        <x-icon name="fas-arrow-right" class="w-8 h-5 text-primary"/>
                    </button>
                    <div class="w-full ml-7 space-y-1">
                        <p class="font-bold text-lg">FEB 26, 2009  00:12.39</p>
                        <p>UTC Transfer</p>
                        <p>{{ $item['balance'] }} </p>
                    </div>
                </div>
                <div class="flex justify-between items-center">
                    <x-icon name="kucoin-token" class="w-16 h-16 ml-7"/>
                    <div class="w-full ml-7 space-y-1">
                        <p>{{ $item['name'] }} </p>
                        <p class="font-bold text-lg">{{ $item['amount'] }} </p>
                    </div>
                    <div>
                        <button class="rounded-full w-6 h-6 bg-gray-100 border flex justify-center items-center">
                            <x-icon name="fas-chevron-down" class="w-4 h-4"/>
                        </button>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>
