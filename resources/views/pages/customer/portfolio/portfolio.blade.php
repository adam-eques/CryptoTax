<x-app-layout>
    @if(auth()->user()->isCustomerAccount())
    <div class="mx-auto my-5 px-3 xs:px-4 xl:max-w-screen-2xl lg:px-5 py-5 bg-white rounded-sm shadow">
        <div>
            @livewire('portfolio.header')
        </div>
    </div>
    @endif
</x-app-layout>