<x-app-layout>
    @if(auth()->user()->isCustomerAccount())
        <x-page icon="fas-home" :title="__('Dashboard')">
            <p class="block">Hier entsteht das Dashboard. Folgende Click-Dummies gibt es:</p>
            <ul class="list-disc block mt-3 mb-6 p-5">
                <li><a href="{{ route("customer.wallet") }}" class="text-color">{{ __("Wallets") }}</a></li>
                <li><a href="{{ route("customer.wallet.new") }}" class="text-color">{{ __("Wallets Add") }}</a></li>
                <li><a href="{{ route("customer.taxes.tax-loss-harvesting") }}" class="text-color">{{ __("Tax-Loss Harvesting") }}</a></li>
                <li><a href="{{ route("customer.taxes.tax-saving-opportunities") }}" class="text-color">{{ __("Tax-Saving Opportunities") }}</a></li>
            </ul>
            <p class="block">Exchanges:</p>
            <ul class="list-disc block mb-8 p-5">
                <li>
                    Kucoin:
                    <a href="{{ route("customer.crypto-exchange.show", ["exchange" => \App\Models\CryptoExchange::EXCHANGE_KUCOIN]) }}" class="text-color">Transactions</a> /
                    <a href="{{ route("customer.crypto-exchange.edit", ["exchange" => \App\Models\CryptoExchange::EXCHANGE_KUCOIN]) }}" class="text-color">Credentials</a>
                </li>
                <li>
                    HitBTC:
                    <a href="{{ route("customer.crypto-exchange.show", ["exchange" => \App\Models\CryptoExchange::EXCHANGE_HITBTC]) }}" class="text-color">Transactions</a> /
                    <a href="{{ route("customer.crypto-exchange.edit", ["exchange" => \App\Models\CryptoExchange::EXCHANGE_HITBTC]) }}" class="text-color">Credentials</a>
                </li>
            </ul>
        </x-page>
    @elseif(auth()->user()->isAdminAccount())
        <x-page icon="fas-home" :title="__('Admin Dashboard')">
            <p class="block mb-8">Hier entsteht das Admin-Dashboard.</p>
        </x-page>
    @elseif(auth()->user()->isTaxAdvisorAccount())
        <x-page icon="fas-home" :title="__('Tax Advisor Dashboard')">
            <p class="block mb-8">Hier entsteht das Tax Advisor-Dashboard.</p>
        </x-page>
    @endif
</x-app-layout>
