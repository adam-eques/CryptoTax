<div class="px-3 py-5 mx-auto my-5 bg-white rounded-sm shadow xs:px-4 lg:px-5 xl:max-w-screen-2xl" x-data="{ selected: '', category:'', action:'', isModalOpen:false }">
    <x-customers.customer-header-bar icon="carbon-wallet" name="Accounts">
        <x-button variant="white" class="col-span-1 border-primary" wire:click="sync">
            <x-icon name="fluentui-arrow-sync-16-o" class="w-5 mr-2" />{{ __('Sync ') }}
        </x-button>
        <x-button class="justify-center col-span-2" tag="a" href="{{ route('customer.account.new') }}">
            <x-icon name="bx-add-to-queue" class="w-5 mr-2"/>
            {{ __('Add New Account') }}
        </x-button>
    </x-customers.customer-header-bar>

    <div class="flex flex-col -mx-2 space-y-10 py-7 md:flex-row lg:-mx-5 md:space-y-0">
        <!-- Left Panel -->
        <div class="px-2 lg:px-5 md:w-2/5">
            <div class="flex flex-col gap-5 font-medium text-gray-900">
                @foreach($rows as $index => $row)
                    <x-toggle-block :label="$row['label']" :opened="true">
                        <div class="flex flex-col overflow-auto divide-y divide-gray-300" x-on:click="category=`{{ $row['label'] }}`; action=''">
                            @foreach($crypto_accounts as $crypto_account)
                                @if ( ($row['id'] == 1) && ($crypto_account->cryptoSource->type == "E"))
                                    <x-account-item-button
                                        wire:click="get_selected_account_id({{ $crypto_account->id }})"
                                        :label="$crypto_account->getName()"
                                        :selected="$crypto_account->id == $selected_account->id"
                                        balance="{{moneyFormat($crypto_account->getBalanceSum(), 2)}}"
                                    >
                                        <div wire:loading x-transition class="text-gray-400">{{ __('Updating...') }}</div>
                                        <div wire:loading.remove class="text-gray-400">{{ $crypto_account->fetched_at ? date("M d, Y, H:i", strtotime($crypto_account->fetched_at)) :'Never' }}</div>
                                    </x-account-item-button>
                                @elseif (($row['id'] == 3) && ($crypto_account->cryptoSource->type == "B"))
                                    <x-account-item-button
                                        wire:click="get_selected_account_id({{ $crypto_account->id }})"
                                        :label="$crypto_account->getName()"
                                        :selected="$crypto_account->id == $selected_account->id"
                                        balance="{{moneyFormat($crypto_account->getBalanceSum(), 2)}}"
                                    >
                                        <div wire:loading x-transition class="text-gray-400">{{ __('Updating...') }}</div>
                                        <div wire:loading.remove class="text-gray-400">{{$crypto_account->fetched_at ? date("M d, Y, H:i", strtotime($crypto_account->fetched_at)) :'Never'}}</div>
                                    </x-account-item-button>
                                @endif
                            @endforeach
                        </div>
                    </x-toggle-block>
                @endforeach
            </div>
        </div>

        <!-- Right Panel -->
        <div class="px-2 lg:px-5 md:w-3/5">
            <div class="w-full h-full border rounded">
                @if($crypto_accounts->count() && $selected_account)
                    <div class="flex justify-between w-full px-3 py-3 bg-gray-100 rounded lg:py-6 md:px-8">
                        <div>
                            <p class="font-bold sm:text-xl md:text-base lg:text-lg xl:text-xl">{{ $selected_account->getName() }}</p>
                            <div wire:loading class="text-gray-400">{{ __('Updating...') }}</div>
                            <div wire:loading.remove class="text-gray-400">{{ __( $selected_account->fetched_at ? date("M d, Y, H:i", strtotime($selected_account->fetched_at)) : "Never" ) }}</div>
                        </div>
                        <div class="flex items-center space-x-3">
                            <p class="font-bold sm:text-xl md:text-base lg:text-lg xl:text-xl">${{ moneyFormat($crypto_account->getBalanceSum(), 2) }}</p>
                            <x-button size="xs" wire:click="edit"  x-on:click="action='edit'">
                                <x-icon name="feathericon-edit" class="w-4 md:w-6"/>
                            </x-button>
                            <x-button size="xs" variant="danger" x-on:click="action='delete'">
                                <x-icon name="ri-delete-bin-6-line" class="w-4 md:w-6"/>
                            </x-button>
                        </div>
                    </div>
                    <div>
                        <div x-show="action == ''" class="overflow-auto">
                            <div class="max-h-full overflow-auto divide-y scrollbar">
                                @foreach ($selected_account->cryptoAssets()->get()->sortByDesc(function($assest){
                                    return $assest->convertTo();
                                }) as $asset)
                                    <x-account-assets-item :asset="$asset"/>
                                @endforeach
                            </div>
                        </div>
                        <div x-show="action == 'edit'">
                            <form wire:submit.prevent="save" autocomplete="off">
                                <div class="p-4">
                                    {{ $this->form }}
                                    <div class="mt-4 text-center">
                                        <x-button type="submit">{{ __("Save") }}</x-button>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div x-show="action =='delete'">
                        </div>
                    </div>
                @else
                    <div class="grid w-full grid-cols-1 gap-0 px-5 py-10 md:grid-cols-2 md:gap-5">
                        <div>
                            <img src='{{ asset('/assets/img/svg/account.svg') }}' class="h-full"/>
                        </div>
                        <div class="m-auto d-flex">
                            <div class="">
                                <h1 class="text-3xl font-bold">{{ __('ADD NEW ACCOUNT') }}</h1>
                                <h5 class="mt-4 text-xl font-bold">{{ __('Follow the myCrypto tax Instruction') }}</h5>
                                <p class="mt-4 text-gray-400">{{ __('Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. ') }}</p>
                                <x-button variant="primary" tag="a" href="{{route('customer.account.new')}}" class="mt-7">
                                    {{ __('Add Account') }}
                                    <x-icon name="heroicon-o-arrow-narrow-right" class="w-12 h-5"/>
                                </x-button>
                            </div>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>


    {{-- Delete Model --}}
    <div
        class="fixed inset-0 z-10 overflow-y-auto" aria-labelledby="modal-title" role="dialog" aria-modal="true"
        x-show="action == 'delete'"
        x-cloak
        x-transition
    >
        <div class="flex items-end justify-center min-h-screen px-4 pt-4 pb-20 text-center sm:block sm:p-0">
            <div class="fixed inset-0 transition-opacity bg-black bg-opacity-75" aria-hidden="true"></div>
                <span class="block sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>
                <div x-on:click.away="action = ''" class="inline-block px-5 py-5 overflow-hidden text-center align-bottom transition-all transform bg-white rounded-lg shadow-xl sm:my-8 sm:align-middle sm:max-w-lg sm:w-full">
                    <x-icon name="fas-exclamation-triangle" class="m-auto w-14 h-14"/>
                    <h4 class="mt-5 font-bold sm:text-xl md:text-base lg:text-lg xl:text-xl">{{ __('Are you sure?') }}</h4>
                    <p class="mt-5">{{ __('If you processed, you will lose all your transaction details. Are you sure you want to delete this Transaction?') }}</p>
                    <div class="flex items-center justify-center mt-10 space-x-5">
                        <x-button variant="white" x-on:click="action=''">{{ __('Cancel') }}</x-button>
                        <x-button variant="danger" wire:click='delete' x-on:click="action=''">{{ __('Confirm') }}</x-button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>



