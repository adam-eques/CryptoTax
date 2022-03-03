@php(\App\Services\NavigationService::instance()->overwriteSubnavi([
    ["label" => "Accounts", "icon" => "fluentui-wallet-32-o", "route" => "customer.account"],
    ["label" => "Transactions", "icon" => "grommet-transaction", "route" => "customer.transactions"],
    ["label" => "Add New Account", "icon" => "bx-add-to-queue", "route" => "customer.account.new"],
], [
    ["label" => "Invite a Friend", "icon" => "go-person-add-16", "route" => "customer.invite", "color" => "text-white bg-primary"],
]))

<x-app-layout>
    <div class="px-3 py-5 mx-auto my-5 bg-white rounded-sm shadow xs:px-4 xl:max-w-screen-2xl lg:px-5">
        @livewire('customer.transaction.overview')
        @livewire('customer.transaction.transaction-list')
    </div>
</x-app-layout>
