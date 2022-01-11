@php(\App\Services\NavigationService::instance()->overwriteSubnavi([
    ["label" => "Transactions", "icon" => "transaction-2", "route" => "transactions1"],
], [
    ["label" => "Invite a Friend", "icon" => "invite", "route" => "customer.invite", "color" => "text-white bg-primary"],
]))

<x-app-layout>
    <div class="mx-auto my-5 px-3 xs:px-4 xl:max-w-screen-2xl lg:px-5 py-5 bg-white rounded-sm shadow">
        <div class="w-full border-b py-2">
            <div class="grid grid-cols-1 md:grid-cols-5">
                <div class="flex items-center justify-start space-x-6 col-span-3 py-5">
                    <x-icon name="transaction-1" class="w-8 h-8"/>
                    <h1 class="font-bold sm:text-xl lg:text-2xl text-primary">{{ __('Transactions') }}</h1>
                </div>
                <div class="grid grid-cols-1 lg:grid-cols-3 gap-x-0 lg:gap-x-3 col-span-2 py-2">
                    <x-button variant="white" class="border-primary">{{ __('Download CSV') }}</x-button>
                    <x-button variant="white" class="border-primary">{{ __('Add transaction') }}</x-button>
                    <x-button>
                        <x-icon name="wallet-1" class="w-8 mr-2"/>
                        {{ __('Add Account') }}
                    </x-button>
                </div>
            </div>
        </div>
        <div class="my-9">
            @livewire('transaction.overview')
        </div>
        @livewire('transaction.trans-list')
    </div>
</x-app-layout>