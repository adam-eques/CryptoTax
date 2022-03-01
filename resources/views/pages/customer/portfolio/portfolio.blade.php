<x-app-layout>
    @if(auth()->user()->isCustomerAccount())
    <x-container class="bg-white rounded-sm shadow my-5">
        <x-customers.customer-header-bar icon="carbon-portfolio" name="Portfolio">
            <x-button variant="white" class="justify-between w-full">
                <x-icon name="carbon-calendar" class="w-5 h-5 mr-3"/>
                <span class="mr-2">{{ __('Today') }}</span>
                <svg class="w-4 transform trnstsn " fill="none" viewBox="0 0 24 24" stroke="currentColor" :class="{'rotate-180': open}">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                </svg>
            </x-button>
            <x-jet-dropdown>
                <x-slot name="trigger">
                    <x-button variant="white" class="justify-between w-full whitespace-nowrap text-primary hover:text-white">
                        <span class="mr-2">{{ __('Past day') }}</span>
                        <svg class="w-4 transform trnstsn " fill="none" viewBox="0 0 24 24" stroke="currentColor" :class="{'rotate-180': open}">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                        </svg>
                    </x-button>
                </x-slot>
                <x-slot name="content">
                    <div class="p-5">

                    </div>
                </x-slot>
            </x-jet-dropdown>
            <x-jet-dropdown>
                <x-slot name="trigger">
                    <x-button class="justify-between w-full tracking-tight whitespace-nowrap" variant="secondary">
                        <span class="mr-2">{{ __('Total performanace') }}</span>
                        <svg class="w-4 transform trnstsn " fill="none" viewBox="0 0 24 24" stroke="currentColor" :class="{'rotate-180': open}">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                        </svg>
                    </x-button>
                </x-slot>
                <x-slot name="content">
                    <div class="p-5">

                    </div>
                </x-slot>
            </x-jet-dropdown>
        </x-customers.customer-header-bar>
        
        @livewire('customer.portfolio.overview')
        @livewire('customer.portfolio.line-chart')
        <div class="grid grid-cols-1 py-4 lg:grid-cols-3 gap-y-4 lg:gap-x-4">
            <div class="h-full col-span-1 space-y-5">
                <div class="p-5 border rounded-lg">
                    @livewire('customer.portfolio.allocation')
                </div>
                <div class="relative p-5 bg-gray-100 border rounded-lg">
                    @livewire('customer.portfolio.invite')
                    <img src="{{asset('assets/img/svg/portfolio_invite.svg')}}" class="absolute bottom-0 right-0 w-40 h-22"/>
                </div>
            </div>
            <div class="col-span-2 p-5 border rounded-lg">
                @livewire('customer.portfolio.crypto-portfolio')
            </div>
        </div>
    </x-container>
    @endif
</x-app-layout>