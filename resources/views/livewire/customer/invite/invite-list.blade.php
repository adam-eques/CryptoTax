<div class="px-3 py-6 mx-auto mt-16 xl:max-w-screen-2xl xs:px-4 lg:px-5">
    <p class="text-3xl font-semibold">Invitee List</p>
    <div class="mt-8 border-b">
        <div class="sm:hidden">
            <label for="tabs" class="sr-only">Select a tab</label>
            <select id="tabs" name="tabs" class="block w-full border-gray-300 rounded-md focus:ring-indigo-500 focus:border-indigo-500">
                <option>First-Level Invitee</option>
                <option selected>Second-Level Invitee</option>
            </select>
        </div>
        <div class="hidden sm:block">
            <nav class="flex items-end space-x-4" aria-label="Tabs">
                <button class="px-8 py-4 text-base font-bold bg-white border rounded-t-lg text-primary hover:text-white focus:text-white hover:bg-primary focus:bg-primary h-18 hover:h-20 focus:h-20">
                    <div class="flex items-center space-x-4">
                        <x-icon name="bi-trophy" class="w-8 h-8"/>
                        <p>First-Level Invitee</p>
                    </div>
                </button>
                <button class="px-8 py-4 text-base font-bold bg-white border rounded-t-lg text-primary hover:text-white focus:text-white hover:bg-primary focus:bg-primary h-18 hover:h-20 focus:h-20">
                    <div class="flex items-center space-x-4">
                        <x-icon name="phosphor-trophy" class="w-8 h-8"/>
                        <p>Second-Level Invitee</p>
                    </div>
                </button>
            </nav>
        </div>
    </div>
    <div class="flex items-center mt-12 space-x-5">
        <x-button size="md" variant="white">All</x-button>
        <x-button size="md" variant="white">This Month</x-button>
        <x-button size="md" variant="white">This Week</x-button>
    </div>
    <div class="overflow-auto mt-9">
        <div class="grid grid-cols-12 py-8 text-sm text-center border bg-bgcolor min-w-clg">
            <div class="col-span-2">Username</div>
            <div class="col-span-2">Registration Time (UTC+8)</div>
            <div class="col-span-1">Commission Rate</div>
            <div class="col-span-7">
                <div class="grid grid-cols-3">
                    <div>Trading Fees Last Week (USDT)</div>
                    <div>Commissons Last Week (USDT)</div>
                    <div>Total Commissions (USDT)</div>
                </div>
            </div>
        </div>
        <div class="p-5 px-5 space-y-5 border-b border-l border-r min-w-clg">
            <div class="grid w-full grid-cols-12 text-sm text-center border py-7 bg-bgcolor">
                <div class="col-span-2">1. Sample@gmail.com</div>
                <div class="col-span-2">2021 / 12 / 10 05:25:22</div>
                <div class="col-span-1">40%</div>
                <div class="col-span-7">
                    <div class="grid grid-cols-3">
                        <div>-</div>
                        <div>-</div>
                        <div>-</div>
                    </div>
                </div>
            </div>
            <div class="grid w-full grid-cols-12 text-sm text-center border py-7 bg-bgcolor">
                <div class="col-span-2">1. Sample@gmail.com</div>
                <div class="col-span-2">2021 / 12 / 10 05:25:22</div>
                <div class="col-span-1">40%</div>
                <div class="col-span-7">
                    <div class="grid grid-cols-3">
                        <div>-</div>
                        <div>-</div>
                        <div>-</div>
                    </div>
                </div>
            </div>
            <div class="grid w-full grid-cols-12 text-sm text-center border py-7 bg-bgcolor">
                <div class="col-span-2">1. Sample@gmail.com</div>
                <div class="col-span-2">2021 / 12 / 10 05:25:22</div>
                <div class="col-span-1">40%</div>
                <div class="col-span-7">
                    <div class="grid grid-cols-3">
                        <div>-</div>
                        <div>-</div>
                        <div>-</div>
                    </div>
                </div>
            </div>
            <div class="grid grid-cols-12 text-sm text-center border py-7 bg-bgcolor">
                <div class="col-span-2">1. Sample@gmail.com</div>
                <div class="col-span-2">2021 / 12 / 10 05:25:22</div>
                <div class="col-span-1">40%</div>
                <div class="col-span-7">
                    <div class="grid grid-cols-3">
                        <div>-</div>
                        <div>-</div>
                        <div>-</div>
                    </div>
                </div>
            </div>
            {{-- Page Nation --}}
            <div class="container mx-auto">
                <div class="flex items-center justify-end">
                    <p class="text-gray-600">Total 122 pieces of data</p>
                    <div class="flex justify-between h-8">
                        <div class="flex items-center justify-center">
                            <button class="flex items-center justify-center p-2 focus:outline-none focus:ring-2 focus:ring-gray-400">
                                <x-icon name="fas-angle-left" class="w-4 h-4"/>
                            </button>
                        </div>
                        <div class="flex justify-center md:mx-7 lg:mx-10 mx-5 items-center flex-row space-x-2.5 text-sm font-medium leading-none text-gray-600">
                            <div class="hidden md:block">
                                <p>...</p>
                            </div>
                            <div class="md:hidden">
                                <p>1</p>
                            </div>
                            <div>
                                <p class="hover:text-white hover:bg-indigo-700 cursor-pointer p-1.5 text-center rounded">2</p>
                            </div>
                            <div>
                                <p class="text-white bg-indigo-700 p-1.5 cursor-pointer text-center rounded">3</p>
                            </div>
                            <div>
                                <p class="hover:text-white hover:bg-indigo-700 cursor-pointer p-1.5 text-center rounded">4</p>
                            </div>
                            <div>
                                <p class="hover:text-white hover:bg-indigo-700 cursor-pointer p-1.5 text-center rounded">5</p>
                            </div>
                            <div class="hidden md:block">
                                <p>...</p>
                            </div>
                        </div>
                        <div class="flex items-center justify-center">
                            <button class="flex items-center justify-center p-2 focus:outline-none focus:ring-2 focus:ring-gray-400">
                                <x-icon name="fas-angle-right" class="w-4 h-4"/>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

