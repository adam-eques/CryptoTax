<x-app-layout>
    <x-page icon="fas-wallet" :title="__('Exchanges & Wallets')">
        <livewire:crypto-exchange.account-form />
    </x-page>

    <x-page icon="fas-wallet" :title="__('Exchange Transactions')">
        <div class="mb-6">
            <livewire:crypto-exchange.transactions-table />
        </div>
    </x-page>

    <x-page icon="fas-wallet" :title="__('Blockchain Transactions')">
        <div class="mb-6">
            <livewire:blockchain.blockchain-table />
        </div>
    </x-page>
</x-app-layout>
