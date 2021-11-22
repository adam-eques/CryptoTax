<x-app-layout>
    <div class="pt-8 mx-auto px-1 xs:px-4 xl:max-w-screen-2xl lg:px-5">
        <div class="bg-white border border-gray-200 px-2 xs:px-4 lg:px-8">
            <!-- Headings -->
            <div class="flex justify-between py-3 md:py-5 border-b border-gray-300">
                <div class="flex gap-2 lg:gap-4 text-gray-700  items-center">
                    <x-icon name="fas-wallet" class="w-6 h-6"></x-icon>
                    <h1 class="font-bold sm:text-xl md:text-2xl lg:text-3xl text-gray-700">{{ __('Wallets') }}</h1>
                </div>

                <div class="flex items-center gap-2 lg:gap-5">
                    <button type="button" class="inline-flex items-center justify-center gap-2 p-2 lg:py-4 md:px-4 lg:px-6 font-semibold tracking-wide text-blue-800 hover:text-white rounded border-color hover:border-color-1 border hover:bg-color-1 focus:shadow-outline focus:outline-none outline-none"
                            title="Sync Wallet">
                        <x-icon name="fas-sync" class="w-5"></x-icon>
                        <span class="hidden md:inline">{{ __("Sync Wallet") }}</span>
                    </button>
                    <button type="button" class="inline-flex items-center justify-center gap-2 p-2 lg:py-4 md:px-4 lg:px-6 font-semibold tracking-wide text-white  rounded bg-color hover:bg-color-1 focus:shadow-outline focus:outline-none  outline-none" title="Add Wallet / Exchange">
                        <x-icon name="fas-wallet" class="w-5"></x-icon>
                        <span class="hidden md:inline">{{ __("Add Wallet / Exchange") }}</span>
                    </button>
                </div>
            </div>

            <div class="pb-8 pt-4 md:pt-8 flex flex-col md:flex-row -mx-2 lg:-mx-5 space-y-10 md:space-y-0">
                <!-- Left Panel -->
                <div class="px-2 lg:px-5 md:w-2/5">
                    @php
                    $rows = [
                        ["label" => "Exchange", "items" => [["name" => "Coinbase", "price" => 2013.00], ["name" => "Binance US", "price" => 2.189], ["name" => "Coinbase Pro", "price" => 25.189], ["name" => "Gemini", "price" => 569.189]]],
                        ["label" => "Crypto Wallet", "items" => [["name" => "Binance US", "price" => 2.189], ["name" => "Coinbase Pro", "price" => 25.189]]],
                        ["label" => "Imported Wallet", "items" => [["name" => "Coinbase Pro", "price" => 25.189], ["name" => "Gemini", "price" => 569.189]]],
                        ["label" => "Other Transactions", "items" => [["name" => "Coinbase", "price" => 2013.00]]],
                    ];
                    @endphp
                    <div class="flex flex-col gap-5 text-gray-900 font-medium">
                        @foreach($rows as $index => $row)
                            <x-toggle-block :label="$row['label']" :opened="$index === 0">
                                <div class="flex flex-col divide-y divide-gray-300 scrollbar overflow-auto max-h-100">
                                    @foreach($row["items"] as $item)
                                        <div class="flex justify-between py-2 lg:py-4 px-4 lg:px-6 items-center">
                                            <div class="space-y-1">
                                                <h3 class="xl:text-xl font-semibold text-gray-700">{{ $item["name"] }}</h3>
                                                <p class="text-gray-400 text-xs xl:text-md">Updating...</p>
                                            </div>
                                            <p class="xl:text-xl text-gray-700  font-semibold">${{ number_format($item["price"], 2) }}</p>
                                        </div>
                                    @endforeach
                                </div>
                            </x-toggle-block>
                        @endforeach
                    </div>
                </div>

                <!-- Right Panel -->
                <div class="px-2 lg:px-5 md:w-3/5">

                    <div class="bg-white border border-gray-300 rounded overflow-hidden">
                        <!-- Heading -->
                        <div class="rounded-t bg-color-2 flex justify-between py-2 lg:py-4 px-4 lg:px-6 items-center border-b border-gray-300">
                            <div class="sm:space-y-1">
                                <h3 class="sm:text-xl uppercase text-gray-700  font-bold">Coinbase</h3>
                                <p class="text-gray-400 text-md">Updating...</p>
                            </div>
                            <p class="sm:text-xl text-gray-700  font-semibold">$698,189.000</p>
                        </div>
                        <div class="flex flex-col divide-y divide-gray-300 scrollbar overflow-auto max-h-100">
                            @php
                                $coins = [
                                    ["transactions" => 102, "price" => 20213, "amount" => 0.019848, "name" => "BTC"],
                                    ["transactions" => 45, "price" => 12456, "amount" => 2.025, "name" => "LTC"],
                                    ["transactions" => 88, "price" => 1.03, "amount" => 22.025, "name" => "XRP"],
                                    ["transactions" => 54, "price" => 2.85743, "amount" => 100.025, "name" => "MIOTA"],
                                    ["transactions" => 57, "price" => 25.045, "amount" => 5.77, "name" => "DASH"],
                                    ["transactions" => 258, "price" => 2258.6878, "amount" => 6.7889, "name" => "ETH"],
                                ];
                            @endphp
                            @foreach($coins as $coin)
                                <x-coin-row :coin="$coin"></x-coin-row>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
