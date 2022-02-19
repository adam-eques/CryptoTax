<div class="grid grid-cols-7 gap-5 items-center px-5 py-6 min-w-[720px]">
    <div class="col-span-3">
        <div class="flex items-center space-x-3">
            <div class="w-14">
                <x-icon name="{{ 'coins.' . $asset->cryptoCurrency->short_name }}" class="w-14 h-14"/>
            </div>
            <div>                                                    
                <p class="font-bold truncate">{{$asset->cryptoCurrency->getName()}} Wallet</p>
                <p class="text-gray-400">{{ 11 }} {{__('Transactions')}}</p>
            </div>
        </div>
    </div>
    <div class="col-span-2 text-right">
        <p class="font-bold">${{ moneyFormat($asset->convertTo(), 2) }}</p>
        <p class="text-gray-400">{{ moneyFormat($asset->balance, 10) }} {{$asset->cryptoCurrency->short_name}}</p>
    </div>
    <div class="col-span-2">
        <x-button tag="a" href="{{route('customer.transactions', ['asset' => $asset->cryptoCurrency->getName()])}}" variant="white" class="justify-center w-full text-center rounded-full border-primary">{{ __('View Transaction') }}</x-button>
    </div>
</div>