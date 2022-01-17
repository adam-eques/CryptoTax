<div x-data="{item:''}">
    <div class="flex items-center border rounded-lg px-4 py-2">
        <x-icon name="fas-search" class="w-4"/>
        <input 
            type="text" 
            class="border-0 ring-0 outline-none rounded-lg w-full focus:ring-0" 
            placeholder="Search for an exchange" 
            wire:model="search" 
        >
    </div>
    <div class="grid grid-cols-1 md:grid-cols-2 gap-0 md:gap-10 mt-8">
        {{-- Left panel --}}
        <div class="overflow-auto h-full border rounded-md">
            <div class="h-110">
                @foreach($cryptoExchangeAccounts as $row)
                    @if (!count($row->credentials))                                
                        <div 
                            class="grid grid-cols-5 items-center py-5 px-6 border-b cursor-pointer hover:bg-gray-100"
                            x-on:click="item = `{{ $row->getName() }}`"
                            x-bind:class = "item == `{{ $row->getName() }}`? 'bg-gray-100' : '' "
                            wire:click = "edit_exchange({{ $row->id }})"
                        >
                            <x-icon name="{{ $row->getName() }}" class="w-auto h-8 col-span-2"></x-icon>
                            <p class="col-span-2">{{ __($row->getName()) }}</p>
                            <div class="w-full flex justify-end">
                                <x-icon name="arrow-right" class="w-5 col-span-1" x-show="item == `{{ $row->getName() }}`"/>
                            </div>
                        </div>
                    @endif
                @endforeach

                @if ($exchanges->count())
                    @foreach ($exchanges as $exchange)
                        <div 
                            class="grid grid-cols-5 items-center py-5 px-6 border-b cursor-pointer hover:bg-gray-100"
                            x-on:click="item = `{{ $exchange->getName() }}`"
                            x-bind:class = "item == `{{ $exchange->getName() }}`? 'bg-gray-100' : '' "
                            wire:click = "get_new_account_id({{ $exchange->id }})"
                        >
                            <x-icon name="{{ $exchange->getName() }}" class="w-auto h-8 col-span-2"></x-icon>
                            <p class="col-span-2">{{ __($exchange->getName()) }}</p>
                            <div class="w-full flex justify-end">
                                <x-icon name="arrow-right" class="w-5 col-span-1" x-show="item == `{{ $exchange->getName() }}`"/>
                            </div>
                        </div>
                    @endforeach
                @endif
            </div>
        </div>
    
        {{-- Right panel --}}
        <div class="border border-dashed rounded-md">
            <div class="h-full w-full p-5">
                @if ($account)
                    <form wire:submit.prevent="save_exchange">
                        <div class="p-4">
                            {{ $this->form }}
                            <div class="text-center mt-4">
                                <x-button type="submit">{{ __("Save") }}</x-button>
                            </div>
                        </div>
                    </form>
                @endif
                @if (!$account)
                    <div class="text-center w-full h-full flex justify-center items-center">
                        <div>
                            <div class="bg-primary flex justify-center items-center rounded-full mx-auto w-30 h-30">
                                <x-icon name="book-info" class="w-16 h-16 text-white"/>
                            </div>
                            <p class="text-xl font-bold mt-3">{{ __('Instructions for API or CSV') }}</p>
                            <p>{{ __('Please select an Exchange to see import instructions.') }}</p>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>    
</div>