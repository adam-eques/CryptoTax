<div class="grid grid-cols-1 md:grid-cols-6 gap-0 md:gap-6" x-data="{ category: 'Exchange'}">
    <div class="col-span-1 py-8 space-y-5">
        @php
            $button_group = [
                [ 'icon' => 'exchange-1', 'name' => 'Exchange' ],
                [ 'icon' => 'wallet-1', 'name' => 'Wallets' ],
                [ 'icon' => 'blockchain', 'name' => 'Blockchains' ],
                [ 'icon' => 'others', 'name' => 'Others' ],
            ]
        @endphp

        @foreach ($button_group as $button)            
            <x-button variant="white" class="w-full bg-gray-200 focus:bg-primary focus:text-white" x-on:click="category = {{ $button['name'] }}">
                <x-icon name="{{ $button['icon'] }}" class="w-8 h-8 mr-3"/>
                <span class="text-xl font-bold tracking-tight">{{ __( $button['name']) }}</span>
                <x-icon name="fas-arrow-right" class="w-3 ml-3" x-show="category == 'Exchange'"/>
            </x-button>
        @endforeach
    </div>
    <div class="col-span-5 border rounded-md p-7">
        <div class="flex items-center border rounded-lg px-4 py-2">
            <x-icon name="fas-search" class="w-4"/>
            <input type="text" class="border-0 ring-0 outline-none rounded-lg w-full focus:ring-0" placeholder="Search for an exchange">
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-0 md:gap-10 mt-8">
            <div class="overflow-auto h-full">
                <div class="border rounded-md">
                    @php
                        $list_data = [
                            [ 'icon' => 'maker', 'name' => 'Coinbase' ],
                            [ 'icon' => 'maker', 'name' => 'Coinbase' ]
                        ]
                    @endphp

                    @foreach ($list_data as $item)
                        <div class="grid grid-cols-5 items-center py-5 px-6 border-b cursor-pointer hover:bg-gray-100">
                            <x-icon name="{{ $item['icon'] }}" class="w-auto h-8 col-span-2"></x-icon>
                            <p class="col-span-3">{{ __($item['name']) }}</p>
                        </div>
                    @endforeach
                    <div class="py-5 flex justify-center items-center space-x-5 cursor-pointer hover:bg-gray-100">
                        <x-icon name="fas-chevron-down" class="w-3 h-3"/>
                        <p>{{ __('More.... (300+ Exchanges)') }}</p>
                    </div>
                </div>
            </div>
            <div class="border border-dashed rounded-md">
                <div class="text-center">
                    <div class="bg-primary flex justify-center items-center rounded-full mx-auto w-30 h-30">
                        <x-icon name="book-info" class="w-16 h-16 text-white"/>
                    </div>
                    <p class="text-xl font-bold">{{ __('Instructions for API or CSV') }}</p>
                    <p>{{ __('Please select an Exchange to see import instructions.') }}</p>
                </div>
            </div>
        </div>
    </div>
</div>

