<div class="grid grid-cols-1 md:grid-cols-6 gap-0 md:gap-6" x-data="{category:''}">
    <div class="col-span-1 py-8 space-y-5">
        @foreach ($buttons as $button)
            <button 
                class="w-full flex items-center justify-between hover:bg-primary hover:text-white border-1 rounded-lg py-4 px-5" 
                wire:click="get_selected_item({{ $button['id'] }})"
                x-on:click="category = {{$button['id']}}"
                x-bind:class="category == {{$button['id']}}?'bg-primary text-white':'bg-gray-100'"
            >
                <div class="inline-flex items-center">
                    <x-icon name="{{ $button['icon'] }}" class="w-8 h-8 mr-2"/>
                    <span class="text-xl font-bold tracking-tight">{{ __( $button['name']) }}</span>
                </div>
                <x-icon name="arrow-right" class="w-5 text-white" x-show="category == {{$button['id']}}"/>
            </button>
        @endforeach
    </div>
    <div class="col-span-5 border rounded-md p-7">
        <div>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-0 md:gap-10">
                <div class="flex items-center border rounded-lg px-4 py-2">
                    <x-icon name="fas-search" class="w-4"/>
                    <input 
                        type="text" 
                        class="border-0 ring-0 outline-none rounded-lg w-full focus:ring-0" 
                        placeholder="Search for an exchange" 
                        wire:model="search" 
                    >
                </div>
                <div class="flex items-center space-x-3 justify-end">
                    <p>{{ __('A service is missing?') }}</p>
                    <x-button>{{ _('Make a request') }}</x-button>
                </div>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-0 md:gap-10 mt-8">
                {{-- Left panel --}}
                <div class="overflow-auto h-full border rounded-md">
                    <div class="h-110">
                        @if (!$selected)                            
                            @foreach ($exchanges_array as $exchange_account)
                                <div 
                                    class="grid grid-cols-7 items-center py-5 px-6 border-b cursor-pointer hover:bg-gray-100"
                                    {{-- wire:click = "get_new_blockchain_id({{ $exchange_account['id'] }})" --}}
                                >
                                    <x-icon name="{{ $exchange_account['name'] }}" class="w-auto h-8 col-span-2"></x-icon>
                                    <p class="col-span-2">{{ __($exchange_account['name']) }}</p>
                                    <div class="inline-flex items-center px-3 py-1 bg-primary rounded-md text-white col-span-2">
                                        <x-icon name="exchange-1" class="w-8 h-8 mr-2 text"/>
                                        <span class="text-md font-bold tracking-tight">{{ __( 'Exchange') }}</span>
                                    </div>
                                    <div class="w-full flex justify-end">
                                        <x-icon name="arrow-right" class="w-5 col-span-1"/>
                                    </div>
                                </div>
                            @endforeach
                            @foreach ($blockchains as $blockchain)
                                <div 
                                    class="grid grid-cols-7 items-center py-5 px-6 border-b cursor-pointer hover:bg-gray-100"
                                    x-on:click="item = `{{ $blockchain['name'] }}`"
                                    x-bind:class = "item == `{{ $blockchain['name'] }}`? 'bg-gray-100' : '' "
                                    {{-- wire:click = "get_new_blockchain_id({{ $blockchain['id'] }})" --}}
                                >
                                    <x-icon name="{{ $blockchain['name'] }}" class="w-auto h-8 col-span-2"></x-icon>
                                    <p class="col-span-2 uppercase">{{ __($blockchain['name']) }}</p>
                                    <div class="inline-flex items-center px-3 py-1 bg-primary rounded-md text-white col-span-2">
                                        <x-icon name="blockchain" class="w-8 h-8 mr-2 text"/>
                                        <span class="text-md font-bold tracking-tight">{{ __( 'Blockchain') }}</span>
                                    </div>
                                    <div class="w-full flex justify-end">
                                        <x-icon name="arrow-right" class="w-5 col-span-1" x-show="item == `{{ $blockchain['name'] }}`"/>
                                    </div>
                                </div>
                            @endforeach
                        @else
                            @if ($selected == 1)                                
                                @foreach ($exchanges_array as $account)
                                    <div 
                                        class="grid grid-cols-7 items-center py-5 px-6 border-b cursor-pointer hover:bg-gray-100"
                                        {{-- wire:click = "get_new_blockchain_id({{ $exchange_account['id'] }})" --}}
                                    >
                                        <x-icon name="{{ $account['name'] }}" class="w-auto h-8 col-span-2"></x-icon>
                                        <p class="col-span-2">{{ __($account['name']) }}</p>
                                        <div class="inline-flex items-center px-3 py-1 bg-primary rounded-md text-white col-span-2">
                                            <x-icon name="exchange-1" class="w-8 h-8 mr-2 text"/>
                                            <span class="text-md font-bold tracking-tight">{{ __( 'Exchange') }}</span>
                                        </div>
                                        <div class="w-full flex justify-end">
                                            <x-icon name="arrow-right" class="w-5 col-span-1"/>
                                        </div>
                                    </div>
                                @endforeach
                            @endif
                            @if ($selected == 3)                                
                                @foreach ($blockchains as $account)
                                    <div 
                                        class="grid grid-cols-7 items-center py-5 px-6 border-b cursor-pointer hover:bg-gray-100"
                                        {{-- wire:click = "get_new_blockchain_id({{ $exchange_account['id'] }})" --}}
                                    >
                                        <x-icon name="{{ $account['name'] }}" class="w-auto h-8 col-span-2"></x-icon>
                                        <p class="col-span-2">{{ __($account['name']) }}</p>
                                        <div class="inline-flex items-center px-3 py-1 bg-primary rounded-md text-white col-span-2">
                                            <x-icon name="blockchain" class="w-8 h-8 mr-2 text"/>
                                            <span class="text-md font-bold tracking-tight">{{ __( 'Blockchain') }}</span>
                                        </div>
                                        <div class="w-full flex justify-end">
                                            <x-icon name="arrow-right" class="w-5 col-span-1"/>
                                        </div>
                                    </div>
                                @endforeach
                            @endif
                        @endif
                    </div>
                </div>
            
                {{-- Right panel --}}
                <div class="border border-dashed rounded-md">
                    <div class="h-full w-full p-5">
                        
                    </div>
                </div>
            </div>    
        </div>
    </div>
</div>


