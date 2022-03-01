<div class="grid w-full grid-cols-3 border p-9" wire:key='{{ $transaction->id }}'>
    <div class="flex items-center">
        <input type="checkbox">
        <x-icon name="coins.{{strtolower(explode('/', $transaction->symbol)[0])}}" class="w-18 h-18 ml-7"/>
        <div class="w-full space-y-1 ml-7">
            <p class="text-gray-500">{{$transaction->cryptoExchangeAccount->cryptoExchange->getName()}} {{ explode('/', $transaction->symbol)[0] }} {{ __('Wallet') }} </p>
            <p class="text-lg font-semibold"> 
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
                    <x-icon name="heroicon-o-arrow-narrow-right" class="w-6 text-primary"/>
                </div>
                <div class="w-full space-y-1 ml-7">
                    <p class="text-lg font-semibold">{{ date("M d, Y H:i:s", $transaction->executed_at/1000) }}</p>
                    <p class="text-gray-500">{{ __('UTC Transfer') }}</p>
                    <x-badge variant="danger" type="square">{{ __('Sold') }}</x-badge>
                </div>
                @break
            @case('buy')
                <div class="px-3 py-5 bg-gray-100 rounded-lg">
                    <x-icon name="heroicon-o-arrow-narrow-right" class="w-6 rotate-180 text-primary"/>
                </div>
                <div class="w-full space-y-1 ml-7">
                    <p class="text-lg font-semibold">{{ date("M d, Y H:i:s", $transaction->executed_at/1000) }}</p>
                    <p class="text-gray-500">{{ __('UTC Transfer') }}</p>
                    <x-badge variant="success" type="square">{{ __('Bought') }}</x-badge>
                </div>
                @break
            @default
        @endswitch
       
    </div>
    <div class="flex items-center justify-between">
        <x-icon name="coins.{{strtolower(explode('/', $transaction->symbol)[1])}}" class="w-18 h-18 ml-7"/>
        <div class="w-full space-y-1 ml-7">
            <p class="text-gray-500">{{$transaction->cryptoExchangeAccount->cryptoExchange->getName()}} {{ explode('/', $transaction->symbol)[1] }} {{ __('Wallet') }}</p>
            <p class="text-lg font-semibold">
                @if($transaction->side == 'sell') + @elseif($transaction->side == 'buy') - @endif
                {{ $transaction->cost }} 
                {{ explode('/', $transaction->symbol)[1] }}
            </p>
        </div>
        <div x-data="{open:false}" class="relative py-2">
            <button class="flex items-center justify-center w-6 h-6 bg-gray-100 border rounded-full" @click="open = true">
                <svg class="w-4 transform trnstsn " fill="none" viewBox="0 0 24 24" stroke="currentColor" :class="{'rotate-180': open}">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                </svg>
            </button>
            <div
                class="absolute right-0 w-40 p-4 origin-top-right bg-white rounded-md shadow-lg top-10 text-primary ring-1 ring-black ring-opacity-5 focus:outline-none"
                role="menu" aria-orientation="vertical" aria-labelledby="user-menu-button" tabindex="-1"
                x-show="open" @click.away="open=false" x-cloak
                x-transition:enter-start="transition ease-in duration-3000"
            >
                <button class="w-full p-2 text-left bg-white hover:bg-gray-100">{{ __('Edit') }}</button>
                <button class="w-full p-2 text-left bg-white hover:bg-gray-100">{{ __('Ignor') }}</button>
            </div>
        </div>
    </div>
</div>