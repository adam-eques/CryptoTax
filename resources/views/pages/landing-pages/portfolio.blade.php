<x-guest-layout>
    <div class="w-full bg-white">
        <div class="relative">
            <div class="absolute top-0 right-0 w-full h-full">
                <img src="{{ asset("assets/img/subpage_images/portfolio_banner.png") }}" class="hidden w-full h-full lg:block"/>
            </div>
            <x-landing-nav for="customer" logo="white" class="relative"/>
            <x-container class="pb-10 mt-16 2xl:mt-30 md:pb-50">
                {{-- Hero section --}}
                <div class="relative grid grid-cols-1 gap-10 md:grid-cols-2 xl:gap-20">
                    <div class="relative order-2 mt-0 sm:order-1 xl:mt-12 2xl:mt-24">
                        <img src="{{ asset('assets/img/subpage_images/contact_bg_pattern.svg') }}" class="absolute hidden h-auto max-w-lg -mt-20 -ml-8 lg:block"/>
                        <div class="relative">
                            <h5 class="text-xl text-primary lg:text-white">{{ __('Get Fully Control') }}</h5>
                            <h2 class="text-2xl font-bold text-primary lg:text-white xl:text-5xl lg:text-4xl md:text-3xl mt-7">{{ __('Of Your Portfolio') }}</p>
                            <h5 class="mt-6 text-lg text-primary lg:text-white">{{ __('Use our cryptocurrency tax software to easily track your trades, see your profits, and never overpay on your crypto taxes again.') }}</h5>
                            <x-button variant="secondary" size="lg" class="mt-6 font-bold tracking-tight border-0">{{ __('View Portfolio') }}</x-button>
                        </div>
                    </div>
                    <div class="order-1 sm:order-2">
                        <img src="{{ asset('assets/img/subpage_images/portfolio_hero.svg') }}" class="w-full" />
                    </div>
                </div>
            </x-container>
        </div>
        {{-- Feature --}}
        <x-container>
            <div class="relative text-center">
                <img src="{{ asset('assets/img/subpage_images/landing_logo_bg_pattern.svg') }}" class="absolute max-w-full -translate-x-1/2 left-1/2 -top-6"/>
                <div class="relative">
                    <p class="font-semibold text-secondary">{{ __('Features') }}</p>
                    <h3 class="mt-4 text-xl font-bold md:text-3xl lg:text-4xl xl:text-5xl">{{ __('With all the Features You Need') }}</h3>
                    <p class="mt-5">{{ __('Duis consectetur feugiat auctor. Morbi nec enim luctus, feugiat arcu id, ultricies ante. Duis vel massa eleifend, porta ') }}</p>
                    <p class="mt-2">{{ __('est non, feugiat metus. Cras ante massa, tincidunt nec lobortis quis ') }}</p>
                    <img src="{{ asset('assets/img/subpage_images/portfolio_all_feature.svg') }}" class="w-full h-auto mt-14" />
                </div>
            </div>
        </x-container>
        {{-- Analytics --}}
        <div class="relative overflow-hidden pt-30">
            <img src="{{ asset('assets/img/subpage_images/portfolio_bg_pattern_1.svg') }}" class="absolute top-0 h-full -right-20"/>
            <x-container class="relative">
                <div class="grid grid-cols-1 gap-5 md:grid-cols-2 2xl:gap-42 xl:gap-30 lg:gap-24 md:gap-10">
                    <div class="flex items-center">
                        <div class="relative my-auto">
                            <img src="{{ asset('assets/img/subpage_images/landing_logo_bg_pattern.svg') }}" class="absolute max-w-full -translate-x-1/2 left-1/2 -top-6"/>
                            <div class="relative">
                                <p class="font-semibold text-secondary">{{ __('Analytics') }}</p>
                                <h2 class="mt-4 text-xl font-bold md:text-3xl lg:text-4xl xl:text-5xl">{{ __('Advanced Analytics,') }}</h2>
                                <h2 class="mt-3 text-xl font-bold md:text-3xl lg:text-4xl xl:text-5xl">{{ __('Understand Business') }}</h2>
                                <p class="mt-5 leading-loose text-left sm:mt-6">{{ __("Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. ") }}</p>
                                <p class="mt-5 leading-loose text-left">{{ __("Design is everywhere. From the dress you’re wearing to the smartphone you’re holding, it’s design. If you think good design is expensive, you should look at the cost of bad design.") }}</p>
                            </div>
                        </div>
                    </div>
                    <div class="flex items-center">
                        <img src="{{asset('assets/img/subpage_images/portfolio_3.svg')}}" class="w-full"/>
                    </div>
                </div>
            </x-container>
        </div>
        {{-- Coin Allocation --}}
        <div class="relative overflow-hidden pt-26">
            <img src="{{ asset('assets/img/subpage_images/portfolio_bg_pattern_1.svg') }}" class="absolute top-0 h-full -left-30"/>
            <x-container class="relative">
                <div class="grid grid-cols-1 gap-5 md:grid-cols-2 2xl:gap-42 xl:gap-30 lg:gap-24 md:gap-10">
                    <div class="">
                        <img src="{{asset('assets/img/subpage_images/portfolio_2.svg')}}" class="w-full"/>
                    </div>
                    <div class="flex items-center">
                        <div class="relative my-auto">
                            <img src="{{ asset('assets/img/subpage_images/landing_logo_bg_pattern.svg') }}" class="absolute max-w-full -translate-x-1/2 left-1/2 -top-6"/>
                            <div class="relative">
                                <p class="font-semibold text-secondary">{{ __('Coin Allocation') }}</p>
                                <h2 class="mt-5 text-xl font-bold md:text-3xl lg:text-4xl xl:text-5xl">{{ __('Portfolio Allocation') }}</h2>
                                <p class="mt-5 leading-loose text-left sm:mt-6">{{ __("Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. ") }}</p>
                                <p class="mt-5 leading-loose text-left">{{ __("Design is everywhere. From the dress you’re wearing to the smartphone you’re holding, it’s design. If you think good design is expensive, you should look at the cost of bad design.") }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </x-container>
        </div>
        {{-- Portfolio --}}
        <div class="relative py-20 overflow-hidden">
            <img src="{{ asset('assets/img/subpage_images/portfolio_bg_pattern_1.svg') }}" class="absolute top-0 h-full -right-30"/>
            <x-container class="relative">
                <div class="grid grid-cols-1 gap-5 md:grid-cols-2 2xl:gap-42 xl:gap-30 lg:gap-24 md:gap-10">
                    <div class="flex items-center">
                        <div class="relative my-auto">
                            <img src="{{ asset('assets/img/subpage_images/landing_logo_bg_pattern.svg') }}" class="absolute max-w-full -translate-x-1/2 left-1/2 -top-6"/>
                            <div class="relative">
                                <p class="font-semibold text-secondary">{{ __('Portfolio') }}</p>
                                <h2 class="mt-5 text-xl font-bold md:text-3xl lg:text-4xl xl:text-5xl">{{ __('My Crypto Portfolio') }}</h2>
                                <p class="mt-5 leading-loose text-left sm:mt-6">{{ __("Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. ") }}</p>
                                <p class="mt-5 leading-loose text-left">{{ __("Design is everywhere. From the dress you’re wearing to the smartphone you’re holding, it’s design. If you think good design is expensive, you should look at the cost of bad design.") }}</p>
                            </div>
                        </div>
                     </div>
                    <div class="flex items-center">
                        <img src="{{asset('assets/img/subpage_images/portfolio_4.svg')}}" class="w-full"/>
                    </div>
                </div>
    
            </x-container>
        </div>
        <x-footer-get-start/>
    </div>
    <x-footer/>
</x-guest-layout>