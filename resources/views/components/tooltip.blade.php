<div class="relative flex flex-col items-center group mx-3">
    <img src="{{asset('assets/img/icon/noti.png')}}" class="w-4 h-4"/>
    <div class="absolute bottom-0  flex-col items-center hidden mb-6 group-hover:flex">
        <span class="relative z-10 p-2 text-xs leading-none text-white whitespace-no-wrap bg-primary shadow-lg">{{ $slot }}</span>
        <div class="w-3 h-3 -mt-2 rotate-45 bg-primary"></div>
    </div>
</div>