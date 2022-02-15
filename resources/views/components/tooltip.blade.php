@props(['content' => ""])
<div class="relative flex flex-col items-center group">
    {{ $slot }}
    <div class="absolute top-8 flex-col items-center hidden group-hover:flex mr-5">
        <div class="relative z-50 bg-secondary shadow-sm rounded-md hidden items-center justify-center text-center p-2 sm:flex">
            <div class="w-4 h-4 bg-secondary rotate-45 absolute -top-1 left-1/2 -translate-x-1/2"></div>
            <p class="text-sm text-white font-bold whitespace-nowrap">{{ $content }}</p>
        </div>
    </div>
</div>