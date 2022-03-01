<x-app-layout>
    <div class="py-16 bg-bgcolor1">
        <div class="px-3 mx-auto xs:px-4 xl:max-w-screen-2xl">
            <div class="grid grid-cols-1 gap-0 md:grid-cols-2 md:gap-5">
                <div class="">
                    <p class="text-lg">{{ __('COUPON') }}</p>
                    <h2 class="mt-3 text-6xl font-bold">{{ __('Big new year offer') }}</h2>
                    <div class="flex py-4 mx-auto mt-3">
                        <h4 class="text-5xl text-secondary">{{ __('UPTO') }} <span class="font-bold">65%</span> OFF</h4>
                    </div>
                    <p class="mt-3">{{ __('Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua') }}</p>
                    <x-button size="xl" class="px-10 py-4 mt-5">{{ __('Refer and Earn') }}</x-button>
                </div>
                <div>
                    <img src="{{ asset('assets/img/svg/service.svg') }}" class="w-full h-full"/>
                </div>
            </div>
        </div>
    </div>
    <div class="py-24 bg-white">
        <div class="px-3 mx-auto xs:px-4 xl:max-w-screen-2xl">
           @livewire('customer.service.service-list')
        </div>
    </div>
</x-app-layout>