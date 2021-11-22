<div class="relative hidden lg:block" x-data="{open:false}">
    <button type="button" title="Notification"
            class="rounded-full text-white hover:text-gray-300 focus:outline-none outline-none relative"
            @click="open = true">
        <span class="sr-only">{{ __("View notifications") }}</span>
        <x-icon name="fas-bell" class="w-6 h-6 mr-2 mt-1"/>
        <span class="rounded-full bg-white text-color px-1 inline-flex text-xs absolute -top-1 -right-1">2</span>
    </button>

    <div
        class="origin-top-right absolute right-0 mt-2 w-70 rounded-md shadow-lg py-1 bg-white ring-1 ring-black ring-opacity-5 focus:outline-none"
        role="menu" aria-orientation="vertical" aria-labelledby="user-menu-button" tabindex="-1"
        x-show="open" @click.away="open=false"
        x-transition:enter-start="transition ease-in duration-3000">
        <x-jet-dropdown-link href="{{ route('taxes') }}">
            <x-icon name="fas-file-alt"  class="w-3 sm:inline mr-2" />
            New tax report available
            <small class="sm:block text-2xs mt-1 ml-6 text-gray-400">2021-11-30 03:04 pm</small>
        </x-jet-dropdown-link>
        <div class="border-t border-gray-100"></div>

        <x-jet-dropdown-link href="{{ route('wallet') }}">
            <x-icon name="fas-plus-square" class="w-3 sm:inline mr-2" />
            New wallet added
            <small class="sm:block text-2xs mt-1 ml-6 text-gray-400">2021-11-30 03:04 pm</small>
        </x-jet-dropdown-link>
    </div>
</div>
