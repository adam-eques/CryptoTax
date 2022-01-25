<div>
    <div class="bg-gray-100 w-full px-10 py-6 rounded">
        <span class="text-xl font-extrabold">{{ __('Profile Setting') }}</span>
    </div>
    <div class="px-10 py-10">
        <div class=" max-w-lg mt-6">
            <x-jet-label>{{ __('First Name') }}</x-jet-label>
            <x-jet-input type="text" class="w-full mt-5"></x-jet-input>
        </div>
        <div class=" max-w-lg mt-6">
            <x-jet-label>{{ __('Last Name') }}</x-jet-label>
            <x-jet-input type="text" class="w-full mt-5"></x-jet-input>
        </div>
        <div class=" max-w-lg mt-6">
            <x-jet-label>{{ __('Mobile') }}</x-jet-label>
            <x-jet-input type="text" class="w-full mt-5"></x-jet-input>
        </div>
        <x-jet-button class="mt-12 px-16">{{ __('Save') }}</x-jet-button>
    </div>
</div>
