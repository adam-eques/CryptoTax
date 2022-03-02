<div x-data="{'isModalOpen': false}">
    <p class="text-3xl font-semibold">Referral Link</p>
    <div class="grid grid-cols-1 px-10 py-5 mt-10 border bg-secondary-200 md:grid-cols-2 gap-x-0 md:gap-x-6">
        <div>
            <p class="text-base font-bold">Default referral link</p>
            <div  class="grid grid-cols-1 gap-0 mt-7 md:grid-cols-12 md:gap-6">
                <div class="col-span-5 py-1 text-center bg-white rounded-lg">
                    <p class="text-base">Default referral Code</p>
                    <div class="flex items-center justify-center py-2 space-x-5">
                        <p class="text-3xl font-bold">dQhR75</p>
                        <button><x-icon name="far-copy" class="w-5 h-6"/></button>
                    </div>
                    {{-- <div class="absolute w-10 h-10 rounded-full bg-bgcolor1 top-6 -left-5"/> --}}
                </div>
                <div class="col-span-7">
                    <p class="text-base">Default referral Link</p>
                    <div type='text' class="flex items-center justify-between py-0 mt-2 border-0 rounded-md bg-secondary-400">
                        <input value="https://www.mycryptotax.com/r/dQhR75" class="py-3 truncate bg-secondary-400 focus:outline-none hover:outline-none"/>
                        <button><x-icon name="far-copy" class="w-5 h-6"/></button>
                    </div>
                </div>
            </div>
        </div>
        <div>
            <p class="text-base font-bold">Remark</p>
            <div class="grid grid-cols-1 mt-7 md:grid-cols-3 gap-x-0 md:gap-x-7">
                <div class="h-full px-6 py-2 bg-white border rounded-lg">
                    <div class="flex items-center space-x-5">
                        <img src="{{ asset('assets/img/svg/avatar.svg') }}" class="w-11 h-11"/>
                        <p class="text-xl font-bold">40%</p>
                    </div>
                    <p class="mt-2 text-sm">Your Commission rate</p>
                </div>
                <div class="h-full px-6 py-2 bg-white border rounded-lg"">
                    <div class="flex items-center space-x-5">
                        <img src="{{ asset('assets/img/svg/users.svg') }}" class="w-11 h-11"/>
                        <p class="text-xl font-bold">0%</p>
                    </div>
                    <p class="mt-2 text-sm">Friend's fee discount</p>
                </div>
                <button class="flex items-center h-full px-6 py-2 space-x-3 border rounded-lg bg-primary hover:bg-secondary" x-on:click="isModalOpen = true">
                    <x-icon name="heroicon-o-share" class="w-10 h-10 text-white"></x-icon>
                    <p class="font-bold text-white text-basic">SHARE NOW</p>
                </button>
                @livewire('customer.invite.invite-share-link-modal')
            </div>
        </div>
    </div>

    <div class="grid grid-cols-1 px-10 py-5 mt-8 border bg-bgcolor md:grid-cols-12 gap-x-0 md:gap-y-6">
        <div class="col-span-5">
            <div class="flex space-x-8">
                <p class="text-base font-bold">Create referral link</p>
                <x-badge type="square" variant="secondary">Available links : 28</x-badge>
            </div>
            <p class="mt-4 text-sm">Set friend's fee discount</p>
            <div class="grid grid-cols-3 mt-5 md:grid-cols-5 gap-x-5">
                <button class="py-2 text-lg bg-white border rounded-md focus:text-2xl hover:bg-primary hover:text-white hover:font-bold focus:text-white focus:bg-primary focus:font-bold">0%</button>
                <button class="py-2 text-lg bg-white border rounded-md focus:text-2xl hover:bg-primary hover:text-white hover:font-bold focus:text-white focus:bg-primary focus:font-bold">5%</button>
                <button class="py-2 text-lg bg-white border rounded-md focus:text-2xl hover:bg-primary hover:text-white hover:font-bold focus:text-white focus:bg-primary focus:font-bold">10%</button>
                <button class="py-2 text-lg bg-white border rounded-md focus:text-2xl hover:bg-primary hover:text-white hover:font-bold focus:text-white focus:bg-primary focus:font-bold">15%</button>
                <button class="py-2 text-lg bg-white border rounded-md focus:text-2xl hover:bg-primary hover:text-white hover:font-bold focus:text-white focus:bg-primary focus:font-bold">20%</button>
            </div>
            <div class="mt-7">
                <p>Your Commission rate    <span class="mr-5 font-bold underline">40%</span> Friend's fee discount  <span class="font-bold underline text-secondary">0%</span></p>
            </div>
        </div>
        <div class="flex justify-end col-span-7">
            <div class="grid grid-cols-1 my-auto xl:grid-cols-3 gap-x-0 xl:gap-x-6">
                <div class="col-span-2">
                    <p class="text-bold">Remarks</p>
                    <input class="w-full px-6 py-4 mt-3 rounded-md" value="0-40 Characters"/>
                    <div class="relative flex items-start mt-4">
                        <div class="flex items-center h-5">
                            <input id="comments" aria-describedby="comments-description" name="comments" type="checkbox" class="w-4 h-4 text-indigo-600 border-gray-300 rounded-sm">
                        </div>
                        <div class="ml-3 text-sm">
                            <label for="comments" class="font-medium text-gray-700">Set as default link</label>
                        </div>
                    </div>
                </div>
                <div class="flex justify-end col-span-1 py-5">
                    <button class="flex items-center w-full px-8 py-6 my-auto rounded-lg bg-secondary hover:bg-primary">
                        <x-icon name="gmdi-create-o" class="w-10 h-10 text-white"></x-icon>
                        <p class="ml-3 font-bold text-white text-basic">CREATE NOW</p>
                    </button>
                </div>
            </div>
        </div>
    </div>

    <div class="mt-8 overflow-auto">
        <table class="w-full text-center border min-w-clg">
            <thead class="bg-bgcolor">
                <tr>
                    <th class="py-6">Referral code</th>
                    <th>Your commission rate/Friend's fee discount</th>
                    <th>Total Invitee</th>
                    <th>Avg.Commission (USDT)</th>
                    <th class="text-left">Remarks</th>
                    <th>Operation</th>
                </tr>
            </thead>
            <tbody>
                <tr class="border-b">
                    <td class="py-6">QBSSSSPLB</td>
                    <td>30% / 10%</td>
                    <td>0</td>
                    <td>0</td>
                    <td><x-icon name="edit" class="w-4 h-4 text-secondary"/></td>
                    <td class="text-secondary">Set as Default</td>
                </tr>
                <tr>
                    <td class="py-6">
                        <div class="flex items-center justify-center space-x-3">
                            <p>dQhR75</p>
                            <x-badge variant="secondary" type="square">Default</x-badge>
                        </div>
                    </td>
                    <td>30% / 10%</td>
                    <td>122</td>
                    <td>0</td>
                    <td><x-icon name="edit" class="w-4 h-4 text-secondary"/></td>
                    <td class="text-secondary">Set as Default</td>
                </tr>
            </tbody>
        </table>
    </div>
</div>
