<x-guest-layout>
    <div class="w-full bg-white relative">
        {{-- hero section --}}
        <img src="{{ asset("assets/img/svg/hero_pattern.svg") }}" class="absolute right-0 top-0 z-0 w-2/3 h-auto"/>
        <x-index.nav/>
        <div class="pt-50 relative">
            <div class="mx-auto px-3 xs:px-4 xl:max-w-screen-2xl lg:px-5">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-20">
                    <div class="relative h-full flex items-center">
                        <div class="p-20 absolute">
                            <img src="{{ asset('assets/img/svg/hero_pattern_2.svg') }}" class="w-full h-auto"/>
                        </div>
                        <div class="m-auto">
                            <p class="text-3xl">{{ __('Track your crypto') }}</p>
                            <p class="text-6xl font-extrabold mt-8">{{ __('Portfolio & Taxes') }}</p>
                            <p class="mt-10 text-lg">{{ __('Use our cryptocurrency tax software to easily track your trades,') }}</p>
                            <p class="mt-3 text-lg">{{ __('see your profits, and never overpay on your crypto taxes again.') }}</p>
                        </div>
                    </div>
                    <div class="">
                        <img src="{{ asset('assets/img/svg/hero_image.svg') }}" class=""/>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-guest-layout>
