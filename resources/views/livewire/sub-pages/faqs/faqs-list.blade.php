<div>
    <x-container>
        <h5 class="text-xl font-bold">{{ __('Hi, How can we help you!') }}</h5>
        <div class="flex items-center mt-3 border rounded-sm">
            <input type="text" placeholder="Add a Question" class="w-full px-3 py-4 border-none rounded-sm outline-none focus:ring-0"/>
            <button class="px-6 text-white rounded-sm bg-secondary hover:bg-primary h-14">
                <x-icon name="fas-search" class="w-6 h-6"/>
            </button>
        </div>
        <div class="border-b">
            <div class="max-w-3xl py-10">
                <h5 class="text-xl font-bold">{{ __('Choose Category') }}</h5>
                <div class="grid grid-cols-1 gap-4 mt-3 sm:grid-cols-2 xl:grid-cols-4 md:gap-10 xl:gap-12">
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
            </div>
        </div>
        
        <div class="grid grid-cols-1 gap-6 py-10 lg:grid-cols-3 md:gap-14">
            <div class="col-span-2">
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
                    <div class="py-4">
                        <x-toggle-block :opened="false" label="{{ $faq['label'] }}">
                            <div class="p-5">{{ __($faq['slot']) }}</div>
                        </x-toggle-block>
                    </div>                  
                @endforeach
            </div>
            <div class="col-span-1">
                <div class="p-5 border rounded bg-bgcolor1 sm:p-10">
                    <p class="text-xl font-semibold">{{ __("Still have a questions?") }}</p>
                    <p class="py-4">{{ __("if you cannot find answer to your question in our FAQ, you can always contact us. we will answer to you shortly!") }}</p>
                    <x-button class="font-semibold">{{ __("Contact us") }}</x-button>
                </div>
            </div>
        </div>
    </x-container>
</div>
