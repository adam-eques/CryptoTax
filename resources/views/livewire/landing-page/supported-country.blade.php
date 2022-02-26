 {{-- supported_country --}}
 <div class="w-full">
    <x-container>
        <div class="relative text-center py-14">
            <img src="{{ asset('assets/img/subpage_images/map_logo_background.svg') }}" class="absolute -translate-x-1/2 top-8 left-1/2"/>
            <div class="relative">
                <p  class="text-2xl font-bold lg:text-3xl xl:text-4xl">{{ __('Supported Countries') }}</p>
                <div class="flex items-center justify-center mt-12 space-x-2 sm:space-x-8 md:space-x-16">
                    <div class="text-center">
                        <x-icon name="flag.usa" class="h-7 sm:h-10"/>
                        <p class="mt-1">USA</p>
                    </div>
                    <div class="text-center">
                        <x-icon name="flag.france" class="h-7 sm:h-10"/>
                        <p class="mt-1">France</p>
                    </div>
                    <div class="text-center">
                        <x-icon name="flag.germany" class="h-7 sm:h-10"/>
                        <p class="mt-1">Germany</p>
                    </div>
                    <div class="text-center">
                        <x-icon name="flag.sk" class="h-7 sm:h-10"/>
                        <p class="mt-1">Korea</p>
                    </div>
                    <div class="text-center">
                        <x-icon name="flag.japan" class="h-7 sm:h-10"/>
                        <p class="mt-1">Japan</p>
                    </div>
                </div>
                <img src="{{ asset('assets/img/subpage_images/landing_supported_country.svg') }}" class="w-full h-auto p-5 m-auto md:p-16 max-w-7xl"/>
                <div class="grid grid-cols-2 gap-0 px-2 md:grid-cols-4 lg:grid-cols-4 sm:gap-4 lg:gap-10 lg:px-10">
                    @php
                        $items = [
                            [ 'icon' => 'level-top', 'amount' => '20M +', 'term' => 'Happy Users' ],
                            [ 'icon' => 'transaction-1', 'amount' => '70M / Year', 'term' => 'Transactions' ],
                            [ 'icon' => 'solid_land', 'amount' => '15K +', 'term' => 'Recently Sold Lands' ],
                            [ 'icon' => 'chains', 'amount' => '8K +', 'term' => 'Supported Coins' ],
                        ]
                    @endphp
                    @foreach ($items as $item)                        
                        <div class="flex items-center justify-end space-x-4">
                            <div class="w-1/4 p-0 xl:p-3">
                                <x-icon name="{{ $item['icon'] }}" class="w-full h-full" />
                            </div>
                            <div class="w-3/4 text-left">
                                <p class="text-xl font-bold sm:text-2xl xl:text-3xl">{{ __($item['amount']) }}</p>
                                <p class="text-base text-gray-400">{{ __($item['term']) }}</p>
                            </div>
                        </div>
                    @endforeach
                    
                </div>
            </div>
        </div>
    </x-container>
</div>
