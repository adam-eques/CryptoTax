<x-container class="bg-white border my-5">
    <div class="px-5 py-10 w-full">
        <div class="flex items-center justify-between flex-wrap space-y-4">
            <div class="flex items-center space-x-8">
                <img src="{{ asset("assets/img/svg/avatar.svg") }}" class="rounded-lg w-18 h-18 object-cover"/>
                <div>
                    <h3 class="text-xl font-bold">{{ __('Gary R. Anderson') }}</h3>
                    <h4 class="text-base text-gray-400 mt-2">{{ __('Financial Advisor') }}</h4>
                </div>
            </div>
            <div class="flex items-start space-x-2 flex-wrap justify-end">
                <h3 class="text-xl font-bold">{{ __('4.9/5.0') }}</h3>
                <div>
                    <div class="flex items-center space-x-1">
                        <x-icon name="star-golden" class="w-4"/>
                        <x-icon name="star-golden" class="w-4"/>
                        <x-icon name="star-golden" class="w-4"/>
                        <x-icon name="star-golden" class="w-4"/>
                        <x-icon name="star-golden" class="w-4"/>
                    </div>
                    <p class="text-sm text-gray-400">{{ __('150 Reviews') }}</p>
                </div>
                <div class="border p-3 rounded-md"><x-icon name="heart-blank" class="w-6 bg-white"/></div>
                <x-button class="font-semibold">{{ __("Contact Now") }}</x-button>
            </div>
        </div>
        <div class="border-t border-b w-full grid grid-cols-1 md:grid-cols-3 mt-10">
            <div class="col-span-1 py-8 md:border-r space-y-4">
                @php
                    $items = [
                        [ 'icon'=>'location', 'label' => 'Address', 'data' => '97845 Baker st. 567, Los Angeles - US' ],
                        [ 'icon'=>'phone', 'label' => 'Phone Number', 'data' => '+54 423 565624' ],
                        [ 'icon'=>'email', 'label' => 'Email Address', 'data' => 'Contact@gmail.com' ],
                        [ 'icon'=>'website', 'label' => 'Website', 'data' => 'www.damianbrayden.com' ],
                        [ 'icon'=>'language', 'label' => 'Languages', 'data' => 'English, Spanish, France' ],
                    ]
                @endphp
                @foreach ($items as $item)                    
                    <div class="flex items-center space-x-4">
                        <div class="h-14 w-14 p-4 rounded-md bg-gray-100 flex items-center justify-center">
                            <x-icon name="{{ $item['icon'] }}" class="h-full w-auto"/>
                        </div>
                        <div class=" space-y-2">
                            <p class="font-bold">{{ __($item['label']) }}</p>
                            <p class="text-gray-400">{{ __($item['data']) }}</p>
                        </div>
                    </div>
                @endforeach
                <div class="flex items-center space-x-4">
                    <div class="h-14 w-14 p-4 rounded-md bg-gray-100 flex items-center justify-center">
                        <x-icon name="third-party" class="h-full w-auto"/>
                    </div>
                    <div class="flex items-center space-x-2">
                       <x-icon name="social.whatsapp" class="w-8"/>
                       <x-icon name="social.skype" class="w-8"/>
                       <x-icon name="social.facebook" class="w-8"/>
                       <x-icon name="social.twitter" class="w-8"/>
                    </div>
                </div>
            </div>
            <div class="col-span-2 py-8 px-0 md:px-8 text-primary leading-relaxed">
                <h2 class="text-2xl font-bold">{{ __('Tax Financial Advisors') }}</h2>
                <p class="mt-8 ">{{ __('Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum') }}</p>
                <p class="mt-3">{{ __('Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse') }}</p>

                <h2 class="text-2xl font-bold mt-8">{{ __('Brayden approach') }}</h2>
                <p class="mt-8 ">{{ __('Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse') }}</p>
            </div>
            <div class="col-span-1 py-8 md:border-r md:border-t">
                <h2 class="text-2xl font-bold">{{ __('Focus') }}</h2>
                <div class="max-w-sm mt-6 space-y-4">
                    <div class="px-5 py-4 bg-gray-100 rounded-lg flex items-center space-x-4">
                        <x-icon name="tax-advisor" class="h-8 w-auto"/>
                        <p class="font-bold">{{ __('Tax Financial Advisor') }}</p>
                    </div>
                </div>
            </div>
            <div class="col-span-2 py-8 md:border-t px-0 md:px-8">
                <h2 class="text-2xl font-bold mb-7">{{ __('Review') }}</h2>
                <div class="border rounded-lg py-5 px-8 relative">
                    <x-icon name="quote" class="w-12 h-12 absolute right-6 top-6"/>
                    <div class="flex items-center space-x-4">
                        <img src="{{ asset("assets/img/svg/avatar.svg") }}" class="rounded-lg w-12 h-12 object-cover"/>
                        <div>
                            <h3 class="text-base font-bold">{{ __('Gary R. Anderson') }}</h3>
                            <h4 class="text-sm text-gray-400 mt-1">{{ __('Financial Advisor') }}</h4>
                        </div>
                    </div>
                    <p class="text-gray-400 italic py-4">"Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam ", </p>
                    <div class="flex items-center space-x-4">
                        <div class="flex items-center space-x-1">
                            <x-icon name="star-golden" class="w-4"/>
                            <x-icon name="star-golden" class="w-4"/>
                            <x-icon name="star-golden" class="w-4"/>
                            <x-icon name="star-golden" class="w-4"/>
                            <x-icon name="star-golden" class="w-4"/>
                        </div>
                        <p class="text-sm text-gray-400">{{ __('06/24/2022') }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-container>
