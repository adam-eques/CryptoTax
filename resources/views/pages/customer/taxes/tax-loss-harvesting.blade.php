<x-app-layout>
    <x-page icon="fas-chart-area" :title="__('Tax-Loss Harvesting')" :border="false">
        <div class="flex flex-col pb-8 -mx-2 space-y-10 md:flex-row lg:-mx-5 md:space-y-0">
            <!-- Left Panel -->
            <div class="px-2 lg:px-5 md:w-3/5">
                <img src="{{asset('/examples/tax-loss-harvesting.jpg')}}" alt="Dummy" class="w-full">
            </div>

            <!-- Right Panel -->
            <div class="px-4 pt-4 lg:px-5 md:w-2/5">
                <h2 class="mb-4 text-xl font-bold">Save up to <span class="text-primary">2536.00USD</span> in taxes</h2>
                <p class="mb-2 font-bold">Get a Pro portfolio subscription to unlock <span class="text-primary">tax-loss harvesting</span>.</p>
                <ul class="my-6">
                    <li>
                        <x-icon name="fas-check-circle" class="absolute inline w-4 mt-1 text-primary" />
                        <p class="mb-4 ml-6">Optimize your 2021 taxes by claming lossess</p>
                    </li>
                    <li>
                        <x-icon name="fas-check-circle" class="absolute inline w-4 mt-1 text-primary" />
                        <p class="mb-4 ml-6">Offset non-crypto capital gains</p>
                    </li>
                    <li>
                        <x-icon name="fas-check-circle" class="absolute inline w-4 mt-1 text-primary" />
                        <p class="mb-4 ml-6">Rollover capital lossess to future years</p>
                    </li>
                    <li>
                        <x-icon name="fas-check-circle" class="absolute inline w-4 mt-1 text-primary" />
                        <p class="mb-4 ml-6">Maximize performance & build wealth</p>
                    </li>
                </ul>

                <x-jet-button class="px-6">{{ __("UPGRADE NOW") }}</x-jet-button>
            </div>
        </div>
    </x-page>
</x-app-layout>
