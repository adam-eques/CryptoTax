<div>
    <div class="flex items-center justify-between">
        <div class="flex items-center justify-start col-span-3 py-5 space-x-6">
            <x-icon name="carbon-portfolio" class="w-10 h-8"/>
            <h4 class="text-xl font-bold md:text-2xl">{{ __('My Crypto Portfolio') }}</h4>
        </div>
        <x-button tag="a" href="{{ route('customer.asset') }}">{{ __('See all assets') }}</x-button>
    </div>
    <div class="h-full overflow-auto scrollbar">
        <table class="min-w-[720px] w-full border rounded">
            <thead class="bg-white border shadow-md">
                <tr class="py-5">
                    <th class="py-5 pl-5 text-left">{{ __('Name') }}</th>
                    <th class="py-5 text-right">{{ __('Holdings') }}</th>
                    <th class="py-5 text-right">{{ __('Price') }}</th>
                    <th class="py-5 text-center">{{ __('All time unrealized return') }}</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($portfolios as $portfolio)                    
                    <tr class="px-5">
                        <td class="flex items-center px-3 py-5 space-x-4">
                            <x-icon name="{{ 'coins.' . strtolower($portfolio['symbol']) }}" class="w-14 h-14"/>
                            <div class="text-left">
                                <p class="font-semibold text-black ">{{ $portfolio['name'] }}</p>
                                <p class="text-gray-400">{{ $portfolio['symbol'] }}</p>
                            </div>
                        </td>
                        <td class="py-5 text-right">
                            <p>{{ $portfolio['holding_cc'] }}</p>
                            <p class="text-gray-400">{{ $portfolio['holding_fiat'] }}</p>
                            <p>{{ $portfolio['symbol'] }}</p>
                        </td>
                        <td class="py-5 text-right">
                            <p>{{ $portfolio['price'] }}</p>
                        </td>
                        <td class="py-5 text-center">
                            <p>{{ $portfolio['unrealized'] }}</p>
                            <x-badge variant="danger" type="square">{{ $portfolio['unrealized_percent'] }}%</x-badge>
                        </td>
                    </tr>             
                @endforeach
            </tbody>
        </table>
    </div>
</div>
