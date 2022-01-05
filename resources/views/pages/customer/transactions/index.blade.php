<x-app-layout>
    <x-page icon="fas-wallet" :title="__('Exchanges & Wallets')">
        <livewire:crypto-exchange.account-form />
    </x-page>

    <x-page icon="fas-wallet" :title="__('Exchange Transactions')">
        <div class="mb-6">
            <livewire:crypto-exchange.transactions-table />
        </div>
    </x-page>

    <x-page icon="fas-wallet" :title="__('Wallet Transactions')">
        <div class="mb-6">
            <livewire:wallet.wallet-table />
        </div>
    </x-page>
</x-app-layout>
