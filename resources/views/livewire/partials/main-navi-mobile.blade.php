<div class="lg:hidden" id="mobile-menu" x-show="mobile" @click.away="mobile=false"
     x-transition:enter-start="transition ease-in duration-3000">
    <div class="px-2 pt-2 pb-3 space-y-1 sm:px-3 flex flex-col md:flex-row gap-3 md:gap-0 md:justify-between">
        @foreach($navItems as $navItem)
            <x-jet-nav-link href="{{ route($navItem['route']) }}" :active="request()->routeIs($navItem['route'])">
                {{-- <x-icon :name="$navItem['icon']" class="w-6 h-6 mr-2"/> --}}
                <img src="{{ asset("assets/img/icon/nav/" . $navItem['icon'] . "_primary.svg") }}" class="w-6 h-6 mr-2"/>
                {{ __($navItem["label"]) }}
            </x-jet-nav-link>
        @endforeach
    </div>
    <div
        class="pt-4 pb-3 border-t border-white border-opacity-30 flex flex-col md:flex-row md:justify-between md:items-center">
        <div class="flex items-center px-5">
            <div class="flex-shrink-0 ring-4 ring-white rounded-full overflow-hidden">
                <img class="h-10 w-10 rounded-full"
                     src="https://images.unsplash.com/photo-1472099645785-5658abf4ff4e?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=facearea&facepad=2&w=256&h=256&q=80"
                     alt=""/>
            </div>
            <div class="ml-3 space-y-2">
                <div class="text-base font-medium leading-none text-white">John Doe</div>
                <div class="text-sm font-light leading-none text-gray-200 hidden">tom@example.com</div>
            </div>
        </div>
        <!-- Dropdown -->
        <div class="mt-3 md:mt-0 px-2 space-y-1 md:space-y-0 flex flex-col md:flex-row md:gap-2">
            <a href="#" class="block px-3 py-2 rounded text-base font-light text-gray-200 hover:text-primary hover:bg-white">
                Your Profile
            </a>
            <a href="#" class="block px-3 py-2 rounded text-base font-light text-gray-200 hover:text-primary hover:bg-white">Settings</a>
            <a href="#" class="block px-3 py-2 rounded text-base font-light text-gray-200 hover:text-primary hover:bg-white">Sign out</a>
        </div>
    </div>
</div>
