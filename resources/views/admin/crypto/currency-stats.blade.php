<x-app-layout>
    <x-slot name="title">Crypto Currency List</x-slot>

    <p class="mb-2">Currently existing conversion rows: <strong>{{ number_format(\App\Models\CryptoCurrencyConversion::query()->count()) }}</strong></p>

    <style>
        tr:nth-child(even) {background-color: #f2f2f2;}
        tr:hover { background-color: #FFFF99}
        table td {
            padding: 5px;
        }
        th small {
           font-weight: normal;
            margin: 0 3px;
        }
    </style>

    <?php
    $counter = 1;
    echo "<table class='text-sm'>";
    echo "<tr class='border-2'>
            <th>#</th>
            <th>ID</th>
            <th>Coin<br><small>_currencies.name</small></th>
            <th>Coin-Short<br><small>_currencies.short_name</small></th>
            <th>CoinGeckoId<br><small>_currencies.coingecko_id</small></th>
            <th>Market cap<br><small>_currencies.market_cap</small></th>
            <th>History Fetch From<br><small>_currencies.fetched_history_date_from</small></th>
            <th>History Fetch Till<br><small>_currencies.fetched_history_date_till</small></th>
            <th>Latest Price Date<br><small>_conversions.price_date</small></th>
            <th>Oldest Price Date<br><small>_conversions.price_date</small></th>
            <th>Price Row Count<br><small>_conversions.*</small></th>
        </tr>";
    foreach($coins AS $coin) {
        $latest = $coin->cryptoCurrencyConversions()->orderBy("price_date", "DESC")->first();
        $oldest = $coin->cryptoCurrencyConversions()->orderBy("price_date", "ASC")->first();
        $priceRowCount = $coin->cryptoCurrencyConversions()->count();

        echo "<tr class='border-2'>";
        echo "<td style='text-align: right'>" . $counter++ ."</td>";
        echo "<td style='text-align: right'>" . $coin->id ."</td>";
        echo "<td>" . $coin->name ."</td>";
        echo "<td>" . $coin->short_name ."</td>";
        echo "<td>" . $coin->coingecko_id ."</td>";
        echo "<td style='text-align: right'>" . number_format($coin->market_cap) ."</td>";
        echo "<td>" . $coin->fetched_history_date_from ."</td>";
        echo "<td>";
        echo $coin->fetched_history_date_till;
        if($today != $coin->fetched_history_date_till) echo " *";
        echo "</td>";
        echo "<td>" . optional($latest)->price_date ."</td>";
        echo "<td>" . optional($oldest)->price_date ."</td>";
        echo "<td>" . $priceRowCount ."</td>";
        echo "</tr>";
    }
    echo "</table>";
    ?>
</x-app-layout>
