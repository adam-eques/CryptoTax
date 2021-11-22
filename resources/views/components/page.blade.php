<div class="pt-8 mx-auto px-1 xs:px-4 xl:max-w-screen-2xl lg:px-5">
    <div class="bg-white border border-gray-200 px-2 xs:px-4 lg:px-8">
        {{-- Headings --}}
        <div class="flex justify-between py-3 md:py-5 border-b border-gray-300 mb-8">
            <div class="flex gap-2 lg:gap-4 text-gray-700  items-center">
                @if(isset($icon) && $icon)<x-icon :name="$icon" class="w-6"></x-icon>@endif
                <h1 class="font-bold sm:text-xl md:text-2xl lg:text-3xl text-gray-700">{{ $title }}</h1>
            </div>

            @if(isset($headerButtons) && $headerButtons)
                <div class="flex items-center gap-2 lg:gap-5">
                    {{ $headerButtons }}
                </div>
            @endif
        </div>

        {{-- Body --}}
        {{ $slot }}
    </div>
</div>
