<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>
            @isset($title)
                {{ $title }} | 
            @endisset
            {{ config('app.name', 'Laravel') }}
        </title>

        <!-- Styles -->
        <link rel="stylesheet" href="{{ mix('mix/css/app.css') }}">

        <!-- Scripts -->
        <script src="{{ mix('mix/js/app.js') }}" defer></script>

        <link rel="stylesheet" href="https://unpkg.com/flickity@2/dist/flickity.min.css">
        <script src="https://unpkg.com/flickity@2/dist/flickity.pkgd.min.js"></script>

        @include("layouts.partials.google-analytics-header")
    </head>
    <body>
        @include("layouts.partials.google-analytics-body")

        <div class="font-sans text-gray-900 antialiased">
            {{ $slot }}
        </div>
        @livewireScripts
        @stack('scripts')
    </body>
</html>
