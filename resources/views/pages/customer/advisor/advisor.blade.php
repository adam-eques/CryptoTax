<x-app-layout>
    {{-- Hero section --}}
    <div class="bg-primary w-full">
        <x-container class="text-white pt-8">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div class="flex h-full order-2 sm:order-1 text-center sm:text-left">
                    <div class="my-auto">
                        <h2 class="text-2xl sm:text-4xl font-bold">{{ __("HIRE THE BEST FINANCIAL ADVISORS") }}</h2>
                        <p class="font-semibold mt-2">{{ __('The top financial advisors in Germany with ratings') }}</p>
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-5 sm:gap-10 py-8" x-data="{total_value:50}">
                            <input class="w-full px-7 py-5 border-none rounded-md outline-none ring-0 text-primary" placeholder="Advisor Name"/>
                            <input class="w-full px-7 py-5 border-none rounded-md outline-none ring-0 text-primary" placeholder="Zip or city"/>
                            <select class="w-full px-7 py-5 border-none rounded-md outline-none ring-0 text-primary">
                                <option disabled selected>{{ __('All Consulting Topics') }}</option>
                                <option></option>
                            </select>
                            <select class="w-full px-7 py-5 border-none rounded-md outline-none ring-0 text-primary">
                                <option disabled selected>{{ __('Financial Advisor') }}</option>
                                <option></option>
                            </select>
                            <div>
                                <p class="text-sm text-gray-700">{{ __('Distance') }}</p>
                                <input class="w-full bg-danger mt-6" type="range" x-model="total_value" min="0" max="100" step="1">
                            </div>
                            <button class="w-full px-7 py-5 border-none rounded-md outline-none ring-0 bg-secondary font-semibold">{{ __('Find a Advisor') }}</button>
                        </div>
                    </div>
                </div>
                <div class="order-1 sm:order-2">
                    <img src="{{asset('assets/img/svg/advisor_banner.svg')}}"/>
                </div>
            </div>
        </x-container>
    </div>

    <x-container class="bg-white mt-16 border">
        <div class="py-6 sm:py-12 px-0 sm:px-6">
            <h3 class="text-2xl font-bold">{{ __('TOP 100 ADVISORS') }}</h3>
            <p class="text-base mt-4 pb-6 border-b">{{ __('Clients Rate Financial Advisors ') }} <span class="text-gray-400 text-sm">{{ __('based on 106,079 client reviews') }}</span> </p>
            <p class="text-gray-400 text-sm mt-7">{{ __('Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusant doloremque laudantium totam rem aperiam, eaque ipsa quae ab illo inventore verit quasi architecto beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia voluptas sit aspe aut odit aut fugit sed quia consequuntur') }}</p>
            <h3 class="text-2xl font-bold mt-10 mb-8">{{ __('Recommended for you') }}</h3>
            @livewire('customer.advisor.recommended')
            <div class="mt-12 border-b"></div>
            <h3 class="mt-12 text-2xl font-bold">{{ __('Search for your results') }}</h3>
            <div class="mt-8">
                @livewire('customer.advisor.advisor-list')
            </div>
        </div>
    </x-container>


</x-app-layout>