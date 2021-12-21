<div class="bg-white shadow-md rounded-md p-5 mt-6">
    {{-- The best athlete wants his opponent at his best. --}}
    <div class="flex items-center justify-between">
        <div class="flex items-center space-x-2">
            <x-icon name="tax" class="w-8 h-7"/>
            <p class="text-lg mr-3 font-extrabold">Crypto Taxes</p>
        </div>
        <div>
            <x-button variant="primary" class="font-normal">{{__('See Details')}}</x-button>
        </div>
    </div>
    <table class="w-full text-center mt-5 text-primary text-base">
        <thead class="border bg-gray-100">
            <tr>
                <th class="py-5 font-bold">Tax year</th>
                <th class="py-5 font-bold">Gains</th>
                <th class="py-5 font-bold">Income</th>
            </tr>
        </thead>
        <tbody class="border">
             <tr class="border">
                 <td class="py-5 flex items-center space-x-2 justify-center">
                     <p>2021</p> 
                     <x-icon name="info" class="w-3 h-3 text-gray-400"/> 
                </td>
                 <td class="py-5">+ $2,456.00</td>
                 <td class="py-5">$1659.00</td>
             </tr>
             <tr class="border py-5">
                 <td class="py-5 flex items-center space-x-2 justify-center">
                    <p>2020</p> 
                    <x-icon name="info" class="w-3 h-3 text-gray-400"/> 
                 </td>
                 <td class="py-5">+ $2,456.00</td>
                 <td class="py-5">$1659.00</td>
             </tr>
             <tr class="border py-5">
                 <td class="py-5 flex items-center space-x-2 justify-center">
                    <p>2019</p> 
                    <x-icon name="info" class="w-3 h-3 text-gray-400"/> 
                 </td>
                 <td class="py-5">+ $2,456.00</td>
                 <td class="py-5">$1659.00</td>
             </tr>
        </tbody>
    </table>
</div>