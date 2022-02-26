<x-app-layout>
    <x-container class="my-7 bg-white p-8 border rounded-sm">
        <x-customers.customer-header-bar icon="payment" name="Payment Information">
            <x-button variant="primary" class="w-full justify-between">
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
            <div class="mt-12 grid grid-cols-1 md:grid-cols-2 gap-10">
                <div class="max-w-xl">
                    <p class="text-lg font-semibold">{{ __('Credit Card') }}</p>
                    <img src="{{ asset('assets/img/cards/red_card.svg') }}" class="w-full h-auto mt-8"/>
                </div>
                <div class="max-w-xl">
                    <p class="text-lg font-semibold">{{ __('Credit Card') }}</p>
                    <div>
                        <x-jet-label class="mt-12 mb-3">{{ __('Name on Card') }}</x-jet-label>
                        <input type="text" placeholder="John Doe" class="w-full p-4 border border-gray-200 focus:border-gray-200 focus:outline-none focus:ring-0 rounded-sm"/>
                        <x-jet-label class="mt-7 mb-3">{{ __('Card Number') }}</x-jet-label>
                        <input type="text" placeholder="4242 4242 4242 4242" class="w-full p-4 border border-gray-200 focus:border-gray-200 focus:outline-none focus:ring-0 rounded-sm"/>
                        <div class="inline-flex items-center flex-wrap gap-4 mt-7 w-full">
                            <div>
                                <x-jet-label class="mb-3">{{ __('CC') }}</x-jet-label>
                                <input type="text" placeholder="543" class="w-30 p-4 border border-gray-200 focus:border-gray-200 focus:outline-none focus:ring-0 rounded-sm"/>
                            </div>
                            <div>
                                <x-jet-label class="mb-3">{{ __('Expiry Date') }}</x-jet-label>
                                <input type="text" placeholder="12 / 22  123" class="w-50 p-4 border border-gray-200 focus:border-gray-200 focus:outline-none focus:ring-0 rounded-sm"/>
                            </div>
                        </div>
                        <x-button class="mt-10">{{ __('Save Card') }}</x-button>
                    </div>
                </div>
            </div>
        </div>
    </x-contanier>
</x-app-layout>