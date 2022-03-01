@php(\App\Services\NavigationService::instance()->overwriteSubnavi([
    ["label" => "profile", "icon" => "tabler-user", "route" => "customer.account"],
    ["label" => "Setting", "icon" => "uni-setting-o", "route" => "customer.transactions"],
], [
    ["label" => "Invite a Friend", "icon" => "go-person-add-16", "route" => "customer.invite", "color" => "text-white bg-primary"],
]))
<x-app-layout>
    <x-container class="p-8 mb-24 bg-white border rounded-sm mt-7">
        <x-customers.customer-header-bar icon="iconoir-message-text" name="Message">
        </x-customers.customer-header-bar>
        <div class="grid grid-cols-1 gap-10 mt-12 overflow-y-auto lg:grid-cols-3">
            <div class="col-span-1 border rounded min-h-[584px]">
                <div class="px-10 bg-gray-100 rounded">
                    <div class="sm:hidden">
                        <label for="tabs" class="sr-only">Select a tab</label>
                        <select id="tabs" name="tabs" class="block w-full py-2 pl-3 pr-10 text-base rounded-md focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                            <option>New</option>
                            <option>Unread</option>
                            <option selected>All</option>
                            <option>Delete all</option>
                        </select>
                    </div>
                    <div class="hidden sm:block">
                        <div class="">
                            <nav class="flex justify-between -mb-px" aria-label="Tabs">
                                <a href="#" class="px-1 py-4 text-sm font-medium text-gray-500 border-b-2 border-transparent hover:text-gray-700 hover:border-gray-300 whitespace-nowrap">
                                    New
                                </a>
                        
                                <a href="#" class="px-1 py-4 text-sm font-medium text-gray-500 border-b-2 border-transparent hover:text-gray-700 hover:border-gray-300 whitespace-nowrap">
                                    Unread
                                </a>
                        
                                <a href="#" class="px-1 py-4 text-sm font-medium text-indigo-600 border-b-2 border-indigo-500 whitespace-nowrap" aria-current="page">
                                    All
                                </a>
                        
                                <a href="#" class="px-1 py-4 text-sm font-medium text-gray-500 border-b-2 border-transparent hover:text-gray-700 hover:border-gray-300 whitespace-nowrap">
                                    Delete all
                                </a>
                            </nav>
                        </div>
                    </div>
                </div>
                <div class="divide-y">
                    <div class="flex items-center p-8 space-x-4">
                        <div class="w-16 p-3 rounded bg-primary h-14">
                            <img src="{{asset('/assets/img/logo.svg')}}" alt="Logo" class="w-full h-full"/>
                        </div>
                        <div class="space-y-3">
                            <div class="flex items-center justify-between">
                                <p class="text-sm">{{ __('From Admin') }}</p>
                                <p class="text-gray-300">{{ __('12 Jan') }}</p>
                            </div>
                            <h3 class="text-base font-semibold">{{ __('Unable to select currency when order.') }}</h3>
                        </div>
                    </div>
                    <div class="flex items-center p-8 space-x-4">
                        <div class="w-16 p-3 rounded bg-primary h-14">
                            <img src="{{asset('/assets/img/logo.svg')}}" alt="Logo" class="w-full h-full"/>
                        </div>
                        <div class="space-y-3">
                            <div class="flex items-center justify-between">
                                <p class="text-sm">{{ __('From Admin') }}</p>
                                <p class="text-gray-300">{{ __('12 Jan') }}</p>
                            </div>
                            <h3 class="text-base font-semibold">{{ __('Unable to select currency when order.') }}</h3>
                        </div>
                    </div>
                    <div class="flex items-center p-8 space-x-4">
                        <div class="w-16 p-3 rounded bg-primary h-14">
                            <img src="{{asset('/assets/img/logo.svg')}}" alt="Logo" class="w-full h-full"/>
                        </div>
                        <div class="space-y-3">
                            <div class="flex items-center justify-between">
                                <p class="text-sm">{{ __('From Admin') }}</p>
                                <p class="text-gray-300">{{ __('12 Jan') }}</p>
                            </div>
                            <h3 class="text-base font-semibold">{{ __('Unable to select currency when order.') }}</h3>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-span-2 p-8 border rounded">
                <h5 class="text-xl font-bold">{{ __('Unable to select currency when order') }}</h5>
                <p class="mt-2 text-gray-400">{{ __('Technical Problem') }}</p>
                <div class="border-b mt-7"></div>
                <h3 class="pt-8 text-base font-semibold truncate">{{ __('Hello Abu Bin Ishtiyak') }}</h3>
                <div class="mt-4 space-y-4 text-gray-400">
                    <p>{{ __('I am facing problem as i can not select currency on buy order page. Can you guys let me know what i am doing doing wrong? Please check attached files.') }}</p>
                    <p>{{ __('Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Donec quam felis, ultricies nec, pellentesque eu, pretium quis, sem. Nulla consequat massa quis enim. Donec pede justo, fringilla vel, aliquet nec, vulputate eget, arcu. In enim justo, rhoncus ut, imperdiet a, venenatis vitae, justo.') }}</p>
                    <p>{{ __('Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Donec quam felis, ultricies nec, pellentesque eu, pretium quis, sem. Nulla consequat massa quis enim. Donec pede justo, fringilla vel, aliquet nec, vulputate eget, arcu. In enim justo, rhoncus ut, imperdiet a, venenatis vitae, justo.') }}</p>
                </div>
                <div class="p-6 mt-10 border rounded-md">
                    <textarea rows="6" class="w-full border-0 focus:border-none focus:ring-0 focus:outline-none"></textarea>
                    <div class="flex space-x-4 bottom-5 left-4">
                        <button class="px-3 py-1 font-semibold text-white rounded-md bg-primary hover:bg-secondary">{{ __('Reply') }}</button>
                        <button>
                            <x-icon name="ri-attachment-line" class="h-6 text-gray-300 hover:text-primary"/>
                        </button>
                        <button>
                            <x-icon name="iconoir-emoji" class="h-6 text-gray-300 hover:text-primary"/>
                        </button>
                        <button>
                            <x-icon name="uiw-picture" class="h-6 text-gray-300 hover:text-primary"/>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </x-container>
</x-app-layout>