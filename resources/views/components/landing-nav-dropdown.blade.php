<div class="relative" x-data="{open:false}">
    <button type="button" class="flex items-center justify-end gap-4 font-medium text-white outline-none focus:outline-none hover:text-secondary"
            id="user-menu-button"
            aria-expanded="false"
            aria-haspopup="true"
            x-cloak
            @click="open = true">
        <span class="sr-only">{{ __("Open user menu") }}</span>
        <span class="bg-primary-600 rounded-full overflow-hidden h-[50px] w-[50px]">
            <img class="h-[50px] w-[50px] rounded-full border-4 border-white"
                 src="https://images.unsplash.com/photo-1472099645785-5658abf4ff4e?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=facearea&facepad=2&w=256&h=256&q=80"
                 alt=""/>
        </span>
        <span class="hidden w-1/2 xl:inline-flex">
            <p class="truncate">{{ Auth::user()->name }}</p>
            <x-icon name="fas-chevron-down" class="inline w-4 ml-2 text-white"/>
        </span>
    </button>

    <div
        class="absolute right-0 w-48 py-1 mt-2 origin-top-right bg-white rounded-md shadow-lg ring-1 ring-black ring-opacity-5 focus:outline-none"
        role="menu" aria-orientation="vertical" aria-labelledby="user-menu-button" tabindex="-1"
        x-show="open" @click.away="open=false" x-cloak
        x-transition:enter-start="transition ease-in duration-3000">
             
        <a href="{{ route('customer.dashboard') }}" class="flex items-center px-4 py-2 space-x-4 text-base text-primary hover:bg-gray-100">
            <x-icon name="carbon-dashboard" class="w-4"/>
            <span>{{ __('Dashboard') }}</span>
        </a>

        <div class="border-t border-gray-100"></div>

        <a href="{{ route('logout') }}" class="flex items-center px-4 py-2 space-x-4 text-base text-primary hover:bg-gray-100">
            <x-icon name="heroicon-o-logout" class="w-4"/>
            <span>{{ __('Log Out') }}</span>
        </a>
    </div>
</div>
