<x-guest-layout>
    <div class="w-full bg-white relative">
        <img src="{{ asset("assets/img/svg/hero_pattern.svg") }}" class="absolute right-0 top-0 z-0 w-2/3 h-auto"/>
        <x-index.nav/>
        {{-- hero section --}}
        <div class="pt-50 relative">
            <div class="mx-auto px-3 xs:px-4 xl:max-w-screen-2xl lg:px-5">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-20">
                    <div class="relative h-full flex items-center">
                        <div class="p-20 absolute">
                            <img src="{{ asset('assets/img/svg/hero_pattern_2.svg') }}" class="w-full h-auto"/>
                        </div>
                        <div class="m-auto">
                            <p class="text-xl lg:text-3xl">{{ __('Track your crypto') }}</p>
                            <p class="text-4xl lg:text-6xl font-extrabold mt-5 lg:mt-8">{{ __('Portfolio & Taxes') }}</p>
                            <p class="mt-5 lg:mt-10 text-lg">{{ __('Use our cryptocurrency tax software to easily track your trades,') }}</p>
                            <p class="mt-3 text-lg">{{ __('see your profits, and never overpay on your crypto taxes again.') }}</p>
                            <div class="flex space-x-4 mt-10 z-20 relative">
                                <x-button class="bg-transparent text-primary font-bold" size="md">{{ __('Learn More') }}</x-button>
                                <x-button size="md" class="font-bold">{{ __('Register for free') }}</x-button>
                            </div>
                        </div>
                    </div>
                    <div class="md:block hidden">
                        <img src="{{ asset('assets/img/svg/hero_image.svg') }}"/>
                    </div>
                </div>
            </div>
        </div>
        {{-- partner --}}
        <div class="mt-24 mx-auto px-3 xs:px-4 xl:max-w-screen-2xl lg:px-5">
            <p class="text-center font-bold text-gray-300">{{  __('Meet Our Partners') }}</p>
            @php
                $partners = ['assets/img/svg/binance.svg', 'assets/img/svg/Bitcoin.svg', 'assets/img/svg/Ethereum.svg', 'assets/img/svg/Kucoin.svg', 'assets/img/svg/Litecoin.svg', 'assets/img/svg/tether.svg']
            @endphp
            <div class="grid grid-cols-3 sm:grid-cols-6 items-center gap-5 md:gap-10 xl:gap-20 mt-5 sm:mt-10 px-10">
                @foreach ($partners as $partner)                    
                    <img src="{{ asset($partner) }}" class="w-full h-auto"/>
                @endforeach
            </div>

            @php
                $items = [
                    [ 'img' => 'assets/img/svg/import_transaction.svg', 'title' => 'Import Your Transactions', 'content' => 'Instantly generate and sign your tax forms including Form 8949, Schedue 1, and Schedue D. also included are our exclusive' ],
                    [ 'img' => 'assets/img/svg/review_transaction.svg', 'title' => 'Review Your Transactions', 'content' => 'Instantly generate and sign your tax forms including Form 8949, Schedue 1, and Schedue D. also included are our exclusive' ],
                    [ 'img' => 'assets/img/svg/download_tax.svg', 'title' => 'Download your tax report', 'content' => 'Instantly generate and sign your tax forms including Form 8949, Schedue 1, and Schedue D. also included are our exclusive' ],
                ]
            @endphp
            <div class="py-24 grid grid-cols-1 lg:grid-cols-3 items-end gpp-3 lg:gap-10">
                @foreach ($items as $item)                    
                    <div class="text-center px-5">
                        <img src="{{ asset($item['img']) }}" class="flex mx-auto"/>
                        <p class="text-lg font-bold my-5">{{ __($item['title']) }}</p>
                        <p class="text-gray-500">{{ __($item['content']) }}</p>
                    </div>
                @endforeach
            </div>
        </div>

    </div>
</x-guest-layout>
