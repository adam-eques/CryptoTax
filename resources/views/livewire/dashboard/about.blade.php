<div class=" bg-primary rounded-md text-white w-full xl:px-20 md:px-12 xl:py-22 md:py-10 px-5 py-5 relative">
    <img src="{{asset('assets/img/svg/about.svg')}}" class="xl:w-106 lg:w-80 w-70 absolute top-0 md:top-8 right-3 z-0"/>
    <div>
        <p class="text-white font-extrabold text-xl sm:text-2xl lg:text-4xl xl:text-5xl">Hello John Doe</p>
        <div class="pt-3">
            <p class="text-xl font-bold text-white">Thanks for signing up.</p>
        </div>
        <div class="py-10">
            <nav aria-label="Progress">
                <ol class="flex items-center">
                    <li class="relative pr-8 lg:pr-14">
                        <div class="absolute inset-0 flex items-center" aria-hidden="true">
                            <div class="h-2 w-full bg-secondary"></div>
                        </div>
                        <x-tooltip content="Connect Your Wallet">
                            <div class="relative w-8 h-8 flex items-center justify-center bg-secondary rounded-full hover:bg-secondary-600">
                                <x-icon name="fas-check" class="w-5 h-5 text-white"></x-icon>
                                <span class="sr-only">Step 1</span>
                            </div>
                        </x-tooltip>
                    </li>
            
                    <li class="relative pr-8 lg:pr-14">
                        <div class="absolute inset-0 flex items-center" aria-hidden="true">
                            <div class="h-2 w-full bg-secondary"></div>
                        </div>
                        <x-tooltip content="Connect Your Wallet">
                            <div class="relative w-8 h-8 flex items-center justify-center bg-secondary rounded-full hover:bg-secondary-600">
                                <x-icon name="fas-check" class="w-5 h-5 text-white"></x-icon>
                                <span class="sr-only">Step 2</span>
                            </div>
                        </x-tooltip>
                    </li>
            
                    <li class="relative pr-8 lg:pr-14">
                        <div class="absolute inset-0 flex items-center" aria-hidden="true">
                            <div class="h-2 w-full bg-gray-500"></div>
                        </div>
                        <x-tooltip content="Connect Your Wallet">
                            <div class="relative w-8 h-8 flex items-center justify-center bg-secondary hover:bg-secondary-600 rounded-full" aria-current="step">
                                <span class="h-2.5 w-2.5 bg-white rounded-full" aria-hidden="true"></span>
                                <span class="sr-only">Step 3</span>
                            </div>
                        </x-tooltip>
                    </li>
                
                    <li class="relative pr-8 lg:pr-14">
                        <!-- Upcoming Step -->
                        <div class="absolute inset-0 flex items-center" aria-hidden="true">
                            <div class="h-2 w-full bg-gray-500"></div>
                        </div>
                        <x-tooltip content="Connect Your Wallet">
                            <div class="group relative w-8 h-8 flex items-center justify-center bg-gray-500 rounded-full">
                                <span class="h-2.5 w-2.5 bg-transparent rounded-full" aria-hidden="true"></span>
                                <span class="sr-only">Step 4</span>
                            </div>
                        </x-tooltip>
                    </li>
                
                    <li class="relative">
                        <div class="absolute inset-0 flex items-center" aria-hidden="true">
                            <div class="h-2 w-full bg-gray-500"></div>
                        </div>
                        <x-tooltip content="Connect Your Wallet">
                            <div href="#" class="group relative w-8 h-8 flex items-center justify-center bg-gray-500 rounded-full">
                                <span class="h-2.5 w-2.5 bg-transparent rounded-full" aria-hidden="true"></span>
                                <span class="sr-only">Step 5</span>
                            </div>
                        </x-tooltip>
                    </li>
                </ol>
            </nav>
        </div>
    </div>
</div>
