<div class="bg-white shadow-md rounded-md p-5 h-full">
    <div class="flex justify-between items-center">
        <div class="flex items-center space-x-2">
            <x-icon name="portfolio" class="w-8 h-8 text-primary"/>
            <p class="mr-3 text-xl font-extrabold">My Crypto Portfolio</p>
        </div>
        <div>
            <x-button variant="primary">See all assets</x-button>
        </div>
    </div>
    <div class="mt-6 overflow-x-auto" x-data="{selected:null}">
        <div class="border rounded-md bg-gray-100 text-primary grid grid-cols-11 py-6 min-w-clg">
            <div class="col-span-1 flex justify-center items-center">
                <x-icon name="biarrow" class="w-2 h-3"/>
            </div>
            <div class="col-span-2 flex justify-start items-center space-x-2 px-5">
                <p class="text-lg">Coin</p>
                <x-icon name="biarrow" class="w-2 h-3"/>
            </div>
            <div class="col-span-1 flex justify-end items-center space-x-2">
                <p class="text-lg">Price</p>
                <x-icon name="biarrow" class="w-2 h-3"/>
            </div>
            <div class="col-span-3 flex justify-center items-center space-x-2">
                <p class="text-lg">Last 7 Days</p>
                <x-icon name="biarrow" class="w-2 h-3"/>
            </div>
            <div class="col-span-1 flex justify-start items-center space-x-2">
                <p class="text-lg">Holdings</p>
                <x-icon name="biarrow" class="w-2 h-3"/>
            </div>
            <div class="col-span-1 flex justify-end items-center space-x-2">
                <p class="text-lg">Percentage</p>
                <x-icon name="biarrow" class="w-2 h-3"/>
            </div>
            <div class="col-span-2 flex justify-center items-center space-x-2">
                <p class="text-lg">PNL</p>
                <x-icon name="biarrow" class="w-2 h-3"/>
            </div>
        </div>
        @foreach ($portfolio ?? [] as $item)  
            <div class="mt-2" 
                x-bind:class="selected == {{ $item['id'] }} ? 'rounded-l-lg border-l-6 border-primary' : ''" 
                @click="selected !== {{ $item['id'] }} ? selected = {{ $item['id'] }} : selected = null"
            >
                <x-portfolio-list-item 
                    id="{{ $item['id'] }}" 
                    icon="bitcoin"
                    name="{{ $item['name'] }}"
                    type="{{ $item['type'] }}"
                    lingColor="#FF0303"
                    price="{{ $item['price'] }}"
                    holdingBtc="{{ $item['holding']['btc'] }}"
                    holdingUsd="{{ $item['holding']['usd'] }}"
                    percent="{{ $item['percentage'] }}"
                    pnlPrice="{{ $item['pnl']['price'] }}"
                    pnlPercent="{{ $item['pnl']['percent'] }}"
                    iconColor="{{ $item['icon']['color'] }} "
                    node="parent"
                />
                <div x-show="selected == {{ $item['id'] }}" x-transition.duration.500ms>
                    @foreach ($item['child'] ?? [] as $child)
                        <x-portfolio-list-item 
                            id="{{ $child['id'] }}" 
                            icon="bitcoin"
                            name="{{ $child['name'] }}"
                            type="{{ $child['type'] }}"
                            lingColor="#FF0303"
                            price="{{ $child['price'] }}"
                            holdingBtc="{{ $child['holding']['btc'] }}"
                            holdingUsd="{{ $child['holding']['usd'] }}"
                            percent="{{ $child['percentage'] }}"
                            pnlPrice="{{ $child['pnl']['price'] }}"
                            pnlPercent="{{ $child['pnl']['percent'] }}"
                            iconColor="{{ $child['icon']['color'] }}"
                            node="child"
                        />
                    @endforeach
                </div>
            </div>          
        @endforeach
    </div>
</div>
