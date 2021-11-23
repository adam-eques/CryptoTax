<div class="bg-white border-b border-gray-200 ">
    <div class="mx-auto px-3 xs:px-4 xl:max-w-screen-2xl lg:px-5 py-3">
        <div class="flex items-center justify-between ">
            <div class="flex items-baseline text-sm space-x-2 lg:space-x-4 -ml-2 lg:-ml-4">
                @foreach($navItems as $navItem)
                    <a href="{{ route($navItem['route']) }}"
                       class="lg:px-4 p-2 gap-2 text-blue-800 hover:text-blue-500 font-semibold inline-flex">
                        <x-icon :name="$navItem['icon']" class="w-5"/>
                        <span class="hidden sm:inline">{{ __($navItem["label"]) }}</span>
                    </a>
                @endforeach
            </div>

            <div class="flex items-center gap-2 lg:gap-5">
                @foreach($actions as $action)
                    <a href="{{ route($action['route']) }}"
                       class="inline-flex items-center justify-center gap-2 p-2 md:px-4 font-medium tracking-wide hover:text-white rounded hover:bg-color-1 focus:shadow-outline focus:outline-none outline-none {{ $action["color"] }}">
                        <x-icon :name="$action['icon']" class="w-5"/>
                        <span class="hidden sm:inline">{{ __($action["label"]) }}</span>
                    </a>
                @endforeach
            </div>
        </div>
    </div>
</div>
