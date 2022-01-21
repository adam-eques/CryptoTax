<!DOCTYPE html>
<html>
    <head>
        {{-- Meta --}}
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        {{-- Styles --}}
        <style>[x-cloak] { display: none !important; }</style>
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">
        <link rel="stylesheet" href="{{ mix('mix/css/app.css') }}">
        @livewireStyles

        {{-- Scripts --}}
        <wireui:scripts />
        <script src="{{ mix('mix/js/app.js') }}" defer></script>
    </head>
    <body>

        <div class="w-screen h-screen flex">
            <div class="m-auto">
                <p class="my-5 text-xl font-bold">MyCryptoTax</p>
                <x-button tag="a" href="{{ route('login') }}" class="p-5">LOG IN</x-button>
                <x-button tag="a" href="{{ route('register') }}" class="p-5">SIGN UP</x-button>
            </div>
        </div>
    </body>
</html>