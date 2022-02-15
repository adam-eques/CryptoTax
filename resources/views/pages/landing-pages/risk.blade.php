<x-guest-layout>
    <x-sub-page-hero icon="risk" subtitle="" title="Risk and Disclaimer"></x-sub-page-hero>
    <div class="relative bg-white py-12">
        <x-container class="text-primary">
            <h6 class="text-2xl font-bold">{{ __('DISCLAIMER') }}</h6>
            <p class="text-gray-400 mt-3">{{ __('Last updated  February 06, 2022') }}</p>
            <h6 class="text-lg font-semibold mt-8">{{ __('Website Disclaimer') }}</h6>
            <p  class="mt-5 leading-loose">{{ __('The information provided by myCrypto Tax (“we,” “us”, or “our”) on mycrypto.tax/ (the “Site”)  is for general informational purposes only. All information on the Site is provided in good faith, however we make no representation or warranty of any kind, express or implied, regarding the accuracy, adequacy, validity, reliability, availability or completeness of any information on the Site . UNDER NO CIRCUMSTANCE SHALL WE HAVE ANY LIABILITY TO YOU FOR ANY LOSS OR DAMAGE OF ANY KIND INCURRED AS A RESULT OF THE USE OF  OR RELIANCE ON ANY INFORMATION PROVIDED ON . YOUR USE OF  AND YOUR RELIANCE ON ANY INFORMATION ON  IS SOLELY AT YOUR OWN RISK.') }}</p>

            <h6 class="text-lg font-semibold mt-8">{{ __('AFFILIATES DISCLAIMER') }}</h6>
            <p  class="mt-5 leading-loose">{{ __('The Site  may contain links to affiliate websites, and we receive an affiliate commission for any purchases made by you on the affiliate website using such links. Our affiliates include the following:') }}</p>
            <div class="flex items-center text-white group my-8">
                <img src="{{asset('/assets/img/logo_primary.svg')}}" alt="Logo" class="h-10">
                <div class="ml-1">
                    <p class="font-semibold text-primary text-md">my</p>
                    <h3 class="text-2xl font-bold leading-5 text-primary">Crypto.Tax</h3>
                </div>
            </div>

            <h6 class="text-lg font-semibold mt-8">{{ __('TESTIMONIALS DISCLAIMER') }}</h6>
            <p  class="mt-5 leading-loose">{{ __('The Site may contain testimonials by users of our products and/or services. These testimonials reflect the real-life experiences and opinions of such users. However, the experiences are personal to those particular users, and may not necessarily be representative of all users of our products and/or services. We do not claim, and you should not assume, that all users will have the same experiences. YOUR INDIVIDUAL RESULTS MAY VARY.') }}</p>
            <p  class="mt-3 leading-loose">{{ __('The Site may contain testimonials by users of our products and/or services. These testimonials reflect the real-life experiences and opinions of such users. However, the experiences are personal to those particular users, and may not necessarily be representative of all users of our products and/or services. We do not claim, and you should not assume, that all users will have the same experiences. YOUR INDIVIDUAL RESULTS MAY VARY.') }}</p>
            <p  class="mt-3 leading-loose">{{ __('The Site may contain testimonials by users of our products and/or services. These testimonials reflect the real-life experiences and opinions of such users. However, the experiences are personal to those particular users, and may not necessarily be representative of all users of our products and/or services. We do not claim, and you should not assume, that all users will have the same experiences. YOUR INDIVIDUAL RESULTS MAY VARY.') }}</p>
        </x-container>
    </div>
    <div class="bg-white">
        <x-footer-get-start/>
    </div>
    <x-footer/>
</x-guest-layout>