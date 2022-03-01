<div>
    <div class="flex items-center justify-center">
        <x-container class="flex items-center justify-center mt-20 -mb-20 sm:w-10/12">
            <div class="relative w-full bg-white rounded-lg shadow-md">
                <img src="{{ asset('assets/img/subpage_images/get_started_bg_pattern.svg') }}" class="absolute top-0 w-full h-full"/>
                <div class="relative flex flex-col items-center justify-center px-10 py-10 lg:px-28 sm:flex-row sm:justify-between">
                    <div>
                        <x-jet-button variant="secondary" class="font-semibold">{{ __('Join myCrypto.tax') }}</x-jet-button>
                        <h1 role="heading" class="mt-3 text-2xl font-bold md:text-3xl xl:text-4xl">{{ __("Act before it's too late") }}</h1>
                        <p role="contentinfo" class="mt-3 text-base text-gray-800">{{ __('Sign up and instantly generate your tax report') }}</p>
                    </div>
                    <x-button class="px-5 py-4 font-semibold">
                        {{ __('Get started now') }}
                        <x-icon name='fluentui-rocket-20-o' class="w-10 h-10 ml-3"/>
                    </x-button>
                </div>
            </div>
        </x-container> 
    </div>
    <div class="flex w-full h-full py-10 bg-primary">
    </div>
</div>