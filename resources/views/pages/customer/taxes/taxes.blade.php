<x-app-layout>
    <x-container class="bg-white rounded-sm shadow mt-7">
        <x-customers.customer-header-bar icon="tax-1" name="2021 Taxes">
            <x-button class="">
                <x-icon name="advisor" class="w-5 h-5 text-white mr-3"/>
                <p class="text-white font-semibold">Add tax professional</p>
            </x-button>
        </x-customers.customer-header-bar>
        <div class="grid grid-cols-1 md:grid-cols-12 gap-y-4 md:gap-x-4 pt-4 pb-12">
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
