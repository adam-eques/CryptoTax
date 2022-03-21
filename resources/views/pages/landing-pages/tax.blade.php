<x-guest-layout title="Tax">
    <div class="relative w-full bg-white">
        <div class="relative">
            <div class="absolute top-0 right-0 w-3/4 h-full">
                <img src="{{ asset("assets/img/subpage_images/tax_banner.png") }}" class="hidden w-full h-full lg:block"/>
            </div>
            <x-landing-nav for="customer" class="relative"/>
            {{-- Hero --}}
            <x-container class="pb-16 mt-8 xl:mt-14">
                <div class="relative grid grid-cols-1 gap-10 md:grid-cols-2 xl:gap-20">
                    <div class="relative mt-0 xl:mt-12 2xl:mt-24">
                        <img src="{{ asset('assets/img/subpage_images/landing_logo_bg_pattern.svg') }}" class="absolute hidden h-auto max-w-lg -mt-16 xl:block"/>
                        <div class="relative">
                            <p class="text-md lg:text-lg text-secondary">{{ __('Duis consectetur feugiat aucto') }}</p>
                            <h2 class="mt-5 text-3xl font-bold md:text-4xl lg:text-5xl xl:text-6xl lg:mt-8">{{ __('Tax Services') }}</h2>
                            <p class="mt-5 text-lg leading-loose lg:mt-10">{{ __('Use our cryptocurrency tax software to easily track your trades, see your profits, and never overpay on your crypto taxes again.') }}</p>
                            <x-button variant="secondary" class="z-20 mt-10 font-bold" size="md">{{ __('Tax Report') }}</x-button>
                        </div>
                    </div>
                    <div class="hidden md:block">
                        <img src="{{ asset('assets/img/subpage_images/tax_hero.svg') }}" class="w-full"/>
                    </div>
                </div>
            </x-container>
        </div>
        <x-container class="relative">
            {{-- Content --}}
            <div class="relative text-center">
                <div class="grid grid-cols-1 gap-5 py-5 md:grid-cols-5 2xl:gap-24 lg:gap-8">
                    <div class="col-span-3">
                        <img src="{{asset('assets/img/subpage_images/tax_capital_gain.svg')}}" class="w-full"/>
                    </div>
                    <div class="flex items-center col-span-2">
                        <div class="relative my-auto">
                            <img src="{{ asset('assets/img/subpage_images/landing_logo_bg_pattern.svg') }}" class="absolute -top-10"/>
                            <div class="relative">
                                <div class="flex items-center">
                                    <img src={{asset('assets/img/subpage_images/capital_coin_icon.svg')}} class="w-14"/>
                                    <h4 class="ml-5 text-2xl font-bold sm:text-4xl">{{ __('Capital Gains') }}</h4>
                                </div>
                                <p class="mt-5 leading-loose text-left sm:mt-9">{{ __("Duis consectetur feugiat auctor. Morbi nec enim luctus, feugiat arcu id, ultricies ante. Duis vel massa eleifend, porta est non, feugiat metus. Cras ante massa, tincidunt nec lobortis quis ") }}</p>
                                <p class="mt-2 leading-loose text-left sm:mt-3">{{ __("Design is everywhere. From the dress you’re wearing to the smartphone you’re holding, it’s design. If you think good design is expensive, you should look at the cost of bad design. ") }}</p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="grid grid-cols-1 gap-5 py-5 md:grid-cols-5 2xl:gap-24 lg:gap-8">
                    <div class="flex items-center order-2 col-span-2 md:order-1">
                        <div class="relative my-auto">
                            <img src="{{ asset('assets/img/subpage_images/landing_logo_bg_pattern.svg') }}" class="absolute -top-10"/>
                            <div class="relative">
                                <div class="flex items-center">
                                    <img src="{{asset('assets/img/subpage_images/tax_transaction_income_icon.svg')}}" class="w-14"/>
                                    <h4 class="ml-5 text-2xl font-bold sm:text-4xl">{{ __('Transaction Income') }}</h4>
                                </div>
                                <p class="mt-5 leading-loose text-left sm:mt-9">{{ __("Duis consectetur feugiat auctor. Morbi nec enim luctus, feugiat arcu id, ultricies ante. Duis vel massa eleifend, porta est non, feugiat metus. Cras ante massa, tincidunt nec lobortis quis ") }}</p>
                                <p class="mt-2 leading-loose text-left sm:mt-3">{{ __("Design is everywhere. From the dress you’re wearing to the smartphone you’re holding, it’s design. If you think good design is expensive, you should look at the cost of bad design. ") }}</p>
                            </div>
                        </div>
                    </div>
                    <div class="order-1 col-span-3 md:order-2">
                        <img src="{{asset('assets/img/subpage_images/tax_transaction_income.svg')}}" class="w-full"/>
                    </div>
                </div>

                <div class="grid grid-cols-1 gap-5 py-5 md:grid-cols-2 2xl:gap-24 lg:gap-8">
                    <div class="col-span-1">
                        <img src="{{asset('assets/img/subpage_images/tax-checklist_report.svg')}}" class="w-full"/>
                    </div>
                    <div class="flex items-center col-span-1">
                        <div class="relative my-auto">
                            <img src="{{ asset('assets/img/subpage_images/landing_logo_bg_pattern.svg') }}" class="absolute -top-10"/>
                            <div class="relative">
                                <div class="flex items-center">
                                    <img src="{{asset('assets/img/subpage_images/tax_checklist_icon.svg')}}" class="w-14"/> 
                                    <h4 class="ml-5 text-2xl font-bold sm:text-4xl">{{ __('Tax Checklist') }}</h4>
                                </div>
                                <p class="mt-5 leading-loose text-left sm:mt-9">{{ __("Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. ") }}</p>
                            </div>
                            <div class="relative">
                                <img src="{{ asset('assets/img/subpage_images/landing_logo_bg_pattern.svg') }}" class="absolute -top-10"/>
                                <div class="relative">
                                    <div class="flex items-center mt-30">
                                        <img src="{{ asset('assets/img/subpage_images/tax_report_icon.svg') }}" class="w-14"/>
                                        <h4 class="ml-5 text-2xl font-bold sm:text-4xl">{{ __('Tax Report') }}</h4>
                                    </div>
                                    <p class="mt-5 leading-loose text-left sm:mt-9">{{ __("Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. ") }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </x-container>
        <x-footer-get-start/>
    </div>
    <x-footer/>
</x-guest-layout>