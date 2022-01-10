<x-app-layout>
    <div class="mx-auto my-5 px-3 xs:px-4 xl:max-w-screen-2xl lg:px-5 py-5 bg-white rounded-sm shadow">
        <div class="w-full border-b py-2">
            <div class="grid grid-cols-1 md:grid-cols-5">
                <div class="flex items-center justify-start space-x-6 col-span-3 py-5">
                    <x-icon name="transaction-1" class="w-8 h-8"/>
                    <h1 class="font-bold sm:text-xl lg:text-2xl text-primary">{{ __('Transactions') }}</h1>
                </div>
                <div class="grid grid-cols-1 lg:grid-cols-3 gap-0 lg:gap-3 col-span-2 py-2">
                    <button class="px-2 lg:px-4  py-3 text-primary hover:text-white bg-white hover:bg-primary inline-flex justify-center border border-primary rounded-lg w-full">
                        {{ __('Download CSV') }}
                    </button>
                    <button class="border border-primary hover:bg-primary rounded-lg w-full h-full py-3 text-primary hover:text-white">{{ __('Add transaction') }}</button>
                    <button 
                        class="flex justify-center items-center border rounded-lg w-full h-full bg-primary hover:bg-secondary text-white py-3 px-1"
                    >
                        <x-icon name="wallet-1" class="w-8 mr-3"/>
                        {{ __('Add wallet') }}
                    </button>
                </div>
            </div>
        </div>
        <div class="my-9">
            @livewire('transaction.overview')
        </div>
        @livewire('transaction.trans-list')
    </div>
</x-app-layout>