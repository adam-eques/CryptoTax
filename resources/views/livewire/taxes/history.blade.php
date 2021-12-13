<div class="border rounded-md p-5">
    {{-- Knowing others is intelligence; knowing yourself is true wisdom. --}}
    <h2 class="text-xl font-bold ">Transaction History</h2>
    <p class="text-lg font-bold py-5">Transactions: 125</p>
    <div class="flex items-center justify-center space-x-5">
        <button class="bg-color hover:bg-indigo-700 flex justify-center items-center px-5 py-3 rounded-lg space-x-5">
            <div class="bg-white px-3 py-1 rounded-lg">
                <img src="{{asset('assets/img/icon/sent.png')}}" class="w-10 h-10"/>
            </div>
            <p class="text-white text-xl font-bold">56 Sent</p>
        </button>
        <button class="bg-color-green hover:bg-green-700 flex justify-center items-center px-5 py-3 rounded-lg space-x-5">
            <div class="bg-white px-3 py-1 rounded-lg">
                <img src="{{asset('assets/img/icon/receive.png')}}" class="w-10 h-10"/>
            </div>
            <p class="text-white text-xl font-bold">56 Received</p>
        </button>        
    </div>
</div>
