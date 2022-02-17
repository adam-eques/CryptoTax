<x-guest-layout>
    <div class="w-full bg-white">
        {{-- Hero --}}
        <div class="relative w-full">
            <div class="w-2/3 h-full absolute right-0 top-0">
                <img src="{{ asset("assets/img/subpage_images/landing_hero_bg_pattern.png") }}" class="w-full h-full hidden lg:block"/>
            </div>
            <x-landing-nav for="customer" class="relative"/>
            <x-container class="mt-16 xl:mt-30 pb-22">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-10 xl:gap-20 relative">
                    <div class="mt-0 xl:mt-12 2xl:mt-24 relative">
                        <img src="{{ asset('assets/img/subpage_images/landing_logo_bg_pattern.svg') }}" class="h-auto max-w-xl absolute -mt-16 z-0 hidden xl:block"/>
                        <div class="relative">
                            <p class="text-xl lg:text-3xl">{{ __('Track your crypto') }}</p>
                            <h2 class="text-3xl md:text-4xl lg:text-5xl xl:text-6xl font-bold mt-5 lg:mt-5">{{ __('Portfolio & Taxes') }}</h2>
                            <p class="mt-5 lg:mt-10 text-lg leading-loose">{{ __('Use our cryptocurrency tax software to easily track your trades, see your profits, and never overpay on your crypto taxes again.') }}</p>
                            <x-button size="lg" class="font-semibold tracking-tight px-8 mt-8">{{ __('Register for free') }}</x-button>
                        </div>
                    </div>
                    <div class="md:block hidden">
                        <img src="{{ asset('assets/img/subpage_images/landing_portfolio_and_taxes.svg') }}" class="w-full"/>
                    </div>
                </div>
            </x-container>
        </div>

        {{-- partner --}}
        <x-container>
            <p class="text-center font-bold text-gray-300">{{  __('Meet Our Partners') }}</p>
            @php
                $partners = [
                    'assets/img/subpage_images/landing_partner_binance.svg',
                    'assets/img/subpage_images/landing_partner_bitcoin.svg',
                    'assets/img/subpage_images/landing_partner_ethereum.svg',
                    'assets/img/subpage_images/landing_partner_kucoin.svg',
                    'assets/img/subpage_images/landing_partner_litecoin.svg',
                    'assets/img/subpage_images/landing_partner_tether.svg'
                ]
            @endphp
            <div class="grid grid-cols-3 sm:grid-cols-6 items-center gap-5 md:gap-10 xl:gap-20 px-10 mt-5 sm:mt-12">
                @foreach ($partners as $partner)
                    <img src="{{ asset($partner) }}" class="w-full h-auto"/>
                @endforeach
            </div>

            @php
                $items = [
                    [ 'img' => 'assets/img/subpage_images/landing_import_transaction.svg', 'title' => 'Import Your Transactions', 'content' => 'Instantly generate and sign your tax forms including Form 8949, Schedue 1, and Schedue D. also included are our exclusive' ],
                    [ 'img' => 'assets/img/subpage_images/landing_review_transaction.svg', 'title' => 'Review Your Transactions', 'content' => 'Instantly generate and sign your tax forms including Form 8949, Schedue 1, and Schedue D. also included are our exclusive' ],
                    [ 'img' => 'assets/img/subpage_images/landing_download_tax.svg', 'title' => 'Download your tax report', 'content' => 'Instantly generate and sign your tax forms including Form 8949, Schedue 1, and Schedue D. also included are our exclusive' ],
                ]
            @endphp
            <div class="relative mt-5 sm:mt-24">
                <img src="{{ asset('assets/img/subpage_images/landing_arrow.svg') }}" class="absolute w-1/2 left-1/2 -translate-x-1/2 top-24 hidden md:block"/>
                <div class="grid grid-cols-1 md:grid-cols-3 items-end gap-3 lg:gap-10 relative">
                    @foreach ($items as $item)
                        <div class="text-center px-5 relative">
                            <img src="{{ asset($item['img']) }}" class="flex mx-auto"/>
                            <p class="text-lg font-bold mt-3">{{ __($item['title']) }}</p>
                            <p class="text-gray-500 mt-5 leading-loose">{{ __($item['content']) }}</p>
                        </div>
                    @endforeach
                </div>
            </div>

            {{-- Why choose us --}}
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-5 mt-10 md:mt-36 pb-14">
                <div>
                    <img src="{{ asset('assets/img/subpage_images/landing_portfolio.svg') }}" class="w-full h-auto"/>
                </div>
                <div class="px-5 sm:px-10">
                    <div class="w-full relative">
                        <div class="w-full absolute -top-18">
                            <img src="{{ asset('assets/img/subpage_images/landing_logo_bg_pattern.svg') }}" class="w-full"/>
                        </div>
                        <div class="relative">
                            <h5 class="text-secondary text-lg font-bold">{{ __('Why Choose Us') }}</h5>
                            <h3 class="text-2xl md:text-2xl lg:text-4xl xl:text-5xl font-bold mt-4">{{  __('Solutions for every ') }}</h3>
                            <h3 class="text-2xl md:text-2xl lg:text-4xl xl:text-5xl font-bold mt-3">{{  __('single problems') }}</h3>
                            <p class="my-4 leading-loose">{{ __('Duis consectetur feugiat auctor. Morbi nec enim luctus, feugiat arcu id, ultricies ante. Duis vel massa eleifend, porta est non, feugiat metus. Cras ante massa, tincidunt nec lobortis quis ') }}</p>
                            <p class="leading-loose">{{ __('Design is everywhere. From the dress you’re wearing to the smartphone you’re holding, it’s design. If you think good design is expensive, you should look at the cost of bad design. ') }}</p>
                            <x-button class="mt-5 font-semibold">{{ __('More Details') }}</x-button>
                        </div>
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
