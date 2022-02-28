<x-guest-layout>
    <x-sub-page-hero icon="help" subtitle="We're here to help" title="Help Center"></x-sub-page-hero>
    <div class="relative py-12 bg-white">
        <x-container>
            <h3 class="text-2xl font-bold">{{ __('Hi, How can we help you!') }}</h3>
            <div class="flex items-center w-full mt-6 border rounded">
                <input class="w-full px-3 py-4 border-0 rounded outline-none" placeholder="Add a Question">
                <button class="flex items-center justify-center text-white bg-primary h-14 w-14">
                    <x-icon name="fas-search" class="w-5 h-5"/>
                </button>
            </div>
            <p class="mt-12 text-xl font-semibold">{{ __('Popular Questions') }}</p>
            <div class="flex flex-wrap gap-4 pt-8 border-b pb-18">
                @php
                    $questions = [
                        "Lorem ipsum dolor sit ut labore et dolore magna ?", "Sorem do eiusmod tempor incididunt dolore ?", "Voluptatem accusantium doloremque?", "Consectetur adipiscing elit sed do eiusmod", "Donseced do eiusmod tempor incididunt ut labore magna aliqua"
                    ]
                @endphp
                @foreach ($questions as $question)                    
                    <div class="py-5 bg-gray-100 rounded px-7">
                        <p>{{ __($question) }}</p>
                    </div>
                @endforeach
            </div>
            <div class="pt-12">
                <h6 class="text-xl font-semibold text-center">{{ __('Browse Our Help Desk') }}</h6>
                <div class="grid max-w-4xl grid-cols-1 gap-4 mx-auto mt-3 sm:grid-cols-2 xl:grid-cols-4 md:gap-10 xl:gap-12">
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
                            <div class="flex items-center justify-center space-x-3">
                                <input id="{{ $category['id'] }}" name="category" type="radio" class="w-5 h-5 transition duration-150 ease-in-out form-radio text-primary" />
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
                        <div class="max-w-6xl py-4 mx-auto">
                            <x-toggle-block :opened="false" label="{{ $faq['label'] }}">
                                <div class="p-5">{{ __($faq['slot']) }}</div>
                            </x-toggle-block>
                        </div>                  
                    @endforeach
                </div>

                <div class="max-w-6xl p-5 mx-auto mt-10 rounded-md bg-primary md:p-14">
                    <div class="grid items-center grid-cols-1 md:grid-cols-12">
                        <div class="col-span-10 text-left text-white">
                            <h2 class="text-xl font-bold md:text-3xl">{{ __("Can't find What you are looking for?") }}</h2>
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