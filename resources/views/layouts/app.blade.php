<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <!-- Meta -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Styles -->
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">
        <link rel="stylesheet" href="{{ mix('mix/css/app.css') }}">
        @livewireStyles

        <!-- Scripts -->
        <script src="{{ mix('mix/js/app.js') }}" defer></script>
        {{-- Push ApexCharts to the top of the scripts stack --}}
        <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
    </head>
    <body>
{{--        <x-jet-banner />--}}

        <div class="overflow-hidden">
            <header>
                @livewire('partials.main-navi')
                @livewire('partials.sub-navi')
            </header>

            <main>
                {{ $slot }}

            </main>

            @include("layouts.app.footer")
        </div>

        @livewireScripts
        @livewire('livewire-toast')
        @livewireChartsScripts     
        @stack('scripts')
    </body>
</html>
