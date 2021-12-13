<div>
    {{-- Do your work, then step back. --}}
    <div class="w-full border-b py-2">
        <div class="grid grid-cols-1 md:grid-cols-5">
            <div class="flex items-center justify-start space-x-6 col-span-3 py-5">
                <img src="{{asset('assets/img/icon/portfolio.png')}}" class="w-10 h-8"/>
                <h4 class="text-2xl font-extrabold">Portfolio</h4>
            </div>
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-0 lg:gap-3 col-span-2">
                <div class="py-2">
                    <button class="lg:px-4 p-2 gap-5 hover:text-white hover:bg-primary-500 inline-flex justify-center py-4 border border-primary rounded-lg w-full">
                        <x-icon name="fas-calendar" class="w-5"/>
                        <span class="hidden sm:inline">Today</span>
                    </button>
                </div>
                <div class="py-2">
                    <button class="border border-color hover:bg-primary rounded-lg w-full h-full py-3 text-primary hover:text-white">Past day</button>
                </div>
                <div  x-data="{ isOpen: false}" class="relative py-2">
                    <button 
                        class="border rounded-lg w-full h-full bg-primary hover:bg-secondary text-white font-bold py-3"
                        @click="isOpen = !isOpen" 
                        @keydown.escape="isOpen = false" 
                    >
                        Total Performance
                        <span class="transform rotate-90">&raquo;</span>
                    </button>
                    <ul x-show="isOpen" @click.away="isOpen = false" 
                        class="absolute font-normal bg-white shadow overflow-hidden rounded w-60 border mt-2 py-5 right-0 z-20 px-3"
                    >
                        <li>Add Drop Down Options here</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
