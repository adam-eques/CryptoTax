<x-app-layout>
    <x-container class="my-7 bg-white p-8 border rounded-sm">
        <x-customers.customer-header-bar icon="credit-card" name="Buy Credits">
        </x-customers.customer-header-bar>
        <div class="mt-14">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-10">
                <div class="max-w-xl">
                    <p class="font-semibold">{{ __('Three Steps to add your credits to your account') }}</p>
                    <div class="mt-10 relative">
                        <div class="absolute h-full border-r-2 border-dashed left-9 py-4">
                        </div>
                        <div class="relative space-y-12">
                            <div class="flex items-center gap-4 bg-white">
                                <div class="w-18 h-18 bg-gray-100 flex items-center justify-center">
                                    <x-icon name="select-dropdown" class="w-12 h-12"/>
                                </div>
                                <div class=" w-10/12">
                                    <h6 class="font-bold text-lg">{{ __('Step - 1') }}</h6>
                                    <p class="text-gray-400 mt-2">{{ __("Select your credit in dropdown Lorem Ipsum has been the industry's standard") }}</p>
                                </div>
                            </div>
                            <div class="flex items-center gap-4 bg-white">
                                <div class="w-18 h-18 bg-gray-100 flex items-center justify-center">
                                    <x-icon name="credit-card-1" class="w-12 h-12"/>
                                </div>
                                <div class=" w-10/12">
                                    <h6 class="font-bold text-lg">{{ __('Step - 2') }}</h6>
                                    <p class="text-gray-400 mt-2">{{ __("Add your Card details Lorem Ipsum has been the industry's standard") }}</p>
                                </div>
                            </div>
                            <div class="flex items-center gap-4 bg-white">
                                <div class="w-18 h-18 bg-gray-100 flex items-center justify-center">
                                    <x-icon name="submit-success" class="w-12 h-12"/>
                                </div>
                                <div class=" w-10/12">
                                    <h6 class="font-bold text-lg">{{ __('Step - 3') }}</h6>
                                    <p class="text-gray-400 mt-2">{{ __("Submit your Details Lorem Ipsum has been the industry's standard") }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="max-w-xl">
                    <div class="border rounded-sm p-7 flex items-center space-x-4">
                        <x-icon name="wallet-1" class="w-12 h-12"/>
                        <div>
                            <p class="text-gray-400">{{ __('You have Currently') }}</p>
                            <h3 class="text-2xl font-bold">{{ __('8654.0 Credits') }}</h3>
                        </div>
                    </div>
                    <p class="text-lg font-semibold py-8">{{ __('Buy Additional Credits') }}</p>
                    <x-jet-label>{{ __('Number of Credits') }}</x-jet-label>
                    <select class="mt-2 w-full p-4 border border-gray-200 focus:border-gray-200 focus:outline-none focus:ring-0 rounded-sm">
                        <option>{{ __('100 Credits for 100 $') }}</option>
                        <option>{{ __('200 Credits for 200 $') }}</option>
                        <option>{{ __('300 Credits for 300 $') }}</option>
                    </select>
                    <x-jet-label class="my-7">{{ __('Your Card Details') }}</x-jet-label>
                    <div class="flex items-center gap-4 flex-wrap">
                        <img src="{{ asset('assets/img/cards/red_card.svg') }}" class="w-24 h-auto"/>
                        <img src="{{ asset('assets/img/cards/red_card.svg') }}" class="w-24 h-auto"/>
                        <img src="{{ asset('assets/img/cards/red_card.svg') }}" class="w-24 h-auto"/>
                    </div>
                    <x-jet-label class="mt-7 mb-3">{{ __('Name on Card') }}</x-jet-label>
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
                    <x-button class="mt-10">{{ __('Buy Now') }}</x-button>
                </div>
            </div>
        </div>
    </x-container>
</x-app-layout>