<x-app-layout>
    {{-- Hero section --}}
    <div class="w-full bg-primary">
        <x-container class="pt-8 text-white">
            <div class="grid grid-cols-1 gap-4 md:grid-cols-2">
                <div class="flex order-2 h-full text-center sm:order-1 sm:text-left">
                    <div class="my-auto">
                        <h2 class="text-2xl font-bold sm:text-4xl">{{ __("HIRE THE BEST FINANCIAL ADVISORS") }}</h2>
                        <p class="mt-2 font-semibold">{{ __('The top financial advisors in Germany with ratings') }}</p>
                        <div class="grid grid-cols-1 gap-5 py-8 sm:grid-cols-2 sm:gap-10" x-data="{total_value:50}">
                            <input class="w-full py-5 border-none rounded-md outline-none px-7 ring-0 text-primary" placeholder="Advisor Name"/>
                            <input class="w-full py-5 border-none rounded-md outline-none px-7 ring-0 text-primary" placeholder="Zip or city"/>
                            <select class="w-full py-5 border-none rounded-md outline-none px-7 ring-0 text-primary">
                                <option disabled selected>{{ __('All Consulting Topics') }}</option>
                                <option></option>
                            </select>
                            <select class="w-full py-5 border-none rounded-md outline-none px-7 ring-0 text-primary">
                                <option disabled selected>{{ __('Financial Advisor') }}</option>
                                <option></option>
                            </select>
                            <div>
                                <p class="text-sm text-gray-600">{{ __('Distance') }}</p>
                                <div class="relative mt-6">
                                    <div class="absolute px-2 font-bold text-center bg-white rounded-md -top-6 text-primary whitespace-nowrap">
                                        <span x-text="total_value"></span>km
                                    </div>
                                    <input name="distance" class="w-full h-2 rounded-full appearance-none bg-secondary" type="range" x-model="total_value" min="0" max="100" step="1">
                                </div>
                            </div>
                            <button class="w-full py-5 font-semibold border-none rounded-md outline-none px-7 ring-0 bg-secondary">{{ __('Find a Advisor') }}</button>
                        </div>
                    </div>
                </div>
                <div class="order-1 sm:order-2">
                    <img src="{{asset('assets/img/svg/advisor_banner.svg')}}"/>
                </div>
            </div>
        </x-container>
    </div>

    <x-container class="mt-16 bg-white border">
        <div class="px-0 py-6 sm:py-12 sm:px-6">
            <h3 class="text-2xl font-bold">{{ __('TOP 100 ADVISORS') }}</h3>
            <p class="pb-6 mt-4 text-base border-b">{{ __('Clients Rate Financial Advisors ') }} <span class="text-sm text-gray-400">{{ __('based on 106,079 client reviews') }}</span> </p>
            <p class="text-sm text-gray-400 mt-7">{{ __('Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusant doloremque laudantium totam rem aperiam, eaque ipsa quae ab illo inventore verit quasi architecto beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia voluptas sit aspe aut odit aut fugit sed quia consequuntur') }}</p>
            <h3 class="mt-10 mb-8 text-2xl font-bold">{{ __('Recommended for you') }}</h3>
            @livewire('customer.advisor.recommended')
            <div class="mt-12 border-b"></div>
            <h3 class="mt-12 text-2xl font-bold">{{ __('Search for your results') }}</h3>
            <div class="mt-8">
                @livewire('customer.advisor.advisor-list')
            </div>
        </div>
    </x-container>


</x-app-layout>