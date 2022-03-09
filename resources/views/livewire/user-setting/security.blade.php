<div>
    <div class="w-full px-10 py-6 bg-gray-100 rounded">
        <span class="text-2xl font-bold">{{ __('Two-Factor Authentication') }}</span>
    </div>
    <div class="px-5 py-5 divide-y md:px-10 md:py-10">
        <div class="items-center justify-between block py-10 md:flex">
            <div>
                <div class="flex items-center space-x-4">
                    <p class="text-xl">{{ __('Email') }}</p>
                    <button class="px-3 py-1 bg-gray-200 rounded">{{  __('Moderately Secure') }}</button>
                </div>
                <p class="mt-2 text-gray-400">{{ __('Email address: johndoe7501@gmail.com Manage email address') }}</p>
            </div>
            <div>
                <x-button>{{ __('Setup') }}</x-button>
            </div>
        </div>
        <div class="items-center justify-between block py-10 md:flex">
            <div>
                <div class="flex items-center space-x-4">
                    <p class="text-xl">{{ __('Text Message') }}</p>
                    <button class="px-3 py-1 bg-gray-200 rounded">{{  __('Moderately Secure') }}</button>
                </div>
                <p class="mt-2 text-gray-400">{{ __('Add a mobile phone number for authentication.') }}</p>
            </div>
            <div>
                <x-button>{{ __('Setup') }}</x-button>
            </div>
        </div>
        <div class="items-center justify-between block py-10 md:flex">
            <div>
                <div class="flex items-center space-x-4">
                    <p class="text-xl">{{ __('Authenticator Apps') }}</p>
                    <button class="px-3 py-1 bg-gray-200 rounded">{{  __('Moderately Secure') }}</button>
                </div>
                <p class="mt-2 text-gray-400">{{ __('Install an authenticator app on your phone like Google Authenticator.') }}</p>
            </div>
            <div>
                <x-button>{{ __('Setup') }}</x-button>
            </div>
        </div>
    </div>
</div>