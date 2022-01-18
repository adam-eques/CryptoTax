<div x-data="{item:''}">
    <div class="grid grid-cols-1 md:grid-cols-2 gap-0 md:gap-10">
        <div class="flex items-center border rounded-lg px-4 py-2">
            <x-icon name="fas-search" class="w-4"/>
            <input 
                type="text" 
                class="border-0 ring-0 outline-none rounded-lg w-full focus:ring-0" 
                placeholder="Search for an exchange" 
                {{-- wire:model="search"  --}}
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
               
            </div>
        </div>
    
        {{-- Right panel --}}
        <div class="border border-dashed rounded-md">
            <div class="h-full w-full p-5">
                
            </div>
        </div>
    </div>    
</div>
