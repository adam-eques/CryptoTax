<div class="grid grid-cols-11 py-6 bg-white border rounded-sm cursor-pointer min-w-clg hover:bg-gray-100" wire:key='{{ $id }}'>
    <div class="flex items-center justify-center col-span-1">
        @if ( $node == "parent")                
            <div class="flex items-center justify-center w-6 h-6 bg-white rounded-full shadow-md">
                <svg class="w-4 transform trnstsn " fill="none" viewBox="0 0 24 24" stroke="currentColor" :class="{'rotate-180': selected == {{ $id }}}">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                </svg>
            </div>
        @endif
    </div>
    <div class="flex items-center justify-start col-span-2 px-5 space-x-2">
        <div class="flex items-center justify-center w-12 h-12 rounded-lg">
            <x-icon name="{{ $icon }}" class="w-full h-full"></x-icon>
        </div>
        <div>
            <p class="text-lg font-semibold ">{{ $name }}</p>
            <p class="text-sm text-gray-400">{{ $type }}</p>
        </div>
    </div>
    <div class="flex items-center justify-end col-span-1 space-x-2">
        <p class="text-lg">{{ $price }}</p>
    </div>
    <div class="flex items-center justify-center col-span-3 space-x-2">
        <div id="{{ $id }}" class="mx-16 -my-10"></div>
    </div>
    <div class="flex items-center justify-start col-span-1 space-x-2">
        <div>
            <p class="text-lg text-primary">{{ $holdingBtc }}</p>
            <p class="text-lg text-primary">{{ $holdingUsd }}</p>
        </div>
    </div>
    <div class="flex items-center justify-end col-span-1 space-x-2">
        <p class="text-xl font-bold">{{ $percent }} %</p>
    </div>
    <div class="flex items-center justify-center col-span-2 space-x-2">
        <div>
            <p class="pb-2 text-lg">{{ $pnlPrice }}</p>
            <x-badge type="square">+{{ $pnlPercent }}%</x-badge>
        </div>
    </div>
</div>

@push('scripts')
 <script>
        (function () {
            var options = {
                chart: {
                    type: 'line',
                    toolbar: {
                        show: false,
                    },
                    height: 100,
                    dropShadow: {
                        enabled: true,
                        top: 2,
                        left: 0,
                        blur: 1,
                        color: '#000',
                        opacity: 0.5
                    }
                },
                series: [{
                    name: 'Last 7 days',
                    data: @json(auth()->user()->myCryptoPortfolio()[2]['last7'])
                }],
                grid: {
                    show: false,
                    padding: {
                        left: 60,
                        right: 60,
                        top: -10,
                        bottom: -10
                    },
                },
                xaxis: {
                    labels: {
                        show: false,
                    },
                    axisBorder: {
                        show: false
                    },
                    axisTicks: {
                        show: false
                    },
                },
                tooltip: {
                    enabled: false
                },
                yaxis: {
                    show: false
                },
                legend: {
                    show: false
                },
                stroke: {
                    curve: 'straight',
                    width: 1
                },
                colors: ["{{ $lineColor }}"],              
            }
            const chart = new ApexCharts(document.getElementById(`{{ $id }}`), options);
            chart.render();
        }());
    </script>
@endpush