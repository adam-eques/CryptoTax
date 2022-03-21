<x-guest-layout title="Contact">
    <x-sub-page-hero icon="contact" subtitle="We're here to help" title="Contact Us"></x-sub-page-hero>
    <div class="relative py-12 bg-white">
        <x-container>
            <p>{{ __("The") }} <a href="{{ route('index') }}" class="font-semibold text-secondary">{{ __("myCrypto Tax") }}</a>  {{__("Help Center has answers to most questions. We’re happy to lend a hand,") }}</p>
            <p>{{ __("but response times may take longer than normal.") }}</p>
            <div class="grid grid-cols-1 gap-5 py-12 md:grid-cols-3 md:gap-8 lg:gap-10 xl:gap-18">
                @php
                    $items = [
                        [ 'id'=>1, 'name'=>'Live chat', 'icon'=>'live-chat', 'line_1'=>'Weekdays: 9 AM — 6 PM ET', 'line_2'=>'Weekends: 9 AM — 5 PM ET', 'button'=>'Chat Now' ],
                        [ 'id'=>1, 'name'=>'Email Contact', 'icon'=>'email-contact', 'line_1'=>'Can’t chat with us during those hours?', 'line_2'=>'We’ll respond to you via email within a day.', 'button'=>'Send Email' ],
                        [ 'id'=>1, 'name'=>'Help Center', 'icon'=>'help-center', 'line_1'=>'Our self-serve help center is open 24/7', 'line_2'=>'with 50+ articles to help.', 'button'=>'Visit Now' ]
                    ]
                @endphp
                @foreach ($items as $item)                    
                    <div class="p-5 text-center border rounded-lg lg:p-9">
                        <div class="flex items-center justify-center space-x-5">
                            <x-icon name="{{$item['icon']}}" class="w-10"/>
                            <h5 class="text-lg font-bold">{{ __($item['name']) }}</h5>
                        </div>
                        <div class="py-4">
                            <p>{{__($item['line_1'])}}</p>
                            <p class="mt-3">{{__($item['line_2'])}}</p>
                        </div>
                        <x-button class="mt-5 font-semibold">{{ __($item['button']) }}</x-button>
                    </div>
                @endforeach
            </div>
            <div class="relative p-8 mt-5 border rounded-lg">
                <div class="absolute top-0 w-10 h-10 -mt-5 rotate-45 -translate-x-1/2 bg-white border-t border-l left-1/2"></div>
                <div class="relative flex justify-center">
                    <div class="w-full max-w-3xl text-center">
                        @livewire('sub-pages.contact-us.email-contact')
                    </div>
                </div>
            </div>
        </x-container>
    </div>
    <div class="bg-white">
        <x-footer-get-start class="bg-white"/>
    </div>
    <x-footer/>
</x-guest-layout>   