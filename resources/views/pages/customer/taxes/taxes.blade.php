<x-app-layout>
    <x-page icon="fas-list" :title="__('Taxes')">
        <p class="block">Hier entsteht das Dashboard. Folgende Click-Dummies gibt es:</p>
        <ul class="list-disc block mt-3 mb-8 p-5">
            <li><a href="{{ route("customer.wallet") }}" class="text-color">{{ __("Wallets") }}</a></li>
            <li><a href="{{ route("customer.taxes") }}" class="text-color">{{ __("Taxes") }}</a></li>
        </ul>
    </x-page>
</x-app-layout>
