
<div class="h-full p-5 bg-white rounded-md shadow-md">
    <div class="flex items-center justify-between">
        <div class="flex items-center space-x-2">
            <x-icon name="grommet-transaction" class="w-8 h-8"/>
            <p class="mr-3 text-lg font-semibold">{{ __('Recent Transaction') }}</p>
        </div>
        <x-button variant="primary" tag="a" href="{{ route('customer.transactions') }}">{{ __('View all') }}</x-button>
    </div>
    <div class="overflow-auto mt-7 scrollbar">
        <div class="space-y-4 min-w-cmd">
            @foreach ($transactios as $item)
                <div class="flex items-center justify-between p-5 border rounded-lg" wire:key="{{$item->id}}">
                    <div class="flex items-center justify-between space-x-6">
                        <div class="w-12 h-12 rounded-lg">
                            <x-icon name="{{'coins.' . strtolower($item->costCurrency->short_name) }}" class="w-full h-full"/>
                        </div>
                        <div>
                            <p class="text-lg font-bold">{{ $item->costCurrency->short_name }} </p>
                            @switch($item->trade_type)
                                @case('B')
                                    <x-badge type="square" class="mt-2">{{ __("Bought") }}</x-badge>
                                    @break
                                @case('S')
                                    <x-badge type="square" variant="danger" class="mt-2">{{ __("Sold") }}</x-badge>
                                    @break
                                @default
                                    
                            @endswitch
                        </div>
                    </div>
                    <div>
                        <h5 class="text-lg font-bold">{{ $item->cost }}</h5>
                        <p class="mt-2 text-sm text-gray-400">{{ $item->executed_at }}</p>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>
