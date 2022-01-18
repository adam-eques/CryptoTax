<div class="grid grid-cols-1 md:grid-cols-6 gap-0 md:gap-6" x-data="{ category: 1}">
    <div class="col-span-1 py-8 space-y-5">
        @foreach ($buttons as $button)            
            <button 
                variant="white" class="w-full flex items-center justify-between bg-gray-100 hover:bg-primary hover:text-white rounded-lg py-4 px-5" 
                x-on:click="category = `{{ $button['id'] }}`"
                x-bind:class="category == `{{ $button['id'] }}` ? 'bg-primary text-white' : ''"
                wire:click="get_selected_item({{ $button['id'] }})"
            >
                <div class="inline-flex items-center">
                    <x-icon name="{{ $button['icon'] }}" class="w-8 h-8 mr-3"/>
                    <span class="text-xl font-bold tracking-tight">{{ __( $button['name']) }}</span>
                </div>
                <x-icon name="arrow-right" class="w-5" x-show="category == `{{ $button['id'] }}`"/>
            </button>
        @endforeach
    </div>
    <div class="col-span-5 border rounded-md p-7">
        @if ($selected == 1)            
            @livewire('account-new.add-new-crypto-exchange')
        @endif
        @if ($selected == 2)
            @livewire('account-new.add-new-wallet')            
        @endif
        @if ($selected == 3)
            @livewire('account-new.add-new-blockchain')
        @endif
        @if ($selected == 4)
            @livewire('account-new.add-others')
        @endif
    </div>
</div>


