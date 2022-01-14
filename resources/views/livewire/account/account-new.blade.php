<div class="grid grid-cols-1 md:grid-cols-6 gap-0 md:gap-6" x-data="{ category: 'Exchange', item: ''}">
    <div class="col-span-1 py-8 space-y-5">
        @php
            $button_group = [
                [ 'icon' => 'exchange-1', 'name' => 'Exchange' ],
                [ 'icon' => 'wallet-1', 'name' => 'Wallets' ],
                [ 'icon' => 'blockchain', 'name' => 'Blockchains' ],
                [ 'icon' => 'others', 'name' => 'Others' ],
            ]
        @endphp

        @foreach ($button_group as $button)            
            <button 
                variant="white" class="w-full flex items-center justify-between bg-gray-100 hover:bg-primary hover:text-white rounded-lg py-4 px-5" 
                x-on:click="category = `{{ $button['name'] }}`, item=''"
                x-bind:class="category == `{{ $button['name'] }}` ? 'bg-primary text-white' : ''"
            >
                <div class="inline-flex items-center">
                    <x-icon name="{{ $button['icon'] }}" class="w-8 h-8 mr-3"/>
                    <span class="text-xl font-bold tracking-tight">{{ __( $button['name']) }}</span>
                </div>
                <x-icon name="arrow-right" class="w-5" x-show="category == `{{ $button['name'] }}`"/>
            </button>
        @endforeach
    </div>
    <div class="col-span-5 border rounded-md p-7">
        <div class="flex items-center border rounded-lg px-4 py-2">
            <x-icon name="fas-search" class="w-4"/>
            <input type="text" class="border-0 ring-0 outline-none rounded-lg w-full focus:ring-0" placeholder="Search for an exchange">
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-0 md:gap-10 mt-8">
            {{-- Left panel --}}
            <div class="overflow-auto h-full border rounded-md">
                <div class="h-110">
                    <div x-show="category == 'Exchange'">
                        @foreach ($cryptoExchangeAccounts as $row)
                            <div 
                                class="grid grid-cols-5 items-center py-5 px-6 border-b cursor-pointer hover:bg-gray-100"
                                x-on:click="item = `{{ $row->getName() }}`"
                                x-bind:class = "item == `{{ $row->getName() }}`? 'bg-gray-100' : '' "
                            >
                                <x-icon name="maker" class="w-auto h-8 col-span-2"></x-icon>
                                <div class="col-span-2">
                                    <p>{{ __($row->getName()) }}</p>
                                    @if($row->hasAllCredentials())
                                        <span class="text-sm">{{ __("Last fetched") }}: {{ $row->fetched_at ? $row->fetched_at->format("Y-m-d H:i") : __("never") }}</span>
                                    @else
                                        <span class="text-danger text-sm">{{ __("Missing credentials") }}</span>
                                    @endif
                                </div>

                                <div class="float-right">
                                    @if($row->hasAllCredentials())
                                        <x-button class="w-full" :disabled="$row->fetching_scheduled_at" size="sm" wire:click="fetch_exchange({{ $row->id }})">{{ __("Fetch") }}</x-button>@endif
                                    <x-button class="w-full" wire:click="edit_exchange({{ $row->id }})" :disabled="$row->fetching_scheduled_at">{{ __("Edit") }}</x-button>
                                    <x-button class="w-full" variant="danger" :disabled="$row->fetching_scheduled_at" size="sm" wire:click="delete_exchange({{ $row->id }})">{{ __("Delete") }}</x-button>
                                </div>
                            </div>
                        @endforeach
                        @if ($exchanges->count())
                            @foreach ($exchanges as $exchange)
                                <div 
                                    class="grid grid-cols-5 items-center py-5 px-6 border-b cursor-pointer hover:bg-gray-100"
                                    x-on:click="item = `{{ $exchange->getName() }}`"
                                    x-bind:class = "item == `{{ $exchange->getName() }}`? 'bg-gray-100' : '' "
                                >
                                    <x-icon name="maker" class="w-auto h-8 col-span-2"></x-icon>
                                    <p class="col-span-2">{{ __($exchange->getName()) }}</p>
                                    <x-button wire:click="add_exchange({{ $exchange->id }})" x-show="item == `{{ $exchange->getName() }}`">{{ __("Add") }}</x-button>
                                </div>
                            @endforeach
                        @endif
                    </div>

                    <div x-show="category == 'Blockchains'">                        
                        @foreach ($blockchains as $row)
                            <div class="grid grid-cols-5 items-center py-5 px-6 border-b cursor-pointer hover:bg-gray-100">
                                <p class="col-span-3 break-all">{{ __($row->getName()) }}</p>
                                <div class="col-span-2">
                                    <x-button :disabled="$row->fetching_scheduled_at" size="sm" wire:click="fetch_blockchain({{ $row->id }})">{{ __("Fetch") }}</x-button>
                                    <x-button variant="danger" :disabled="$row->fetching_scheduled_at" size="sm" wire:click="delete_blockchain({{ $row->id }})">{{ __("Delete") }}</x-button>
                                </div>
                            </div>
                        @endforeach
                    </div>

                    @if ( count( $exchanges ) > 10 )                        
                        <div class="py-5 flex justify-center items-center space-x-5 cursor-pointer hover:bg-gray-100">
                            <x-icon name="fas-chevron-down" class="w-3 h-3"/>
                            <p>{{ __('More.... (300+ Exchanges)') }}</p>
                        </div>
                    @endif
                </div>
            </div>

            {{-- Right panel --}}
            <div class="border border-dashed rounded-md">
                <div class="flex justify-center items-center h-full w-full">
                    <div x-show="category=='Exchange'">
                        @if($account)
                            <div class="px-2 lg:px-3">
                                <x-card :title="$account->getName()">
                                    @if($account->fetching_scheduled_at)
                                        <p class="p-4">{{ __("Fetching is currently scheduled. You can't modify credentials until fetching is finished.") }}</p>
                                    @else
                                        <form wire:submit.prevent="save_exchange">
                                            <div class="p-4">
                                                {{ $this->form }}
                                                <div class="text-center mt-4">
                                                    <x-button type="submit">{{ __("Save") }}</x-button>
                                                </div>
                                            </div>
                                        </form>
                                    @endif
                                </x-card>
                            </div>
                        @endif
                    </div>
                    <div x-show="category=='Blockchains'">
                        <div class="p-4">
                            <h2 class="text-lg mb-2"> {{ __("Add new blockchain address") }}</h2>
                            <div class="mt-1">
                                <input class=" h-10 transition duration-75 px-3 rounded-lg shadow-sm focus:border-primary-600 focus:ring-1 focus:ring-inset focus:ring-primary-600 border border-primary-300" name="address" wire:model.defer="newBlockchainAddress" placeholder="Address" />
                                <x-button wire:click="add_blockchain">Add</x-button>
                            </div>
                        </div>
                    </div>

                    <div class="text-center" x-show="category=='Wallets'||category=='Others'">
                        <div class="bg-primary flex justify-center items-center rounded-full mx-auto w-30 h-30">
                            <x-icon name="book-info" class="w-16 h-16 text-white"/>
                        </div>
                        <p class="text-xl font-bold mt-3">{{ __('Instructions for API or CSV') }}</p>
                        <p>{{ __('Please select an Exchange to see import instructions.') }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

