<div class="relative" x-data="{open:false}">
    <button type="button" class="flex items-center justify-end outline-none focus:outline-none text-white hover:text-secondary gap-4 font-medium"
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
        <span class="xl:inline-flex hidden w-1/2">
            <p class="truncate">{{ Auth::user()->name }}</p>
            <x-icon name="fas-chevron-down" class="w-4 ml-2 inline text-white"/>
        </span>
    </button>

    <div
        class="origin-top-right absolute right-0 mt-2 w-48 rounded-md shadow-lg py-1 bg-white ring-1 ring-black ring-opacity-5 focus:outline-none"
        role="menu" aria-orientation="vertical" aria-labelledby="user-menu-button" tabindex="-1"
        x-show="open" @click.away="open=false" x-cloak
        x-transition:enter-start="transition ease-in duration-3000">
             
        <a href="{{ route('customer.dashboard') }}" class="flex items-center space-x-4 py-2 px-4 text-primary hover:bg-gray-100 text-base">
            <x-icon name="dashboard" class="w-6"/>
            <span>{{ __('Dashboard') }}</span>
        </a>

        <div class="border-t border-gray-100"></div>

        <a href="{{ route('logout') }}" class="flex items-center space-x-4 py-2 px-4 text-primary hover:bg-gray-100 text-base">
            <x-icon name="dashboard" class="w-6"/>
            <span>{{ __('Log Out') }}</span>
        </a>
    </div>
</div>
