<x-app-layout title="Taxes">
    <x-container class="bg-white rounded-sm shadow mt-7">
        <x-customers.customer-header-bar icon="tabler-tax" name="2021 Taxes">
            <x-button class="">
                <x-icon name="uni-user-md-o" class="w-5 h-5 mr-3 text-white"/>
                <p class="font-semibold text-white">Add tax professional</p>
            </x-button>
        </x-customers.customer-header-bar>
        <div class="grid grid-cols-1 pt-4 pb-12 md:grid-cols-12 gap-y-4 md:gap-x-4">
            <div class="col-span-7 space-y-4">
                @livewire('customer.taxes.gains')
                @livewire('customer.taxes.income')
            </div>
            <div class="col-span-5">
                @livewire('customer.taxes.history')
                @livewire('customer.taxes.check-list')
                @livewire('customer.taxes.report')
            </div>
        </div>
    </x-container>
</x-app-layout>
