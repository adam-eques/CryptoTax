<div>
    <div class="bg-gray-100 w-full px-10 py-6 rounded">
        <span class="text-2xl font-bold">{{ __('Change your password') }}</span>
    </div>
    <div class="px-10 py-10">
        @if (Laravel\Fortify\Features::enabled(Laravel\Fortify\Features::updatePasswords()))
            <div class="mt-10 sm:mt-0">
                @livewire('profile.update-password-form')
            </div>
        @endif
    </div>
</div>
