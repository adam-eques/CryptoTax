<x-guest-layout>
    <div class="bg-primary">
        <x-landing-nav for="customer" logo="white" class="relative"/>
        <x-container>
            <div class="py-10 lg:pt-28 lg:pb-20 grid grid-cols-1 lg:grid-cols-2 gap-10 xl:gap-50">
                <div class="flex">
                    <div class="my-auto text-white relative">
                        <img src="{{ asset('assets/img/subpage_images/contact_bg_pattern.svg') }}" class="absolute -top-14"/>
                        <div class="relative">
                            <p class="text-secondary">{{ __('Duis consectetur feugiat aucto') }}</p>
                            <h2 class="text-2xl md:text-3xl lg:text-5xl font-extrabold mt-5">{{ __('About myCrypto Tax') }}</h2>
                            <p class="leading-loose mt-4">{{ __('As a app web crawler expert, I help organizations adjust to the expanding significance of internet promoting. As a app web crawler expert, I help organizations adjust to the expanding significance of internet promoting. Lorem Ipsum is simply dummy text of the printing and typ esetting industry is simply dummy text ') }}</p>
                        </div>
                    </div>
                </div>
                <div class="w-full lg:block hidden">
                    <img src="{{ asset('assets/img/subpage_images/white_logo.svg') }}" class="w-full" />
                </div>
            </div>
        </x-container>
    </div>
    <x-container class="text-center py-22">
        <h3 class="text-2xl lg:text-4xl font-bold">{{ __('MyCrypto Tax by the Numbers') }}</h3>
        <div class="max-w-4xl text-center mx-auto mt-8">
            <p class="">{{ __('Lorem ipsum dolor sit amet, consectetur adipiscing elit. Duis finibus mi id elit gravida, quis tincidunt purus fringilla. Aenean convallis a neque non pellentesque.') }}</p>
        </div>
        <div class="grid grid-cols-2 md:grid-cols-4 lg:grid-cols-4 gap-0 sm:gap-4 lg:gap-10 px-2 lg:px-10 mt-14">
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
                    <div class="text-left w-3/4">
                        <p class="text-xl sm:text-2xl xl:text-3xl font-bold">{{ __($item['amount']) }}</p>
                        <p class="text-gray-400 text-base">{{ __($item['term']) }}</p>
                    </div>
                </div>
            @endforeach
            
        </div>
    </x-container>

    <div class="bg-white text-center">
        <x-container class="py-16">
            <div class="relative">
                <img src="{{ asset('assets/img/subpage_images/landing_logo_bg.svg') }}" class="absolute top-2 left-1/2 -translate-x-1/2"/>
                <div class="relative">
                    <h3 class="text-2xl lg:text-4xl font-bold">{{ __('We support 5 Countries') }}</h3>
                    <div class="max-w-4xl text-center mx-auto mt-8">
                        <p class="">{{ __('Lorem ipsum dolor sit amet, consectetur adipiscing elit. Duis finibus mi id elit gravida, quis tincidunt purus fringilla. Aenean convallis a neque non pellentesque.') }}</p>
                    </div>
                    <img src="{{ asset('assets/img/subpage_images/about_supported_country.svg') }}" class="w-full mt-12 sm:mt-24"/>
                </div>
            </div>
            <div class="relative grid grid-cols-1 xl:grid-cols-3 gap-5 sm:gap-10 md:gap-26 py-16 md:pt-32">
                <div class="col-span-1 text-left">
                    <h3 class="text-2xl lg:text-4xl font-bold">{{ __('Our Team') }}</h3>
                    <p class="leading-loose mt-5">{{ __('Save your time and money by choosing our professional team.Donec id elit non mi porta gravida at eget metus. Morbi leo risus, porta ac consectetur ac, vestibulum at eros tempus porttitor.') }}</p>
                </div>
                <div class="col-span-2">
                    <div class="grid grid-cols-1 sm:grid-cols-3 gap-16">
                        <div class="text-left">
                            <img src="{{ asset('assets/img/subpage_images/team_member_avatar.svg') }}" class="w-full object-cover rounded-md"/>
                            <p class="text-lg font-semibold my-3">{{ __('Cory Zamora') }}</p>
                            <p>{{ __('Financial Analyst') }}</p>
                        </div>
                        <div class="text-left">
                            <img src="{{ asset('assets/img/subpage_images/team_member_avatar.svg') }}" class="w-full object-cover rounded-md"/>
                            <p class="text-lg font-semibold my-3">{{ __('Cory Zamora') }}</p>
                            <p>{{ __('Financial Analyst') }}</p>
                        </div>
                        <div class="text-left">
                            <img src="{{ asset('assets/img/subpage_images/team_member_avatar.svg') }}" class="w-full object-cover rounded-md"/>
                            <p class="text-lg font-semibold my-3">{{ __('Cory Zamora') }}</p>
                            <p>{{ __('Financial Analyst') }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </x-container>
    </div>
    <x-container class="mb-16">
        @livewire('landing-page.testimonials')
    </x-container>
    <div class="bg-white">
        <x-container class="grid grid-cols-1 md:grid-cols-2 gap-60 py-16 md:py-26">
            <div>
                <h3 class="text-2xl lg:text-4xl font-bold">{{ __('Support') }}</h3>
                <p class="mt-6 leading-loose">{{ __('Choose the most convenient way to contact our support team. Ask your question via email or online chat. Experienced professionals will answer any of your questions about the platform.') }}</p>
                <div class="mt-10 grid grid-cols-1 md:grid-cols-3 divide-x">
                    <div>
                        <h3 class="text-2xl lg:text-4xl font-bold">{{ __('20k +') }}</h3>
                    </div>
                    <div>
                        <h3 class="text-2xl lg:text-4xl font-bold">{{ __('20k +') }}</h3>
                    </div>
                    <div>
                        <h3 class="text-2xl lg:text-4xl font-bold">{{ __('20k +') }}</h3>
                    </div>
                </div>
            </div>
            <div>

            </div>
        </x-container>
        <x-footer-get-start/>
    </div>
    <x-footer/>
</x-guest-layout>