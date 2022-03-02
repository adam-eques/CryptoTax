@php
    $lastweek= [
        'first_row' => [
            [ 'icon' => 'bi-trophy', 'amount' => '10', 'category' => 'First-level Invitee' ],
            [ 'icon' => 'phosphor-trophy', 'amount' => '10', 'category' => 'Second-level Invitee' ],
            [ 'icon' => 'go-people-24', 'amount' => '0', 'category' => 'Total - Invitee' ]
        ],
        'second_row' => [
            [ 'icon' => 'bi-trophy', 'amount' => '1.29', 'category' => 'First-level commission' ],
            [ 'icon' => 'phosphor-trophy', 'amount' => '10', 'category' => 'Second-level commission' ],
            [ 'icon' => 'healthicons-o-money-bag', 'amount' => '1.29', 'category' => 'Total commission' ]
        ]
    ];

    $total= [
        'first_row' => [
            [ 'icon' => 'bi-trophy', 'amount' => '122', 'category' => 'First-level Invitee' ],
            [ 'icon' => 'phosphor-trophy', 'amount' => '10', 'category' => 'Second-level Invitee' ],
            [ 'icon' => 'go-people-24', 'amount' => '122', 'category' => 'Total - Invitee' ]
        ],
        'second_row' => [
            [ 'icon' => 'bi-trophy', 'amount' => '1.29', 'category' => 'First-level commission' ],
            [ 'icon' => 'phosphor-trophy', 'amount' => '10', 'category' => 'Second-level commission' ],
            [ 'icon' => 'healthicons-o-money-bag', 'amount' => '1.29', 'category' => 'Total commission' ]
        ]
    ];
@endphp

<div>
    <P class="text-3xl font-semibold">Overview</P>
    <div class="px-3 py-8 bg-white border rounded-md mt-7 sm:px-12">
        <div class="grid grid-cols-1 md:grid-cols-12">
            <div class="flex items-center col-span-4 space-x-5">
                <div class="flex items-center justify-center w-16 rounded-lg h-14 bg-secondary">
                    <x-icon name="healthicons-o-money-bag" class="w-10 h-10 text-white"/>
                </div>
                <p class="text-2xl font-bold">Commissions Last Week</p>
            </div>
            <div class="flex items-center col-span-8 space-x-6">
                <div class="grid grid-cols-1 md:grid-cols-12 gap-y-2 gap-x-0 md:gap-x-5">
                    <x-button size="md" variant="secondary" class="col-span-3">First-level:40%</x-button>
                    <x-button size="md" class="col-span-3">Second-level : 5%</x-button>
                    <x-button size="md" class="justify-center col-span-6 bg-gray-400">Referral relationship : 365 Day(s)</x-button>
                </div>
            </div>
        </div>
        <div class="grid grid-cols-1 mt-12 md:grid-cols-12 gap-x-0 md:gap-x-6">
            <div class="grid grid-cols-1 col-span-5 xl:grid-cols-3 gap-x-0 xl:gap-x-6">
                @foreach ($lastweek['first_row'] as $item)                    
                    <div class="p-3 border rounded-lg bg-bgcolor">
                        <div class="flex items-center space-x-6">
                            <x-icon name="{{ $item['icon'] }}" class="w-8 h-10 text-secondary"/>
                            <p class="text-4xl font-bold">{{ $item['amount'] }}</p>
                        </div>
                        <p class="mt-4 text-sm text-center text-gray-600">{{ $item['category'] }}</p>
                    </div>
                @endforeach
            </div>
            <div class="grid grid-cols-1 col-span-7 xl:grid-cols-3 gap-x-0 xl:gap-x-6">
                @foreach ($lastweek['second_row'] as $item)                    
                    <div class="p-3 border rounded-lg bg-bgcolor">
                        <div class="flex items-center space-x-6">
                            <x-icon name="{{ $item['icon'] }}" class="w-8 h-10 text-secondary"/>
                            <p class="text-4xl font-bold">{{ $item['amount'] }} <span class="text-lg">USDT</span></p>
                        </div>
                        <p class="mt-4 text-sm text-center text-gray-600">{{ $item['category'] }}</p>
                    </div>
                @endforeach
            </div>
        </div>
    </div>

    <div class="px-3 py-8 mt-6 bg-white border rounded-md sm:px-12">
        <div class="grid grid-cols-1 md:grid-cols-12">
            <div class="flex items-center col-span-4 space-x-5">
                <div class="flex items-center justify-center w-16 rounded-lg h-14 bg-primary">
                    <x-icon name="healthicons-o-money-bag" class="w-10 h-10 text-white"/>
                </div>
                <p class="text-2xl font-bold">Total Commissions</p>
            </div>
        </div>
        <div class="grid grid-cols-1 mt-12 md:grid-cols-12 gap-x-0 md:gap-x-6">
            <div class="grid grid-cols-1 col-span-5 xl:grid-cols-3 gap-x-0 xl:gap-x-6">
                @foreach ($total['first_row'] as $item)                    
                    <div class="p-3 border rounded-lg bg-bgcolor">
                        <div class="flex items-center space-x-6">
                            <x-icon name="{{ $item['icon'] }}" class="w-8 h-10 text-secondary"/>
                            <p class="text-4xl font-bold">{{ $item['amount'] }}</p>
                        </div>
                        <p class="mt-4 text-sm text-center text-gray-600">{{ $item['category'] }}</p>
                    </div>
                @endforeach
            </div>
            <div class="grid grid-cols-1 col-span-7 xl:grid-cols-3 gap-x-0 xl:gap-x-6">
                @foreach ($total['second_row'] as $item)                    
                    <div class="p-3 border rounded-lg bg-bgcolor">
                        <div class="flex items-center space-x-6">
                            <x-icon name="{{ $item['icon'] }}" class="w-8 h-10 text-secondary"/>
                            <p class="text-4xl font-bold">{{ $item['amount'] }} <span class="text-lg">USDT</span></p>
                        </div>
                        <p class="mt-4 text-sm text-center text-gray-600">{{ $item['category'] }}</p>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
    <p class="text-sm text-gray-700 mt-9">* Commissions between 11/28 - 12/40 will be distributed on 12/07. Next distribution. 12/14(UTC+8) </p>
</div>
