<x-app-layout>
    <div class="bg-white">
        <div class="px-3 py-6 mx-auto xl:max-w-screen-2xl xs:px-4 lg:px-5">
            <div class="grid grid-cols-1 gap-0 md:grid-cols-12 md:gap-5">
                <div class="col-span-5 py-10 md:py-30">
                    <p class="text-3xl font-bold text-primary md:text-4xl xl:text-6xl">Refer Your Friend</p>
                    <p class="mt-5 text-3xl text-primary md:text-4xl xl:text-6xl">and get rewarded</p>
                    <p class="mt-4 text-base text-primary">Invite friends to trade on mycrypto tax to get 40% off the trading  fees as commission. Once Your friend  becomes  mycrypto tax affiliate, you can enjoy second -level commission.
                    </p>
                </div>
                <div class="col-span-7 p-5">
                    <img src="{{asset('assets/img/svg/invite.svg')}}" class="w-full h-full"/>
                </div>
            </div>
        </div>
        <div id="overview" class="w-full border-t border-b bg-bgcolor">
            <div class="px-3 py-12 mx-auto xl:max-w-screen-2xl xs:px-4 lg:px-5">
                @livewire('customer.invite.invite-overview')
            </div>
        </div>
        <div class="px-3 py-6 mx-auto xl:max-w-screen-2xl xs:px-4 lg:px-5">
            @livewire('customer.invite.invite-referral')
            @livewire('customer.invite.invite-list')
        </div>
    </div>
</x-app-layout>