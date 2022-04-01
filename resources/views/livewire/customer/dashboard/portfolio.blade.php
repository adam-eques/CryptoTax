<div class="h-full p-5 bg-white rounded-md shadow-md">
    <div class="flex items-center justify-between">
        <div class="flex items-center space-x-2">
            <x-icon name="carbon-portfolio" class="w-8 h-8 text-primary"/>
            <p class="mr-3 text-lg font-semibold">{{ __('My Crypto Portfolio') }}</p>
        </div>
        <div>
            <x-button variant="primary" tag="a" href="{{ route('customer.portfolio') }}">{{  __('See all assets')}}</x-button>
        </div>
    </div>
    <div class="mt-6 overflow-x-auto" x-data="{selected:null}">
        <div class="grid grid-cols-11 py-6 bg-gray-100 border rounded-md text-primary min-w-clg">
            <div class="flex items-center justify-center col-span-1">
                <x-icon name="biarrow" class="w-2 h-3"/>
            </div>
            <div class="flex items-center justify-start col-span-2 px-5 space-x-2">
                <p class="text-basic">{{ _('Coin') }}</p>
                <x-icon name="biarrow" class="w-2 h-3"/>
            </div>
            <div class="flex items-center justify-end col-span-1 space-x-2">
                <p class="text-basic">{{ __('Price') }}</p>
                <x-icon name="biarrow" class="w-2 h-3"/>
            </div>
            <div class="flex items-center justify-center col-span-3 space-x-2">
                <p class="text-basic">{{ __('Last 7 days') }}</p>
                <x-icon name="biarrow" class="w-2 h-3"/>
            </div>
            <div class="flex items-center justify-start col-span-1 space-x-2">
                <p class="text-md">{{ __('Holdings') }}</p>
                <x-icon name="biarrow" class="w-2 h-3"/>
            </div>
            <div class="flex items-center justify-end col-span-1 space-x-2">
                <p class="text-basic">{{ __('Percentage') }}</p>
                <x-icon name="biarrow" class="w-2 h-3"/>
            </div>
            <div class="flex items-center justify-center col-span-2 space-x-2">
                <p class="text-basic">{{ __('PNL') }}</p>
                <x-icon name="biarrow" class="w-2 h-3"/>
            </div>
        </div>
        @foreach ($portfolio ?? [] as $item)  
            <div class="mt-2" 
                {{-- x-bind:class="selected == {{ $item['symbol'] }} ? 'rounded-l border-l-5 border-primary' : ''" 
                @click="selected !== {{ $item['symbol'] }} ? selected = {{ $item['symbol'] }} : selected = null"
                x-transition --}}
            >
                <x-portfolio-list-item 
                    id="{{$item['name']}}" 
                    icon="{{'coins.' . strtolower($item['symbol'])}}"
                    name="{{$item['name']}}"
                    type="{{$item['symbol']}}"
                    lineColor="#00C928"
                    price="{{number_format($item['price'], 4)}}"
                    holdingBtc="{{ number_format($item['holding_cc'], 6) }}"
                    holdingUsd="{{ number_format($item['holding_fiat'], 6) }}"
                    percent="{{ number_format( $item['percent'], 2)}}"
                    pnlPrice="{{ number_format($item['pnl'], 6) }}"
                    pnlPercent="{{ number_format( $item['percent'], 6) }}"
                    node="parent"
                />
            </div>          
        @endforeach
    </div>
</div>
