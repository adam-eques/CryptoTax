<div class=" bg-bgcolor1 rounded-md text-white w-full px-5 md:px-8 xl:px-11 py-5 md:py-8 xl:py-12 relative">
    <img src="{{asset('assets/img/svg/about.svg')}}" class="xl:w-106 lg:w-80 w-70 absolute top-0 md:top-8 right-3 z-0 hidden md:block"/>
    <div class="max-w-lg z-10">
        <h2 class="text-primary text-3xl font-extrabold">{{ __('Hello John Doe') }}</h2>
        <p class="text-primary text-base">Thanks for signing up.</p>
        <div class="flex flex-wrap items-center space-x-3 mt-8">
            <div class="bg-white rounded-xl p-3">
                <x-icon name="wallet-1" class="w-8 h-8 text-secondary"></x-icon>
            </div>
            <h5 class="text-lg font-bold text-primary">1. Add Wallets & Exchanges</h5>
            <button class="font-bold text-sm bg-primary hover:bg-secondary rounded py-2 px-3">{{ __('ADD WALLET') }}</button>
        </div>
        <p class="text-primary mt-6">Add your wallets and exchanges for api sync, csv import or manually upload your transactions</p>
       
        <!-- This example requires Tailwind CSS v2.0+ -->
        <nav aria-label="Progress" class="mt-11">
            <ol class="flex items-center">
                <li class="relative pr-8 sm:pr-10">
                    <!-- Completed Step -->
                    <div class="absolute inset-0 flex items-center" aria-hidden="true">
                        <div class="h-0.5 w-full bg-secondary"></div>
                    </div>
                    <a href="#" class="relative w-6 h-6 flex items-center justify-center bg-secondary rounded-full hover:bg-indigo-900">
                    <!-- Heroicon name: solid/check -->
                        <svg class="w-4 h-4 text-white" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                            <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd" />
                        </svg>
                        <span class="sr-only">Step 1</span>
                    </a>
                </li>
            
                <li class="relative pr-8 sm:pr-10">
                    <!-- Completed Step -->
                    <div class="absolute inset-0 flex items-center" aria-hidden="true">
                        <div class="h-0.5 w-full bg-secondary"></div>
                    </div>
                    <a href="#" class="relative w-6 h-6 flex items-center justify-center bg-secondary rounded-full hover:bg-indigo-900">
                    <!-- Heroicon name: solid/check -->
                        <svg class="w-4 h-4 text-white" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                            <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd" />
                        </svg>
                        <span class="sr-only">Step 2</span>
                    </a>
                </li>
            
                <li class="relative pr-8 sm:pr-10">
                    <!-- Current Step -->
                    <div class="absolute inset-0 flex items-center" aria-hidden="true">
                        <div class="h-0.5 w-full bg-gray-200"></div>
                    </div>
                    <a href="#" class="relative w-6 h-6 flex items-center justify-center bg-white border-2 border-secondary rounded-full" aria-current="step">
                        <span class="h-2.5 w-2.5 bg-secondary rounded-full" aria-hidden="true"></span>
                        <span class="sr-only">Step 3</span>
                    </a>
                </li>
            
                <li class="relative pr-8 sm:pr-10">
                    <!-- Upcoming Step -->
                    <div class="absolute inset-0 flex items-center" aria-hidden="true">
                        <div class="h-0.5 w-full bg-gray-200"></div>
                    </div>
                    <a href="#" class="group relative w-6 h-6 flex items-center justify-center bg-white border-2 border-gray-300 rounded-full hover:border-gray-400">
                        <span class="h-2.5 w-2.5 bg-transparent rounded-full group-hover:bg-gray-300" aria-hidden="true"></span>
                        <span class="sr-only">Step 4</span>
                    </a>
                </li>
            
                <li class="relative">
                    <!-- Upcoming Step -->
                    <div class="absolute inset-0 flex items-center" aria-hidden="true">
                        <div class="h-0.5 w-full bg-gray-200"></div>
                    </div>
                    <a href="#" class="group relative w-6 h-6 flex items-center justify-center bg-white border-2 border-gray-300 rounded-full hover:border-gray-400">
                        <span class="h-2.5 w-2.5 bg-transparent rounded-full group-hover:bg-gray-300" aria-hidden="true"></span>
                        <span class="sr-only">Step 5</span>
                    </a>
                </li>
            </ol>
        </nav>
    </div>
</div>
