<div class="border rounded-sm p-6 relative">
    <div class="absolute w-14 h-14 rounded-bl-full bg-gray-200 top-0 right-0">
        <x-icon name="vaadin-medal" class="w-7 h-8 absolute top-2 right-2"/>
    </div>
    <div class="flex items-center space-x-6">
        <img src="{{ asset("assets/img/svg/avatar.svg") }}" class="rounded-lg w-18 h-18 object-cover"/>
        <div>
            <h3 class="text-xl font-bold">{{ __('Gary R. Anderson') }}</h3>
            <h4 class="text-base text-gray-400 my-1">{{ __('Financial Advisor') }}</h4>
            <div class="flex items-center space-x-1">
                <x-icon name="ri-star-fill" class="w-4 text-yellow-400"/>
                <x-icon name="ri-star-fill" class="w-4 text-yellow-400"/>
                <x-icon name="ri-star-fill" class="w-4 text-yellow-400"/>
                <x-icon name="ri-star-fill" class="w-4 text-yellow-400"/>
                <x-icon name="ri-star-fill" class="w-4 text-yellow-400"/>
                <p class="text-sm text-gray-400">{{ __('150 Reviews') }}</p>
            </div>
        </div>
    </div>
    <div class="flex flex-wrap items-center mt-7">
        @php
            $stacks = ['Tax Advisor', 'Insurance Agent', 'Financial investment broker', 'Insurance Agent']
        @endphp
        @foreach ($stacks as $stack)            
            <h4 class="text-md font-bold text-primary px-3 py-1 border rounded-md my-2 ml-1">{{ __($stack) }}</h4>
        @endforeach
    </div>
</div>