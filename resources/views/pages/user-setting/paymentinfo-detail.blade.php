@php(\App\Services\NavigationService::instance()->overwriteSubnavi([
    ["label" => "profile", "icon" => "tabler-user", "route" => "customer.account"],
    ["label" => "Setting", "icon" => "uni-setting-o", "route" => "customer.user-setting"],
], [
    ["label" => "Invite a Friend", "icon" => "go-person-add-16", "route" => "customer.invite", "color" => "text-white bg-primary"],
]))
<x-app-layout>
    <x-container class="p-8 my-5 bg-white border rounded-sm">
        <x-customers.customer-header-bar icon="fluentui-payment-16-o" name="Payment Information">
            <x-button variant="primary" class="justify-between w-full">
                <x-icon name="bx-add-to-queue" class="w-5 h-5 mr-3"/>
                <span class="mr-2">{{ __('Add new account') }}</span>
            </x-button>
        </x-customers.customer-header-bar>
        <div class="mt-6">
            <div class="flex items-center space-x-4">
                <div>
                    <x-icon name="ri-secure-payment-line" class="w-8 h-10"/>
                </div>
                <div>
                    <p class="text-lg font-semibold">{{ __('Card is secure') }}</p>
                    <p class="text-gray-400">{{ __('Your data is protected, everything will be private') }}</p>
                </div>
            </div>
            <div class="grid grid-cols-1 gap-10 mt-12 md:grid-cols-2">
                <div class="max-w-xl">
                    <p class="text-lg font-semibold">{{ __('Credit Card') }}</p>
                    <img src="{{ asset('assets/img/cards/red_card.svg') }}" class="w-full h-auto mt-8"/>
                </div>
                <div class="max-w-xl">
                    <p class="text-lg font-semibold">{{ __('Credit Card') }}</p>
                    <div>
                        <x-jet-label class="mt-12 mb-3">{{ __('Name on Card') }}</x-jet-label>
                        <input type="text" placeholder="John Doe" class="w-full p-4 border border-gray-200 rounded-sm focus:border-gray-200 focus:outline-none focus:ring-0"/>
                        <x-jet-label class="mb-3 mt-7">{{ __('Card Number') }}</x-jet-label>
                        <input type="text" placeholder="4242 4242 4242 4242" class="w-full p-4 border border-gray-200 rounded-sm focus:border-gray-200 focus:outline-none focus:ring-0"/>
                        <div class="inline-flex flex-wrap items-center w-full gap-4 mt-7">
                            <div>
                                <x-jet-label class="mb-3">{{ __('CC') }}</x-jet-label>
                                <input type="text" placeholder="543" class="p-4 border border-gray-200 rounded-sm w-30 focus:border-gray-200 focus:outline-none focus:ring-0"/>
                            </div>
                            <div>
                                <x-jet-label class="mb-3">{{ __('Expiry Date') }}</x-jet-label>
                                <input type="text" placeholder="12 / 22  123" class="p-4 border border-gray-200 rounded-sm w-50 focus:border-gray-200 focus:outline-none focus:ring-0"/>
                            </div>
                        </div>
                        <x-button class="mt-10">{{ __('Save Card') }}</x-button>
                    </div>
                </div>
            </div>
        </div>
    </x-contanier>
</x-app-layout>