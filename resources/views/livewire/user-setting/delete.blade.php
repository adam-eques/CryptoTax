<div>
    <div class="bg-gray-100 w-full px-10 py-6 rounded">
        <span class="text-2xl font-bold">{{ __('Delete Account') }}</span>
        <span class="text-gray-400">{{ __("Permanently delete your account. ") }}</span>
    </div>
    <div class="px-10 py-10">
        @if (Laravel\Jetstream\Jetstream::hasAccountDeletionFeatures())
            <div class="mt-10 sm:mt-0">
                @livewire('profile.delete-user-form')
            </div>
        @endif
    </div>
</div>
