<x-guest-layout>
    <div class="w-full bg-white relative">
        <img src="{{ asset("assets/img/svg/hero_pattern.svg") }}" class="absolute right-0 top-0 z-0 w-2/3 h-auto"/>
        <x-landing-nav :for="'customer'"/>
        {{-- hero section --}}
        <x-container class="pt-24 relative">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-20">
                <div class="relative h-full flex items-center">
                    <div class="my-auto relative">
                        <img src="{{ asset('assets/img/svg/hero_pattern_2.svg') }}" class="h-auto absolute -mt-16 -ml-8"/>
                        <div class="relative">
                            <p class="text-xl lg:text-3xl">{{ __('Track your crypto') }}</p>
                            <h2 class="text-3xl md:text-4xl lg:text-5xl xl:text-6xl font-bold mt-5 lg:mt-8">{{ __('Portfolio & Taxes') }}</h2>
                            <p class="mt-5 lg:mt-10 text-lg">{{ __('Use our cryptocurrency tax software to easily track your trades,') }}</p>
                            <p class="mt-3 text-lg">{{ __('see your profits, and never overpay on your crypto taxes again.') }}</p>
                            <div class="flex space-x-4 mt-10 z-20 relative">
                                <x-button variant="white" class="bg-transparent text-primary font-bold" size="md">{{ __('Learn More') }}</x-button>
                                <x-button size="md" class="font-bold">{{ __('Register for free') }}</x-button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="md:block hidden">
                    <img src="{{ asset('assets/img/svg/hero_image.svg') }}"/>
                </div>
            </div>
        </x-container>
        {{-- partner --}}
        <x-container class="mt-22">
            <p class="text-center font-bold text-gray-300">{{  __('Meet Our Partners') }}</p>
            @php
                $partners = ['assets/img/svg/binance.svg', 'assets/img/svg/Bitcoin.svg', 'assets/img/svg/Ethereum.svg', 'assets/img/svg/Kucoin.svg', 'assets/img/svg/Litecoin.svg', 'assets/img/svg/tether.svg']
            @endphp
            <div class="grid grid-cols-3 sm:grid-cols-6 items-center gap-5 md:gap-10 xl:gap-20 mt-5 sm:mt-10">
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
            <div class="py-5 sm:py-24 grid grid-cols-1 lg:grid-cols-3 items-end gap-3 lg:gap-10">
                @foreach ($items as $item)                    
                    <div class="text-center px-5">
                        <img src="{{ asset($item['img']) }}" class="flex mx-auto"/>
                        <p class="text-lg font-bold my-5">{{ __($item['title']) }}</p>
                        <p class="text-gray-500">{{ __($item['content']) }}</p>
                    </div>
                @endforeach
            </div>

            {{-- Why choose us --}}
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-5 py-5 md:py-24">
                <div>
                    <img src="{{ asset('assets/img/svg/landing_img_1.svg') }}" class="w-full h-auto"/>
                </div>
                <div class="relative px-5 sm:px-10">
                    <img src="{{ asset('assets/img/svg/hero_pattern_2.svg') }}" class="w-full h-auto absolute -top-18"/>
                    <div class="relative">
                        <h5 class="text-secondary text-lg font-bold">{{ __('Why Choose Us') }}</h5>
                        <h3 class="text-2xl md:text-2xl lg:text-4xl xl:text-5xl font-bold mt-4">{{  __('Solutions for every ') }}</h3>
                        <h3 class="text-2xl md:text-2xl lg:text-4xl xl:text-5xl font-bold mt-4">{{  __('single problems') }}</h3>
                        <p class="my-6">{{ __('Duis consectetur feugiat auctor. Morbi nec enim luctus, feugiat arcu id, ultricies ante. Duis vel massa eleifend, porta est non, feugiat metus. Cras ante massa, tincidunt nec lobortis quis ') }}</p>
                        <p>{{ __('Design is everywhere. From the dress you’re wearing to the smartphone you’re holding, it’s design. If you think good design is expensive, you should look at the cost of bad design. ') }}</p>
                        <x-button class="mt-7">{{ __('More Details') }}</x-button>
                    </div>
                </div>
            </div>
        </x-container>
    </div>

    {{-- Supported Country --}}
    @livewire('landing-page.supported-country')

    <div class="w-full bg-white py-5 sm:py-12">
        <x-container>
            {{-- Membership --}}
            @livewire('landing-page.membership-plan')
            
            {{-- FAQs --}}
            @livewire('landing-page.faqs')
        </x-container>
    </div>

    <div class="w-full">
        {{-- testimonials --}}
        @livewire('landing-page.testimonials')

        {{-- Get start --}}
        <x-footer-get-start/>
    </div>

    {{-- footer --}}
    <x-footer/>
    
</x-guest-layout>
