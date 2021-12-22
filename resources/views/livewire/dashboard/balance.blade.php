@php
    $situation = [
        [ 'category' => 'Total Balance', 'amount' => '$ 124, 563, 000', 'percent' => '30'],
        [ 'category' => 'Your Tax', 'amount' => '$ 124, 563, 000', 'percent' => '94'],
    ]
@endphp

<div class="bg-white p-5 rounded-md shadow-md">
    <div class="flex items-center justify-between">
        <div class="flex items-center space-x-2 py-5">
            <x-icon name="coin" class="w-8 h-8"/>
            <p class="mr-3 font-extrabold text-lg">{{ __("My Balance") }}</p>
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
    <div class=" lg:px-4 sm:px-3 px-2 py-4">
        <img src="{{asset('assets/img/svg/Credit Card.svg')}}" class=" w-9/12 mx-auto"/>
    </div>
    <div class="grid grid-cols-1 xl:grid-cols-2 gap-0 md:gap-4 mt-3">
        
        @foreach ($situation as $item)            
            <div>
                <p class="text-sm text-secondary">{{ __( $item['category'] ) }}</p>
                <p class="text-2xl text-primary font-semibold pt-2">{{ __( $item['amount'] ) }}</p>
                <x-progressbar height="sm" variant="primary" progress="{{ $item['percent'] }}"></x-progressbar>
            </div>
        @endforeach

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
        </x-button>
    </div>
</div>
