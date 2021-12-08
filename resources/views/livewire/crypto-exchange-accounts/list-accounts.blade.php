@php($accounts = auth()->user()->cryptoExchangeAccounts)
<div>
    <p class="block font-bold mb-3">Your existing exchanges:</p>
    <ul class="list-disc block mb-8 p-5">
        @foreach($accounts as $account)
            <li>
                <a href="{{ route("customer.crypto-exchange.show", ["exchange" => $account->cryptoExchange]) }}" class="cursor-pointer text-color">
                    {{ $account->cryptoExchange->name }} (Last fetched: {{ $account->fetched_at ? $account->fetched_at->format("Y-m-d H:i:s") : "never" }})
                </a>
            </li>
        @endforeach
    </ul>
</div>
