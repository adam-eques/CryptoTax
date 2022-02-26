<x-guest-layout>
    <div class="w-full bg-white">
        {{-- Hero --}}
        <div class="relative w-full">
            <div class="absolute top-0 right-0 w-2/3 h-full">
                <img src="{{ asset("assets/img/subpage_images/landing_hero_bg_pattern.png") }}" class="hidden w-full h-full lg:block"/>
            </div>
            <x-landing-nav for="customer" class="relative"/>
            <x-container class="mt-16 xl:mt-30 pb-22">
                <div class="relative grid grid-cols-1 gap-10 md:grid-cols-2 xl:gap-20">
                    <div class="relative mt-0 xl:mt-12 2xl:mt-24">
                        <img src="{{ asset('assets/img/subpage_images/landing_logo_bg_pattern.svg') }}" class="absolute z-0 hidden h-auto max-w-xl -mt-16 xl:block"/>
                        <div class="relative">
                            <p class="text-xl lg:text-3xl">{{ __('Track your crypto') }}</p>
                            <h2 class="mt-5 text-3xl font-bold md:text-4xl lg:text-5xl xl:text-6xl lg:mt-5">{{ __('Portfolio & Taxes') }}</h2>
                            <p class="mt-5 text-lg leading-loose lg:mt-10">{{ __('Use our cryptocurrency tax software to easily track your trades, see your profits, and never overpay on your crypto taxes again.') }}</p>
                            <x-button size="lg" class="px-8 mt-8 font-semibold tracking-tight">{{ __('Register for free') }}</x-button>
                        </div>
                    </div>
                    <div class="hidden md:block">
                        <img src="{{ asset('assets/img/subpage_images/landing_portfolio_and_taxes.svg') }}" class="w-full"/>
                    </div>
                </div>
            </x-container>
        </div>

        {{-- partner --}}
        <x-container>
            <p class="font-bold text-center text-gray-300">{{  __('Meet Our Partners') }}</p>
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
            <div class="grid items-center grid-cols-3 gap-5 px-10 mt-5 sm:grid-cols-6 md:gap-10 xl:gap-20 sm:mt-12">
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
                <img src="{{ asset('assets/img/subpage_images/landing_arrow.svg') }}" class="absolute hidden w-1/2 -translate-x-1/2 left-1/2 top-24 md:block"/>
                <div class="relative grid items-end grid-cols-1 gap-3 md:grid-cols-3 lg:gap-10">
                    @foreach ($items as $item)
                        <div class="relative px-5 text-center">
                            <img src="{{ asset($item['img']) }}" class="flex mx-auto"/>
                            <p class="mt-3 text-lg font-bold">{{ __($item['title']) }}</p>
                            <p class="mt-5 leading-loose text-gray-500">{{ __($item['content']) }}</p>
                        </div>
                    @endforeach
                </div>
            </div>

            {{-- Why choose us --}}
            <div class="grid grid-cols-1 gap-5 mt-10 lg:grid-cols-2 md:mt-36 pb-14">
                <div>
                    <img src="{{ asset('assets/img/subpage_images/landing_portfolio.svg') }}" class="w-full h-auto"/>
                </div>
                <div class="px-5 sm:px-10">
                    <div class="relative w-full">
                        <div class="absolute w-full -top-18">
                            <img src="{{ asset('assets/img/subpage_images/landing_logo_bg_pattern.svg') }}" class="w-full"/>
                        </div>
                        <div class="relative">
                            <h5 class="text-lg font-bold text-secondary">{{ __('Why Choose Us') }}</h5>
                            <h3 class="mt-4 text-2xl font-bold md:text-2xl lg:text-4xl xl:text-5xl">{{  __('Solutions for every ') }}</h3>
                            <h3 class="mt-3 text-2xl font-bold md:text-2xl lg:text-4xl xl:text-5xl">{{  __('single problems') }}</h3>
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

    <div class="w-full py-5 bg-white sm:py-12">
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
