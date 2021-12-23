<x-app-layout>
    <x-page icon="fas-wallet" :title="__('Exchanges')">
        <livewire:crypto-exchange-form />
    </x-page>

    <x-page icon="fas-wallet" :title="__('Transactions')">
        <div class="mb-6">
            <livewire:transactions-table />
        </div>
    </x-page>
</x-app-layout>
