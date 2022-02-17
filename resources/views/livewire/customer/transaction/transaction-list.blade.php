
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
        <div class="min-w-[1024px]">            
            @foreach ($exchange_transactions as $transaction)
                <x-transaction-list-item :transaction="$transaction"/>
            @endforeach
        </div>
    </div>
    <div class="mt-16 mb-8">
        {{$exchange_transactions->links()}}
    </div>
</div>
