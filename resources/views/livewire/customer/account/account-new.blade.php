<div class="grid grid-cols-1 xl:grid-cols-6 gap-0 xl:gap-6" x-data="{category:'', 'isModalOpen': false}">

    {{-- Category Selection --}}
    <div class="col-span-1">
        {{-- Desktop --}}
        <div class="hidden xl:block py-8 space-y-5">
            @foreach ($buttons as $button)
                <button 
                    class="w-full flex items-center justify-between hover:bg-primary hover:text-white border-1 rounded-lg py-4 px-3 2xl:px-5" 
                    wire:click="get_selected_item({{ $button['id'] }})"
                    x-on:click="category = {{$button['id']}}"
                    x-bind:class="category == {{$button['id']}}?'bg-primary text-white':'bg-gray-100'"
                >
                    <div class="inline-flex items-center">
                        <x-icon name="{{ $button['icon'] }}" class="w-8 h-8 mr-2"/>
                        <span class="text-xl font-semibold tracking-tight truncate">{{ __( $button['name']) }}</span>
                    </div>
                    <x-icon name="arrow-right" class="w-5 text-white hidden 2xl:block" x-cloak x-show="category == {{$button['id']}}"/>
                </button>
            @endforeach
        </div>

        {{-- Mobile --}}
        <div class="block xl:hidden py-2">
            <select name="category" class="w-full bg-white border border-gray-200 px-3 py-4 rounded outline-none" wire:model.lazy="selected">
                <option selected>All</option>
                @foreach ($buttons as $button)                    
                    <option value="{{ $button['id'] }}">{{ __($button['name']) }}</option>
                @endforeach
            </select>
        </div>
    </div>

    {{-- Add account section --}}
    <div class="col-span-6 xl:col-span-5 border rounded-md p-3 xl:p-7" x-data="{selected_item:''}">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-5 md:gap-10">
            <div class="items-center border rounded-lg px-4 py-2 flex order-2 lg:order-1">
                <x-icon name="fas-search" class="w-4"/>
                <input 
                    type="text" 
                    class="border-0 ring-0 outline-none rounded-lg w-full focus:ring-0" 
                    placeholder="Search for an exchange" 
                    wire:model="search" 
                >
            </div>
            <div class="flex items-center flex-wrap space-x-3 justify-end order-1 lg:order-2">
                <p>{{ __('A service is missing?') }}</p>
                <x-button>{{ _('Make a request') }}</x-button>
            </div>
        </div>
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-4 lg:gap-10 mt-5 lg:mt-8">
            {{-- Left panel --}}
            <div class="overflow-auto h-full border rounded-md">
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
            <div class="border border-dashed rounded-md lg:block hidden">
                <div class="h-full w-full p-5">
                    @if ($exchange_account)
                        <img src="{{ asset('assets/img/exchange_icon/' . $exchange_account->getName() . '.svg') }}"  class="h-10 w-auto flex m-auto"/>    
                        <p class="text-xl font-bold text-center mt-3">{{ __($exchange_account->getName() . ' API integration')}}</p>
                        <form wire:submit.prevent="save_exchange">
                            <div class="p-4">
                                {{ $this->form }}
                                <div class="text-center mt-4">
                                    <x-button type="submit">{{ __("Save") }}</x-button>
                                </div>
                            </div>
                        </form>
                    @elseif($newBlockchainId)
                        <p class="text-xl font-bold text-center mt-3"><span x-text="selected_item" class="uppercase"></span> {{ __(' API integration') }} </p> 
                        <div class="mt-10">
                            <div>
                                <p class="text-gray-600">Address<span class="text-danger">*</span></p>
                                <div class="mt-1">
                                    <input class="py-2 px-2 border rounded w-full" name="address" wire:model.defer="newBlockchainAddress" placeholder="Address" />
                                </div>
                                <div class="flex justify-center mt-3">
                                    <x-button wire:click="add_blockchain">Add</x-button>
                                </div>
                            </div>
                        </div>
                    @else
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
            {{-- Mobile --}}
            <div class="lg:hidden block">
                <div 
                    class="fixed z-10 inset-0 overflow-y-auto" 
                    aria-labelledby="modal-title" 
                    role="dialog" 
                    aria-modal="true"
                    x-show="isModalOpen"
                    x-cloak
                    x-transition
                >
                    <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
                        <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity" aria-hidden="true"></div>
                            <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>
                            <div class="inline-block align-bottom bg-white rounded-lg px-4 pt-5 pb-4 text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-sm sm:w-full sm:p-6">
                                <div class="flex justify-end">
                                    <button aria-label="Close" x-on:click="isModalOpen=false" class="flex justify-end">✖</button>
                                </div>
                                @if ($exchange_account)
                                    <img src="{{ asset('assets/img/exchange_icon/' . $exchange_account->getName() . '.svg') }}"  class="h-10 w-auto flex m-auto"/> 
                                    <p class="text-xl font-bold text-center mt-3">{{ __($exchange_account->getName() . ' API integration')}}</p>
                                    <form wire:submit.prevent="save_exchange">
                                        <div class="p-4">
                                            {{ $this->form }}
                                            <div class="text-center mt-4">
                                                <x-button type="submit">{{ __("Save") }}</x-button>
                                            </div>
                                        </div>
                                    </form>
                                @elseif($newBlockchainId)
                                    <p class="text-xl font-bold text-center mt-3"><span x-text="selected_item" class="uppercase"></span> {{ __(' API integration') }} </p> 
                                    <div class="flex justify-center mt-5">
                                        <div>
                                            <p class="text-gray-600">Address<span class="text-danger">*</span></p>
                                            <div class="mt-1 space-y-5">
                                                <input 
                                                    class="py-2 px-2 border rounded w-full" 
                                                    name="address" 
                                                    wire:model.defer="newBlockchainAddress" 
                                                    placeholder="Address" 
                                                />
                                                <x-button wire:click="add_blockchain" class="w-full justify-center">Add</x-button>
                                            </div>
                                        </div>
                                    </div>
                                @else
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
            </div>
        </div>    
    </div>
</div>


