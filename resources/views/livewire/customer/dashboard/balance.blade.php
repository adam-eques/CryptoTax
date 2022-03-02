<div class="p-5 bg-white rounded-md shadow-md" x-data="{ view: 'tile' }" >
    <div class="flex items-center justify-between">
        <div class="flex items-center py-5 space-x-2">
            <x-icon name="carbon-money" class="w-8 h-8"/>
            <p class="mr-3 text-lg font-semibold">{{ __("My Balance") }}</p>
        </div>
        <div class="flex items-center space-x-3">
            <button 
                class="px-3 py-2 bg-white border rounded-lg hover:text-white hover:bg-primary" 
                x-bind:class="view === 'tile' ? 'bg-primary text-white' : 'bg-white text-primary'" 
                x-on:click="view = 'tile'"
            >
                <x-icon name="tile" class="w-6 h-6"/>
            </button>
            <button 
                class="px-3 py-2 border rounded-lg hover:text-white hover:bg-primary" 
                x-bind:class="view === 'list' ? 'bg-primary text-white' : 'bg-white text-primary'" 
                x-on:click="view = 'list'"
            >
                <x-icon name="list" class="w-6 h-6"/>
            </button>
        </div>
    </div>

    <div class="relative px-2 py-4 overflow-hidden lg:px-4 sm:px-3">
        <div class="w-full mySwiper">
            <div class="swiper-wrapper">
                <div class="w-2/3 bg-center bg-cover swiper-slide">
                    <img src="{{asset('assets/img/cards/red_card.svg')}}" class="w-2/3 mx-auto"/>
                </div>
                <div class="w-2/3 bg-center bg-cover swiper-slide">
                    <img src="{{asset('assets/img/cards/red_card.svg')}}" class="w-2/3 mx-auto"/>
                </div>
                <div class="w-2/3 bg-center bg-cover swiper-slide">
                    <img src="{{asset('assets/img/cards/red_card.svg')}}" class="w-2/3 mx-auto"/>
                </div>
            </div>
            <div class="swiper-pagination"></div>
        </div>
    </div>

    <div x-show="view == 'tile'" x-transition class="mt-3">
        <div class="grid grid-cols-1 gap-0 xl:grid-cols-2 md:gap-4">
            
            @foreach ($situation as $item)            
                <div>
                    <p class="text-sm text-secondary">{{ __( $item['category'] ) }}</p>
                    <p class="pt-2 text-2xl font-semibold text-primary">$ {{ __( $item['amount'] ) }}</p>
                    <x-progressbar height="sm" variant="primary" progress="{{ $item['percent'] }}" class="mt-5"></x-progressbar>
                </div>
            @endforeach
    
        </div>
        <div class="grid grid-cols-1 gap-0 mt-8 mb-5 xl:grid-cols-3 xl:gap-2">
            <x-button variant="primary" class="flex items-center p-2 space-x-3" tag="a" href="{{ route('customer.account.new') }}">
                <div class="p-1 bg-white rounded-lg">
                    <x-icon name="carbon-wallet" class="w-5 h-5 text-primary"/>
                </div>
                <span class="text-sm font-bold tracking-tighter">{{ __('Add Account') }}</span>
            </x-button>
            <x-button variant="third" class="flex items-center p-2 space-x-3" tag="a" href="{{ route('customer.taxes') }}">
                <div class="p-1 bg-white rounded-lg">
                    <x-icon name="tabler-calculator" class="w-5 h-5 text-third"/>
                </div>
                <span class="text-sm font-bold tracking-tighter">{{ __('Tax Calculation') }}</span>
            </x-button>
            <x-button variant="secondary" class="flex items-center p-2 space-x-3" tag="a" href="{{ route('customer.taxes') }}">
                <div class="p-1 bg-white rounded-lg">
                    <x-icon name="uni-user-md-o" class="w-5 h-5 text-secondary"/>
                </div>
                <span class="text-sm font-bold tracking-tighter">{{ __('Get Tax Pro') }}</span>
            </x-button>
        </div>
    </div>

    <div class="mt-2 space-y-5" x-show="view == 'list'" x-transition>
        <div class="flex items-center justify-between px-6 py-4 bg-primary rounded-xl">
            <img src="{{ asset('assets/img/svg/mastercard.svg') }}"/>
            <div class="text-right text-white">
                <p class="text-sm">****    ****   *****   1569</p>
                <p class="mt-2">Balance <span class="ml-5 text-lg font-bold">$ 673, 146.369</span></p>
            </div>
        </div>
        <div class="flex items-center justify-between px-6 py-4 bg-success rounded-xl">
            <img src="{{ asset('assets/img/svg/visa.svg') }}"/>
            <div class="text-right text-white">
                <p class="text-sm">****    ****   *****   1569</p>
                <p class="mt-2">Balance <span class="ml-5 text-lg font-bold">$ 673, 146.369</span></p>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script type="module">
    var swiper = new Swiper(".mySwiper", {
        effect: "coverflow",
        grabCursor: true,
        centeredSlides: true,
        slidesPerView: "auto",
        loop: true,
        coverflowEffect: {
            rotate: 50,
            stretch: 0,
            depth: 100,
            modifier: 1,
            slideShadows: true,
        },
        pagination: {
            el: ".swiper-pagination",
        },
    });
</script>
@endpush