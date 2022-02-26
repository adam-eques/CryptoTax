<x-guest-layout>
    <div class="w-full bg-white">
        <x-sub-page-hero icon="blogs" subtitle="" title="Our Blog"></x-sub-page-hero>
        <x-container class="py-10">
            <img src="{{ asset('assets/img/subpage_images/blog_headimage.svg') }}" class="w-full rounded-md"/>
            <h3 class="text-xl font-bold mt-9 md:text-3xl">{{ __('The Crypto project has reached seven billions') }}</h3>
            <p class="mt-6 text-gray-600">{{ __('Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum. Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt. Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit, sed quia non numquam eius modi tempora incidunt ut labore et dolore magnam aliquam quaerat voluptatem.') }}</p>
            <h4 class="text-xl font-semibold mt-14 md:text-2xl">{{ __('Pricing Page: 11 Must-Know Ways to Drive More Sales') }}</h4>
            <p class="mt-8 text-gray-600">{{ __('Leos qui ratione voluptatem sequi nesciunt. Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit, sed quia non numquam eius modi tempora incidunt ut labore et dolore magnam aliquam quaerat voluptatem. Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.') }}</p>
            <p class="mt-8 text-gray-600">{{ __('Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo.') }}</p>
            <div class="flex flex-wrap items-center justify-between pb-10 mt-20 border-b">
                <div class="flex items-center py-3 space-x-8">
                    <img src="{{ asset('assets/img/subpage_images/landing_testimonial_avatar.svg') }}" class="object-cover w-16 h-16 border rounded-full bg-gray-50"/>
                    <div>
                        <p class="text-lg font-semibold">{{ __('John Doe') }}</p>
                        <p class="text-gray-400">{{ __('Just now') }}</p>
                    </div>
                </div>
                <div class="flex items-center py-3 space-x-2">
                    <p class="text-gray-300">{{ __('Share------') }}</p>
                    <x-icon name="social.facebook-gray" class="w-6 h-6 text-gray-400"/>
                    <x-icon name="social.twitter-gray" class="w-6 h-6 text-gray-400"/>
                    <x-icon name="social.instagram-gray" class="w-6 h-6 text-gray-400"/>
                    <x-icon name="social.linkedin-gray" class="w-6 h-6 text-gray-400"/>
                </div>
            </div>
            <div class="py-10">
                <h5 class="text-lg font-bold text-gray-400">{{ __('3 Comments') }}</h5>
                <div class="px-10 py-5 mt-6 border rounded-md">
                    <x-comment/>
                    <div class="px-10 py-5 mt-6 border rounded-md">
                        <x-comment/>
                    </div>
                </div>
                <div class="px-10 py-5 mt-6 space-y-8">
                    <x-comment/>
                    <x-comment/>
                </div>
            </div>
        </x-container>
        <x-footer-get-start/>
    </div>
    <x-footer/>
</x-guest-layout>