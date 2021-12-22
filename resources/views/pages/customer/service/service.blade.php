<x-app-layout>
    <div class="bg-bgcolor1 py-16">
        <div class="mx-auto px-3 xs:px-4 xl:max-w-screen-2xl">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-0 md:gap-5">
                <div class="">
                    <p class="text-lg">COUPON</p>
                    <h2 class="text-6xl font-bold mt-3">BIG NEW YEAR OFFER</h2>
                    <div class="mt-3 border-t-2 border-secondary py-4 flex mx-auto">
                        <h4 class="text-5xl text-secondary">UPTO <span class="font-bold">65%</span> OFF</h4>
                    </div>
                    <p class="mt-3">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. </p>
                    <x-button size="xl" class="mt-5 font-extrabold  py-6">Refer and Earn</x-button>
                </div>
                <div>
                    <img src="{{ asset('assets/img/svg/service.svg') }}" class="w-full h-full"/>
                </div>
            </div>
        </div>
    </div>
    <div class="bg-white py-24">
        <div class="mx-auto px-3 xs:px-4 xl:max-w-screen-2xl">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-x-0 md:gap-x-6 gap-y-6 md:gap-y-0">
                <div class="w-full grid grid-cols-1 xl:grid-cols-5 border rounded-md py-9 px-6 bg-white hover:bg-bgcolor">
                    <div class="col-span-2 border-r border-dashed flex items-center justify-center relative">
                        <img src="{{ asset('assets/img/svg/zalando.svg') }}" class="w-52 h-14"/>
                        <x-icon name="scissors" class="text-gray-400 w-6 h-6 absolute -right-3 top-8"/>
                    </div>
                    <div class="col-span-3 pl-10">
                        <div class="flex justify-between items-end">
                            <p class="text-secondary text-5xl font-bold">80% <span class="text-2xl">offer</span></p>
                            <div>
                                <button class="bg-secondary rounded-md">
                                    <div class="bg-primary hover:bg-secondary py-4 px-6 rounded-t-md rounded-bl-md rounded-br-3xl text-lg text-white font-bold">SHOW COUPON</div>
                                </button>
                                <p class="text-sm mt-2 ml-2">Expries <span class="text-secondary ml-2">12 Dec 2021</span></p>
                            </div>
                        </div>
                        <div class="mt-7">
                            <p class="font-bold">Get 30% off ZALANDO, Unlimited and  ZALANDO Family !</p>
                        </div>
                    </div>
                </div>

                <div class="w-full grid grid-cols-1 xl:grid-cols-5 border rounded-md py-9 px-6 bg-white hover:bg-bgcolor">
                    <div class="col-span-2 border-r border-dashed flex items-center justify-center relative">
                        <img src="{{ asset('assets/img/svg/zalando.svg') }}" class="w-52 h-14"/>
                        <x-icon name="scissors" class="text-gray-400 w-6 h-6 absolute -right-3 top-8"/>
                    </div>
                    <div class="col-span-3 pl-10">
                        <div class="flex justify-between items-end">
                            <p class="text-secondary text-5xl font-bold">80% <span class="text-2xl">offer</span></p>
                            <div>
                                <button class="bg-secondary rounded-md">
                                    <div class="bg-primary hover:bg-secondary py-4 px-6 rounded-t-md rounded-bl-md rounded-br-3xl text-lg text-white font-bold">SHOW COUPON</div>
                                </button>
                                <p class="text-sm mt-2 ml-2">Expries <span class="text-secondary ml-2">12 Dec 2021</span></p>
                            </div>
                        </div>
                        <div class="mt-7">
                            <p class="font-bold">Get 30% off ZALANDO, Unlimited and  ZALANDO Family !</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>