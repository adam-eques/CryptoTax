@props(['content' => ""])
<div class="relative flex flex-col items-center group">
    {{-- <img src="{{asset('assets/img/icon/dashboard/tooltip.svg')}}" class="w-4 h-4"/> --}}
    {{ $slot }}
    <div class="absolute top-12 -left-14 flex-col items-center hidden group-hover:flex">
        <div class="z-50 bg-secondary shadow-sm rounded-full flex items-center px-2 py-3 space-x-2 w-50">
            <x-icon name="wallet" class="w-6 h-6 text-white hidden xl:block"></x-icon>
            <p class="text-md text-white">{{ $content }}</p>
        </div>
        <img src="{{asset('assets/img/icon/dashboard/arrow.svg')}}" alt="" class="w-15 h-15 -mt-18">
    </div>
</div>