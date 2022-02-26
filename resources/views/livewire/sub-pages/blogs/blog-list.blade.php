<div>
   <div class="grid grid-cols-1 gap-2 lg:grid-cols-2 md:gap-5 lg:gap-12 xl:gap-14 2xl:gap-24">
       <div>
           <img src="{{ asset('assets/img/subpage_images/blog.svg') }}" class="w-full"/>
       </div>
        <div>
            <x-badge variant="secondary" size="md" type="square">{{ __('The Newest') }}</x-badge>
            <h3 class="my-3 text-xl font-semibold lg:my-5 md:text-2xl">{{ __('The Crypto project has reached seven billions') }}</h3>
            <p class="pb-3 leading-loose text-gray-600 lg:pb-5">{{ __('means an entity that controls, is controlled by or is under common control with a party, where "control" means ownership of 50% or more of the shares, equity interest or other securities entitled to vote for election of directors or other managing authority') }}</p>
            <div class="flex items-center space-x-8">
                <img src="{{ asset('assets/img/subpage_images/landing_testimonial_avatar.svg') }}" class="object-cover w-16 h-16 border rounded-full bg-gray-50"/>
                <div>
                    <p class="text-lg font-semibold">{{ __('John Doe') }}</p>
                    <p class="text-gray-400">{{ __('Just now') }}</p>
                </div>
            </div>
       </div>
   </div>

   <div class="grid grid-cols-1 gap-5 mt-20 md:grid-cols-3 md:gap-10">
       @php
            $blogs = [
                [ 'id' => 1, 'img' => '', 'title' => '', 'content' => '', 'avatar' => '', 'name' => '', 'time' => '' ],
                [ 'id' => 2, 'img' => '', 'title' => '', 'content' => '', 'avatar' => '', 'name' => '', 'time' => '' ],
                [ 'id' => 3, 'img' => '', 'title' => '', 'content' => '', 'avatar' => '', 'name' => '', 'time' => '' ],
                [ 'id' => 4, 'img' => '', 'title' => '', 'content' => '', 'avatar' => '', 'name' => '', 'time' => '' ],
                [ 'id' => 5, 'img' => '', 'title' => '', 'content' => '', 'avatar' => '', 'name' => '', 'time' => '' ],
                [ 'id' => 6, 'img' => '', 'title' => '', 'content' => '', 'avatar' => '', 'name' => '', 'time' => '' ],
            ]
       @endphp
       @foreach ($blogs as $blog)           
            <div>
                <img src="{{ asset('assets/img/subpage_images/blog.svg') }}" class="w-full"/>
                <h3 class="my-3 text-lg font-semibold">{{ __('myCrypto Tax Enables NFT Tax Compliance and Portfolio Tracking') }}</h3>
                <p class="pb-3 leading-loose text-gray-600">{{ __('means an entity that controls, is controlled by or is under common control with a party, where "control" means ownership.') }}</p>
                <div class="flex items-center space-x-8">
                    <img src="{{ asset('assets/img/subpage_images/landing_testimonial_avatar.svg') }}" class="object-cover w-16 h-16 border rounded-full bg-gray-50"/>
                    <div>
                        <p class="text-lg font-semibold">{{ __('John Doe') }}</p>
                        <p class="text-gray-400">{{ __('Just now') }}</p>
                    </div>
                </div>
            </div>
       @endforeach
   </div>
</div>
