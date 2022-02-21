<div>
    <div class="p-4 bg-gray-100 border rounded-sm">
        <div class="grid grid-cols-1 md:grid-cols-12 gap-x-0 md:gap-x-2 gap-y-2 md:gap-y-0">
            <div class="col-span-1 px-6 py-4 bg-white rounded-md md:col-span-4">
                <div class="relative w-full">
                    <input class="w-full border-0 outline-none" placeholder="Filter transactions" wire:model.lazy="search">
                    <div class="absolute right-0 pl-4 border-l-2 top-1">
                        <button>
                            <x-icon name="fas-search" class="w-4 h-4"></x-icon>
                        </button>
                    </div>
                </div>
            </div>
            <div class="col-span-1 md:col-span-2">
                <div class="grid h-full grid-cols-6 gap-x-3">
                    <div class="col-span-2">
                        <button class="w-full h-full text-white rounded-md bg-primary hover:bg-secondary-400">
                            {{ __('All') }}
                        </button>
                    </div>
                    <div class="w-full h-full col-span-4">
                        <select class="w-full h-full bg-white rounded-md" wire:model.lazy="order">
                            <option value="" disabled selected hidden>{{ __('Order By') }}</option>
                            @foreach ($filter['order'] as $item)                                
                                <option value="{{ $item['value'] }}">{{ __($item['label']) }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>
            <select class="h-full col-span-1 bg-white rounded-md md:col-span-2">
                <option value="" disabled selected hidden class="text-gray-100">{{ __('Transaction type') }}</option>
                @foreach ($filter['type'] as $item)                                
                    <option value="{{ $item['value'] }}">{{ __($item['label']) }}</option>
                @endforeach
            </select>
            <div class="col-span-1 md:col-span-3">
                <div class="grid h-full grid-cols-7 gap-x-3">
                    <select class="w-full h-full col-span-3 bg-white rounded-md">
                        <option value="" disabled selected hidden>{{ __('Account') }}</option>
                        @foreach ($filter['category'] as $item)                                
                            <option value="{{ $item['value'] }}">{{ __($item['label']) }}</option>
                        @endforeach
                    </select>
                    <select class="w-full h-full col-span-4 bg-white rounded-md">
                        <option value="" disabled selected hidden>{{ __('Category') }}</option>
                        @foreach ($filter['exchange'] as $item)                                
                            <option value="{{ $item['value'] }}">{{ __($item['label']) }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
        </div>
    </div>
    <div class="mt-10 overflow-auto rounded-sm">
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

