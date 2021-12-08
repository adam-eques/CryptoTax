<x-app-layout>

    <x-page icon="fas-wallet" :title="__('Exchanges')">
        <div class="pb-8 flex flex-col md:flex-row -mx-2 lg:-mx-5 space-y-10 md:space-y-0 ">
            <!-- Left Panel -->
            <div class="px-2 lg:px-5 md:w-1/2">
                <x-card title="Kucoin">
                    <div class="p-4">
                        <livewire:crypto-exchange-accounts.exchange-account-form :crypto-exchange-id="\App\Models\CryptoExchange::EXCHANGE_KUCOIN" />
                    </div>
                </x-card>
            </div>

            <!-- Right Panel -->
            <div class="px-4 lg:px-5 md:w-1/2">
                <x-card title="Hitbtc">
                    <div class="p-4">
                        <livewire:crypto-exchange-accounts.exchange-account-form :crypto-exchange-id="\App\Models\CryptoExchange::EXCHANGE_HITBTC" />
                    </div>
                </x-card>
            </div>
        </div>
    </x-page>

    <x-page icon="fas-wallet" :title="__('Transactions')">

        <div class="mb-6">
            <livewire:transactions-table />
        </div>
    </x-page>
</x-app-layout>
