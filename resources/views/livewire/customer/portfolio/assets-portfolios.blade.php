<div>
    <h4 class="flex items-center text-2xl font-bold">{{ __('Portfolio ') }}<span class="ml-4 text-base font-normal">{{ __('please select your coins below Search bar.') }}</span></h4>
    <div class="flex items-center max-w-4xl space-x-4 mt-7">
        <input class="w-full px-4 py-3 border rounded-md" placeholder="Search Coin Name"/>
        <x-button>{{ __('Search') }}</x-button>
    </div>
    <div class="grid grid-cols-1 gap-4 mt-9 sm:grid-cols-2 lg:grid-cols-4 md:gap-8">
        @php
            $items = [
                [ 'icon' => 'uni-moneybag-o', 'name' => 'Net Worth', 'balance' => '10,236.01' ],
                [ 'icon' => 'bi-trophy', 'name' => 'Total Rewards', 'balance' => '54.83' ],
                [ 'icon' => 'healthicons-o-money-bag', 'name' => 'Total Assets', 'balance' => '10,181.58' ],
                [ 'icon' => 'fluentui-money-dismiss-20-o', 'name' => 'Total Debts', 'balance' => '0' ]
            ]        
        @endphp
        @foreach ($items as $item)        
            <div class="p-5 space-y-4 border rounded-md">
                <div class="flex items-center justify-between space-x-4">
                    <div class="space-y-4">
                        <h5 class="text-gray-400">{{ __($item['name']) }}</h5>
                        <h3 class="flex items-start text-2xl font-bold xl:text-3xl"><span class="text-base">$</span>{{ __($item['balance']) }}</h3>
                    </div>
                    <x-icon name="{{ $item['icon'] }}" class="w-20 h-20 text-gray-400"/>
                </div>
            </div>
        @endforeach
    </div>
    <div class="mt-12 space-y-10">
        <x-assets-toggle-block :opened="true">
            <x-slot name="triger">
                <div class="flex items-center justify-center w-6 h-6 border rounded-full">            
                    <svg class="w-4 transform trnstsn " fill="none" viewBox="0 0 24 24" stroke="currentColor" :class="{'rotate-180': opened}">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                    </svg>
                </div>
                <x-icon name="bx-add-to-queue" class="w-6 h-6"/>
                <span class="text-xl font-bold">{{ __('Wallet') }}</span>
                <x-badge size="md" variant="primary" type="square">{{ __('$ 21.67') }}</x-badge>
                <button class="p-2 text-sm text-white rounded-md bg-primary hover:bg-secondary">{{ __('Add Token') }}</button>
            </x-slot>
            <div class="p-5 overflow-auto">
                <div class="grid grid-cols-4 p-5 rounded-md min-w-[520px] bg-gray-50">
                    <p class="font-bold">{{ __('Assets') }}</p>
                    <p class="font-bold">{{ __('Balances') }}</p>
                    <p class="font-bold">{{ __('Price') }}</p>
                    <p class="font-bold">{{ __('Value') }}</p>
                </div>
                <div class="divide-y">
                    <div class="grid items-center grid-cols-4 p-5 min-w-[520px]">
                        <div class="flex items-center space-x-4">
                            <x-icon name="coins.BTC" class="w-8 h-8"/>
                            <p class="font-bold">{{ __('Bitcoin') }}</p>
                        </div>
                        <p class="">{{ __('$ 69,729.64') }}</p>
                        <p class="">{{ __('$ 433.46') }}</p>
                        <p class="">{{ __('$ 9.8') }}</p>
                    </div>
                    <div class="grid items-center grid-cols-4 p-5 min-w-[520px]">
                        <div class="flex items-center space-x-4">
                            <x-icon name="coins.BTC" class="w-8 h-8"/>
                            <p class="font-bold">{{ __('Bitcoin') }}</p>
                        </div>
                        <p class="">{{ __('$ 69,729.64') }}</p>
                        <p class="">{{ __('$ 433.46') }}</p>
                        <p class="">{{ __('$ 9.8') }}</p>
                    </div>
                    <div class="grid items-center grid-cols-4 p-5 min-w-[520px]">
                        <div class="flex items-center space-x-4">
                            <x-icon name="coins.BTC" class="w-8 h-8"/>
                            <p class="font-bold">{{ __('Bitcoin') }}</p>
                        </div>
                        <p class="">{{ __('$ 69,729.64') }}</p>
                        <p class="">{{ __('$ 433.46') }}</p>
                        <p class="">{{ __('$ 9.8') }}</p>
                    </div>
                    <div class="grid items-center grid-cols-4 p-5 min-w-[520px]">
                        <div class="flex items-center space-x-4">
                            <x-icon name="coins.BTC" class="w-8 h-8"/>
                            <p class="font-bold">{{ __('Bitcoin') }}</p>
                        </div>
                        <p class="">{{ __('$ 69,729.64') }}</p>
                        <p class="">{{ __('$ 433.46') }}</p>
                        <p class="">{{ __('$ 9.8') }}</p>
                    </div>
                </div>
            </div>
        </x-assets-toggle-block>
        <x-assets-toggle-block :opened="true">
            <x-slot name="triger">
                <div class="flex items-center justify-center w-6 h-6 border rounded-full">            
                    <svg class="w-4 transform trnstsn " fill="none" viewBox="0 0 24 24" stroke="currentColor" :class="{'rotate-180': opened}">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                    </svg>
                </div>
                <span class="text-xl font-bold">{{ __('VSS') }}</span>
                <p class="font-normal">{{ __('to be claimed') }}<span class="ml-2 font-bold">$56.36</span></p>
                <x-badge size="md" variant="primary" type="square">{{ __('$ 5,392.62') }}</x-badge>
            </x-slot>
            <div class="p-5 overflow-auto">
                <p class="mb-4 font-bold">{{ __('Farms') }}</p>
                <div class="grid grid-cols-5 p-5 rounded-md min-w-[1024px] bg-gray-50">
                    <p class="font-bold">{{ __('Pool') }}</p>
                    <p class="font-bold">{{ __('Balances') }}</p>
                    <p class="font-bold">{{ __('Rewards') }}</p>
                    <p class="font-bold">{{ __('APR') }}</p>
                    <p class="font-bold">{{ __('Value') }}</p>
                </div>
                <div class="divide-y">
                    <div class="grid grid-cols-5 p-5 rounded-md min-w-[1024px]">
                        <div class="font-bold">
                            <div class="relative flex items-center space-x-6">
                                <x-icon name="coins.BTC" class="w-8 h-8"/>
                                <x-icon name="coins.LTC" class="absolute left-0 w-7 h-7 top-2"/>
                                <p class="font-bold">{{ __('Bitcoin + Litecoin') }}</p>
                            </div>
                        </div>
                        <div>
                            <p>{{ __('$ 69,729.64 + $ 96,569') }}</p>
                            <p class="text-sm text-gray-400">{{ __('$ 956.89') }}</p>
                        </div>
                        <div>
                            <p>{{ __('$ 433.46 BTC') }}</p>
                            <p class="text-sm text-gray-400">{{ __('$ 956.89') }}</p>
                        </div>
                        <div>
                            <p>{{ __('59.01%') }}</p>
                            <p class="text-sm text-gray-400">{{ __('0.31% Daily') }}</p>
                        </div>
                        <div>
                            <p>{{ __('$ 1029.8') }}</p>
                        </div>
                    </div>
                </div>

                <p class="mt-8 mb-4 font-bold">{{ __('Auto Compound') }}</p>
                <div class="grid grid-cols-5 p-5 rounded-md min-w-[1024px] bg-gray-50">
                    <p class="font-bold">{{ __('Pool') }}</p>
                    <p class="font-bold">{{ __('Deposited') }}</p>
                    <p class="font-bold">{{ __('Earned') }}</p>
                    <p class="font-bold">{{ __('APR') }}</p>
                    <p class="font-bold">{{ __('Value') }}</p>
                </div>
                <div class="divide-y">
                    <div class="grid grid-cols-5 p-5 rounded-md min-w-[1024px]">
                        <div class="font-bold">
                            <div class="relative flex items-center space-x-6">
                                <x-icon name="coins.BTC" class="w-8 h-8"/>
                                <x-icon name="coins.LTC" class="absolute left-0 w-7 h-7 top-2"/>
                                <p class="font-bold">{{ __('Bitcoin + Litecoin') }}</p>
                            </div>
                        </div>
                        <div>
                            <p>{{ __('$ 69,729.64 + $ 96,569') }}</p>
                            <p class="text-sm text-gray-400">{{ __('$ 956.89') }}</p>
                        </div>
                        <div>
                            <p>{{ __('$ 433.46 BTC') }}</p>
                            <p class="text-sm text-gray-400">{{ __('$ 956.89') }}</p>
                        </div>
                        <div>
                            <p>{{ __('59.01%') }}</p>
                            <p class="text-sm text-gray-400">{{ __('0.31% Daily') }}</p>
                        </div>
                        <div>
                            <p>{{ __('$ 1029.8') }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </x-assets-toggle-block>
        <x-assets-toggle-block :opened="true">
            <x-slot name="triger">
                <div class="flex items-center justify-center w-6 h-6 border rounded-full">            
                    <svg class="w-4 transform trnstsn " fill="none" viewBox="0 0 24 24" stroke="currentColor" :class="{'rotate-180': opened}">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                    </svg>
                </div>
                <span class="text-xl font-bold">{{ __('PancakeSwap') }}</span>
                <x-badge size="md" variant="primary" type="square">{{ __('$ 5,392.62') }}</x-badge>
            </x-slot>
            <div class="p-5 overflow-auto">
                <div class="grid grid-cols-5 p-5 rounded-md min-w-[1024px] bg-gray-50">
                    <p class="font-bold">{{ __('Pool') }}</p>
                    <p class="font-bold">{{ __('Balances') }}</p>
                    <p class="font-bold">{{ __('Rewards') }}</p>
                    <p class="font-bold">{{ __('APR') }}</p>
                    <p class="font-bold">{{ __('Value') }}</p>
                </div>
                <div class="divide-y">
                    <div class="grid grid-cols-5 p-5 rounded-md min-w-[1024px]">
                        <div class="font-bold">
                            <div class="relative flex items-center space-x-6">
                                <x-icon name="coins.BTC" class="w-8 h-8"/>
                                <x-icon name="coins.LTC" class="absolute left-0 w-7 h-7 top-2"/>
                                <p class="font-bold">{{ __('Bitcoin + Litecoin') }}</p>
                            </div>
                        </div>
                        <div>
                            <p>{{ __('$ 69,729.64 + $ 96,569') }}</p>
                            <p class="text-sm text-gray-400">{{ __('$ 956.89') }}</p>
                        </div>
                        <div>
                            <p>{{ __('$ 433.46 BTC') }}</p>
                            <p class="text-sm text-gray-400">{{ __('$ 956.89') }}</p>
                        </div>
                        <div>
                            <p>{{ __('59.01%') }}</p>
                            <p class="text-sm text-gray-400">{{ __('0.31% Daily') }}</p>
                        </div>
                        <div>
                            <p>{{ __('$ 1029.8') }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </x-assets-toggle-block>
        <x-assets-toggle-block :opened="true">
            <x-slot name="triger">
                <div class="flex items-center justify-center w-6 h-6 border rounded-full">            
                    <svg class="w-4 transform trnstsn " fill="none" viewBox="0 0 24 24" stroke="currentColor" :class="{'rotate-180': opened}">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                    </svg>
                </div>
                <span class="text-xl font-bold">{{ __('Tectonic') }}</span>
                <x-badge size="md" variant="primary" type="square">{{ __('$ 5,392.62') }}</x-badge>
            </x-slot>
            <div class="p-5 overflow-auto">
                <div class="grid grid-cols-4 p-5 rounded-md min-w-[520px] bg-gray-50">
                    <p class="font-bold">{{ __('Assets') }}</p>
                    <p class="font-bold">{{ __('Balances') }}</p>
                    <p class="font-bold">{{ __('Price') }}</p>
                    <p class="font-bold">{{ __('Value') }}</p>
                </div>
                <div class="grid items-center grid-cols-4 p-5 min-w-[520px]">
                    <div class="flex items-center space-x-4">
                        <x-icon name="coins.BTC" class="w-8 h-8"/>
                        <p class="font-bold">{{ __('Bitcoin') }}</p>
                    </div>
                    <p class="">{{ __('$ 69,729.64') }}</p>
                    <p class="">{{ __('$ 433.46') }}</p>
                    <p class="">{{ __('$ 9.8') }}</p>
                </div>
            </div>
        </x-assets-toggle-block>
        <x-assets-toggle-block :opened="true">
            <x-slot name="triger">
                <div class="flex items-center justify-center w-6 h-6 border rounded-full">            
                    <svg class="w-4 transform trnstsn " fill="none" viewBox="0 0 24 24" stroke="currentColor" :class="{'rotate-180': opened}">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                    </svg>
                </div>
                <span class="text-xl font-bold">{{ __('Binance Spot & Earn') }}</span>
                <x-badge size="md" variant="primary" type="square">{{ __('Earn $ 21.67') }}</x-badge>
            </x-slot>
            <div class="p-5 overflow-auto">
                <div class="grid grid-cols-4 p-5 rounded-md min-w-[520px] bg-gray-50">
                    <p class="font-bold">{{ __('Assets') }}</p>
                    <p class="font-bold">{{ __('Balances') }}</p>
                    <p class="font-bold">{{ __('Price') }}</p>
                    <p class="font-bold">{{ __('Value') }}</p>
                </div>
                <div class="grid items-center grid-cols-4 p-5 min-w-[520px]">
                    <div class="flex items-center space-x-4">
                        <x-icon name="coins.BTC" class="w-8 h-8"/>
                        <p class="font-bold">{{ __('Bitcoin') }}</p>
                    </div>
                    <p class="">{{ __('$ 69,729.64') }}</p>
                    <p class="">{{ __('$ 433.46') }}</p>
                    <p class="">{{ __('$ 9.8') }}</p>
                </div>
            </div>
        </x-assets-toggle-block>
    </div>
</div>
