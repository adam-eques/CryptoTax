<div class="mt-4 rounded-md grid grid-cols-9 border bg-gray-100 min-w-clg">
    <div class="w-full col-span-1 flex items-center justify-center border-l-8 border-primary " x-bind:class="selected == {{ $id }} ? 'rounded-t-md' : 'rounded-md'">
        <button class="w-8 h-8 flex justify-center items-center rounded-full bg-white shadow-lg"  @click="selected !== {{ $id }} ? selected = {{ $id }} : selected = null">
            <img src="{{asset("assets/img/icon/dashboard/arrow_regular.svg")}}" class="w-4 h-4" x-bind:class="selected == {{ $id }} ? 'rotate-180' : ''"/>
        </button>
    </div>
    <div class="col-span-2 flex items-center justify-left space-x-6 py-3">
        <img src="{{asset("assets/img/icon/coin/bitcoin.svg")}}" class="w-16 h-16"/>
        <div>
            <p class="text-xl font-bold text-primary">Bitcoin</p>
            <p>BIT</p>
        </div>
    </div>
    <div class="col-span-2 flex items-center h-full justify-left space-x-6">
        <div>
            <p class="text-2xl font-bold text-primary">$ 57,114.77</p>
            <p class="pt-2 text-primary">100608.16 CRO</p>
        </div>
    </div>
    <div class="col-span-2 flex items-center justify-left space-x-6">
        <p class="text-2xl font-bold text-primary">$ 356.85</p>
    </div>
    <div class="col-span-2 flex items-center justify-left space-x-6">
        <div>
            <p class="text-2xl font-bold text-primary">+ $ 57,114.77</p>
            <x-badge size="sm">{{ __("+0%") }}</x-badge>
        </div>
    </div>
    <div class="col-span-9 flex items-center space-x-6 bg-white border-l-8 border-primary rounded-b-md p-5" x-show="selected == {{ $id }}">
        <x-button variant="secondary">{{ __("Kraken 0.10") }}</x-button>
        <x-button variant="warning">{{ __("Binance  0.15") }}</x-button>
        <x-button variant="success">{{ __("Lite Coin") }}</x-button>
    </div>
</div>