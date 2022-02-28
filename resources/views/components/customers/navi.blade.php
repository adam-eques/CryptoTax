@php($navItems = \App\Services\NavigationService::instance()->getTopLevelItems())
<nav class="bg-primary" x-data="{mobile:false}">
    <div class="px-3 mx-auto xs:px-4 xl:max-w-screen-2xl lg:px-5">
        <div class="flex items-center justify-between py-2 lg:py-0 lg:h-20">
            {{-- Site Logo --}}
            <div class="flex-shrink-0">
                <a href="{{ route("customer.dashboard") }}" class="flex items-center text-white group">
                    <img src="{{asset('/assets/img/logo.svg')}}" alt="Logo" class="h-10">
                    <div class="ml-1">
                        <p class="font-semibold text-white text-md">my</p>
                        <h3 class="text-2xl font-bold leading-5 text-white">Crypto.Tax</h3>
                    </div>
                </a>
            </div>

            <div class="items-center justify-center flex-1 hidden px-5 lg:flex 2xl:px-20">
                <div class="flex items-baseline justify-start flex-1 gap-3">
                    @foreach($navItems as $navItem)
                        <x-jet-nav-link href="{{ route($navItem['route']) }}" :active="request()->routeIs($navItem['route'])">
                            <x-icon :name="$navItem['icon']" class="w-6 h-6 mr-1"/>
                            {{ $navItem["label"] }}
                        </x-jet-nav-link>
                    @endforeach
                </div>
            </div>

            <div class="ml-auto mr-5">
                <x-customers.user-dropdown />
            </div>

            <x-customers.main-navi-mobile />
        </div>
    </div>

    <div class="lg:hidden" id="mobile-menu" x-show="mobile" @click.away="mobile=false" x-cloak
         x-transition:enter-start="transition ease-in duration-3000">
        <div class="flex flex-col gap-3 px-2 pt-2 pb-3 space-y-1 sm:px-3 md:flex-row md:gap-0 md:justify-between">
            @foreach($navItems as $navItem)
                <x-jet-nav-link href="{{ route($navItem['route']) }}" :active="request()->routeIs($navItem['route'])">
                    <x-icon :name="$navItem['icon']" class="w-6 h-6 mr-2"/>
                    {{ $navItem["label"] }}
                </x-jet-nav-link>
            @endforeach
        </div>
        <div
            class="flex flex-col pt-4 pb-3 border-t border-white border-opacity-30 md:flex-row md:justify-between md:items-center">
            <div class="flex items-center px-5">
                <div class="flex-shrink-0 overflow-hidden rounded-full ring-4 ring-white">
                    <img class="w-10 h-10 rounded-full"
                        src="https://images.unsplash.com/photo-1472099645785-5658abf4ff4e?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=facearea&facepad=2&w=256&h=256&q=80"
                        alt=""
                    />
                </div>
                <div class="ml-3 space-y-2">
                    <div class="text-base font-medium leading-none text-white">{{ __(auth()->user()->name) }}</div>
                    <div class="hidden text-sm font-light leading-none text-gray-200">tom@example.com</div>
                </div>
            </div>
            <!-- Dropdown -->
            <div class="flex flex-col px-2 mt-3 space-y-1 md:mt-0 md:space-y-0 md:flex-row md:gap-2">
              
                <x-jet-dropdown-link href="{{ route('customer.message') }}" class="flex items-center gap-3 py-3 text-white">
                    <x-iconoir-message-text class="w-6"/>
                    {{ __('Messages') }}
                </x-jet-dropdown-link>
                <x-jet-dropdown-link href="{{ route('customer.notification') }}" class="flex items-center gap-3 py-3 text-white">
                    <x-iconoir-bell-notification class="w-6"/>
                    {{ __('Notifications') }}
                </x-jet-dropdown-link>
                <x-jet-dropdown-link href="{{ route('customer.payment-info') }}" class="flex items-center gap-3 py-3 text-white">
                    <x-fluentui-payment-16-o  class="w-6"/>
                    {{ __('Payment Informations') }}
                </x-jet-dropdown-link>
                <x-jet-dropdown-link href="{{ route('customer.billing-log') }}" class="flex items-center gap-3 py-3 text-white">
                    <x-ri-bill-line class="w-6"/>
                    {{ __('Billing') }}
                </x-jet-dropdown-link>
                <x-jet-dropdown-link href="{{ route('customer.buy-credit') }}" class="flex items-center gap-3 py-3 text-white">
                    <x-feathericon-shopping-bag class="w-6"/>
                    {{ __('Buy Credits') }}
                </x-jet-dropdown-link>
                <x-jet-dropdown-link href="{{ route('customer.user-setting') }}" class="flex items-center gap-3 py-3 text-white">
                    <x-uni-setting-o class="w-6"/>
                    {{ __('Setting') }}
                </x-jet-dropdown-link>
                
                <!-- Authentication -->
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <x-jet-dropdown-link href="{{ route('logout') }}" onclick="event.preventDefault(); this.closest('form').submit();" class="flex items-center gap-3 py-3 text-white">
                        <x-heroicon-o-logout class="w-6"/>
                        {{ __('Log Out') }}
                    </x-jet-dropdown-link>
                </form>
                
            </div>
        </div>
    </div>
</nav>

{{-- Subnavi --}}
<x-customers.sub-navi />
