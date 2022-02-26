<div>
    <h5 class="text-xl font-bold">{{ __('Choose Category') }}</h5>
    <div class="grid grid-cols-1 gap-4 mt-8 sm:grid-cols-2 xl:grid-cols-4 md:gap-10 xl:gap-12">
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
    <div class="text-left mt-18">
        <div>
            <x-jet-label>{{ __('Category') }}</x-jet-label>
            <x-jet-input type="text" placeholder="Account access or email" class="w-full mt-4"/>
        </div>
        <div class="mt-6">
            <x-jet-label>{{ __('Topic') }}</x-jet-label>
            <x-jet-input type="text" placeholder="Change email address" class="w-full mt-4"/>
        </div>
        <div class="mt-9">
            <h5 class="text-lg font-bold">{{ __('Suggested Answer') }}</h5>
            <p class="py-2 font-bold text-secondary">{{ __('How can I change my Mycryptotax email') }}</p>
            <p>{{ __('You can change your Mycryptotax email at any time from the') }}  <a href="{{route('index')}}" class="font-bold text-secondary">{{ __('Settings page') }}</a></p>
        </div>
        <div class="mt-9">
            <x-jet-label>{{ __('Your Email') }}</x-jet-label>
            <x-jet-input type="text" placeholder="enter email address" class="w-full mt-4"/>
        </div>
        <div class="mt-5">
            <x-jet-label>{{ __('Please describe your issue') }}</x-jet-label>
            <textarea rows="5" class="w-full mt-4 border border-gray-300 shadow-lg"></textarea>
        </div>
        <div class="mt-5">
            <x-jet-label>{{ __('Screenshots or files') }}</x-jet-label>
            <x-jet-input type="text" placeholder="Select Files" class="w-full mt-4"/>
        </div>
        <div class="flex items-center mt-10 space-x-3">
            <x-button variant="secondary" class="font-bold">{{__("Submit Issue")}}</x-jet-button>
            <x-button variant="primary" class="font-bold" >{{__("Cancel")}}</x-jet-button>
        </div>
    </div>
</div>
