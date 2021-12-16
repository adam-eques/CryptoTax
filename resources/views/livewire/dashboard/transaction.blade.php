<div class="bg-white shadow-md rounded-md p-5">
    <div class="flex items-center space-x-2">
        <img src="{{asset('assets/img/icon/dashboard/transaction.svg')}}" class="w-8 h-8"/>
        <x-typography size="lg" class="mr-3 font-extrabold">Recent Transaction</x-typography>
    </div>
    <div class="overflow-auto mt-5">
        <div class="space-y-1 min-w-cmd">
            <div class="flex items-center justify-between hover:bg-gray-100 border p-4 rounded-lg">
                <div class="flex items-center justify-between space-x-6">
                    <img src="{{ asset('assets/img/icon/coin/binance.svg') }}" class="h-16 w-16"/>
                    <div>
                        <p class="text-xl font-bold">Binance Coin </p>
                        <p class="text-gray-400">Buy</p>
                    </div>
                </div>
                <div>
                    <p>$2356</p>
                    <p>Today 13,59 pm</p>
                </div>
            </div>
            <div class="flex items-center justify-between hover:bg-gray-100 border p-4 rounded-lg">
                <div class="flex items-center justify-between space-x-6">
                    <img src="{{asset('assets/img/icon/coin/litecoin.svg')}}" class="h-16 w-16"/>
                    <div>
                        <p class="text-xl font-bold">Lite Coin</p>
                        <p class="text-gray-400">Buy</p>
                    </div>
                </div>
                <div>
                    <p>$2356</p>
                    <p>Today 13,59 pm</p>
                </div>
            </div>
            <div class="flex items-center justify-between hover:bg-gray-100 border p-4 rounded-lg">
                <div class="flex items-center justify-between space-x-6">
                    <img src="{{asset('assets/img/icon/coin/cardano.svg')}}" class="h-16 w-16"/>
                    <div>
                        <p class="text-xl font-bold">Cardano Coin </p>
                        <p class="text-gray-400">Buy</p>
                    </div>
                </div>
                <div>
                    <p>$2356</p>
                    <p>Today 13,59 pm</p>
                </div>
            </div>
        </div>
    </div>
</div>
