<div>
    <h6 class="text-xl font-semibold">{{ __('Credit Card') }}</h6>
    <div class="grid grid-cols-1 gap-12 mt-8 md:grid-cols-3 md:gap-24">
        @php
            $items = [
                [], [], [], []
            ]
        @endphp
        @foreach ($items as $item)            
            <div>
                <img src="{{ asset('assets/img/cards/red_card.svg') }}" class="w-full h-auto"/>
                <div class="flex flex-wrap items-center justify-between gap-2 mt-5">
                    <div class="flex items-center space-x-3 lg:space-x-6">
                        <button class="flex items-center px-2 py-1 border rounded border-primary hover:bg-primary hover:text-white">
                            <x-icon name="cross-circle" class="w-4 h-4 mr-2"/>
                            <p>{{ __('Remove') }}</p>
                        </button>
                        <a class="flex items-center px-2 py-1 border rounded border-primary hover:bg-primary hover:text-white cursor-pointer" href="{{ route('customer.payment-info.detail', [ 'id' =>1 ]) }}">
                            <x-icon name="edit" class="w-4 h-4 mr-2"/>
                            <p>{{ __('Edit') }}</p>
                        </a>
                    </div>
                    <button class="px-4 py-1 text-white border rounded-md bg-primary hover:bg-secondary">{{ __('Default card') }}</button>
                </div>
            </div>
        @endforeach
    </div>
    <div class="mt-14">
        <h6 class="text-xl font-semibold">{{ __('Others') }}</h6>
        <div class="flex flex-wrap items-center mt-6 gap-7">
            <button class="p-3 border rounded-md">
                <img src="{{ asset('assets/img/svg/paypal.svg') }}"/>
            </button>
            <button class="p-3 border rounded-md">
                <img src="{{ asset('assets/img/svg/google_pay.svg') }}"/>
            </button>
            <button class="p-3 border rounded-md">
                <img src="{{ asset('assets/img/svg/apple_pay.svg') }}"/>
            </button>
        </div>
    </div>
</div>
