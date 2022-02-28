<div>
    <div class="w-full px-10 py-6 bg-gray-100 rounded">
        <span class="text-2xl font-bold">{{ __('Profile Setting') }}</span>
    </div>
    <div class="px-2 py-10 sm:px-10">
        @if (Laravel\Fortify\Features::canUpdateProfileInformation())
            {{-- @livewire('profile.update-profile-information-form') --}}
            <x-jet-label for="bane" value="{{ __('Name') }}" />
            <x-jet-input placeholder="Name" class="w-full max-w-2xl px-4 mt-2" wire:model.defer="name"/>
            <x-jet-label for="bane" value="{{ __('Mobile') }}" class="mt-6"/>
            <x-jet-input class="w-full max-w-2xl px-4 mt-2" placeholder="Enter mobile number here" wire:model.defer="phone" />
            <div class="flex items-center mt-10 space-x-4">
                <x-jet-button class="mt-2 mr-2" type="button" wire:click="update_userprofile" wire:loading.attr="disabled">
                    {{ __('Save') }}
                </x-jet-button>
                <div wire:loading class="text-gray-400">{{ __('Saving...') }}</div>
            </div>
        @endif
    </div>
</div>
