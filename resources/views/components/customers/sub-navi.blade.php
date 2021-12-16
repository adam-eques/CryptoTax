@php($subnavi = \App\Services\NavigationService::instance()->getRouteItem())
@if($subnavi && ($subnavi["children"] || $subnavi["actions"]))
    <div class="bg-white border-b border-gray-200">
        <div class="mx-auto px-3 xs:px-4 xl:max-w-screen-2xl lg:px-5 py-3">
            <div class="flex items-center justify-between ">
                <div class="flex items-baseline text-sm space-x-2 lg:space-x-4 -ml-2 lg:-ml-4">
                    @foreach($subnavi["children"] as $navItem)
                        <a href="{{ $navItem['route'] }}"
                           class="lg:px-4 p-2 gap-2 hover:text-secondary inline-flex items-center">
                            <x-icon :name="$navItem['icon']" class="w-5"/>
                            <span class="hidden sm:inline">{{ $navItem["label"] }}</span>
                        </a>
                    @endforeach
                </div>

                @if(!empty($subnavi["actions"]))
                    <div class="flex items-center gap-2 lg:gap-5">
                        @foreach($subnavi["actions"] as $action)
                            <a href="{{ route($action['route']) }}"
                               class="inline-flex items-center justify-center gap-2 p-2 md:px-4 font-medium tracking-wide hover:text-white rounded hover:bg-secondary focus:shadow-outline focus:outline-none outline-none {{ $action["color"] }}">
                                <x-icon :name="$action['icon']" class="w-5"/>
                                <span class="hidden sm:inline">{{ $action["label"] }}</span>
                            </a>
                        @endforeach
                    </div>
                @endif
            </div>
        </div>
    </div>
@endif
