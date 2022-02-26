<div>
    <div class="w-full px-10 py-6 bg-gray-100 rounded">
        <span class="text-2xl font-bold">{{ __('Email address') }}</span>
    </div>
    <div class="px-10 py-10">
        @if (Laravel\Fortify\Features::canUpdateProfileInformation())
            @livewire('profile.update-profile-information-form')
        @endif
    </div>
</div>