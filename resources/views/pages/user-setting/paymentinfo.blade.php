@php(\App\Services\NavigationService::instance()->overwriteSubnavi([
    ["label" => "profile", "icon" => "tabler-user", "route" => "customer.account"],
    ["label" => "Setting", "icon" => "uni-setting-o", "route" => "customer.user-setting"],
], [
    ["label" => "Invite a Friend", "icon" => "go-person-add-16", "route" => "customer.invite", "color" => "text-white bg-primary"],
]))
<x-app-layout>
    <x-container class="p-8 bg-white border rounded-sm my-7">
        <x-customers.customer-header-bar icon="payment" name="Payment Information">
            <x-button variant="primary" class="justify-between w-full">
                <x-icon name="new-wallet" class="w-5 h-5 mr-3"/>
                <span class="mr-2">{{ __('Add new account') }}</span>
            </x-button>
        </x-customers.customer-header-bar>
        <div class="mt-6">
            <div class="flex items-center space-x-4">
                <div>
                    <x-icon name="security" class="w-6 h-8"/>
                </div>
                <div>
                    <p class="text-lg font-semibold">{{ __('Card is secure') }}</p>
                    <p class="text-gray-400">{{ __('Your data is protected, everything will be private') }}</p>
                </div>
            </div>

            <div class="px-5 mt-14">
                @livewire('user-setting.payment-info')
            </div>
        </div>
    </x-container>
</x-app-layout>