<div>
    <h6 class="text-xl font-semibold">{{ __('Credit Card') }}</h6>
    <div class="mt-8 grid grid-cols-1 md:grid-cols-3 gap-12 md:gap-24">
        @php
            $items = [
                [], [], [], []
            ]
        @endphp
        @foreach ($items as $item)            
            <div>
                <img src="{{ asset('assets/img/cards/red_card.svg') }}" class="w-full h-auto"/>
                <div class="mt-5 flex items-center justify-between flex-wrap gap-2">
                    <div class="flex items-center space-x-3 lg:space-x-6">
                        <button class="py-1 px-2 border rounded border-primary hover:bg-primary hover:text-white flex items-center">
                            <x-icon name="cross-circle" class="w-4 h-4 mr-2"/>
                            <p>{{ __('Remove') }}</p>
                        </button>
                        <button class="py-1 px-2 border rounded border-primary hover:bg-primary hover:text-white flex items-center">
                            <x-icon name="edit" class="w-4 h-4 mr-2"/>
                            <p>{{ __('Edit') }}</p>
                        </button>
                    </div>
                    <button class="py-1 px-4 border rounded-md bg-primary hover:bg-secondary text-white">{{ __('Default card') }}</button>
                </div>
            </div>
        @endforeach
    </div>
    <div class="mt-14">
        <h6 class="text-xl font-semibold">{{ __('Others') }}</h6>
        <div class="mt-6 flex items-center gap-7 flex-wrap">
            <button class="border rounded-md p-3">
                <img src="{{ asset('assets/img/svg/paypal.svg') }}"/>
            </button>
            <button class="border rounded-md p-3">
                <img src="{{ asset('assets/img/svg/google_pay.svg') }}"/>
            </button>
            <button class="border rounded-md p-3">
                <img src="{{ asset('assets/img/svg/apple_pay.svg') }}"/>
            </button>
        </div>
    </div>
</div>
