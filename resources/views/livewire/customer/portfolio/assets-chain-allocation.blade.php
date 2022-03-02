<div>
    <h4 class="text-2xl font-bold">{{ __('Chain Allocation') }}</h4>
    <div class="grid grid-cols-1 gap-x-12 gap-y-10 mt-14 md:grid-cols-2 md:gap-x-24">
        <div class="flex items-center space-x-6">
            <div class="w-1/12">
                <x-icon name="coins.btc" class="w-10 h-10"/>
            </div>
            <p class="text-lg font-semibold">{{ __('Bitcoin') }}</p>
            <x-progressbar :progress="50" variant="success"/>
            <p class="font-semibold">{{ __('84.5%') }}</p>
        </div>
        <div class="flex items-center space-x-6">
            <div class="w-1/12">
                <x-icon name="coins.btc" class="w-10 h-10"/>
            </div>
            <p class="text-lg font-semibold">{{ __('Bitcoin') }}</p>
            <x-progressbar :progress="50" variant="danger"/>
            <p class="font-semibold">{{ __('84.5%') }}</p>
        </div>
        <div class="flex items-center space-x-6">
            <div class="w-1/12">
                <x-icon name="coins.btc" class="w-10 h-10"/>
            </div>
            <p class="text-lg font-semibold">{{ __('Bitcoin') }}</p>
            <x-progressbar :progress="50" variant="third"/>
            <p class="font-semibold">{{ __('84.5%') }}</p>
        </div>
        <div class="flex items-center space-x-6">
            <div class="w-1/12">
                <x-icon name="coins.btc" class="w-10 h-10"/>
            </div>
            <p class="text-lg font-semibold">{{ __('Bitcoin') }}</p>
            <x-progressbar :progress="50" variant="primary"/>
            <p class="font-semibold">{{ __('84.5%') }}</p>
        </div>
        <div class="flex items-center space-x-6">
            <div class="w-1/12">
                <x-icon name="coins.btc" class="w-10 h-10"/>
            </div>
            <p class="text-lg font-semibold">{{ __('Bitcoin') }}</p>
            <x-progressbar :progress="50" variant="warning"/>
            <p class="font-semibold">{{ __('84.5%') }}</p>
        </div>
        <div class="flex items-center space-x-6">
            <div class="w-1/12">
                <x-icon name="coins.btc" class="w-10 h-10"/>
            </div>
            <p class="text-lg font-semibold">{{ __('Bitcoin') }}</p>
            <x-progressbar :progress="50" variant="secondary"/>
            <p class="font-semibold">{{ __('84.5%') }}</p>
        </div>
    </div>
</div>
