<x-app-layout>
    <x-container class="my-7 bg-white p-8 border rounded-sm">
        <x-customers.customer-header-bar icon="bell" name="Notification">
        </x-customers.customer-header-bar>
        <div class="mt-6 space-y-3">
            <x-notification-item type="success" title="Successfully 2000 Credited" content="you can amend your PIN at any time by using an iTAN under Administration."/>
            <x-notification-item type="warning" title="Warning" content="you can amend your PIN at any time by using an iTAN under Administration That's Password is not correct"/>
            <x-notification-item type="inform" title="Infomation" content="you can amend your PIN at any time by using an iTAN under Administration That's Password is not correct"/>
            <x-notification-item type="error" title="Error Make a strong Password" content="you can amend your PIN at any time by using an iTAN under Administration."/>
        </div>
    </x-container>
</x-app-layout>