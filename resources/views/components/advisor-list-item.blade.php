<div class="border rounded p-7">
    <div class="flex items-center justify-between">
        <img src="{{ asset("assets/img/svg/avatar.svg") }}" class="object-cover rounded-lg w-18 h-18"/>
        <div class="text-right">
            <div class="flex items-center justify-end space-x-4">
                <x-icon name="fas-heart" class="w-4 h-4 text-primary"/> 
                {{-- <x-icon name="far-heart" class="w-4 h-4 text-primary"/> --}}
                <h3 class="text-2xl font-bold">5.0</h3>
            </div>
            <div class="flex items-end my-1 space-x-1">
                <x-icon name="ri-star-fill" class="w-4 text-yellow-400"/>
                <x-icon name="ri-star-fill" class="w-4 text-yellow-400"/>
                <x-icon name="ri-star-fill" class="w-4 text-yellow-400"/>
                <x-icon name="ri-star-fill" class="w-4 text-yellow-400"/>
                <x-icon name="ri-star-fill" class="w-4 text-yellow-400"/>
            </div>
            <p class="text-sm text-gray-400">{{ __('150 Reviews') }}</p>
        </div>
    </div>
    <h3 class="mt-5 text-xl font-bold">{{ __('Gary R. Anderson') }}</h3>
    <h4 class="mt-1 text-base text-gray-400">{{ __('Financial Advisor') }}</h4>
    <p class="mt-4 text-gray-400">{{ __('Illud scripserit mei an, sea te sonet partem contentiones. Eu quo enim corrumpit euripidis, ') }}</p>
    <div class="flex flex-wrap items-center mb-5">
        @php
            $stacks = ['Tax Advisor', 'Insurance Agent', 'Financial investment broker']
        @endphp
        @foreach ($stacks as $stack)            
            <h4 class="px-2 py-1 my-2 ml-1 font-bold border rounded-md text-md text-primary">{{ __($stack) }}</h4>
        @endforeach
    </div>
    <div class="mt-9">
        <a href="{{ route('customer.advisor.detail', ['id' => 1]) }}" class="px-4 py-2 font-semibold text-white rounded-md bg-primary hover:bg-secondary">{{ __('View Profile') }}</a>
    </div>
</div>
