@props(["opened" => false, "label"])
<div class="border border-gray-100 rounded" x-data="{opened:{{ $opened ? 'true' : 'false' }}}">
    <div 
        aria-current="true"
        type="button"
        class="flex items-center w-full px-4 py-3 space-x-4 font-semibold text-left text-gray-700 border-0 rounded cursor-pointer lg:py-6 lg:px-8 focus:outline-none"
        x-on:click="opened = !opened; selected='';"
    >
        {{ $triger }}
    </div>

    <div class="overflow-hidden max-h-0 trnstsn" x-ref="container0" x-bind:style="opened ? 'max-height: ' + $refs.container0.scrollHeight + 'px' : ''">
        <div class="flex flex-col overflow-auto divide-y divide-gray-300 scrollbar max-h-100">
            {{ $slot }}
        </div>
    </div>
</div>
