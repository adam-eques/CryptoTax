<x-app-layout>
    <x-page icon="wallet" :title="__('Accounts')">
        <div class="pb-8 flex flex-col md:flex-row -mx-2 lg:-mx-5 space-y-10 md:space-y-0">
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
                                        <p class="xl:text-xl text-gray-700 font-semibold">${{ moneyFormat($item["price"], 2) }}</p>
                                    </div>
                                @endforeach
                            </div>
                        </x-toggle-block>
                    @endforeach
                </div>
            </div>

            <!-- Right Panel -->
            <div class="px-2 lg:px-5 md:w-3/5">
                <x-card title="Coinbase" subtitle="Updating..." right="$698,189.000">
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
                </x-card>
            </div>
        </div>
    </x-page>
</x-app-layout>
