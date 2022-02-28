<div class="relative z-50 hidden w-full ml-3 lg:block" x-data="{open:false}">
    <button type="button" class="flex items-center justify-end gap-4 font-medium text-white outline-none focus:outline-none"
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
        <span class="hidden xl:inline-flex xl:w-1/2">
            <p class="truncate">{{ Auth::user()->name }}</p>
            <x-icon name="fas-chevron-down" class="inline w-4 ml-2 text-white"/>
        </span>
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
        class="absolute right-0 w-56 py-1 mt-2 origin-top-right bg-white divide-y rounded-md shadow-lg ring-1 ring-black ring-opacity-5 focus:outline-none"
        role="menu" aria-orientation="vertical" aria-labelledby="user-menu-button" tabindex="-1"
        x-show="open" @click.away="open=false" x-cloak
        x-transition:enter-start="transition ease-in duration-3000"
    >
        <x-jet-dropdown-link href="{{ route('customer.message') }}" class="flex items-center gap-3 py-3">
            <x-iconoir-message-text class="w-6 text-primary"/>
            {{ __('Messages') }}
        </x-jet-dropdown-link>
        <x-jet-dropdown-link href="{{ route('customer.notification') }}" class="flex items-center gap-3 py-3">
            <x-iconoir-bell-notification class="w-6 text-primary"/>
            {{ __('Notifications') }}
        </x-jet-dropdown-link>
        <x-jet-dropdown-link href="{{ route('customer.payment-info') }}" class="flex items-center gap-3 py-3">
            <x-fluentui-payment-16-o  class="w-6 text-primary"/>
            {{ __('Payment Informations') }}
        </x-jet-dropdown-link>
        <x-jet-dropdown-link href="{{ route('customer.billing-log') }}" class="flex items-center gap-3 py-3">
            <x-ri-bill-line class="w-6 text-primary"/>
            {{ __('Billing') }}
        </x-jet-dropdown-link>
        <x-jet-dropdown-link href="{{ route('customer.buy-credit') }}" class="flex items-center gap-3 py-3">
            <x-feathericon-shopping-bag class="w-6 text-primary"/>
            {{ __('Buy Credits') }}
        </x-jet-dropdown-link>
        <x-jet-dropdown-link href="{{ route('customer.user-setting') }}" class="flex items-center gap-3 py-3">
            <x-uni-setting-o class="w-6 text-primary"/>
            {{ __('Setting') }}
        </x-jet-dropdown-link>
        
        <!-- Authentication -->
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <x-jet-dropdown-link href="{{ route('logout') }}" onclick="event.preventDefault(); this.closest('form').submit();" class="flex items-center gap-3 py-3">
                <x-heroicon-o-logout class="w-6 text-primary"/>
                {{ __('Log Out') }}
            </x-jet-dropdown-link>
        </form>
    </div>
</div>
