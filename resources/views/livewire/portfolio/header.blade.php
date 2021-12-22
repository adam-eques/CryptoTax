<div>
    {{-- Do your work, then step back. --}}
    <div class="w-full border-b py-2">
        <div class="grid grid-cols-1 md:grid-cols-5">
            <div class="flex items-center justify-start space-x-6 col-span-3 py-5">
                <x-icon name="portfolio" class="w-8 h-8"/>
                <h1 class="font-bold sm:text-xl lg:text-2xl text-primary">{{ __('Portfolio') }}</h1>
            </div>
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-0 lg:gap-3 col-span-2">
                <div class="py-2">
                    <button class="lg:px-4 p-2 gap-5 text-primary hover:text-white bg-white hover:bg-primary inline-flex justify-center py-4 border border-primary rounded-lg w-full">
                        <x-icon name="calendar" class="w-5"/>
                        <span class="hidden sm:inline">{{ __('Today') }}</span>
                    </button>
                </div>
                <div class="py-2">
                    <button class="border border-primary hover:bg-primary rounded-lg w-full h-full py-3 text-primary hover:text-white">{{ __('Past day') }}</button>
                </div>
                <div  x-data="{ isOpen: false}" class="relative py-2">
                    <button 
                        class="flex justify-center items-center border rounded-lg w-full h-full bg-secondary hover:bg-primary text-white font-bold py-3 px-1"
                        @click="isOpen = !isOpen" 
                        @keydown.escape="isOpen = false" 
                    >
                        {{ __('Total performance') }}
                        <x-icon name="fas-chevron-down" class="w-3 ml-3"/>
                    </button>
                    <ul x-show="isOpen" @click.away="isOpen = false" 
                        class="absolute font-normal bg-white shadow overflow-hidden rounded w-60 border mt-2 py-5 right-0 z-20 px-3"
                    >
                        <li>{{ __('Add Drop Down Options here') }}</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
