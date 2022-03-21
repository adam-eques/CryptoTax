<x-guest-layout title="Account">
    <div class="w-full bg-white">
        <div class="relative">
            <div class="absolute top-0 right-0 w-full h-full">
                <img src="{{ asset("assets/img/subpage_images/account_hero_bg.png") }}" class="hidden w-full h-full lg:block"/>
            </div>
            <x-landing-nav for="customer" logo="white" class="relative"/>
            <x-container class="pb-10 mt-16 2xl:mt-26">
                {{-- Hero section --}}
                <div class="relative grid grid-cols-1 gap-10 md:grid-cols-2 xl:gap-20">
                    <div class="relative order-2 mt-0 sm:order-1 xl:mt-12 2xl:mt-24">
                        <img src="{{ asset('assets/img/subpage_images/contact_bg_pattern.svg') }}" class="absolute z-0 hidden h-auto max-w-lg -mt-16 xl:block"/>
                        <div class="relative">
                            <h5 class="text-xl text-primary lg:text-white">{{ __('Duis consectetur feugiat auctor') }}</h5>
                            <h2 class="text-2xl font-bold text-primary lg:text-white xl:text-5xl lg:text-4xl md:text-3xl mt-7">{{ __('Add Your Accounts') }}</p>
                            <h5 class="mt-6 text-lg leading-loose text-primary lg:text-white">{{ __('Use our cryptocurrency tax software to easily track your trades, see your profits, and never overpay on your crypto taxes again.') }}</h5>
                            <x-button variant="secondary" size="lg" class="mt-6 font-bold tracking-tight border-0">{{ __('Add Accounts') }}</x-button>
                        </div>
                    </div>
                    <div class="order-1 sm:order-2">
                        <img src="{{ asset('assets/img/subpage_images/account_hero.svg') }}" class="w-full" />
                    </div>
                </div>
            </x-container>
        </div>
        {{--  --}}
        <div class="relative">
            {{-- <img src="{{ asset('assets/img/subpage_images/account_middle_line.svg') }}" class="absolute w-full h-auto top-1/2" /> --}}
            <x-container class="relative mt-8 text-center bg-white rounded-md xl:mt-18 sm:mt-10">
                <img src="{{ asset('assets/img/subpage_images/landing_logo_bg_pattern.svg') }}" class="absolute max-w-full -translate-x-1/2 left-1/2 -top-6"/>
                <div class="relative">
                    <p class="font-semibold text-secondary">{{ __('Add Account') }}</p>
                    <h3 class="mt-4 text-xl font-bold md:text-3xl lg:text-4xl xl:text-5xl">{{ __('Simple and Easy, Add Your Account') }}</h3>
                    <p class="mt-5">{{ __('Duis consectetur feugiat auctor. Morbi nec enim luctus, feugiat arcu id, ultricies ante. Duis vel massa eleifend, porta ') }}</p>
                    <p class="mt-2">{{ __('est non, feugiat metus. Cras ante massa, tincidunt nec lobortis quis ') }}</p>
                    <img src="{{ asset('assets/img/subpage_images/account_new_account.svg') }}" class="w-full h-auto mt-14" />
                </div>
            </x-container>
        </div>        
        {{--  --}}
        <div class="relative my-5 overflow-hidden">
            <img src="{{ asset('assets/img/subpage_images/account_bg_pattern_2.svg') }}" class="absolute top-0 h-auto -right-32" />
            <img src="{{asset('assets/img/subpage_images/account-bg_pattern.svg')}}" class="absolute bottom-0 right-5"/>
            <x-container class="relative grid grid-cols-1 gap-5 md:grid-cols-2 2xl:gap-42 xl:gap-30 lg:gap-24 md:gap-10">
                <div class="w-full">
                    <img src="{{asset('assets/img/subpage_images/account_make_transaction.svg')}}" class="w-full"/>
                </div>
                <div class="flex items-center">
                    <div class="relative my-auto">
                        <img src="{{ asset('assets/img/subpage_images/landing_logo_bg_pattern.svg') }}" class="absolute max-w-full -translate-x-1/2 left-1/2 -top-10"/>
                        <div class="relative">
                            <p class="font-semibold text-secondary">{{ __('First Transactions') }}</p>
                            <h2 class="mt-4 text-xl font-bold md:text-3xl lg:text-4xl xl:text-5xl">{{ __('Make your Transaction') }}</h2>
                            <p class="mt-5 leading-loose text-left sm:mt-9">{{ __("Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. ") }}</p>
                            <p class="mt-5 leading-loose text-left">{{ __("Design is everywhere. From the dress you’re wearing to the smartphone you’re holding, it’s design. If you think good design is expensive, you should look at the cost of bad design.") }}</p>
                        </div> 
                    </div>
                </div>
            </x-container>
        </div>
        {{--  --}}
        <x-container class="relative">
            <img src="{{ asset('assets/img/subpage_images/landing_logo_bg_pattern.svg') }}" class="absolute max-w-full -translate-x-1/2 left-1/2 -top-6"/>   
            <div class="relative mt-10 text-center sm:mt-24">
                <p class="font-semibold text-secondary">{{ __("Transaction") }}</p>
                <h3 class="mt-4 text-xl font-bold md:text-3xl lg:text-4xl xl:text-5xl">{{ __('Transaction History') }}</h3>
                <p class="mt-5">{{ __('Duis consectetur feugiat auctor. Morbi nec enim luctus, feugiat arcu id, ultricies ante. Duis vel massa eleifend, porta') }}</p>
                <p class="mt-2">{{ __('est non, feugiat metus. Cras ante massa, tincidunt nec lobortis quis') }}</p>
                <img src="{{ asset('assets/img/subpage_images/account_transaction_history.svg') }}" class="w-full mt-8"/>
            </div>
        </x-container>
       <x-footer-get-start/>
    </div>
    <x-footer/>
</x-guest-layout>