@switch($transaction->trade_type)
    @case('B')
        <div class="grid w-full grid-cols-3 p-9 @if($transaction->ignored) line-through text-gray-300 @endif" wire:key='{{ $transaction->id }}'>
            <div class="flex items-center">
                <x-icon name="coins.{{ strtolower($transaction->cryptoCurrency->short_name) }}" class="w-18 h-18 ml-7"/>
                <div class="w-full space-y-1 ml-7">
                    <p class="text-gray-500">{{$transaction->cryptoAccount->getName()}} {{ $transaction->cryptoCurrency->short_name }} {{ __('Wallet') }} </p>
                    <p class="text-lg font-semibold">
                        +
                        {{ $transaction->amount }}
                        {{ $transaction->cryptoCurrency->short_name }}
                    </p>
                    <p class="text-gray-500">{{ __('View Transactions') }}</p>
                </div>
            </div>
            <div class="flex items-center">
                <div class="px-3 py-5 bg-gray-100 rounded-lg">
                    <x-icon name="heroicon-o-arrow-narrow-right" class="w-6 rotate-180 text-primary"/>
                </div>
                <div class="w-full space-y-1 ml-7">
                    <p class="text-lg font-semibold">{{ date("M d, Y H:i:s", strtotime($transaction->executed_at)) }}</p>
                    <p class="text-gray-500">{{ __('UTC Transfer') }}</p>
                    <x-badge variant="success" type="square">{{ __('Bought') }}</x-badge>
                </div>
            </div>
            <div class="flex items-center justify-between">
                <x-icon name="coins.{{strtolower($transaction->costCurrency->short_name)}}" class="w-18 h-18 ml-7"/>
                <div class="w-full space-y-1 ml-7">
                    <p class="text-lg font-semibold">
                        -
                        {{ $transaction->cost}}
                        {{ $transaction->costCurrency->short_name }}
                    </p>
                    <p class="text-sm text-gray-500">{{ $transaction->fee }} {{ $transaction->feeCurrency->short_name .  __(' :fee')}}</p>
                </div>
            </div>
        </div>
        @break
    @case('S')
        <div class="grid w-full grid-cols-3 p-9 @if($transaction->ignored) line-through text-gray-300 @endif" wire:key='{{ $transaction->id }}'>
            <div class="flex items-center">
                <x-icon name="coins.{{ strtolower($transaction->cryptoCurrency->short_name) }}" class="w-18 h-18 ml-7"/>
                <div class="w-full space-y-1 ml-7">
                    <p class="text-gray-500">{{$transaction->cryptoAccount->getName()}} {{ $transaction->cryptoCurrency->short_name }} {{ __('Wallet') }} </p>
                    <p class="text-lg font-semibold">
                        -
                        {{ $transaction->amount }}
                        {{ $transaction->cryptoCurrency->short_name }}
                    </p>
                    <p class="text-gray-500">{{ __('View Transactions') }}</p>
                </div>
            </div>
            <div class="flex items-center">
                <div class="px-3 py-5 bg-gray-100 rounded-lg">
                    <x-icon name="heroicon-o-arrow-narrow-left" class="w-6 rotate-180 text-primary"/>
                </div>
                <div class="w-full space-y-1 ml-7">
                    <p class="text-lg font-semibold">{{ date("M d, Y H:i:s", strtotime($transaction->executed_at)) }}</p>
                    <p class="text-gray-500">{{ __('UTC Transfer') }}</p>
                    <x-badge variant="danger" type="square">{{ __('Sold') }}</x-badge>
                </div>
            </div>
            <div class="flex items-center justify-between">
                <x-icon name="coins.{{strtolower($transaction->costCurrency->short_name)}}" class="w-18 h-18 ml-7"/>
                <div class="w-full space-y-1 ml-7">
                    <p class="text-gray-500">{{$transaction->cryptoAccount->getName()}} {{ $transaction->costCurrency->short_name }} {{ __('Wallet') }}</p>
                    <p class="text-lg font-semibold">
                        +
                        {{ $transaction->cost}}
                        {{ $transaction->costCurrency->short_name }}
                    </p>
                    <p class="text-sm text-gray-500">{{ $transaction->fee }} {{ $transaction->feeCurrency->short_name .  __(' :fee')}}</p>
                </div>
            </div>
        </div>
        @break
    @case('R')
        <div class="grid w-full grid-cols-3 p-9 @if($transaction->ignored) line-through text-gray-300 @endif" wire:key='{{ $transaction->id }}'>
            <div class="flex items-center">
              
            </div>
            <div class="flex items-center">
                <div class="px-3 py-5 bg-gray-100 rounded-lg">
                    <x-icon name="heroicon-s-download" class="w-6 text-primary"/>
                </div>
                <div class="w-full space-y-1 ml-7">
                    <p class="text-lg font-semibold">{{ date("M d, Y H:i:s", strtotime($transaction->executed_at)) }}</p>
                    <p class="text-gray-500">{{ __('UTC Transfer') }}</p>
                    <x-badge variant="third" type="square">{{ __('Received') }}</x-badge>
                </div>
            </div>
            <div class="flex items-center justify-between">
                <x-icon name="coins.{{strtolower($transaction->costCurrency->short_name)}}" class="w-18 h-18 ml-7"/>
                <div class="w-full space-y-1 ml-7">
                    <p class="text-gray-500">{{$transaction->cryptoAccount->getName()}} {{ $transaction->costCurrency->short_name }} {{ __('Wallet') }}</p>
                    <p class="text-lg font-semibold">
                        +
                        {{ $transaction->cost}}
                        {{ $transaction->costCurrency->short_name }}
                    </p>
                    <p class="text-sm text-gray-500">{{ $transaction->fee }} {{ $transaction->feeCurrency->short_name .  __(' :fee')}}</p>
                </div>
            </div>
        </div>
        @break
    @case('G')
        <div class="grid w-full grid-cols-3 p-9 @if($transaction->ignored) line-through text-gray-300 @endif" wire:key='{{ $transaction->id }}'>
            <div class="flex items-center">
                <x-icon name="coins.{{ strtolower($transaction->cryptoCurrency->short_name) }}" class="w-18 h-18 ml-7"/>
                <div class="w-full space-y-1 ml-7">
                    <p class="text-gray-500">{{$transaction->cryptoAccount->getName()}} {{ $transaction->cryptoCurrency->short_name }} {{ __('Wallet') }} </p>
                    <p class="text-lg font-semibold">
                        -
                        {{ $transaction->amount }}
                        {{ $transaction->cryptoCurrency->short_name }}
                    </p>
                    <p class="text-gray-500">{{ __('View Transactions') }}</p>
                </div>
            </div>
            <div class="flex items-center">
                <div class="px-3 py-5 bg-gray-100 rounded-lg">
                    <x-icon name="heroicon-s-upload" class="w-6 text-primary"/>
                </div>
                <div class="w-full space-y-1 ml-7">
                    <p class="text-lg font-semibold">{{ date("M d, Y H:i:s", strtotime($transaction->executed_at)) }}</p>
                    <p class="text-gray-500">{{ __('UTC Transfer') }}</p>
                    <x-badge variant="warning" type="square">{{ __('Sent') }}</x-badge>
                </div>
            </div>
            <div class="flex items-center">
            </div>
        </div>
        @break
    @default
        
@endswitch
  
