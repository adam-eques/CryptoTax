<x-container class="bg-white border my-5">
    <div class="px-5 py-10 w-full">
        <div class="flex items-center justify-between flex-wrap">
            <div class="flex items-center space-x-8">
                <img src="{{ asset("assets/img/svg/avatar.svg") }}" class="rounded-lg w-18 h-18 object-cover"/>
                <div>
                    <h3 class="text-xl font-bold">{{ __('Gary R. Anderson') }}</h3>
                    <h4 class="text-base text-gray-400 mt-2">{{ __('Financial Advisor') }}</h4>
                </div>
            </div>
            <div class="flex items-start space-x-2">
                <h3 class="text-xl font-bold">{{ __('4.9/5.0') }}</h3>
                <div>
                    <div class="flex items-center space-x-1">
                        <x-icon name="star-golden" class="w-4"/>
                        <x-icon name="star-golden" class="w-4"/>
                        <x-icon name="star-golden" class="w-4"/>
                        <x-icon name="star-golden" class="w-4"/>
                        <x-icon name="star-golden" class="w-4"/>
                    </div>
                    <p class="text-sm text-gray-400">{{ __('150 Reviews') }}</p>
                </div>
                <div class="border p-3 rounded-md"><x-icon name="heart-blank" class="w-6 bg-white"/></div>
                <x-button class="font-semibold">{{ __("Contact Now") }}</x-button>
            </div>
        </div>
    </div>
</x-container>
