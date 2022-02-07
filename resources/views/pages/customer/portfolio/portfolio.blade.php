<x-app-layout>
    @if(auth()->user()->isCustomerAccount())
    <div class="mx-auto my-5 px-3 xs:px-4 xl:max-w-screen-2xl lg:px-5 py-5 bg-white rounded-sm shadow">
        <x-customers.customer-header-bar icon="portfolio" name="Portfolio">
            <div class="w-full">
                <x-button variant="white" class="w-full">
                    <x-icon name="calendar" class="w-5 mr-3"/>
                    <span>{{ __('Today') }}</span>
                    <x-icon name="fas-chevron-down" class="w-2 ml-2 inline"/>
                </x-button>
            </div>
            <div class="w-full">
                <x-jet-dropdown>
                    <x-slot name="trigger">
                        <x-button variant="white" class="w-full whitespace-nowrap text-primary hover:text-white">
                            <span>{{ __('Past day') }}</span>
                            <x-icon name="fas-chevron-down" class="w-2 ml-2 inline"/>
                        </x-button>
                    </x-slot>
                    <x-slot name="content">
                        <div class="p-5">

                        </div>
                    </x-slot>
                </x-jet-dropdown>
            </div>
            <div class="w-full whitespace-nowrap">
                <x-jet-dropdown>
                    <x-slot name="trigger">
                        <x-button class="justify-center tracking-tight w-full" variant="secondary">
                            {{ __('Total performanace') }}
                            <x-icon name="fas-chevron-down" class="w-2 ml-2 inline"/>
                        </x-button>
                    </x-slot>
                    <x-slot name="content">
                        <div class="p-5">

                        </div>
                    </x-slot>
                </x-jet-dropdown>
            </div>
        </x-customers.customer-header-bar>
        
        @livewire('customer.portfolio.overview')
        @livewire('customer.portfolio.line-chart')
        <div class="grid grid-cols-1 md:grid-cols-3 gap-0 md:gap-4 py-4">
            <div class="col-span-1 space-y-5 h-full">
                <div class="border rounded-lg p-5">
                    @livewire('customer.portfolio.allocation')
                </div>
                <div class="border rounded-lg p-5 bg-gray-100 relative">
                    @livewire('customer.portfolio.invite')
                    <img src="{{asset('assets/img/svg/portfolio_invite.svg')}}" class="absolute bottom-0 right-0 w-40 h-22"/>
                </div>
            </div>
            <div class="col-span-2 border rounded-lg p-5">
                @livewire('customer.portfolio.crypto-portfolio')
            </div>
        </div>
    </div>
    @endif
</x-app-layout>