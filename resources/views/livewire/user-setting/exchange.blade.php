<div>
    <div class="w-full px-10 py-6 bg-gray-100 rounded">
        <span class="text-2xl font-bold">{{ __('Request Exchange') }}</span>
    </div>
    <div class="px-5 py-5 md:px-10 md:py-10">
        <div>
            <x-jet-label>{{ __('Exchange Type') }}</x-jet-label>
            <select class="w-full py-4 mt-4 border border-gray-300 rounded-sm" id="type" wire:model="type">
                <option value="1" selected>{{ __('CSV') }}</option>
                <option value="2">{{ __('API') }}</option>
                <option value="3">{{ __('Blockchain') }}</option>
            </select>
        </div>
        <div class="mt-7">
            @switch($type)
                @case(1)
                    @livewire('user-setting.exchange-csv')
                    @break
                @case(2)
                    @livewire('user-setting.exchange-api')
                    @break
                @case(3)
                    @livewire('user-setting.exchange-blockchain')
                    @break
                @default

            @endswitch
        </div>
    </div>
</div>
