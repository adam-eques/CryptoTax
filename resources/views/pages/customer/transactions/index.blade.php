<x-app-layout>
    <x-page icon="fas-wallet" :title="__('Exchanges & Blockchains & Wallets Accounts')">
        <livewire:crypto-account.account-form />
    </x-page>

    <x-page icon="fas-wallet" :title="__('Transactions')">
        <div class="mb-6">
            <livewire:crypto-account.transactions-table />
        </div>
    </x-page>
</x-app-layout>
