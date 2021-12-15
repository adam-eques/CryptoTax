<nav class="bg-primary" x-data="{mobile:false}">
    <div class="mx-auto px-3 xs:px-4 xl:max-w-screen-2xl lg:px-5">
        <div class="flex items-center justify-between py-2 lg:py-0 lg:h-20">
            {{-- Site Logo --}}
            <div class="flex-shrink-0">
                <a href="{{ route("dashboard") }}" class="flex items-center text-white group">
                    <img src="{{asset('assets/img/primary_logo.svg')}}" alt="Logo" class="w-50">
                </a>
            </div>

            <div class="hidden lg:flex items-center flex-1 justify-center px-5 2xl:px-20">
                <div class="flex items-baseline flex-1 justify-start gap-3">
                    @foreach($navItems as $navItem)
                        <x-jet-nav-link href="{{ route($navItem['route']) }}" :active="request()->routeIs($navItem['route'])">
                            {{-- <x-icon :name="$navItem['icon']" class="w-6 h-6 mr-2"/> --}}
                            <img src="{{ asset("assets/img/icon/nav/" . $navItem['icon'] . "_primary.svg") }}" class="w-6 h-6 mr-1"/>
                            {{ __($navItem["label"]) }}
                        </x-jet-nav-link>
                    @endforeach
                </div>
            </div>

            <div class="ml-auto mr-5 flex items-center gap-4">
                <div class="flex items-center gap-4">
                    {{-- Message Button --}}
                    <button type="button" title="Message"
                            class="rounded-full text-white hover:text-gray-300 focus:outline-none outline-none ">
                        <span class="sr-only">Message</span>
                        <x-icon name="fas-comment" class="w-6 h-6 mr-2"/>
                    </button>

                    {{-- Notification --}}
                    @include("livewire.partials.notifications")
                </div>

                {{-- User dropdown --}}
                @include("livewire.partials.main-navi-user-dropdown")
            </div>

            <div class="flex lg:hidden">
                {{-- Mobile menu button --}}
                <button type="button" class="bg-white inline-flex items-center justify-center p-2 rounded-md
                         text-primary-3 hover:bg-primary-2 focus:outline-none outline-none" aria-controls="mobile-menu"
                        aria-expanded="false" @click="mobile = true">
                    <span class="sr-only">Open main menu</span>
                    {{--
                        Heroicon name: outline/menu
                        Menu open: "hidden ", Menu closed: "block "
                    --}}
                    <svg class="block h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true"
                         :class="{'hidden':mobile, '':!mobile}">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
                    </svg>
                    {{--
                      Heroicon name: outline/x
                      Menu open: "block ", Menu closed: "hidden "
                    --}}
                    <svg class="hidden h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor"
                         aria-hidden="true" :class="{'':mobile, 'hidden':!mobile}">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                    </svg>
                </button>
            </div>
        </div>
    </div>

    @include("livewire.partials.main-navi-mobile")
</nav>
