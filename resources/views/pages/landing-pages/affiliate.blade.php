<x-guest-layout>
    <div class="w-full bg-white">
        <div class="relative">
            <div class="absolute top-0 right-0 w-full h-full">
                <img src="{{ asset("assets/img/subpage_images/affiliate_banner.png") }}" class="hidden w-full h-full md:block"/>
            </div>
            <x-landing-nav for="affiliate" class="relative"/>
            <x-container class="pb-10 mt-16 2xl:mt-20">    
                {{-- hero section --}}
                <div class="relative grid grid-cols-1 gap-5 md:grid-cols-2">
                    <div class="relative order-2 mt-0 sm:order-1 xl:mt-12 2xl:mt-24">
                        <img src="{{ asset('assets/img/subpage_images/contact_bg_pattern.svg') }}" class="absolute hidden w-full max-w-lg -mt-20 lg:block"/>
                        <div class="relative">
                            <h2 class="text-2xl font-bold text-primary md:text-white xl:text-5xl lg:text-4xl md:text-3xl">{{ __('Make Money By Becoming') }}</p>
                            <h3 class="mt-5 text-2xl text-primary md:text-white xl:text-5xl lg:text-4xl md:text-3xl font-md">{{ __("a myCrypto Tax") }} <span class="italic text-secondary">{{ _('Affiliate') }}</span></h3>
                            <h5 class="mt-6 text-lg leading-loose text-primary md:text-white">{{ __('Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et.') }}</h5>
                            <x-button variant="secondary" size="lg" class="mt-6 font-bold tracking-tight border-0">{{ __('Start Earning Now') }}</x-button>
                        </div>
                    </div>
                    <div class="order-1 sm:order-2">
                        <img src="{{ asset('assets/img/subpage_images/affiliate_hero.svg') }}" class="w-full" />
                    </div>
                </div>
            </x-container>
        </div>
        {{-- How it works --}}
        <x-container>
            <div class="relative text-center">
                <img src="{{ asset('assets/img/subpage_images/landing_logo_bg.svg') }}" class="absolute h-auto max-w-md -translate-x-1/2 left-1/2"/>
                <div class="relative py-10 sm:py-20">
                    <h3 class="text-2xl font-bold xl:text-4xl lg:tet-3xl text-primary">{{ __('How It Works') }}</h3>
                    <p class="px-2 mt-6 leading-loose sm:px-10">{{ __('Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. ') }}</p>
                </div>
                <div class="grid grid-cols-1 gap-5 py-5 md:grid-cols-2 2xl:gap-42 xl:gap-30 lg:gap-24 md:gap-10">
                    <div class="">
                        <img src="{{asset('assets/img/subpage_images/affiliate_1.svg')}}" class="w-full"/>
                    </div>
                    <div class="flex items-center">
                        <div class="my-auto">
                            <div class="flex items-center">
                                <x-icon name="sign-up" class="w-14"/>
                                <h4 class="ml-5 text-xl font-bold  sm:text-2xl">{{ __('Sign up') }}</h4>
                            </div>
                            <p class="mt-5 leading-loose text-left sm:mt-9">{{ __("Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. ") }}</p>
                            <div class="flex justify-start mt-5 sm:mt-8">
                                <x-button size="xl" class="px-10 font-bold">{{__('Sign up')}}</x-button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="grid grid-cols-1 gap-5 py-5 md:grid-cols-2 2xl:gap-42 xl:gap-30 lg:gap-24 md:gap-10">
                    <div class="flex items-center order-2 md:order-1">
                        <div class="my-auto">
                            <div class="flex items-center">
                                <x-icon name="referral" class="w-14"/>
                                <h4 class="ml-5 text-xl font-bold  sm:text-2xl">{{ __('Referral') }}</h4>
                            </div>
                            <p class="mt-5 leading-loose text-left sm:mt-9">{{ __("Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. ") }}</p>
                            <p class="mt-5 leading-loose text-left sm:mt-9">{{ __("Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. ") }}</p>
                            <div class="flex justify-start mt-5 sm:mt-8">
                                <x-button size="xl" class="px-10 font-bold">{{__('Referral')}}</x-button>
                            </div>
                        </div>
                    </div>
                    <div class="order-1 md:order-2">
                        <img src="{{asset('assets/img/subpage_images/affiliate_2.svg')}}" class="w-full"/>
                    </div>
                </div>
                <div class="grid grid-cols-1 gap-5 py-5 md:grid-cols-2 2xl:gap-42 xl:gap-30 lg:gap-24 md:gap-10">
                    <div class="">
                        <img src="{{asset('assets/img/subpage_images/affiliate_3.svg')}}" class="w-full"/>
                    </div>
                    <div class="flex items-center">
                        <div class="my-auto">
                            <div class="flex items-center">
                                <x-icon name="money" class="w-14"/>
                                <h4 class="ml-5 text-xl font-bold  sm:text-2xl">{{ __('Earn') }}</h4>
                            </div>
                            <p class="mt-5 leading-loose text-left sm:mt-9">{{ __("Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. ") }}</p>
                            <p class="mt-5 leading-loose text-left sm:mt-9">{{ __("Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. ") }}</p>
                            <div class="flex justify-start mt-5 sm:mt-8">
                                <x-button size="xl" class="px-10 font-bold">{{__('Earn')}}</x-button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </x-container>
    </div>

    <div class="w-full">
        <x-container class="pb-20">
            {{-- Textmonial --}}
            @livewire('landing-page.testimonials')
        </x-container>
    </div>

    <div class="w-full py-12 bg-white">
        <x-container class="relative">
            {{-- FAQs --}}
            @livewire('affiliate.landing-page.faqs')
        </x-container>
    </div>
    <x-footer/>
</x-guest-layout>