@php
    $list = [
        [ 'icon' => 'kucoin-token' ],
        [ 'icon' => 'celo' ],
        [ 'icon' => 'bitcoin-cash' ],
        [ 'icon' => 'c-eth' ],
        [ 'icon' => 'cosmos'  ],
        [ 'icon' => 'kucoin-token' ],
        [ 'icon' => 'kucoin-token' ],
        [ 'icon' => 'celo' ],
        [ 'icon' => 'bitcoin-cash' ],
        [ 'icon' => 'c-eth' ],
        [ 'icon' => 'cosmos'  ],
        [ 'icon' => 'kucoin-token' ],
    ]
@endphp

<div class="grid grid-cols-1 md:grid-cols-2 gap-x-0 md:gap-x-7 gap-y-7">
    @foreach ($list as $item)        
        <div class="grid w-full grid-cols-1 px-6 bg-white border rounded-md xl:grid-cols-5 py-9 hover:bg-bgcolor">
            <div class="relative flex items-center justify-center col-span-2 border-r border-dashed">
                <x-icon name="{{ $item['icon'] }}" class="w-32 h-32"/>
                <x-icon name="scissors" class="absolute w-6 h-6 text-gray-400 -right-3 top-8"/>
            </div>
            <div class="col-span-3 xl:pl-10">
                <div class="flex items-end justify-between">
                    <p class="text-5xl font-bold text-secondary">80% <span class="text-2xl">offer</span></p>
                    <div>
                        <button class="rounded-md bg-secondary">
                            <div class="px-6 py-4 text-lg font-bold text-white bg-primary hover:bg-secondary rounded-t-md rounded-bl-md rounded-br-3xl">SHOW COUPON</div>
                        </button>
                        <p class="mt-2 ml-2 text-sm">Expries <span class="ml-2 text-secondary">12 Dec 2021</span></p>
                    </div>
                </div>
                <div class="mt-7">
                    <p class="font-bold">Get 30% off ZALANDO, Unlimited and  ZALANDO Family !</p>
                </div>
            </div>
        </div>
    @endforeach
</div>
