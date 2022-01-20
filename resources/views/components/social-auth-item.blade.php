<button class="flex items-center border-0 md:border py-5 px-2 md:px-18">
    <x-icon name="{{$icon}}" class="w-8 h-8 mr-5"/>
    <p class="block md:hidden text-lg font-bold uppercase">{{ $name }}</p>
    <p class="hidden md:block text-lg font-bold">{{ $slot }}</p>
</button>