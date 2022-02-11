<div class="bg-primary">
    <x-landing-nav for="customer" logo="white" class="relative"/>
    <x-container class="mt-10 py-10 relative">
        <img src="{{asset('assets/img/subpage_images/transparent_logo.svg')}}" class="absolute right-0 -top-2"/>
        <div class="flex items-center space-x-8">
            <x-icon name="{{ $icon }}" class="w-12 text-white"/>
            <div>
                <p class="text-white">{{ __($subtitle) }}</p>
                <h4 class="text-white text-2xl font-semibold">{{ __($title) }}</h4>
            </div>
        </div>
    </x-container>
</div>