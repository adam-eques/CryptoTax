<div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-4 gap-0 md:gap-4 py-5">
    {{-- Because she competes with no one, no one can compete with her. --}}
    <div class="shadow-md p-4 rounded-md bg-color-1 bg-opacity-10 my-2">
        <div class="flex items-center justify-start space-x-4 px-5">
            <div class="rounded-full w-6 h-6 bg-color-green relative">
                <x-icon name='fas-arrow-up' class="text-white w-4 h-4 absolute top-1 left-1" />
            </div>
            <p class="font-bold">Total Return</p>
            <div class="bg-color-green px-2 py-1 rounded-lg">
                <span class="text-lg font-bold text-white">+117.94%</span>
            </div>
            <img src="{{asset('assets/img/icon/noti.png')}}" class="w-4 h-4"/>
        </div>
        <div class="flex justify-start items-start px-5 pt-4">
            <span class="text-xl font-bold">$</span>
            <span class=" text-5xl font-extrabold">20,806</span>
        </div>
    </div>
    <div class="shadow-md p-4 rounded-md bg-color-danger-500 bg-opacity-10 my-2">
        <div class="flex items-center justify-start space-x-4 px-5">
            <div class="rounded-full w-6 h-6 bg-color-danger-500 relative">
                <x-icon name='fas-arrow-down' class="text-white w-4 h-4 absolute top-1 left-1" />
            </div>
            <p class="font-bold">Past Day</p>
            <div class="bg-color-danger-500 px-2 py-1 rounded-lg">
                <span class="text-lg font-bold text-white">-117.94%</span>
            </div>
            <img src="{{asset('assets/img/icon/noti.png')}}" class="w-4 h-4"/>
        </div>
        <div class="flex justify-start items-start px-5 pt-4">
            <span class="text-xl font-bold">$</span>
            <span class=" text-5xl font-extrabold">1,025</span>
        </div>
    </div>
    <div class="shadow-md p-4 rounded-md bg-color-primary-500 bg-opacity-10 my-2">
        <div class="flex items-center justify-start space-x-4 px-5">
            <div>
                <img src="{{asset('assets/img/icon/net_deposits.png')}}" class="text-white w-8 h-8" />
            </div>
            <p class="font-bold">Net Deposits</p>
            <img src="{{asset('assets/img/icon/noti.png')}}" class="w-4 h-4"/>
        </div>
        <div class="flex justify-start items-start px-5 pt-4">
            <span class="text-xl font-bold">$</span>
            <span class=" text-5xl font-extrabold">12,259</span>
        </div>
    </div>
    <div class="shadow-md p-4 rounded-md bg-color-warning-500 bg-opacity-10 my-2">
        <div class="flex items-center justify-start space-x-4 px-5">
            <div>
                <img src="{{asset('assets/img/icon/net_proceeds.png')}}" class="text-white w-8 h-8" />
            </div>
            <p class="font-bold">Net Proceeds</p>
            <img src="{{asset('assets/img/icon/noti.png')}}" class="w-4 h-4"/>
        </div>
        <div class="flex justify-start items-start px-5 pt-4">
            <span class="text-xl font-bold">$</span>
            <span class=" text-5xl font-extrabold">1,256</span>
        </div>
    </div>
</div>
