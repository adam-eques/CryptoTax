<div class="mx-auto my-5 px-3 xs:px-4 lg:px-5 py-5 xl:max-w-screen-2xl  bg-white rounded-sm shadow" x-data="{ selected: '', category:'', action:'', isModalOpen:false }">
    <div class="w-full border-b pb-5">
        <div class="grid grid-cols-1 md:grid-cols-8">
            <div class="flex items-center justify-start space-x-3 col-span-6 py-6">
                <x-icon name="wallet" class="w-7 h-8"/>
                <h1 class="font-bold sm:text-xl lg:text-2xl text-primary">{{ __('Accounts') }}</h1>
            </div>
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-x-0 lg:gap-x-3 col-span-2 py-2">
                @if($account)
                    <x-button variant="white" class="border-primary col-span-1">
                        <x-icon name="sync" class="w-7 mr-2" wire:click="fetch_exchange({{$account}})"/>{{ __('Sync ') }}
                    </x-button>
                @elseif ($blockchain)
                    <x-button variant="white" class="border-primary col-span-1">
                        <x-icon name="sync" class="w-7 mr-2" wire:click="fetch_blockchain({{$blockchain}})"/>{{ __('Sync ') }}
                    </x-button>
                @else
                    <x-button variant="white" class="border-primary col-span-1" :disabled="true">
                        <x-icon name="sync" class="w-7 mr-2" wire:click="fetch_blockchain({{$blockchain}})"/>{{ __('Sync ') }}
                    </x-button>
                @endif
                <x-button class="col-span-2 justify-center" tag="a" href="{{ route('customer.account.new') }}">
                    <x-icon name="wallet-1" class="w-7 mr-2"/>
                    {{ __('Add New Account') }}
                </x-button>
            </div>
        </div>
    </div>
    <div class="p-7 flex flex-col md:flex-row -mx-2 lg:-mx-5 space-y-10 md:space-y-0">
        <!-- Left Panel -->
        <div class="px-2 lg:px-5 md:w-2/5">
            <div class="flex flex-col gap-5 text-gray-900 font-medium">
                @foreach($rows as $index => $row)
                    <x-toggle-block :label="$row['label']" :opened="true">
                        <div class="flex flex-col divide-y divide-gray-300 scrollbar overflow-auto max-h-100" x-on:click="category=`{{ $row['label'] }}`; action=''">
                            @foreach($row["items"] as $item)
                                @if (  $row['id'] == 1)
                                    <button
                                        class="flex justify-between space-x-2 py-2 lg:py-4 px-4 lg:px-6 items-center relative hover:bg-gray-100"
                                        wire:click="get_selected_account({{ $item->id }})"
                                    >
                                        <x-icon name="{{ $item->getName() }}" class="w-30 h-auto"/>
                                        <div class="space-y-1 text-left">
                                            <h3 class="xl:text-lg font-semibold text-gray-700">{{ $item->getName() }}</h3>
                                            <p class="text-gray-400 text-xs xl:text-md">Updating...</p>
                                        </div>
                                        <p class="xl:text-xl text-gray-700 font-semibold">${{ moneyFormat($item["price"], 2) }}</p>
                                        @if ($account && $account->getName() == $item->getName())                                            
                                            <div
                                                class="bg-secondary-500 rounded-br-sm rounded-tr-sm w-2 h-full absolute right-0"
                                                x-transition
                                            ></div>
                                        @endif
                                    </button>
                                @elseif ($row['id'] == 3)
                                    <button
                                        class="flex justify-between space-x-2 py-2 lg:py-4 px-4 lg:px-6 items-center relative hover:bg-gray-100"
                                        wire:click="get_selected_blockchain({{ $item->id }})"
                                    >
                                        <x-icon name="{{ explode(':',  $item->getName())[0] }}" class="w-30 h-auto"/>
                                        <div class="space-y-1 text-left">
                                            <h3 class="xl:text-lg font-semibold text-gray-700 uppercase">{{explode(':',  $item->getName())[0] }}</h3>
                                            <p class="text-gray-400 text-xs xl:text-md">Updating...</p>
                                        </div>
                                        <p class="xl:text-xl text-gray-700 font-semibold">${{ moneyFormat($item["balance"], 2) }}</p>
                                        @if ($blockchain && $blockchain->blockchain_id == $item->blockchain_id)                                            
                                            <div
                                                class="bg-secondary-500 rounded-br-sm rounded-tr-sm w-2 h-full absolute right-0"
                                                x-transition
                                            ></div>
                                        @endif
                                    </button>
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
                @if($cryptoExchangeAccounts->count() || $blockchainAccounts->count())
                    {{-- Right panel for Exchanges --}}
                    @if ($account)
                        <div class="w-full flex justify-between py-3 lg:py-6 px-8 bg-gray-100 rounded">
                            <div>
                                <p class="font-bold sm:text-xl md:text-base lg:text-lg xl:text-xl">{{ $account->getName() }}</p>
                                <p class="text-gray-400">{{ __('Updating...') }}</p>
                            </div>
                            <div class="flex items-center space-x-3">
                                <p class="font-bold sm:text-xl md:text-base lg:text-lg xl:text-xl">${{ moneyFormat(0.00, 2) }}</p>
                                <x-button size="xs" wire:click="edit_exchange" x-on:click="action='edit'">
                                    <x-icon name="edit" class="w-6"/>
                                </x-button>
                                <x-button size="xs" variant="danger" x-on:click="action='delete'">
                                    <x-icon name="fas-trash-alt" class="w-6"/>
                                </x-button>
                            </div>
                        </div>
                        <div>
                            <div x-show="action == ''" class="overflow-auto">
                                <div class="divide-y max-h-110">
                                    @foreach ($account->balances()->get() as $balance)                                        
                                        <div class="flex justify-between items-center px-5 py-3">
                                            <div class="flex items-center space-x-4">
                                                <x-icon name="{{str_replace(' ', '-',strtolower( $balance->cryptoCurrency()->get()[0]->getName()))}}" class="w-14 h-14"/>
                                                <div>
                                                    <p class="font-bold">{{$balance->cryptoCurrency()->get()[0]->getName()}} Wallet</p>
                                                    <p class="text-gray-400">102 Transactions</p>
                                                </div>
                                            </div>
                                            <div class="flex items-center space-x-4">
                                                <div>
                                                    <p class="font-bold">$ 2013.00</p>
                                                    <p class="text-gray-400">{{$balance->balance}} {{$balance->cryptoCurrency()->get()[0]->short_name}}</p>
                                                </div>
                                                <x-button variant="white" class="rounded-full border-primary">View Transaction</x-button>
                                            </div>
                                        </div>
                                    @endforeach                                   
                                </div>
                            </div>
                            <div x-show="action == 'edit'">
                                <form wire:submit.prevent="save_exchange">
                                    <div class="p-4">
                                        {{ $this->form }}
                                        <div class="text-center mt-4">
                                            <x-button type="submit">{{ __("Save") }}</x-button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                            <div x-show="action =='delete'">
    
                            </div>
                        </div>
                    @elseif ($blockchain)
                        {{-- Right Panel for Blockchain --}}
                        <div class="w-full flex justify-between py-3 lg:py-6 px-8 bg-gray-100 rounded">
                            <div>
                                <p class="font-bold sm:text-xl md:text-base lg:text-lg xl:text-xl uppercase">{{ explode(':',  $blockchain->getName())[0] }}</p>
                                <p class="text-gray-400">{{ __('Updating...') }}</p>
                            </div>
                            <div class="flex items-center space-x-3">
                                <p class="font-bold sm:text-xl md:text-base lg:text-lg xl:text-xl">${{ moneyFormat($blockchain["balance"], 2) }}</p>
                                <x-button size="xs" x-on:click="action='edit'">
                                    <x-icon name="edit" class="w-6"/>
                                </x-button>
                                <x-button size="xs" variant="danger" x-on:click="action='delete'">
                                    <x-icon name="fas-trash-alt" class="w-6"/>
                                </x-button>
                            </div>
                        </div>
                        <div>
                            <div x-show="action == ''" class="p-5">
                                <div class="text-center">
                                    <p class="font-bold sm:text-xl md:text-base lg:text-lg xl:text-xl">{{ __("Transaction Details") }}</p>
                                    <p>{{ __() }}</p>
                                </div>
                            </div>
                            <div x-show="action == 'edit'" class="py-10 flex justify-center">
                                <div class="mx-auto">
                                    <label>{{__('*Address')}}</label>
                                    <div class="mt-1">
                                        <input class=" h-10 transition duration-75 px-3 rounded-lg shadow-sm focus:border-primary-600 focus:ring-1 focus:ring-inset focus:ring-primary-600 border border-primary-300" name="address" wire:model.defer="newBlockchainAddress" placeholder="Address" />
                                        <x-button wire:click="add">Add</x-button>
                                    </div>
                                </div>
                            </div>
                            <div x-show="action =='delete'">
        
                            </div>
                        </div>
                    @endif
                @else
                    <div class="w-full px-5 py-10 grid grid-cols-1 md:grid-cols-2 gap-0 md:gap-5">
                        <div>
                            <img src='{{ asset('/assets/img/svg/account.svg') }}' class="h-full"/>
                        </div>
                        <div class="d-flex m-auto">
                            <div class="">
                                <h1 class="text-3xl font-bold">{{ __('ADD NEW ACCOUNT') }}</h1>
                                <h5 class="text-xl font-bold mt-4">{{ __('Follow the myCrypto tax Instruction') }}</h5>
                                <p class="text-gray-400 mt-4">{{ __('Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. ') }}</p>
                                <x-button variant="primary" tag="a" href="{{route('customer.account.new')}}" class="mt-7">
                                    {{ __('Add Account') }}
                                    <x-icon name="fas-arrow-right" class="h-5 w-12"/>
                                </x-button>
                            </div>
                        </div>
                    </div>    
                @endif
            </div>
        </div>
    </div>

    {{-- Modal --}}
    <div
        class="fixed z-10 inset-0 overflow-y-auto" aria-labelledby="modal-title" role="dialog" aria-modal="true"
        x-show="action == 'delete'"
        x-on:click.away="action = ''"
        x-cloak
        x-transition
    >
        <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
            <div class="fixed inset-0 bg-black bg-opacity-75 transition-opacity" aria-hidden="true"></div>
                <span class="block sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>
                <div class="inline-block align-bottom bg-white rounded-lg px-5 py-5 text-center overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full">
                    <x-icon name="fas-exclamation-triangle" class="w-14 h-14 m-auto"/>
                    <h4 class="font-bold sm:text-xl md:text-base lg:text-lg xl:text-xl mt-5">{{ __('Are you sure?') }}</h4>
                    <p class="mt-5">{{ __('If you processed, you will lose all your transaction details. Are you sure you want to delete this Transaction?') }}</p>
                    <div class="flex justify-center space-x-5 items-center mt-10">
                        <x-button variant="white" x-on:click="action=''">Cancel</x-button>
                        @if($account)
                            <x-button variant="danger" wire:click="delete_exchange({{ $account }})" x-on:click="action=''">Confirm</x-button>
                        @elseif($blockchain)
                            <x-button variant="danger" wire:click="delete_blockchain({{ $blockchain }})" x-on:click="action=''">Confirm</x-button>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


