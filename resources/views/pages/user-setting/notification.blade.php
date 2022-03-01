@php(\App\Services\NavigationService::instance()->overwriteSubnavi([
    ["label" => "profile", "icon" => "tabler-user", "route" => "customer.account"],
    ["label" => "Setting", "icon" => "uni-setting-o", "route" => "customer.transactions"],
], [
    ["label" => "Invite a Friend", "icon" => "go-person-add-16", "route" => "customer.invite", "color" => "text-white bg-primary"],
]))
<x-app-layout>
    <x-container class="p-8 bg-white border rounded-sm my-7">
        <x-customers.customer-header-bar icon="iconoir-bell-notification" name="Notification">
        </x-customers.customer-header-bar>
        <div class="mt-6 space-y-3">
            <x-notification-item type="success" title="Successfully 2000 Credited" content="you can amend your PIN at any time by using an iTAN under Administration."/>
            <x-notification-item type="warning" title="Warning" content="you can amend your PIN at any time by using an iTAN under Administration That's Password is not correct"/>
            <x-notification-item type="inform" title="Infomation" content="you can amend your PIN at any time by using an iTAN under Administration That's Password is not correct"/>
            <x-notification-item type="error" title="Error Make a strong Password" content="you can amend your PIN at any time by using an iTAN under Administration."/>
        </div>
    </x-container>
</x-app-layout>