<div>
    <div class="bg-gray-100 w-full px-10 py-6 rounded">
        <span class="text-2xl font-bold">{{ __('Profile Setting') }}</span>
    </div>
    <div class="px-2 sm:px-10 py-10">
        @if (Laravel\Fortify\Features::canUpdateProfileInformation())
            @livewire('profile.update-profile-information-form')
        @endif
    </div>
</div>
