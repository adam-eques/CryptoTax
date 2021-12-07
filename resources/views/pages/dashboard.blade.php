<x-app-layout>
    @if(auth()->user()->isCustomerAccount())
        {{-- <x-page icon="fas-home" :title="__('Dashboard')">
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
                    <a href="{{ route("customer.crypto-exchange.show", ["exchange" => \App\Models\CryptoExchange::EXCHANGE_KUCOIN]) }}" class="text-color">Kucoin</a>
                </li>
            </ul>
        </x-page> --}}
        <div class="mx-auto px-3 xs:px-4 xl:max-w-screen-2xl lg:px-5 py-5">
            <div class="grid grid-cols-1 md:grid-cols-12 md:gap-4 gap-0">
                <div class="col-span-7">
                    @livewire('dashboard.about')
                    @livewire('dashboard.performance')
                </div>
                <div class="col-span-5">
                    @livewire('dashboard.balance')
                    @livewire('dashboard.taxes')
                </div>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-12 md:gap-4 gap-0">
                <div class="col-span-7">
                    @livewire('dashboard.portfolio')
                </div>
                <div class="col-span-5">
                    @livewire('dashboard.transaction')
                </div>
            </div>
        </div>
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
