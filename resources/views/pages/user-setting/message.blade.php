<x-app-layout>
    <x-container class="mt-7 mb-24 bg-white p-8 border rounded-sm">
        <x-customers.customer-header-bar icon="message" name="Message">
        </x-customers.customer-header-bar>
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-10 mt-12 overflow-y-auto">
            <div class="col-span-1 border rounded min-h-[584px]">
                <div class="bg-gray-100 px-10 rounded">
                    <div class="sm:hidden">
                        <label for="tabs" class="sr-only">Select a tab</label>
                        <select id="tabs" name="tabs" class="block w-full pl-3 pr-10 py-2 text-base focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm rounded-md">
                            <option>New</option>
                            <option>Unread</option>
                            <option selected>All</option>
                            <option>Delete all</option>
                        </select>
                    </div>
                    <div class="hidden sm:block">
                        <div class="">
                            <nav class="-mb-px flex justify-between" aria-label="Tabs">
                                <a href="#" class="border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300 whitespace-nowrap py-4 px-1 border-b-2 font-medium text-sm">
                                    New
                                </a>
                        
                                <a href="#" class="border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300 whitespace-nowrap py-4 px-1 border-b-2 font-medium text-sm">
                                    Unread
                                </a>
                        
                                <a href="#" class="border-indigo-500 text-indigo-600 whitespace-nowrap py-4 px-1 border-b-2 font-medium text-sm" aria-current="page">
                                    All
                                </a>
                        
                                <a href="#" class="border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300 whitespace-nowrap py-4 px-1 border-b-2 font-medium text-sm">
                                    Delete all
                                </a>
                            </nav>
                        </div>
                    </div>
                </div>
                <div class="divide-y">
                    <div class="p-8 flex items-center space-x-4">
                        <div class="bg-primary w-16 h-14 rounded p-3">
                            <img src="{{asset('/assets/img/logo.svg')}}" alt="Logo" class="h-full w-full"/>
                        </div>
                        <div class="space-y-3">
                            <div class="flex items-center justify-between">
                                <p class="text-sm">{{ __('From Admin') }}</p>
                                <p class="text-gray-300">{{ __('12 Jan') }}</p>
                            </div>
                            <h3 class="text-base font-semibold truncate">{{ __('Unable to select currency when order.') }}</h3>
                        </div>
                    </div>
                    <div class="p-8 flex items-center space-x-4">
                        <div class="bg-primary w-16 h-14 rounded p-3">
                            <img src="{{asset('/assets/img/logo.svg')}}" alt="Logo" class="h-full w-full"/>
                        </div>
                        <div class="space-y-3">
                            <div class="flex items-center justify-between">
                                <p class="text-sm">{{ __('From Admin') }}</p>
                                <p class="text-gray-300">{{ __('12 Jan') }}</p>
                            </div>
                            <h3 class="text-base font-semibold truncate">{{ __('Unable to select currency when order.') }}</h3>
                        </div>
                    </div>
                    <div class="p-8 flex items-center space-x-4">
                        <div class="bg-primary w-16 h-14 rounded p-3">
                            <img src="{{asset('/assets/img/logo.svg')}}" alt="Logo" class="h-full w-full"/>
                        </div>
                        <div class="space-y-3">
                            <div class="flex items-center justify-between">
                                <p class="text-sm">{{ __('From Admin') }}</p>
                                <p class="text-gray-300">{{ __('12 Jan') }}</p>
                            </div>
                            <h3 class="text-base font-semibold truncate">{{ __('Unable to select currency when order.') }}</h3>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-span-2 p-8 border rounded">
                <h5 class="text-xl font-bold">{{ __('Unable to select currency when order') }}</h5>
                <p class="text-gray-400 mt-2">{{ __('Technical Problem') }}</p>
                <div class="border-b mt-7"></div>
                <h3 class="text-base font-semibold truncate pt-8">{{ __('Hello Abu Bin Ishtiyak') }}</h3>
                <div class="mt-4 text-gray-400 space-y-4">
                    <p>{{ __('I am facing problem as i can not select currency on buy order page. Can you guys let me know what i am doing doing wrong? Please check attached files.') }}</p>
                    <p>{{ __('Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Donec quam felis, ultricies nec, pellentesque eu, pretium quis, sem. Nulla consequat massa quis enim. Donec pede justo, fringilla vel, aliquet nec, vulputate eget, arcu. In enim justo, rhoncus ut, imperdiet a, venenatis vitae, justo.') }}</p>
                    <p>{{ __('Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Donec quam felis, ultricies nec, pellentesque eu, pretium quis, sem. Nulla consequat massa quis enim. Donec pede justo, fringilla vel, aliquet nec, vulputate eget, arcu. In enim justo, rhoncus ut, imperdiet a, venenatis vitae, justo.') }}</p>
                </div>
                <div class="mt-10 border rounded-md p-6">
                    <textarea rows="6" class="w-full border-0 focus:border-none focus:ring-0 focus:outline-none"></textarea>
                    <div class="flex bottom-5 left-4 space-x-4">
                        <button class=" bg-primary hover:bg-secondary text-white font-semibold px-3 py-1 rounded-md">{{ __('Reply') }}</button>
                        <button>
                            <x-icon name="attatchment" class="h-6 text-gray-300 hover:text-primary"/>
                        </button>
                        <button>
                            <x-icon name="emoji" class="h-6 text-gray-300 hover:text-primary"/>
                        </button>
                        <button>
                            <x-icon name="image" class="h-6 text-gray-300 hover:text-primary"/>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </x-container>
</x-app-layout>