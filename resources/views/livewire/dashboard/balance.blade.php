<div class="bg-white p-5 rounded-md shadow-md">
    <div class="flex items-center justify-between">
        <div class="flex items-center space-x-2 py-5">
            <x-icon name="coin" class="w-8 h-8"/>
            <x-typography size="lg" class="mr-3 font-extrabold">My Balance</x-typography>
        </div>
        <div class="flex items-center space-x-3">
            <button class="border rounded-lg px-3 py-2 text-primary hover:text-white bg-white hover:bg-primary">
                <x-icon name="tile" class="w-6 h-6"/>
            </button>
            <button class="border rounded-lg px-3 py-2 text-primary hover:text-white bg-white hover:bg-primary">
                <x-icon name="list" class="w-6 h-6"/>
            </button>
        </div>
    </div>
    <div class=" lg:px-8 sm:px-6 px-5 py-4">
        <img src="{{asset('assets/img/svg/credit_card.svg')}}" class=" w-9/12 mx-auto"/>
    </div>
    <div class="grid grid-cols-1 xl:grid-cols-2 gap-0 md:gap-4 mt-3">
        <div>
            {{-- <p class="text-md text-secondary-500">Total Balance</p> --}}
            <x-typography variant="secondary" size="md">{{ __('Total Balance') }}</x-typography>
            <x-typography size="2xl" variant="primary">{{ __('$ 124, 563, 000') }}</x-typography>
            <x-progressbar height="sm" variant="primary" progress="30"></x-progressbar>
        </div>
        <div>            
            <x-typography variant="secondary" size="md">{{ __('Your Tax') }}</x-typography>
            <x-typography size="2xl" variant="primary">{{ __('$ 124, 563, 000') }}</x-typography>
            <x-progressbar height="sm" variant="primary" progress="45"></x-progressbar>
        </div>
        <x-button variant="primary" class="flex items-center space-x-5 mt-8">
            <div class="px-3 py-2 rounded-lg bg-white">
                <x-icon name="wallet-1" class="w-8 h-8 text-primary"/>
            </div>
            <span>{{ __('Add Wallet') }}</span>
        </x-button>
        <x-button variant="third" class="p-3 flex items-center space-x-5 mt-8">
            <div class="px-3 py-2 bg-white rounded-lg">
                <x-icon name="tax-1" class="w-8 h-8 text-third"/>
            </div>
            <span>{{ __('Tax Optimizion') }}</span>
            {{-- <x-typography variant="white" size="md"></x-typography> --}}
        </x-button>
    </div>
</div>
