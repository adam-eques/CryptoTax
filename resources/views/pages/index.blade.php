<x-guest-layout>
    <div class="w-full bg-white relative">
        <img src="{{ asset("assets/img/svg/hero_pattern.svg") }}" class="absolute right-0 top-0 z-0 w-2/3 h-auto"/>
        <x-index.nav/>
        {{-- hero section --}}
        <div class="pt-50 relative">
            <div class="mx-auto px-3 xs:px-4 xl:max-w-screen-2xl lg:px-5">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-20">
                    <div class="relative h-full flex items-center">
                        <div class="p-20 absolute">
                            <img src="{{ asset('assets/img/svg/hero_pattern_2.svg') }}" class="w-full h-auto"/>
                        </div>
                        <div class="m-auto">
                            <p class="text-xl lg:text-3xl">{{ __('Track your crypto') }}</p>
                            <p class="text-4xl lg:text-6xl font-extrabold mt-5 lg:mt-8">{{ __('Portfolio & Taxes') }}</p>
                            <p class="mt-5 lg:mt-10 text-lg">{{ __('Use our cryptocurrency tax software to easily track your trades,') }}</p>
                            <p class="mt-3 text-lg">{{ __('see your profits, and never overpay on your crypto taxes again.') }}</p>
                            <div class="flex space-x-4 mt-10 z-20 relative">
                                <x-button variant="white" class="bg-transparent text-primary font-bold" size="md">{{ __('Learn More') }}</x-button>
                                <x-button size="md" class="font-bold">{{ __('Register for free') }}</x-button>
                            </div>
                        </div>
                    </div>
                    <div class="md:block hidden">
                        <img src="{{ asset('assets/img/svg/hero_image.svg') }}"/>
                    </div>
                </div>
            </div>
        </div>
        {{-- partner --}}
        <div class="mt-24 mx-auto px-3 xs:px-4 xl:max-w-screen-2xl lg:px-5">
            <p class="text-center font-bold text-gray-300">{{  __('Meet Our Partners') }}</p>
            @php
                $partners = ['assets/img/svg/binance.svg', 'assets/img/svg/Bitcoin.svg', 'assets/img/svg/Ethereum.svg', 'assets/img/svg/Kucoin.svg', 'assets/img/svg/Litecoin.svg', 'assets/img/svg/tether.svg']
            @endphp
            <div class="grid grid-cols-3 sm:grid-cols-6 items-center gap-5 md:gap-10 xl:gap-20 mt-5 sm:mt-10 px-10">
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
            <div class="py-24 grid grid-cols-1 lg:grid-cols-3 items-end gpp-3 lg:gap-10">
                @foreach ($items as $item)                    
                    <div class="text-center px-5">
                        <img src="{{ asset($item['img']) }}" class="flex mx-auto"/>
                        <p class="text-lg font-bold my-5">{{ __($item['title']) }}</p>
                        <p class="text-gray-500">{{ __($item['content']) }}</p>
                    </div>
                @endforeach
            </div>

            {{-- Why choose us --}}
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-5 py-10 md:py-24">
                <div>
                    <img src="{{ asset('assets/img/svg/landing_img_1.svg') }}" class="w-full h-auto"/>
                </div>
                <div class="relative px-5 sm:px-10">
                    <div class="absolute -top-18">
                        <img src="{{ asset('assets/img/svg/hero_pattern_2.svg') }}" class="w-full h-auto"/>
                    </div>
                    <p class="text-secondary text-lg font-bold">{{ __('Why Choose Us') }}</p>
                    <p class="text-3xl md:text-4xl xl:text-6xl font-extrabold mt-4">{{  __('Solutions for every ') }}</p>
                    <p class="text-3xl md:text-4xl  xl:text-6xl font-extrabold mt-4">{{  __('single problems') }}</p>
                    <p class="my-6">{{ __('Duis consectetur feugiat auctor. Morbi nec enim luctus, feugiat arcu id, ultricies ante. Duis vel massa eleifend, porta est non, feugiat metus. Cras ante massa, tincidunt nec lobortis quis ') }}</p>
                    <p>{{ __('Design is everywhere. From the dress you’re wearing to the smartphone you’re holding, it’s design. If you think good design is expensive, you should look at the cost of bad design. ') }}</p>
                    <x-button class="mt-7">{{ __('More Details') }}</x-button>
                </div>
            </div>
        </div>
    </div>

    {{-- Supported Country --}}
    @livewire('landing-page.supported-country')

    <div class="w-full bg-white py-12">
        <div class="mx-auto px-3 xs:px-4 xl:max-w-screen-2xl lg:px-5">
            {{-- Membership --}}
            @livewire('landing-page.membership-plan')
            
            {{-- FAQs --}}
            @livewire('landing-page.faqs')
        </div>
    </div>

    <div class="w-full">
        {{-- testimonials --}}
        @livewire('landing-page.testimonials')

        {{-- Get start --}}
        <div>
            <div class="flex items-center justify-center">
                <div class="flex sm:w-10/12 mt-20 -mb-20 items-center justify-center">
                    <div class="w-full bg-white rounded-lg">
                        <div class="py-10 lg:px-28 px-10 flex sm:flex-row flex-col items-center sm:justify-between justify-center">
                            <div>
                                <x-jet-button variant="secondary" class="">{{ __('Join myCrypto.tax') }}</x-jet-button>
                                <h1 role="heading" class="text-3xl md:text-4xl xl:text-5xl mt-3 font-extrabold">{{ __("Act before it's too late") }}</h1>
                                <p role="contentinfo" class="text-lg mt-3 text-gray-800">{{ __('Sign up and instantly generate your tax report') }}</p>
                            </div>
                            <x-button>
                                {{ __('Get started now') }}
                                <x-icon name='rocket' class="ml-3 w-6 h-6"/>
                            </x-button>
                        </div>
                    </div>
                </div> 
            </div>
            <div class="bg-primary w-full h-full flex py-10">
            </div>
        </div>
    </div>

    {{-- footer========================================================================================== --}}
    <footer class="bg-primary pt-10 md:pt-20">
        <h2 id="footer-heading" class="sr-only">Footer</h2>
        <div class="mx-auto px-3 xs:px-4 xl:max-w-screen-2xl lg:px-5">
            <div class="flex flex-col lg:flex-row">
                <!-- Footer Intro section -->
                <div class="lg:w-1/3 space-y-4 lg:space-y-10 pr-5 xl:pr-20 items-center lg:items-start flex justify-center lg:justify-start flex-col text-center lg:text-left">
                    <div class="flex-shrink-0 ">
                        <a href="{{ route("customer.dashboard") }}" class="flex items-center text-white group">
                            <img src="{{asset('/assets/img/logo.svg')}}" alt="Logo" class="w-9">
                            <span class="ml-2 text-xl font-bold">myCrypto Tax</span>
                        </a>
                    </div>

                    <p class="text-white text-opacity-30 text-sm sm:text-base leading-loose">
                        Lorem ipsum dolor sit amet, consectetur adipisicing elit. Itaque, quos!
                    </p>
                </div>
                <!-- Footer Menus -->
                <div class="grid grid-cols-2 gap-2 xl:gap-8 lg:w-3/4 mt-8 lg:mt-0">
                    <div class="md:grid md:grid-cols-2 gap-2 xl:gap-8">
                        <div>
                            <h3 class="text-lg font-semibold text-white tracking-wider space-y-2">
                                <span>About</span>
                                <hr class="w-7 h-1 border-blue-500">
                            </h3>
                            <ul role="list" class="mt-4 space-y-4">
                                <li>
                                    <a href="javascript:void(0)" class="text-sm sm:text-base text-white text-opacity-30 hover:text-opacity-100">
                                        Announcement
                                    </a>
                                </li>

                                <li>
                                    <a href="javascript:void(0)" class="text-sm sm:text-base text-white text-opacity-30 hover:text-opacity-100">
                                        Help Center
                                    </a>
                                </li>

                                <li>
                                    <a href="javascript:void(0)" class="text-sm sm:text-base text-white text-opacity-30 hover:text-opacity-100">
                                        Media
                                    </a>
                                </li>
                            </ul>
                        </div>
                        <div class="mt-12 md:mt-0">
                            <h3 class="text-lg font-semibold text-white tracking-wider space-y-2">
                                <span>Product</span>
                                <hr class="w-7 h-1 border-blue-500">
                            </h3>
                            <ul role="list" class="mt-4 space-y-4">
                                <li>
                                    <a href="javascript:void(0)" class="text-sm sm:text-base text-white text-opacity-30 hover:text-opacity-100">
                                        API Doc
                                    </a>
                                </li>

                                <li>
                                    <a href="javascript:void(0)" class="text-sm sm:text-base text-white text-opacity-30 hover:text-opacity-100">
                                        Token Listing
                                    </a>
                                </li>

                                <li>
                                    <a href="javascript:void(0)" class="text-sm sm:text-base text-white text-opacity-30 hover:text-opacity-100">
                                        Cloud Solution
                                    </a>
                                </li>

                                <li>
                                    <a href="javascript:void(0)" class="text-sm sm:text-base text-white text-opacity-30 hover:text-opacity-100">
                                        Institutional Cooperation
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="md:grid md:grid-cols-2 gap-2 xl:gap-8">
                        <div>
                            <h3 class="text-lg font-semibold text-white tracking-wider space-y-2">
                                <span>Legal</span>
                                <hr class="w-7 h-1 border-blue-500">
                            </h3>
                            <ul role="list" class="mt-4 space-y-4">
                                <li>
                                    <a href="javascript:void(0)" class="text-sm sm:text-base text-white text-opacity-30 hover:text-opacity-100">
                                        Terms of Service
                                    </a>
                                </li>

                                <li>
                                    <a href="javascript:void(0)" class="text-sm sm:text-base text-white text-opacity-30 hover:text-opacity-100">
                                        Privacy Policy
                                    </a>
                                </li>

                                <li>
                                    <a href="javascript:void(0)" class="text-sm sm:text-base text-white text-opacity-30 hover:text-opacity-100">
                                        Risk And Disclaimer
                                    </a>
                                </li>

                            </ul>
                        </div>
                        <div class="mt-12 md:mt-0">
                            <h3 class="text-lg font-semibold text-white tracking-wider space-y-2">
                                <span>Other</span>
                                <hr class="w-7 h-1 border-blue-500">
                            </h3>
                            <ul role="list" class="mt-4 space-y-4">
                                <li>
                                    <a href="javascript:void(0)" class="text-sm sm:text-base text-white text-opacity-30 hover:text-opacity-100">
                                        Assets Introduction
                                    </a>
                                </li>

                                <li>
                                    <a href="javascript:void(0)" class="text-sm sm:text-base text-white text-opacity-30 hover:text-opacity-100">
                                        APP Download
                                    </a>
                                </li>

                                <li>
                                    <a href="javascript:void(0)" class="text-sm sm:text-base text-white text-opacity-30 hover:text-opacity-100">
                                        Market Making Program
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <div class="flex items-center justify-center">
                <p class="py-8 text-md text-white text-opacity-10 md:mt-0 md:order-1 text-center">
                    Copyright &copy; CryptoTax Inc. Designed & Developed by BSBV (bsbv.net) {{ now()->format("Y") }}.
                </p>
            </div>
        </div>
    </footer>
</x-guest-layout>
