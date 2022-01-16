<div class="mx-auto my-5 px-3 xs:px-4 lg:px-5 py-5 xl:max-w-screen-2xl  bg-white rounded-sm shadow" x-data="{ selected: '', category:'', action:'' }">
    <div class="w-full border-b pb-5">
        <div class="grid grid-cols-1 md:grid-cols-8">
            <div class="flex items-center justify-start space-x-3 col-span-6 py-6">
                <x-icon name="wallet" class="w-7 h-8"/>
                <h1 class="font-bold sm:text-xl lg:text-2xl text-primary">{{ __('Accounts') }}</h1>
            </div>
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-x-0 lg:gap-x-3 col-span-2 py-2">
                <x-button variant="white" class="border-primary col-span-1">
                    <x-icon name="sync" class="w-7 mr-2"/>
                    {{ __('Sync ') }}
                </x-button>
                <x-button class="col-span-2 justify-center" tag="a" href="{{ route('customer.account.new') }}">
                    <x-icon name="wallet-1" class="w-7 mr-2"/>
                    {{ __('Add New Account') }}
                </x-button>
            </div>
        </div>
    </div>
    <div class="p-7 flex flex-col md:flex-row -mx-2 lg:-mx-5 space-y-10 md:space-y-0">
        <!-- Left Panel -->
        <div class="px-2 lg:px-5 md:w-2/5">
            @php
                $rows = [
                    ["label" => "Exchanges", "items" => $cryptoExchangeAccounts ],
                    ["label" => "Wallets", "items" => [ ]],
                    ["label" => "Blockchain", "items" => $blockchains],
                    ["label" => "Others", "items" => [ ]],
                ];
            @endphp
            <div class="flex flex-col gap-5 text-gray-900 font-medium">
                @foreach($rows as $index => $row)
                    <x-toggle-block :label="$row['label']" :opened="$index === 0">
                        <div class="flex flex-col divide-y divide-gray-300 scrollbar overflow-auto max-h-100" x-on:click="category=`{{ $row['label'] }}`; action=''">
                            @foreach($row["items"] as $item)
                                @if (  $row['label'] == 'Exchanges' && $item->credentials )
                                    <button 
                                        class="flex justify-between space-x-4 py-2 lg:py-4 px-4 lg:px-6 items-center relative hover:bg-gray-100"
                                        x-on:click="selected = `{{ $item->getName() }}`"
                                        wire:click="get_selected_account({{ $item->id }})"
                                    >
                                        <div class="space-y-1 text-left">
                                            <h3 class="xl:text-lg font-semibold text-gray-700">{{ $item->getName() }}</h3>
                                            <p class="text-gray-400 text-xs xl:text-md">Updating...</p>
                                        </div>
                                        <p class="xl:text-xl text-gray-700 font-semibold">${{ moneyFormat($item["price"], 2) }}</p>
                                        <div 
                                            class="bg-secondary-500 rounded-br-sm rounded-tr-sm w-2 h-full absolute right-0"     
                                            x-transition
                                            x-bind:class="selected == `{{ $item->getName() }}` ? 'absolute' : 'hidden'"
                                        ></div>
                                    </button>
                                @endif
                                @if ($row['label'] == 'Blockchain')
                                    <button 
                                        class="flex justify-between space-x-4 py-2 lg:py-4 px-4 lg:px-6 items-center relative hover:bg-gray-100"
                                        x-on:click="selected = `{{ $item->getName() }}`"
                                        {{-- wire:click="get_selected_account({{ $item->id }})" --}}
                                    >
                                        <div class="space-y-1 text-left">
                                            <h3 class="xl:text-lg font-semibold text-gray-700">{{ $item->getName() }}</h3>
                                            <p class="text-gray-400 text-xs xl:text-md">Updating...</p>
                                        </div>
                                        <p class="xl:text-xl text-gray-700 font-semibold">${{ moneyFormat($item["price"], 2) }}</p>
                                        <div 
                                            class="bg-secondary-500 rounded-br-sm rounded-tr-sm w-2 h-full absolute right-0"     
                                            x-transition
                                            x-bind:class="selected == `{{ $item->getName() }}` ? 'absolute' : 'hidden'"
                                        ></div>
                                    </button>
                                @endif
                            @endforeach
                        </div>
                    </x-toggle-block>
                @endforeach
            </div>
        </div>

        <!-- Right Panel -->
        <div class="px-2 lg:px-5 md:w-3/5">
            <div class="w-full h-full border rounded">
                <div class="w-full flex justify-between py-3 lg:py-6 px-4 lg:px-8 bg-gray-100 rounded" x-show="selected!=''">
                    <div>
                        <p x-text="selected" class="font-bold sm:text-xl md:text-base lg:text-lg xl:text-xl"></p>
                        <p class="text-gray-400">{{ __('Updating...') }}</p>
                    </div>
                    <div class="flex items-center space-x-3">
                        <p class="font-bold sm:text-xl md:text-base lg:text-lg xl:text-xl">{{ __('$ 698,189.000') }}</p>
                        <x-button size="xs">
                            <x-icon name="edit" class="w-6" wire:click="edit_exchange" x-on:click="action='edit'"/>
                        </x-button>
                        <x-button size="xs" variant="danger" wire:click="delete_exchange" x-on:click="action='delete'">
                            <x-icon name="fas-trash-alt" class="w-6"/>
                        </x-button>
                    </div>
                </div>
                {{-- Echange --}}
                <div x-show="selected!=''">
                    <div x-show="category == 'Exchanges' && action == 'edit' ">
                        @if($account)  
                            <div>
                                <form wire:submit.prevent="save_exchange">
                                    <div class="p-4">
                                        {{ $this->form }}
        
                                        <div class="text-center mt-4">
                                            <x-button type="submit">{{ __("Save") }}</x-button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        @endif
                    </div>
                </div>

                {{-- Blockchains --}}
                <div x-show="selected!=''">
                    <div x-show="category == 'Blockchain' && action == 'edit' ">
                       Edit
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
