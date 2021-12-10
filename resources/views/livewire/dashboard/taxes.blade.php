<div class="bg-white shadow-sm rounded-md px-8 py-4 my-5">
    {{-- The best athlete wants his opponent at his best. --}}
    <div class="flex items-center justify-between">
        <div class="flex items-center space-x-3">
            <img src="{{asset('assets/img/icon/taxes.png')}}" class="w-6 h-8"/>
            <h1 class="text-lg text-black font-extrabold">Crypto Taxes</h1>
        </div>
        <div>
            <button class="bg-color text-white rounded-lg py-2 px-5 text-sm">See Details</button>
        </div>
    </div>
    <div class="py-5">
       <table class="w-full text-center">
           <thead class="border bg-gray-100">
               <tr>
                   <th class="py-5">Tax year</th>
                   <th class="py-5">Gains</th>
                   <th class="py-5">Income</th>
               </tr>
           </thead>
           <tbody class="border">
                <tr class="border">
                    <td class="py-5 flex items-center space-x-6 justify-center">2021 <img src="{{asset('assets/img/icon/noti.png')}}" class="w-4 h-4 ml-3"/></td>
                    <td class="py-5">+ $2,456.00</td>
                    <td class="py-5">$1659.00</td>
                </tr>
                <tr class="border py-5">
                    <td class="py-5 flex items-center space-x-6 justify-center">2020 <img src="{{asset('assets/img/icon/noti.png')}}" class="w-4 h-4 ml-3"/></td>
                    <td class="py-5">+ $2,456.00</td>
                    <td class="py-5">$1659.00</td>
                </tr>
                <tr class="border py-5">
                    <td class="py-5 flex items-center space-x-6 justify-center">2019 <img src="{{asset('assets/img/icon/noti.png')}}" class="w-4 h-4 ml-3"/></td>
                    <td class="py-5">+ $2,456.00</td>
                    <td class="py-5">$1659.00</td>
                </tr>
           </tbody>
       </table>
    </div>
</div>