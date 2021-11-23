<x-app-layout>
    <x-page icon="fas-home" :title="__('Dashboard')">
        <p class="block">Hier entsteht das Dashboard. Folgende Click-Dummies gibt es:</p>
        <ul class="list-disc block mt-3 mb-8 p-5">
            <li><a href="{{ route("wallet") }}" class="text-color">{{ __("Wallets") }}</a></li>
            <li><a href="{{ route("wallet.new") }}" class="text-color">{{ __("Wallets Add") }}</a></li>
{{--            <li><a href="{{ route("taxes") }}" class="text-color">{{ __("Taxes") }}</a></li>--}}
        </ul>
    </x-page>
</x-app-layout>
