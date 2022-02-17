
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
                            <option>{{ __('date') }}</option>
                        </select>
                    </div>
                </div>
            </div>
            <select class="h-full bg-white rounded-md col-span-1 md:col-span-2">
                <option value="" disabled selected hidden class="text-gray-100">{{ __('Transaction type') }}</option>
                <option value="">{{ __('Sell') }}</option>
                <option value="">{{ __('Buy') }}</option>
            </select>
            <div class="col-span-1 md:col-span-3">
                <div class="grid grid-cols-7 h-full gap-x-3">
                    <select class="col-span-3 h-full w-full bg-white rounded-md">
                        <option value="" disabled selected hidden>{{ __('') }}</option>
                        <option>{{ __('') }}</option>
                    </select>
                    <select class="col-span-4 h-full w-full bg-white rounded-md">
                        <option value="" disabled selected hidden>{{ __('Category') }}</option>
                        <option value="">{{ __('Exchange') }}</option>
                        <option value="">{{ __('Blockchains') }}</option>
                    </select>
                </div>
            </div>
        </div>
    </div>
    <div class="mt-10 rounded-sm overflow-auto">
        @foreach ($exchange_transactions as $transaction)
            <div class="grid grid-cols-3 p-9 border min-w-max">
                <div class="flex justify-start items-center">
                    <input type="checkbox">
                    <x-icon name="coins.{{strtolower($transaction->cryptoExchangeAccount->cryptoExchange->getName())}}" class="w-18 h-18 ml-7"/>
                    <div class="w-full ml-7 space-y-1">
                        <p class="text-gray-500">{{$transaction->cryptoExchangeAccount->cryptoExchange->getName()}} {{ explode('/', $transaction->symbol)[0] }} {{ __('Wallet') }} </p>
                        <p class="font-semibold text-lg"> {{ $transaction->amount }} {{ explode('/', $transaction->symbol)[0] }} </p>
                        <p class="text-gray-500">{{ __('View Transactions') }}</p>
                        <p class="text-gray-500">{{ $transaction->fee_cost }} {{ $transaction->fee_currency }}</p>
                    </div>
                </div>
                <div class="flex justify-start items-center">
                    @switch($transaction->side)
                        @case('sell')                                
                            <div class="px-3 py-5 bg-gray-100 rounded-lg">
                                <x-icon name="arrow-right" class="w-6 text-primary"/>
                            </div>
                            <div class="w-full ml-7 space-y-1">
                                <p class="font-semibold text-lg">{{ date("M d, Y H:i:s", $transaction->executed_at/1000) }}</p>
                                <p class="text-gray-500">{{ __('UTC Transfer') }}</p>
                                <x-badge variant="danger" type="square">{{ $transaction->side }}</x-badge>
                            </div>
                            @break
                        @case('buy')
                            <div class="px-3 py-5 bg-gray-100 rounded-lg">
                                <x-icon name="arrow-right" class="w-6 text-primary rotate-180"/>
                            </div>
                            <div class="w-full ml-7 space-y-1">
                                <p class="font-semibold text-lg">{{ date("M d, Y H:i:s", $transaction->executed_at/1000) }}</p>
                                <p class="text-gray-500">{{ __('UTC Transfer') }}</p>
                                <x-badge variant="success" type="square">{{ $transaction->side }}</x-badge>
                            </div>
                            @break
                        @default
                    @endswitch
                   
                </div>
                <div class="flex justify-between items-center">
                    <x-icon name="coins.{{strtolower($transaction->cryptoExchangeAccount->cryptoExchange->getName())}}" class="w-18 h-18 ml-7"/>
                    <div class="w-full ml-7 space-y-1">
                        <p class="text-gray-500">{{$transaction->cryptoExchangeAccount->cryptoExchange->getName()}} {{ explode('/', $transaction->symbol)[1] }} {{ __('Wallet') }}</p>
                        <p class="font-semibold text-lg">{{ $transaction->cost }} {{ explode('/', $transaction->symbol)[1] }}</p>
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
    <div class="mt-16 mb-8">
        {{$exchange_transactions->links()}}
    </div>
</div>
