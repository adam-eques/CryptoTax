<div class="grid grid-cols-1 gap-0 xl:grid-cols-6 xl:gap-6" x-data="{category:'', 'isModalOpen': false}">
    {{-- Category Selection --}}

    <div class="col-span-1">
        {{-- Desktop --}}
        <div class="hidden py-8 space-y-5 xl:block">
            @foreach ($categories as $category)
                <button 
                    class="flex items-center justify-between w-full px-3 py-4 rounded-lg hover:bg-primary hover:text-white border-1 2xl:px-5" 
                    wire:key='{{ $category["id"] }}'
                    wire:click="get_selected_category({{ $category["id"] }})"
                    x-on:click="category = {{$category['id']}}"
                    x-bind:class="category == {{$category['id']}}?'bg-primary text-white':'bg-gray-100'"
                >
                    <div class="inline-flex items-center">
                        <x-icon name="{{ $category['icon'] }}" class="w-8 h-8 mr-2"/>
                        <span class="text-xl font-semibold tracking-tight truncate">{{ __( $category['name']) }}</span>
                    </div>
                    <x-icon name="heroicon-o-arrow-narrow-right" class="hidden w-5 text-white 2xl:block" x-cloak x-show="category == {{$category['id']}}"/>
                </button>
            @endforeach
        </div>

        {{-- Mobile --}}
        <div class="block py-2 xl:hidden">
            <select name="category" class="w-full px-3 py-4 bg-white border border-gray-200 rounded outline-none" wire:model.lazy="selected">
                <option selected>All</option>
                @foreach ($categories as $category)                    
                    <option value="{{ $category['id'] }}">{{ __($category['name']) }}</option>
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
            <div class="h-full overflow-auto border rounded-md scrollbar">
                <div class="h-[550px]">
                    @foreach ($crypto_resources as $resource)                        
                        <x-new-account-row 
                            category="{{$resource->type}}" 
                            :selected="$selected_account_id === $resource->id" 
                            wire:click="add({{ $resource->id }})"
                            :name="$resource->name" 
                        />
                    @endforeach
                </div>
            </div>
        
            {{-- Right panel --}}
            {{-- Desktop --}}
            <div class="hidden border border-dashed rounded-md lg:block">
                <div class="w-full h-full p-5">
                    @if($selected_account)
                        <img src="{{ asset('assets/img/exchange_icon/' . $selected_account->cryptoSource->name . '.svg') }}"  class="flex w-auto h-10 m-auto"/>    
                        <p class="mt-3 text-xl font-bold text-center">{{ __($selected_account->getName() . ' API integration')}}</p>
                        <form wire:submit.prevent="save" autocomplete="off" wire:key="{{$selected_account->id}}">
                            <div class="p-4">
                                {{ $this->form }}
                                <div class="mt-4 text-center">
                                    <x-button type="submit">{{ __("Save") }}</x-button>
                                </div>
                            </div>
                        </form>
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
                                @if($selected_account)
                                    <div wire:key='{{$selected_account->id}}'>
                                        <img src="{{ asset('assets/img/exchange_icon/' . $selected_account->cryptoSource->name . '.svg') }}"  class="flex w-auto h-10 m-auto"/>    
                                        <p class="mt-3 text-xl font-bold text-center">{{ __($selected_account->getName() . ' API integration')}}</p>
                                        <form wire:submit.prevent="save" autocomplete="off">
                                            <div class="p-4">
                                                {{ $this->form }}
                                                <div class="mt-4 text-center">
                                                    <x-button type="submit">{{ __("Save") }}</x-button>
                                                </div>
                                            </div>
                                        </form>
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
{{-- 
            <div wire:loading.block class="hidden lg:block">
                <x-spiner/>
            </div>  --}}
        </div>    
    </div>
</div>


