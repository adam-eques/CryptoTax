<x-container>
    <div class="relative">
        <img src="{{ asset('assets/img/subpage_images/map_logo_background.svg') }}" class="absolute -translate-x-1/2 left-1/2"/>
        <div class="relative mt-16 text-center">
            <p class="my-5 text-2xl font-bold lg:text-3xl xl:text-4xl">{{ __('What our members are sayings') }}</p>
            <img src="{{ asset('assets/img/subpage_images/landing_testimonial_ fullmarks.svg') }}" class="flex mx-auto"/>
            @php
                $reviews = [
                    [ 'content' => "Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s", 'avatar' => 'assets/img/subpage_images/landing_testimonial_avatar.svg', 'name'=>'Londynn Vargas', 'score' => 5 ],
                    [ 'content' => "Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s", 'avatar' => 'assets/img/subpage_images/landing_testimonial_avatar.svg', 'name'=>'Londynn Vargas', 'score' => 5 ],
                    [ 'content' => "Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s", 'avatar' => 'assets/img/subpage_images/landing_testimonial_avatar.svg', 'name'=>'Londynn Vargas', 'score' => 5 ],
                ]
            @endphp
            <div class="w-full mt-18 main-carousel-1">
                @foreach ($reviews as $review)                            
                    <div class="w-full px-4 carousel-cell md:w-1/2 xl:w-1/3">
                        <div class="relative p-8 text-left bg-white rounded-md shadow-sm">
                            <x-icon name="quote" class="absolute w-8 top-4 right-4"/>
                            <p class="leading-loose">{{ __($review['content']) }}</p>
                            <div class="flex items-center mt-8 space-x-4">
                                <img src="{{ asset($review['avatar']) }}" class="w-16 h-16 rounded-md"/>
                                <div>
                                    <p class="text-lg font-bold">{{ __($review['name']) }}</p>
                                    <div class="flex items-center space-x-1">
                                        @for ($i = 0; $i < $review['score']; $i++)
                                            <x-icon name="star-1" class="w-5 h-5"/>                                            
                                        @endfor
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</x-container>

@push('scripts')
<script type="module">
    var elem_1 = document.querySelector('.main-carousel-1');
    var flkty = new Flickity( elem_1, {
        prevNextButtons: false,
        cellAlign: 'left',
        contain: true,
        pageDots: true
    });
</script>
@endpush
