<x-guest-layout>
    <div class="w-screen h-screen flex">
        <div class="m-auto">
            <p class="my-5 text-xl font-bold">MyCryptoTax</p>
            <x-button tag="a" href="{{ route('login') }}" class="p-5">LOG IN</x-button>
            <x-button tag="a" href="{{ route('register') }}" class="p-5">SIGN UP</x-button>
        </div>
    </div>
</x-guest-layout>
