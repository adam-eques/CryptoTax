<footer class="bg-primary pt-10 md:pt-20">
    <h2 id="footer-heading" class="sr-only">Footer</h2>
    <x-container>
        <div class="flex flex-col lg:flex-row">
            <!-- Footer Intro section -->
            <div class="lg:w-1/3 space-y-4 lg:space-y-10 pr-5 xl:pr-20 items-center lg:items-start flex justify-center lg:justify-start flex-col text-center lg:text-left">
                <div class="flex-shrink-0 ">
                    <a href="{{ route("customer.dashboard") }}" class="flex items-center text-white group">
                        <img src="{{asset('/assets/img/logo.svg')}}" alt="Logo" class="h-10">
                        <div class="ml-1 text-left">
                            <p class="text-md font-semibold text-white">my</p>
                            <h3 class="text-xl lg:text-2xl font-extrabold text-white">Crypto.Tax</h3>
                        </div>
                    </a>
                </div>

                <p class="text-white text-opacity-30 text-sm sm:text-base leading-loose">
                    Lorem ipsum dolor sit amet, consectetur adipisicing elit. Itaque, quos!
                </p>
            </div>
            <!-- Footer Menus -->
            @php
                $links = [
                    'About' => [ 
                        ['link' => 'About us', 'route' => 'index'], 
                        ['link' => 'Help Center', 'route' => 'index'], 
                        ['link' => 'Contact', 'route' => 'contact']
                    ],
                    'Product' => [ 
                        ['link' => 'Compare', 'route' => 'index'], 
                        ['link' => 'Pricing', 'route' => 'pricing'], 
                        ['link' => 'FAQ', 'route' => 'faqs']
                    ],
                    'Legal' => [ 
                        ['link' => 'Imprint', 'route' => 'index'], 
                        ['link' => 'Terms of Service', 'route' => 'terms'],
                        ['link' => 'Privacy Polity', 'route' => 'policy'],
                        ['link' => 'Risk and Disclaimer', 'route' => 'contact']
                    ],
                    'Other' => [ 
                        ['link' => 'Tax Advisor', 'route' => 'index'], 
                        ['link' => 'Affiliate Partner', 'route' => 'affiliate'], 
                        ['link' => 'Blog', 'route' => 'blog']
                    ],
                ]
            @endphp
            <div class="grid grid-cols-2 gap-2 xl:gap-8 lg:w-3/4 mt-8 lg:mt-0">
                <div class="md:grid md:grid-cols-2 gap-2 xl:gap-8">
                    <div>
                        <h3 class="text-lg font-semibold text-white tracking-wider space-y-2">
                            <span>About</span>
                            <hr class="w-7 h-1 border-blue-500">
                        </h3>
                        <ul role="list" class="mt-4 space-y-4">
                            @foreach ($links['About'] as $item)                                
                                <li>
                                    <a href="{{ route($item['route'])  }}" class="text-sm sm:text-base text-white text-opacity-30 hover:text-opacity-100">
                                        {{ __($item['link']) }}
                                    </a>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                    <div class="mt-12 md:mt-0">
                        <h3 class="text-lg font-semibold text-white tracking-wider space-y-2">
                            <span>Product</span>
                            <hr class="w-7 h-1 border-blue-500">
                        </h3>
                        <ul role="list" class="mt-4 space-y-4">
                            @foreach ($links['Product'] as $item)                                
                                <li>
                                    <a href="{{ route($item['route'])  }}" class="text-sm sm:text-base text-white text-opacity-30 hover:text-opacity-100">
                                        {{ __($item['link']) }}
                                    </a>
                                </li>
                            @endforeach
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
                            @foreach ($links['Legal'] as $item)                                
                                <li>
                                    <a href="{{ route($item['route'])  }}" class="text-sm sm:text-base text-white text-opacity-30 hover:text-opacity-100">
                                        {{ __($item['link']) }}
                                    </a>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                    <div class="mt-12 md:mt-0">
                        <h3 class="text-lg font-semibold text-white tracking-wider space-y-2">
                            <span>Other</span>
                            <hr class="w-7 h-1 border-blue-500">
                        </h3>
                        <ul role="list" class="mt-4 space-y-4">
                            @foreach ($links['Other'] as $item)                                
                                <li>
                                    <a href="{{ route($item['route'])  }}" class="text-sm sm:text-base text-white text-opacity-30 hover:text-opacity-100">
                                        {{ __($item['link']) }}
                                    </a>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <div class="flex items-center justify-between py-8 space-x-4">
            <p class="text-md text-white text-opacity-10 md:mt-0 text-center">
                Copyright &copy; CryptoTax Inc. Designed & Developed by <a href="http://bsbv.net" target="_blank" class="text-primary-200 hover:text-white"> BSBV Inc</a>.
            </p>
            <div class="py-2 relative" x-data="{open:false, lng:'English'}">
                <div 
                    class="bg-primary border border-primary-300 rounded text-white text-opacity-30 w-fit px-3 py-2 cursor-pointer flex items-center justify-between space-x-2"
                    @click="open = true"
                >
                    <x-icon name="flag.tax_country_1" class="w-6 h-4" x-show="lng=='English'" x-cloak/>
                    <x-icon name="flag.tax_country_2" class="w-6 h-4" x-show="lng=='Deutsch'" x-cloak/>
                    <p x-text="lng"></p>
                    <svg class="w-4 trnstsn transform " fill="none" viewBox="0 0 24 24" stroke="currentColor" :class="{'rotate-180': open}">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                    </svg>
                </div>
                <div
                    class="origin-top-right absolute bottom-14 right-0 w-fit rounded-md shadow-lg py-2 bg-primary text-white ring-1 ring-black ring-opacity-5 focus:outline-none"
                    role="menu" aria-orientation="vertical" aria-labelledby="user-menu-button" tabindex="-1"
                    x-show="open" @click.away="open=false" x-cloak
                    x-transition:enter-start="transition ease-in duration-3000"
                >
                    <button class="flex items-center justify-start space-x-4 px-5 py-2 hover:bg-primary-300 w-full" x-on:click="open=false; lng='English'">
                        <x-icon name="flag.tax_country_1" class="w-6 h-4"/>
                        <p>English</p>
                    </button>
                    <button class="flex items-center justify-start space-x-4 px-5 py-2 hover:bg-primary-300 w-full" x-on:click="open=false; lng='Deutsch'">
                        <x-icon name="flag.tax_country_2" class="w-6 h-4"/>
                        <p>Deutsch</p>
                    </button>
                </div>
            </div>
        </div>
    </x-container>
</footer>