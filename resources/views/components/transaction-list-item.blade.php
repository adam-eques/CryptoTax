<div class="grid grid-cols-3 p-9 border w-full">
    <div class="flex items-center">
        <input type="checkbox">
        <x-icon name="coins.{{strtolower($transaction->cryptoExchangeAccount->cryptoExchange->getName())}}" class="w-18 h-18 ml-7"/>
        <div class="w-full ml-7 space-y-1">
            <p class="text-gray-500">{{$transaction->cryptoExchangeAccount->cryptoExchange->getName()}} {{ explode('/', $transaction->symbol)[0] }} {{ __('Wallet') }} </p>
            <p class="font-semibold text-lg"> 
                @if($transaction->side == 'sell') - @elseif($transaction->side == 'buy') + @endif 
                {{ $transaction->amount }} 
                {{ explode('/', $transaction->symbol)[0] }} 
            </p>
            <p class="text-gray-500">{{ __('View Transactions') }}</p>
            <p class="text-gray-500">{{ $transaction->fee_cost }} {{ $transaction->fee_currency }}</p>
        </div>
    </div>
    <div class="flex items-center">
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
            <p class="font-semibold text-lg">
                @if($transaction->side == 'sell') + @elseif($transaction->side == 'buy') - @endif
                {{ $transaction->cost }} 
                {{ explode('/', $transaction->symbol)[1] }}
            </p>
        </div>
        <div>
            <button class="rounded-full w-6 h-6 bg-gray-100 border flex justify-center items-center">
                <x-icon name="fas-chevron-down" class="w-4 h-4"/>
            </button>
        </div>
    </div>
</div>