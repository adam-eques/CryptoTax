<x-app-layout>
    <x-container class="px-3 py-5 my-5 bg-white rounded-sm shadow xs:px-4 lg:px-5">
        <x-customers.customer-header-bar icon="chains" name="Assets">
            <x-button class="">
                <x-icon name="export" class="w-5 h-5 mr-3 text-white"/>
                <p class="font-semibold text-white">{{ __('Export') }}</p>
            </x-button>
        </x-customers.customer-header-bar>
        <div class="py-8">
            @livewire('customer.portfolio.assets-overview')
        </div>
        <div class="mt-8 border-b pb-14">
            @livewire('customer.portfolio.assets-chain-allocation')
        </div>
        <div class="mt-12">
            @livewire('customer.portfolio.assets-portfolios')
        </div>
    </x-container>
</x-app-layout>