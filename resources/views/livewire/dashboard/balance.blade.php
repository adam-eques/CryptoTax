<div class="bg-white py-4 px-8 rounded-md shadow-md">
    {{-- A good traveler has no fixed plans and is not intent upon arriving. --}}
    <div class="flex items-center justify-between">
        <div class="flex items-center space-x-3">
            <img src="{{asset('assets/img/icon/coin.png')}}" class="w-8 h-8"/>
            <h1 class="text-lg text-black font-extrabold">My Balance</h1>
        </div>
        <div class="flex items-center space-x-3">
            <button class="hover:bg-primary p-3 rounded-md">
                <x-icon name="fas-th-large" class="w-6 h-6 text-secondary-400 hover:text-white"/>
            </button>
            <button class="hover:bg-primary p-3 rounded-md">
                <x-icon name="fas-list" class="w-6 h-6 text-secondary-400 hover:text-white"/>
            </button>
        </div>
    </div>
    <div class="py-5">
        <img src="{{asset('assets/img/svg/credit_card.svg')}}" class=" w-9/12 mx-auto"/>
    </div>
    <div class="grid grid-cols-1 xl:grid-cols-2 gap-0 md:gap-4 mt-4">
        <div>
            <p class="text-md text-secondary-500">Total Balance</p>
            <h2 class="text-black font-extrabold text-2xl">$ 124, 563, 000</h2>
            <div class="w-full bg-gray-200 rounded-full h-1.5 dark:bg-gray-700 mt-5 mb-7">
                <div class="bg-primary h-1.5 rounded-full" style="width: 86%"></div>
            </div>            
        </div>
        <div>
            <p class="text-md text-secondary-500">Your Tax</p>
            <h2 class="text-black font-extrabold text-2xl">$ 124, 563, 000</h2>
            <div class="w-full bg-gray-200 rounded-full h-1.5 dark:bg-gray-700 mt-5 mb-7">
                <div class="bg-primary h-1.5 rounded-full" style="width: 96%"></div>
            </div>
           
        </div>
        <button class="bg-primary hover:bg-secondary p-3 rounded-lg flex items-center space-x-5 my-2">
            <div class="px-3 py-2 bg-white rounded-lg">
                <img src="{{asset('assets/img/icon/wallet_icon.png')}}" class="w-8 h-8"/>
            </div>
            <h4 class="text-lg font-extrabold text-white">Add Wallet</h4>
        </button>
        <button class="bg-third hover:bg-secondary p-3 rounded-lg flex items-center space-x-5 my-2">
            <div class="px-3 py-2 bg-white rounded-lg">
                <img src="{{asset('assets/img/icon/tax_icon.png')}}" class="w-8 h-8"/>
            </div>
            <h4 class="text-lg font-extrabold text-white">Tax Optimizion</h4>
        </button>
    </div>
</div>
