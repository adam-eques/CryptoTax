<x-guest-layout>
    <x-sub-page-hero icon="help" subtitle="We're here to help" title="Help Center"></x-sub-page-hero>
    <div class="relative bg-white py-12">
        <x-container>
            <h3 class="text-2xl font-bold">{{ __('Hi, How can we help you!') }}</h3>
            <div class="w-full border flex items-center mt-6 rounded">
                <input class="border-0 outline-none w-full py-4 px-3 rounded" placeholder="Add a Question">
                <button class="bg-primary text-white h-14 w-14 flex items-center justify-center">
                    <x-icon name="fas-search" class="w-5 h-5"/>
                </button>
            </div>
            <p class="mt-12 text-xl font-semibold">{{ __('Popular Questions') }}</p>
            <div class="flex flex-wrap gap-4 pt-8 pb-18 border-b">
                @php
                    $questions = [
                        "Lorem ipsum dolor sit ut labore et dolore magna ?", "Sorem do eiusmod tempor incididunt dolore ?", "Voluptatem accusantium doloremque?", "Consectetur adipiscing elit sed do eiusmod", "Donseced do eiusmod tempor incididunt ut labore magna aliqua"
                    ]
                @endphp
                @foreach ($questions as $question)                    
                    <div class="bg-gray-100 py-5 px-7 rounded">
                        <p>{{ __($question) }}</p>
                    </div>
                @endforeach
            </div>
            <div class="pt-12">
                <h6 class="text-xl font-semibold text-center">{{ __('Browse Our Help Desk') }}</h6>
                <div class="grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-4 mt-3 gap-4 md:gap-10 xl:gap-12 max-w-4xl mx-auto">
                    @php
                        $categories = [
                            ['image'=>'contact_email_category_account.svg', 'id'=>'account', 'label'=>'Account'],
                            ['image'=>'contact_email_category_price&plan.svg', 'id'=>'price-plans', 'label'=>'Pricing & plans'],
                            ['image'=>'contact_email_category_bug&error.svg', 'id'=>'bug-error', 'label'=>'Bug and Error'],
                            ['image'=>'contact_email_category_other.svg', 'id'=>'other', 'label'=>'Other'],
                        ]
                    @endphp
                    @foreach ($categories as $category)            
                        <div class="py-5">
                            <img src="{{ asset('assets/img/subpage_images/' . $category['image']) }}" class="flex mx-auto"/>
                            <div class="space-x-3 flex items-center justify-center">
                                <input id="{{ $category['id'] }}" name="category" type="radio" class="form-radio h-5 w-5 text-primary transition duration-150 ease-in-out" />
                                <p> {{ $category['label'] }} </p>
                            </div>
                        </div>
                    @endforeach
                </div>

                <div class="py-10">
                    @php
                        $faqs = [
                            [ 'label'=>'Is SEO a risky and time consuming proposition?', 'slot' => "it look like readable English. Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for 'lorem ipsum' will uncover many web sites still in their infancy. Various versions" ],
                            [ 'label'=>'Is SEO a risky and time consuming proposition?', 'slot' => "it look like readable English. Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for 'lorem ipsum' will uncover many web sites still in their infancy. Various versions" ], 
                            [ 'label'=>'Is SEO a risky and time consuming proposition?', 'slot' => "it look like readable English. Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for 'lorem ipsum' will uncover many web sites still in their infancy. Various versions" ],
                            [ 'label'=>'Is SEO a risky and time consuming proposition?', 'slot' => "it look like readable English. Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for 'lorem ipsum' will uncover many web sites still in their infancy. Various versions" ],
                            [ 'label'=>'Is SEO a risky and time consuming proposition?', 'slot' => "it look like readable English. Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for 'lorem ipsum' will uncover many web sites still in their infancy. Various versions" ], 
                            [ 'label'=>'Is SEO a risky and time consuming proposition?', 'slot' => "it look like readable English. Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for 'lorem ipsum' will uncover many web sites still in their infancy. Various versions" ],
                            [ 'label'=>'Is SEO a risky and time consuming proposition?', 'slot' => "it look like readable English. Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for 'lorem ipsum' will uncover many web sites still in their infancy. Various versions" ],
                        ]
                    @endphp
                    @foreach ($faqs as $faq)  
                        <div class="py-4 max-w-6xl mx-auto">
                            <x-toggle-block :opened="false" label="{{ $faq['label'] }}">
                                <div class="p-5">{{ __($faq['slot']) }}</div>
                            </x-toggle-block>
                        </div>                  
                    @endforeach
                </div>

                <div class="mt-10 bg-primary rounded-md p-5 md:p-14 max-w-6xl mx-auto">
                    <div class="grid grid-cols-1 md:grid-cols-12 items-center">
                        <div class="col-span-10 text-left text-white">
                            <h2 class="text-xl md:text-3xl font-bold">{{ __("Can't find What you are looking for?") }}</h2>
                            <p class="mt-3">{{ __('Under what license are Regular Labs extensions released?') }}</p>
                        </div>
                        <div class="col-span-2 py-3">
                            <x-button variant="secondary" class="font-bold tracking-tight">{{ __('Contact Us') }}</x-button>
                        </div>
                    </div>
                </div>
            </div>
        </x-container>
    </div>
    <div class="bg-white">
        <x-footer-get-start/>
        <x-footer/>
    </div>
</x-guest-layout>