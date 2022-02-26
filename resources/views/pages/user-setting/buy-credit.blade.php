<x-app-layout>
    <x-container class="p-8 bg-white border rounded-sm my-7">
        <x-customers.customer-header-bar icon="credit-card" name="Buy Credits">
        </x-customers.customer-header-bar>
        <div class="mt-14">
            <div class="grid grid-cols-1 gap-10 lg:grid-cols-2">
                <div class="max-w-xl">
                    <p class="font-semibold">{{ __('Three Steps to add your credits to your account') }}</p>
                    <div class="relative mt-10">
                        <div class="absolute h-full py-4 border-r-2 border-dashed left-9">
                        </div>
                        <div class="relative space-y-12">
                            <div class="flex items-center gap-4 bg-white">
                                <div class="flex items-center justify-center bg-gray-100 w-18 h-18">
                                    <x-icon name="select-dropdown" class="w-12 h-12"/>
                                </div>
                                <div class="w-10/12 ">
                                    <h6 class="text-lg font-bold">{{ __('Step - 1') }}</h6>
                                    <p class="mt-2 text-gray-400">{{ __("Select your credit in dropdown Lorem Ipsum has been the industry's standard") }}</p>
                                </div>
                            </div>
                            <div class="flex items-center gap-4 bg-white">
                                <div class="flex items-center justify-center bg-gray-100 w-18 h-18">
                                    <x-icon name="credit-card-1" class="w-12 h-12"/>
                                </div>
                                <div class="w-10/12 ">
                                    <h6 class="text-lg font-bold">{{ __('Step - 2') }}</h6>
                                    <p class="mt-2 text-gray-400">{{ __("Add your Card details Lorem Ipsum has been the industry's standard") }}</p>
                                </div>
                            </div>
                            <div class="flex items-center gap-4 bg-white">
                                <div class="flex items-center justify-center bg-gray-100 w-18 h-18">
                                    <x-icon name="submit-success" class="w-12 h-12"/>
                                </div>
                                <div class="w-10/12 ">
                                    <h6 class="text-lg font-bold">{{ __('Step - 3') }}</h6>
                                    <p class="mt-2 text-gray-400">{{ __("Submit your Details Lorem Ipsum has been the industry's standard") }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="max-w-xl">
                    <div class="flex items-center space-x-4 border rounded-sm p-7">
                        <x-icon name="wallet-1" class="w-12 h-12"/>
                        <div>
                            <p class="text-gray-400">{{ __('You have Currently') }}</p>
                            <h3 class="text-2xl font-bold">{{ __('8654.0 Credits') }}</h3>
                        </div>
                    </div>
                    <p class="py-8 text-lg font-semibold">{{ __('Buy Additional Credits') }}</p>
                    <x-jet-label>{{ __('Number of Credits') }}</x-jet-label>
                    <select class="w-full p-4 mt-2 border border-gray-200 rounded-sm focus:border-gray-200 focus:outline-none focus:ring-0">
                        <option>{{ __('100 Credits for 100 $') }}</option>
                        <option>{{ __('200 Credits for 200 $') }}</option>
                        <option>{{ __('300 Credits for 300 $') }}</option>
                    </select>
                    <x-jet-label class="my-7">{{ __('Your Card Details') }}</x-jet-label>
                    <div class="flex flex-wrap items-center gap-4">
                        <img src="{{ asset('assets/img/cards/red_card.svg') }}" class="w-24 h-auto"/>
                        <img src="{{ asset('assets/img/cards/red_card.svg') }}" class="w-24 h-auto"/>
                        <img src="{{ asset('assets/img/cards/red_card.svg') }}" class="w-24 h-auto"/>
                    </div>
                    <x-jet-label class="mb-3 mt-7">{{ __('Name on Card') }}</x-jet-label>
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
                    <x-button class="mt-10">{{ __('Buy Now') }}</x-button>
                </div>
            </div>
        </div>
    </x-container>
</x-app-layout>