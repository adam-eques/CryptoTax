<x-app-layout>
    <x-page icon="fas-wallet" :title="__('Exchanges & Blockchains & Wallets')">
        <livewire:crypto-account.account-form />

        <div class="flex flex-col pb-8 -mx-2 space-y-10 md:flex-row lg:-mx-5 md:space-y-0">
            <div class="px-2 lg:px-5 md:w-1/2">
                <livewire:blockchain.blockchain-form />
            </div>
        </div>
    </x-page>

    <x-page icon="fas-wallet" :title="__('Exchange Transactions')">
        <div class="mb-6">
            <livewire:crypto-account.transactions-table />
        </div>
    </x-page>

    <x-page icon="fas-wallet" :title="__('Blockchain Transactions')">
        <div class="mb-6">
            <livewire:blockchain.blockchain-table />
        </div>
    </x-page>
</x-app-layout>
