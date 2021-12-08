<x-app-layout>
    <x-previous-page href="{{ route('customer.wallet') }}"></x-previous-page>

    <x-page icon="fas-wallet" :title="__('New Wallet')">
        <div class="pb-8 flex flex-col md:flex-row -mx-2 lg:-mx-5 space-y-10 md:space-y-0">
            <!-- Left Panel -->
            <div class="px-2 lg:px-5 md:w-2/5">
                <x-card :title="__('Add Wallet')">
                    <div class="p-6">
                        <livewire:wallet-new></livewire:wallet-new>
                    </div>
                </x-card>
            </div>

            <!-- Right Panel -->
            <div class="px-4 lg:px-5 md:w-3/5 pt-4">
                <p class="font-bold mb-4">How to add your account:</p>
                <p class="mb-2">01. Choose an exchange, wallet, or address type from the list on the left</p>
                <p>02. Follow the instructions</p>
            </div>
        </div>
    </x-page>
</x-app-layout>
