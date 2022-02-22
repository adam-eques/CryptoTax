<div class="grid grid-cols-1 gap-4 md:gap-8 sm:grid-cols-2 lg:grid-cols-4">
    @php
        $items = [
            [ 'icon' => 'net-worth', 'name' => 'Net Worth', 'balance' => '40,307,515.403' ],
            [ 'icon' => 'claim', 'name' => 'to be Claimed', 'balance' => '10,254,.023' ],
            [ 'icon' => 'money', 'name' => 'Total Assets', 'balance' => '60,637,515.403' ],
            [ 'icon' => 'debt', 'name' => 'Total Debts', 'balance' => '-2630.02' ]
        ]        
    @endphp
    @foreach ($items as $item)        
        <div class="p-5 space-y-4 border rounded-md">
            <x-icon name="{{ $item['icon'] }}" class="w-16 h-14"/>
            <div class="flex items-center space-x-4">
                <h5 class="text-gray-400">{{ __($item['name']) }}</h5>
                <x-badge variant="success" type='square'>{{ __('+ $ 117,94.0') }}</x-badge>
                <x-icon name="info" class="w-4 text-gray-500"/>
            </div>
            <h3 class="flex items-start text-2xl font-bold xl:text-3xl"><span class="text-base">$</span>{{ __($item['balance']) }}</h3>
        </div>
    @endforeach
</div>
