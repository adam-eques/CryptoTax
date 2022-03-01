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
                x-bind:class="selected == {{ $item['id'] }} ? 'rounded-l border-l-5 border-primary' : ''" 
                @click="selected !== {{ $item['id'] }} ? selected = {{ $item['id'] }} : selected = null"
                x-transition
            >
                <x-portfolio-list-item 
                    :id="$item['id']" 
                    :icon="$item['icon']"
                    :name="$item['name']"
                    :type="$item['type']"
                    lineColor="{{ $item['lineColor'] }}"
                    :price="$item['price']"
                    holdingBtc="{{ $item['holding']['btc'] }}"
                    holdingUsd="{{ $item['holding']['usd'] }}"
                    :percent="$item['percentage']"
                    pnlPrice="{{ $item['pnl']['price'] }}"
                    pnlPercent="{{ $item['pnl']['percent'] }}"
                    node="parent"
                />
                <div x-show="selected == {{ $item['id'] }}" x-transition.duration.500ms>
                    @foreach ($item['child'] ?? [] as $child)
                        <x-portfolio-list-item 
                            :id="$child['id']" 
                            :icon="$child['icon']"
                            :name="$child['name']"
                            :type="$child['type']"
                            lineColor="{{ $child['lineColor'] }}"
                            :price="$child['price']"
                            holdingBtc="{{ $child['holding']['btc'] }}"
                            holdingUsd="{{ $child['holding']['usd'] }}"
                            percent="{{ $child['percentage'] }}"
                            pnlPrice="{{ $child['pnl']['price'] }}"
                            pnlPercent="{{ $child['pnl']['percent'] }}"
                            node="child"
                        />
                    @endforeach
                </div>
            </div>          
        @endforeach
    </div>
</div>
