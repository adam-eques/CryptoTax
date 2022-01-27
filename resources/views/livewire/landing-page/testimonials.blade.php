<div class="mx-auto px-3 xs:px-4 xl:max-w-screen-2xl lg:px-5 pt-5 md::pt-20 text-center relative">
    <div class="relative">
        <div class="absolute left-1/2 -translate-x-1/2">
            <img src="{{ asset('assets/img/svg/hero_pattern_2.svg') }}" class="mx-auto"/>
        </div>
        <p class="text-3xl md:text-4xl xl:text-5xl font-extrabold my-5">{{ __('What our members are sayings') }}</p>
        <img src="{{ asset('assets/img/svg/full_marks.svg') }}" class="flex mx-auto"/>
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8 mt-18 relative">
            @php
                $reviews = [
                    [ 'content' => "Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s", 'avatar' => 'assets/img/svg/avatar.svg', 'name'=>'Londynn Vargas', 'score' => 5 ],
                    [ 'content' => "Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s", 'avatar' => 'assets/img/svg/avatar.svg', 'name'=>'Londynn Vargas', 'score' => 5 ],
                    [ 'content' => "Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s", 'avatar' => 'assets/img/svg/avatar.svg', 'name'=>'Londynn Vargas', 'score' => 5 ],
                ]
            @endphp
            @foreach ($reviews as $review)                            
                <div class="bg-white shadow-sm rounded-md p-8 text-left">
                    <p>{{ __($review['content']) }}</p>
                    <div class="flex items-center space-x-4 mt-9">
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
            @endforeach
        </div>
    </div>
</div>