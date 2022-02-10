<x-guest-layout>
    <div class="w-full bg-white">
        <div class="relative">
            <div class="w-full h-full absolute right-0 top-0">
                <img src="{{ asset("assets/img/subpage_images/portfolio_banner.png") }}" class="w-full h-full hidden lg:block"/>
            </div>
            <x-landing-nav for="customer" logo="white" class="relative"/>
            <x-container class="mt-16 2xl:mt-30 pb-10 md:pb-50">
                {{-- Hero section --}}
                <div class="grid grid-cols-1 md:grid-cols-2 gap-10 xl:gap-20 relative">
                    <div class="order-2 sm:order-1 relative mt-0 xl:mt-12 2xl:mt-24">
                        <img src="{{ asset('assets/img/svg/transparent_logo.svg') }}" class="h-auto max-w-lg absolute -mt-20 -ml-8 hidden lg:block"/>
                        <div class="relative">
                            <h5 class="text-primary lg:text-white text-xl">{{ __('Get Fully Control') }}</h5>
                            <h2 class="text-primary lg:text-white xl:text-5xl lg:text-4xl md:text-3xl text-2xl font-bold mt-7">{{ __('Of Your Portfolio') }}</p>
                            <h5 class="text-primary lg:text-white text-lg mt-6">{{ __('Use our cryptocurrency tax software to easily track your trades, see your profits, and never overpay on your crypto taxes again.') }}</h5>
                            <x-button variant="secondary" size="lg" class="mt-6 border-0 tracking-tight font-bold">{{ __('View Portfolio') }}</x-button>
                        </div>
                    </div>
                    <div class="order-1 sm:order-2">
                        <img src="{{ asset('assets/img/subpage_images/portfolio_hero.svg') }}" class="w-full" />
                    </div>
                </div>
            </x-container>
        </div>
        {{--  --}}
        <x-container>
            <div class="text-center relative">
                <img src="{{ asset('assets/img/subpage_images/landing_logo_bg_pattern.svg') }}" class="absolute left-1/2 -translate-x-1/2 -top-6 max-w-full"/>
                <div class="relative">
                    <p class="text-secondary font-semibold">{{ __('Features') }}</p>
                    <h3 class="font-bold text-xl md:text-3xl lg:text-4xl xl:text-5xl mt-4">{{ __('With all the Features You Need') }}</h3>
                    <p class="mt-5">{{ __('Duis consectetur feugiat auctor. Morbi nec enim luctus, feugiat arcu id, ultricies ante. Duis vel massa eleifend, porta ') }}</p>
                    <p class="mt-2">{{ __('est non, feugiat metus. Cras ante massa, tincidunt nec lobortis quis ') }}</p>
                    <img src="{{ asset('assets/img/subpage_images/portfolio_all_feature.svg') }}" class="w-full h-auto mt-14" />
                </div>
            </div>
        </x-container>
        {{--  --}}
        <div class="overflow-hidden relative mt-20 py-10">
            <img src="{{ asset('assets/img/subpage_images/portfolio_bg_pattern_1.svg') }}" class="absolute top-0 -right-20 h-full"/>
            <x-container class="relative">
                <div class="grid grid-cols-1 md:grid-cols-2 2xl:gap-42 xl:gap-30 lg:gap-24 md:gap-10 gap-5">
                    <div class="flex items-center">
                        <div class="my-auto relative">
                            <img src="{{ asset('assets/img/subpage_images/landing_logo_bg_pattern.svg') }}" class="absolute left-1/2 -translate-x-1/2 -top-6 max-w-full"/>
                            <div class="relative">
                                <p class="text-secondary font-semibold">{{ __('Analytics') }}</p>
                                <h2 class="font-bold text-xl md:text-3xl lg:text-4xl xl:text-5xl mt-4">{{ __('Advanced Analytics,') }}</h2>
                                <h2 class="font-bold text-xl md:text-3xl lg:text-4xl xl:text-5xl mt-2">{{ __('Understand Business') }}</h2>
                                <p class="sm:mt-7 mt-5 text-left leading-loose">{{ __("Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. ") }}</p>
                                <p class="mt-5 text-left leading-loose">{{ __("Design is everywhere. From the dress you’re wearing to the smartphone you’re holding, it’s design. If you think good design is expensive, you should look at the cost of bad design.") }}</p>
                            </div>
                        </div>
                    </div>
                    <div class="flex items-center">
                        <img src="{{asset('assets/img/subpage_images/portfolio_3.svg')}}" class="w-full"/>
                    </div>
                </div>
            </x-container>
        </div>
        {{--  --}}
        <div class="overflow-hidden relative py-10">
            <img src="{{ asset('assets/img/subpage_images/portfolio_bg_pattern_1.svg') }}" class="absolute top-0 -left-30 h-full"/>
            <x-container class="relative">
                <div class="grid grid-cols-1 md:grid-cols-2 2xl:gap-42 xl:gap-30 lg:gap-24 md:gap-10 gap-5 py-5">
                    <div class="">
                        <img src="{{asset('assets/img/subpage_images/portfolio_2.svg')}}" class="w-full"/>
                    </div>
                    <div class="flex items-center">
                        <div class="my-auto relative">
                            <img src="{{ asset('assets/img/subpage_images/landing_logo_bg_pattern.svg') }}" class="absolute left-1/2 -translate-x-1/2 -top-6 max-w-full"/>
                            <div class="relative">
                                <p class="text-secondary font-semibold">{{ __('Coin Allocation') }}</p>
                                <h2 class="font-bold text-xl md:text-3xl lg:text-4xl xl:text-5xl mt-4">{{ __('Portfolio Allocation') }}</h2>
                                <p class="sm:mt-9 mt-5 text-left leading-loose">{{ __("Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. ") }}</p>
                                <p class="mt-5 text-left leading-loose">{{ __("Design is everywhere. From the dress you’re wearing to the smartphone you’re holding, it’s design. If you think good design is expensive, you should look at the cost of bad design.") }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </x-container>
        </div>
        {{--  --}}
        <div class="overflow-hidden relative py-10">
            <img src="{{ asset('assets/img/subpage_images/portfolio_bg_pattern_1.svg') }}" class="absolute top-0 -right-30 h-full"/>
            <x-container class="relative">
                <div class="grid grid-cols-1 md:grid-cols-2 2xl:gap-42 xl:gap-30 lg:gap-24 md:gap-10 gap-5 py-5">
                    <div class="flex items-center">
                        <div class="my-auto relative">
                            <img src="{{ asset('assets/img/subpage_images/landing_logo_bg_pattern.svg') }}" class="absolute left-1/2 -translate-x-1/2 -top-6 max-w-full"/>
                            <div class="relative">
                                <p class="text-secondary font-semibold">{{ __('portfolio') }}</p>
                                <h2 class="font-bold text-xl md:text-3xl lg:text-4xl xl:text-5xl mt-4">{{ __('My Crypto Portfolio') }}</h2>
                                <p class="sm:mt-9 mt-5 text-left leading-loose">{{ __("Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. ") }}</p>
                                <p class="mt-5 text-left leading-loose">{{ __("Design is everywhere. From the dress you’re wearing to the smartphone you’re holding, it’s design. If you think good design is expensive, you should look at the cost of bad design.") }}</p>
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