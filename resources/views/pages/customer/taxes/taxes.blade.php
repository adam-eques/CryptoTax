<x-app-layout>
    <div class="mx-auto my-5 px-3 xs:px-4 xl:max-w-screen-2xl lg:px-5 py-5 bg-white rounded-sm shadow">
       @livewire('taxes.header')
       <div class="grid grid-cols-1 md:grid-cols-12 gap-0 md:gap-4">
           <div class="col-span-7 space-y-5">
               @livewire('taxes.gains')
               @livewire('taxes.income')
           </div>
           <div class="col-span-5"></div>
       </div>
    </div>
</x-app-layout>
