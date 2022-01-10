@props(['content' => ""])
<div class="relative flex flex-col items-center group">
    {{ $slot }}
    <div class="absolute top-12 -left-14 flex-col items-center hidden group-hover:flex">
        <div class="z-50 bg-secondary shadow-sm rounded-full flex items-center px-2 py-3 space-x-2 w-50">
            <x-icon name="wallet" class="w-6 h-6 text-white hidden xl:block"></x-icon>
            <p class="text-sm text-white">{{ $content }}</p>
        </div>
        <x-icon name="triangle-1" class="w-12 h-12 -mt-18 -rotate-45 text-secondary"></x-icon>
    </div>
</div>