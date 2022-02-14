<div>
    <div class="flex items-center justify-center">
        <x-container class="flex sm:w-10/12 mt-20 -mb-20 items-center justify-center">
            <div class="w-full bg-white rounded-lg shadow-md relative">
                <img src="{{ asset('assets/img/subpage_images/get_started_bg_pattern.svg') }}" class="w-full h-full absolute top-0"/>
                <div class="py-10 lg:px-28 px-10 flex sm:flex-row flex-col items-center sm:justify-between justify-center relative">
                    <div>
                        <x-jet-button variant="secondary" class="font-semibold">{{ __('Join myCrypto.tax') }}</x-jet-button>
                        <h1 role="heading" class="text-2xl md:text-3xl xl:text-4xl mt-3 font-bold">{{ __("Act before it's too late") }}</h1>
                        <p role="contentinfo" class="text-base mt-3 text-gray-800">{{ __('Sign up and instantly generate your tax report') }}</p>
                    </div>
                    <x-button class="font-semibold px-5 py-6">
                        {{ __('Get started now') }}
                        <x-icon name='rocket' class="ml-3 w-6 h-6"/>
                    </x-button>
                </div>
            </div>
        </x-container> 
    </div>
    <div class="bg-primary w-full h-full flex py-10">
    </div>
</div>