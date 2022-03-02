<div 
    class="fixed inset-0 z-10 overflow-y-auto" aria-labelledby="modal-title" role="dialog" aria-modal="true"  
    x-show="isModalOpen"
    x-on:click.away="isModalOpen = false"
    x-cloak
    x-transition
>
    <div class="flex items-end justify-center min-h-screen px-4 pt-4 pb-20 text-center sm:block sm:p-0">
        <div class="fixed inset-0 transition-opacity bg-black bg-opacity-75" aria-hidden="true"></div>
            <span class="block sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>
            <div class="inline-block px-0 pt-5 overflow-hidden text-left align-bottom transition-all transform bg-white rounded-lg shadow-xl sm:my-8 sm:align-middle sm:max-w-3xl sm:w-full">
                <div class="flex justify-end px-4">
                    <button x-on:click="isModalOpen = false">
                        <x-icon name='fas-times-circle' class="w-4 h-4 text-gray-600"/>
                    </button>
                </div>
                <div class="px-4 text-center">
                    <p class="text-lg font-bold">Find the next Crypto gem on Mycrypto tax</p>
                    <p class="mt-5 text-xs">For every <span class="font-bold text-secondary">4 Crypto holders</span> in the world<br/> there's 1 from Mycryptotax Cryptocurrency exchange</p>
                    <img src="{{ asset('assets/img/svg/invite_share.svg') }}" class="w-full px-4"/>
                </div>
                <div class="grid items-end grid-cols-1 px-4 md:grid-cols-7 mt-9 gap-x-0 md:gap-x-4">
                    <div class="relative col-span-2">
                        <div class="block md:absolute -bottom-20 left-5">
                            <div class="flex items-center justify-center p-5 bg-white rounded-xl">
                                <img src="{{ asset('assets/img/svg/qr_code.svg') }}"/>
                            </div>
                            <p class="mt-3 font-bold text-center text-primary md:text-white">SHARE NOW</p>
                        </div>
                    </div>
                    <div class="col-span-3">
                        <p class="text-sm">Default referral Link</p>
                        <div class="flex items-center px-3 rounded-md bg-secondary-300">
                            <input type="text" class="w-full py-3 text-sm truncate border-0 rounded-md focus:outline-none focus:ring-0 bg-secondary-300" value="https://www.mycryptotax.com/r/dQhR75"/>
                            <button>
                                <x-icon name="copy" class="w-6 h-10"/>
                            </button>
                        </div>
                    </div>
                    <div class="col-span-2">
                        <x-button class="w-full">
                            <x-icon name="download" class="w-8 h-8 text-primary"/>
                            <p class="ml-2 text-sm">Download now</p>
                        </x-button>
                    </div>
                </div>
                <div class="flex flex-wrap justify-center mt-5 space-x-4 bg-primary py-9">
                   <x-icon name="social.facebook" class="my-2"/>
                   <x-icon name="social.twitter" class="my-2"/>
                   <x-icon name="social.youtube" class="my-2"/>
                   <x-icon name="social.instagram" class="my-2"/>
                   <x-icon name="social.linkedin" class="my-2"/>
                   <x-icon name="social.whatsapp" class="my-2"/>
                   <x-icon name="social.telegram" class="my-2"/>
                   <x-icon name="social.line" class="my-2"/>
                </div>
            </div>
        </div>
    </div>
</div>
