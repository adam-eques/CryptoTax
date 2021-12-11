<x-app-layout>
    @if(auth()->user()->isCustomerAccount())
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
            <div class="grid grid-cols-1 md:grid-cols-12 md:gap-4 gap-0 mt-5">
                <div class="col-span-7">
                    @livewire('dashboard.portfolio')
                </div>
                <div class="col-span-5">
                    @livewire('dashboard.transaction')
                    @livewire('dashboard.news')
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
