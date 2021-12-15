<div class="bg-white shadow-md rounded-md p-5 mt-5">
    {{-- The best athlete wants his opponent at his best. --}}
    <div class="flex items-center justify-between">
        <div class="flex items-center space-x-3">
            <img src="{{asset('assets/img/icon/taxes.png')}}" class="w-6 h-8"/>
            <h1 class="text-lg text-black font-extrabold">Crypto Taxes</h1>
        </div>
        <div>
            <x-button variant="primary">{{__('See Details')}}</x-button>
        </div>
    </div>
    <table class="w-full text-center mt-5">
        <thead class="border bg-gray-100">
            <tr>
                <th class="py-5">Tax year</th>
                <th class="py-5">Gains</th>
                <th class="py-5">Income</th>
            </tr>
        </thead>
        <tbody class="border">
             <tr class="border">
                 <td class="py-5 flex items-center space-x-6 justify-center">2021 <x-tooltip>Tool Tip</x-tooltip></td>
                 <td class="py-5">+ $2,456.00</td>
                 <td class="py-5">$1659.00</td>
             </tr>
             <tr class="border py-5">
                 <td class="py-5 flex items-center space-x-6 justify-center">2020 <x-tooltip>Tool Tip</x-tooltip></td>
                 <td class="py-5">+ $2,456.00</td>
                 <td class="py-5">$1659.00</td>
             </tr>
             <tr class="border py-5">
                 <td class="py-5 flex items-center space-x-6 justify-center">2019 <x-tooltip>Tool Tip</x-tooltip></td>
                 <td class="py-5">+ $2,456.00</td>
                 <td class="py-5">$1659.00</td>
             </tr>
        </tbody>
    </table>
</div>