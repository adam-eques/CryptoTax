@php(\App\Services\NavigationService::instance()->overwriteSubnavi([
    ["label" => "Accounts", "icon" => "fluentui-wallet-32-o", "route" => "customer.account"],
    ["label" => "Transactions", "icon" => "grommet-transaction", "route" => "customer.transactions"],
    ["label" => "Add New Account", "icon" => "bx-add-to-queue", "route" => "customer.account.new"],
], [
    ["label" => "Invite a Friend", "icon" => "go-person-add-16", "route" => "customer.invite", "color" => "text-white bg-primary"],
]))

<x-app-layout title="New Account">
    <div class="px-3 py-5 mx-auto my-5 bg-white rounded-sm shadow xl:max-w-screen-2xl xs:px-4 lg:px-6">

        <x-customers.customer-header-bar icon="bx-add-to-queue" name="Add New Account">
        </x-customers.customer-header-bar>

        <div class="py-6">
            <h5 class="text-xl font-bold">{{ __("Import transactions") }}</h5>
            <div class="grid grid-cols-1 gap-3 xl:grid-cols-7 mt-7">
                <div class="flex items-center col-span-2 space-x-3 md:space-x-6">
                    <div class="relative flex items-center justify-center w-16 h-16 bg-gray-200 rounded-full">
                        <x-icon name="uni-exchange-o" class="w-7 h-7"/>
                        <div class="absolute top-0 right-0 flex items-center justify-center w-5 h-5 rounded-full bg-primary">
                            <p class="text-sm font-bold text-white">1</p>
                        </div>
                    </div>
                    <p class="w-3/4">{{ __('Select your Exchanges from the list.') }}</p>
                </div>
                <div class="flex items-center col-span-5 space-x-3 md:space-x-6">
                    <div class="relative flex items-center justify-center w-16 h-16 bg-gray-200 rounded-full">
                        <x-icon name="fluentui-book-information-24-o" class="w-7 h-7"/>
                        <div class="absolute top-0 right-0 flex items-center justify-center w-5 h-5 rounded-full bg-primary">
                            <p class="text-sm font-bold text-white">2</p>
                        </div>
                    </div>
                    <p class="w-3/4">{{ __("Follow the instructions to upload your data with CSV files or the exchange's API.") }}</p>
                </div>
            </div>
        </div>

        <div class="mt-9">
            @livewire('customer.account.account-new')
        </div>

    </div>
</x-app-layout>
