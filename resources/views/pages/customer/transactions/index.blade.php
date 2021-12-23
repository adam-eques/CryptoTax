<x-app-layout>
    <x-page icon="fas-wallet" :title="__('Exchanges')">
        <livewire:crypto-exchange.account-form />
    </x-page>

    <x-page icon="fas-wallet" :title="__('Transactions')">
        <div class="mb-6">
            <livewire:crypto-exchange.transactions-table />
        </div>
    </x-page>
</x-app-layout>
