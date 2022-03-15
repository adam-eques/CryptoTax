<div class="grid w-full grid-cols-3 border p-9" wire:key='{{ $transaction->id }}'>
    <div class="flex items-center">
        <input type="checkbox">
        <x-icon name="coins.{{ strtolower($transaction->cryptoCurrency->short_name) }}" class="w-18 h-18 ml-7"/>
        <div class="w-full space-y-1 ml-7">
            <p class="text-gray-500">{{$transaction->cryptoAccount->getName()}} {{ $transaction->cryptoCurrency->short_name }} {{ __('Wallet') }} </p>
            <p class="text-lg font-semibold">
                @if($transaction->trade_type == 'S') - @elseif($transaction->trade_type == 'B') + @endif
                {{ $transaction->amount }}
                {{ $transaction->cryptoCurrency->short_name }}
            </p>
            <p class="text-gray-500">{{ __('View Transactions') }}</p>
            <p class="text-gray-500">{{ $transaction->fee }} {{ $transaction->feeCurrency->short_name }}</p>
        </div>
    </div>
    <div class="flex items-center">
        @switch($transaction->trade_type)
            @case('S')
                <div class="px-3 py-5 bg-gray-100 rounded-lg">
                    <x-icon name="heroicon-o-arrow-narrow-right" class="w-6 text-primary"/>
                </div>
                <div class="w-full space-y-1 ml-7">
                    <p class="text-lg font-semibold">{{ date("M d, Y H:i:s", strtotime($transaction->executed_at)) }}</p>
                    <p class="text-gray-500">{{ __('UTC Transfer') }}</p>
                    <x-badge variant="danger" type="square">{{ __('Sold') }}</x-badge>
                </div>
                @break
            @case('B')
                <div class="px-3 py-5 bg-gray-100 rounded-lg">
                    <x-icon name="heroicon-o-arrow-narrow-right" class="w-6 rotate-180 text-primary"/>
                </div>
                <div class="w-full space-y-1 ml-7">
                    <p class="text-lg font-semibold">{{ date("M d, Y H:i:s", strtotime($transaction->executed_at)) }}</p>
                    <p class="text-gray-500">{{ __('UTC Transfer') }}</p>
                    <x-badge variant="success" type="square">{{ __('Bought') }}</x-badge>
                </div>
                @break
            @default
        @endswitch

    </div>
    <div class="flex items-center justify-between">
        {{-- <x-icon name="coins.{{strtolower($transaction->priceCurrency->short_name)}}" class="w-18 h-18 ml-7"/> --}}
        <div class="w-full space-y-1 ml-7">
            {{-- <p class="text-gray-500">{{$transaction->cryptoAccount->getName()}} {{ $transaction->priceCurrency->short_name }} {{ __('Wallet') }}</p> --}}
            <p class="text-lg font-semibold">
                @if($transaction->trade_type == 'S') + @elseif($transaction->trade_type == 'B') - @endif
                {{ $transaction->price *  $transaction->amount}}
                {{-- {{ $transaction->priceCurrency->short_name }} --}}
            </p>
            <p class="text-gray-500">{{ $transaction->fee }} {{ $transaction->feeCurrency->short_name }}</p>
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
