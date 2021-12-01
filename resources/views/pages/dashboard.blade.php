<x-app-layout>
    @if(auth()->user()->isCustomerAccount())
        <x-page icon="fas-home" :title="__('Dashboard')">
            <p class="block">Hier entsteht das Dashboard. Folgende Click-Dummies gibt es:</p>
            <ul class="list-disc block mt-3 mb-8 p-5">
                <li><a href="{{ route("customer.wallet") }}" class="text-color">{{ __("Wallets") }}</a></li>
                <li><a href="{{ route("customer.wallet.new") }}" class="text-color">{{ __("Wallets Add") }}</a></li>
                <li><a href="{{ route("customer.taxes.tax-loss-harvesting") }}" class="text-color">{{ __("Tax-Loss Harvesting") }}</a></li>
                <li><a href="{{ route("customer.taxes.tax-saving-opportunities") }}" class="text-color">{{ __("Tax-Saving Opportunities") }}</a></li>
            </ul>
        </x-page>
    @elseif(auth()->user()->isAdminAccount())
        <x-page icon="fas-home" :title="__('Admin Dashboard')">
            <p class="block mb-8">Hier entsteht das Admin-Dashboard.</p>
        </x-page>
    @endif
</x-app-layout>
