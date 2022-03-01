<div class="grid grid-cols-1 gap-0 xl:grid-cols-6 xl:gap-6" x-data="{category:'', 'isModalOpen': false}">
    {{-- Category Selection --}}

    <div class="col-span-1">
        {{-- Desktop --}}
        <div class="hidden py-8 space-y-5 xl:block">
            @foreach ($buttons as $button)
                <button 
                    class="flex items-center justify-between w-full px-3 py-4 rounded-lg hover:bg-primary hover:text-white border-1 2xl:px-5" 
                    wire:click="get_selected_item({{ $button['id'] }})"
                    wire:key='{{ $button["id"] }}'
                    x-on:click="category = {{$button['id']}}"
                    x-bind:class="category == {{$button['id']}}?'bg-primary text-white':'bg-gray-100'"
                >
                    <div class="inline-flex items-center">
                        <x-icon name="{{ $button['icon'] }}" class="w-8 h-8 mr-2"/>
                        <span class="text-xl font-semibold tracking-tight truncate">{{ __( $button['name']) }}</span>
                    </div>
                    <x-icon name="arrow-right" class="hidden w-5 text-white 2xl:block" x-cloak x-show="category == {{$button['id']}}"/>
                </button>
            @endforeach
        </div>

        {{-- Mobile --}}
        <div class="block py-2 xl:hidden">
            <select name="category" class="w-full px-3 py-4 bg-white border border-gray-200 rounded outline-none" wire:model.lazy="selected">
                <option selected>All</option>
                @foreach ($buttons as $button)                    
                    <option value="{{ $button['id'] }}">{{ __($button['name']) }}</option>
                @endforeach
            </select>
        </div>
    </div>

    {{-- Add account section --}}
    <div class="col-span-6 p-3 border rounded-md xl:col-span-5 xl:p-7" x-data="{selected_item:''}">
        <div class="grid grid-cols-1 gap-5 lg:grid-cols-2 md:gap-10">
            <div class="flex items-center order-2 px-4 py-2 border rounded-lg lg:order-1">
                <x-icon name="fas-search" class="w-4"/>
                <input 
                    type="text" 
                    class="w-full border-0 rounded-lg outline-none ring-0 focus:ring-0" 
                    placeholder="Search for an exchange" 
                    wire:model="search" 
                >
            </div>
            <div class="flex flex-wrap items-center justify-end order-1 space-x-3 lg:order-2">
                <p>{{ __('A service is missing?') }}</p>
                <x-button>{{ _('Make a request') }}</x-button>
            </div>
        </div>
        <div class="grid grid-cols-1 gap-4 mt-5 lg:grid-cols-2 lg:gap-10 lg:mt-8">
            {{-- Left panel --}}
            <div class="h-full overflow-auto border rounded-md">
                <div class="h-110">
                    @if (!$selected)                            
                        @foreach ($exchanges_array as $account)
                            <x-new-account-row :category="1" :selected="$newAccountId == $account['id']" :name="$account['name']" 
                                wire:click="get_new_exchange_id({{ $account['id'] }})"
                                x-on:click="isModalOpen=true"
                            />
                        @endforeach
                        @foreach ($blockchains as $account)
                            <x-new-account-row :category="3" :selected="$newBlockchainId == $account['id']" :name="$account['name']"
                                wire:click="get_new_blockchain_id({{ $account['id'] }})"
                                x-on:click="isModalOpen=true"
                            />
                        @endforeach
                    @else
                        @if ($selected == 1)                                
                            @foreach ($exchanges_array as $account)
                                <x-new-account-row :category="1" :selected="$newAccountId == $account['id']" :name="$account['name']"
                                    wire:click="get_new_exchange_id({{ $account['id'] }})"
                                    x-on:click="isModalOpen=true"
                                />
                            @endforeach
                        @endif
                        @if ($selected == 3)                                
                            @foreach ($blockchains as $account)
                                <x-new-account-row :category="3" :selected="$newBlockchainId == $account['id']" :name="$account['name']"
                                    wire:click="get_new_blockchain_id({{ $account['id'] }})"
                                    x-on:click="isModalOpen=true"
                                />
                            @endforeach
                        @endif
                    @endif
                </div>
            </div>
        
            {{-- Right panel --}}
            {{-- Desktop --}}
            <div class="hidden border border-dashed rounded-md lg:block">
                <div class="w-full h-full p-5">
                    @if ($exchange_account)
                        <img src="{{ asset('assets/img/exchange_icon/' . $exchange_account->getName() . '.svg') }}"  class="flex w-auto h-10 m-auto"/>    
                        <p class="mt-3 text-xl font-bold text-center">{{ __($exchange_account->getName() . ' API integration')}}</p>
                        <form wire:submit.prevent="save_exchange" autocomplete="off">
                            <div class="p-4">
                                {{ $this->form }}
                                <div class="mt-4 text-center">
                                    <x-button type="submit">{{ __("Save") }}</x-button>
                                </div>
                            </div>
                        </form>
                    @elseif($newBlockchainId)
                        <p class="mt-3 text-xl font-bold text-center"><span x-text="selected_item" class="uppercase"></span> {{ __(' API integration') }} </p> 
                        <div class="mt-10">
                            <div>
                                <p class="text-gray-600">Address<span class="text-danger">*</span></p>
                                <div class="mt-1">
                                    <input class="w-full px-2 py-2 border rounded" name="address" wire:model.defer="newBlockchainAddress" placeholder="Address" />
                                </div>
                                <div class="flex justify-center mt-3">
                                    <x-button wire:click="add_blockchain">Add</x-button>
                                </div>
                            </div>
                        </div>
                    @else
                        <div class="flex items-center justify-center w-full h-full text-center">
                            <div>
                                <div class="flex items-center justify-center mx-auto rounded-full bg-primary w-30 h-30">
                                    <x-icon name="go-book-16" class="w-16 h-16 text-white"/>
                                </div>
                                <p class="mt-3 text-xl font-bold">{{ __('Instructions for API or CSV') }}</p>
                                <p>{{ __('Please select an Exchange to see import instructions.') }}</p>
                            </div>
                        </div>
                    @endif
                </div>
            </div>

            {{-- Mobile --}}
            <div class="block lg:hidden">
                <div 
                    class="fixed inset-0 z-10 overflow-y-auto" 
                    aria-labelledby="modal-title" 
                    role="dialog" 
                    aria-modal="true"
                    x-show="isModalOpen"
                    x-cloak
                    x-transition
                >
                    <div class="flex items-end justify-center min-h-screen px-4 pt-4 pb-20 text-center sm:block sm:p-0">
                        <div class="fixed inset-0 transition-opacity bg-gray-500 bg-opacity-75" aria-hidden="true"></div>
                            <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>
                            <div class="inline-block px-4 pt-5 pb-4 overflow-hidden text-left align-bottom transition-all transform bg-white rounded-lg shadow-xl sm:my-8 sm:align-middle sm:max-w-sm sm:w-full sm:p-6">
                                <div class="flex justify-end">
                                    <button aria-label="Close" x-on:click="isModalOpen=false" class="flex justify-end">✖</button>
                                </div>
                                @if ($exchange_account)
                                    <img src="{{ asset('assets/img/exchange_icon/' . $exchange_account->getName() . '.svg') }}"  class="flex w-auto h-10 m-auto"/> 
                                    <p class="mt-3 text-xl font-bold text-center">{{ __($exchange_account->getName() . ' API integration')}}</p>
                                    <form wire:submit.prevent="save_exchange" autocomplete="off">
                                        <div class="p-4">
                                            {{ $this->form }}
                                            <div class="mt-4 text-center">
                                                <x-button type="submit">{{ __("Save") }}</x-button>
                                            </div>
                                        </div>
                                    </form>
                                @elseif($newBlockchainId)
                                    <p class="mt-3 text-xl font-bold text-center"><span x-text="selected_item" class="uppercase"></span> {{ __(' API integration') }} </p> 
                                    <div class="flex justify-center mt-5">
                                        <div>
                                            <p class="text-gray-600">Address<span class="text-danger">*</span></p>
                                            <div class="mt-1 space-y-5">
                                                <input 
                                                    class="w-full px-2 py-2 border rounded" 
                                                    name="address" 
                                                    wire:model.defer="newBlockchainAddress" 
                                                    placeholder="Address" 
                                                />
                                                <x-button wire:click="add_blockchain" class="justify-center w-full">Add</x-button>
                                            </div>
                                        </div>
                                    </div>
                                @else
                                    <div class="flex items-center justify-center w-full h-full text-center">
                                        <div>
                                            <div class="flex items-center justify-center mx-auto rounded-full bg-primary w-30 h-30">
                                                <x-icon name="go-book-16" class="w-16 h-16 text-white"/>
                                            </div>
                                            <p class="mt-3 text-xl font-bold">{{ __('Instructions for API or CSV') }}</p>
                                            <p>{{ __('Please select an Exchange to see import instructions.') }}</p>
                                        </div>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div wire:loading.block class="lg:block hidden">
                <x-spiner/>
            </div>            
        </div>    
    </div>
</div>


