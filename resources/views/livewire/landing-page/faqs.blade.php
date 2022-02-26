<div class="grid grid-cols-1 gap-10 mt-10 lg:grid-cols-2 lg:gap-30 md:mt-16 xl:mt-30">
    <div class="relative p-5">
        <img src="{{ asset('assets/img/subpage_images/landing_logo_bg_pattern.svg') }}" class="absolute h-auto -mt-16 -ml-8"/>
        <div class="relative">
            <p class="my-5 text-2xl font-bold lg:text-3xl xl:text-4xl">{{ __('Frequently Asked Questions') }}</p>
            <p class="text-gray-400">{{ __("Here you'll find answers to the most common questions our users.") }}</p>
            <div class="mt-12 divide-y">
                @php
                    $faqs = [ 
                        [ "open" => false, "title" => "Is SEO a risky and time consuming proposition?", "content" => "There are many variations of passages of Lorem Ipsum available but the majority suffered is alteration in that words which don't look even slightly." ],
                        [ "open" => true, "title" => "How to choose a perfect digital marketing plan?", "content" => "There are many variations of passages of Lorem Ipsum available but the majority suffered is alteration in that words which don't look even slightly." ],
                        [ "open" => false, "title" => "Is it feasible to go for a complete website audit?", "content" => "There are many variations of passages of Lorem Ipsum available but the majority suffered is alteration in that words which don't look even slightly." ]
                    ]
                @endphp
                @foreach ($faqs as $faq)                            
                    <x-faq-toggle-block :label="$faq['title']" :opened="$faq['open']">{{ __($faq['content']) }}</x-faq-toggle-block>
                @endforeach
            </div>
        </div>
    </div>
    <div class="p-5">
        <img src="{{ asset('assets/img/subpage_images/landing_faqs.svg') }}" class="w-auto h-full" />
    </div>
</div>