<div>
    {{-- Do your work, then step back. --}}
    <div class="w-full border-b py-5">
        <div class="flex justify-between items-center flex-wrap">
            <div class="flex items-center justify-start space-x-3">
                <x-icon name="portfolio" class="w-9 h-9"/>
                <h1 class="font-bold sm:text-xl lg:text-2xl text-primary">{{ __('Portfolio') }}</h1>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
                <div class="col-span-2 md:col-span-1 w-full">
                    <x-button variant="white" class="w-full">
                        <x-icon name="calendar" class="w-5 mr-3"/>
                        <span>{{ __('Today') }}</span>
                    </x-button>
                </div>
                <div class="col-span-2 md:col-span-1 w-full">
                    <x-button variant="white" class="w-full">
                        <span>{{ __('Past day') }}</span>
                    </x-button>
                </div>
                <div class="col-span-2 w-full">
                    <x-button class="justify-center tracking-tight w-full" tag="a" href="{{ route('customer.account.new') }}">
                        {{ __('Total performanace') }}
                    </x-button>
                </div>
            </div>
        </div>
        {{-- <div class="grid grid-cols-1 md:grid-cols-5">
            <div class="flex items-center justify-start space-x-6 col-span-3 py-5">
                <x-icon name="portfolio" class="w-8 h-8"/>
                <h1 class="font-bold sm:text-xl lg:text-2xl text-primary">{{ __('portfolio') }}</h1>
            </div>
            <div class="grid grid-cols-1 lg:grid-cols-4 gap-3 col-span-2">
                <div class="col-span-1">
                    <x-button variant="white" class="w-full">
                        <x-icon name="calendar" class="w-5 mr-3"/>
                        <span class="hidden sm:inline">{{ __('Today') }}</span>
                    </x-button>
                </div>
                <div class="col-span-1">
                    <x-button variant="white" class="w-full">
                        <span class="hidden sm:inline">{{ __('Past day') }}</span>
                    </x-button>
                </div>
                <div class="relative  w-full col-span-2">
                    <x-button>{{ __('Total performanace') }}</x-button>
                </div>
            </div>
        </div> --}}
    </div>
</div>
