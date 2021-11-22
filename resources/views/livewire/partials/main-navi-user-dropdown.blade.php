<div class="ml-3 relative hidden lg:block" x-data="{open:false}">
    <button type="button" class=" flex items-center outline-none focus:outline-none text-white gap-4 font-medium"
            id="user-menu-button"
            aria-expanded="false"
            aria-haspopup="true"
            @click="open = true">
        <span class="sr-only">{{ __("Open user menu") }}</span>
        <span class="w-[50px] bg-gray-800 rounded-full overflow-hidden ring-4 ring-white">
            <img class="h-[50px] w-[50px] rounded-full"
                 src="https://images.unsplash.com/photo-1472099645785-5658abf4ff4e?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=facearea&facepad=2&w=256&h=256&q=80"
                 alt=""/>
        </span>
        <span class="xl:inline-flex hidden">{{ Auth::user()->name }}</span>
    </button>

    <!--
    Dropdown menu, show/hide based on menu state.

    Entering: "transition ease-out duration-100 "
    From: "transform opacity-0 scale-95 "
    To: "transform opacity-100 scale-100 "
    Leaving: "transition ease-in duration-75 "
    From: "transform opacity-100 scale-100 "
    To: "transform opacity-0 scale-95 "
    -->
    <div
        class="origin-top-right absolute right-0 mt-2 w-48 rounded-md shadow-lg py-1 bg-white ring-1 ring-black ring-opacity-5 focus:outline-none"
        role="menu" aria-orientation="vertical" aria-labelledby="user-menu-button" tabindex="-1"
        x-show="open" @click.away="open=false"
        x-transition:enter-start="transition ease-in duration-3000">
        <x-jet-dropdown-link href="{{ route('profile.show') }}">
            {{ __('Profile') }}
        </x-jet-dropdown-link>
        @if (Laravel\Jetstream\Jetstream::hasApiFeatures())
            <x-jet-dropdown-link href="{{ route('api-tokens.index') }}">
                {{ __('API Tokens') }}
            </x-jet-dropdown-link>
        @endif

        <div class="border-t border-gray-100"></div>

        <!-- Authentication -->
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <x-jet-dropdown-link href="{{ route('logout') }}" onclick="event.preventDefault(); this.closest('form').submit();">
                {{ __('Log Out') }}
            </x-jet-dropdown-link>
        </form>
    </div>
</div>
