<div class="border rounded p-7">
    <div class="flex justify-between items-center">
        <img src="{{ asset("assets/img/svg/avatar.svg") }}" class="rounded-lg w-18 h-18 object-cover"/>
        <div class="text-right">
            <div class="flex items-center justify-end space-x-4">
                <x-icon name="heart" class="w-4 h-4 text-primary"/>
                <h3 class="text-2xl font-bold">5.0</h3>
            </div>
            <div class="flex items-end space-x-1 my-1">
                <x-icon name="star-golden" class="w-4"/>
                <x-icon name="star-golden" class="w-4"/>
                <x-icon name="star-golden" class="w-4"/>
                <x-icon name="star-golden" class="w-4"/>
                <x-icon name="star-golden" class="w-4"/>
            </div>
            <p class="text-sm text-gray-400">{{ __('150 Reviews') }}</p>
        </div>
    </div>
    <h3 class="text-xl font-bold mt-5">{{ __('Gary R. Anderson') }}</h3>
    <h4 class="text-base text-gray-400 mt-1">{{ __('Financial Advisor') }}</h4>
    <p class="text-gray-400 mt-4">{{ __('Illud scripserit mei an, sea te sonet partem contentiones. Eu quo enim corrumpit euripidis, ') }}</p>
    <div class="flex flex-wrap items-center mt-5">
        @php
            $stacks = ['Tax Advisor', 'Insurance Agent', 'Financial investment broker']
        @endphp
        @foreach ($stacks as $stack)            
            <h4 class="text-md font-bold text-primary px-2 py-1 border rounded-md my-2 ml-1">{{ __($stack) }}</h4>
        @endforeach
    </div>
    <button class="text-white font-semibold bg-primary hover:bg-secondary px-4 py-2 mt-9 mb-5 rounded-md">{{ __('View Profile') }}</button>
</div>