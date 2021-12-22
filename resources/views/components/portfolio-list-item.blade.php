<div class="grid grid-cols-11 min-w-clg py-6 rounded-md  cursor-pointer bg-white hover:bg-gray-100 border">
    <div class="col-span-1 flex justify-center items-center">
        @if ( $node == "parent")                
            <div class="w-8 h-8 bg-white shadow-md rounded-full flex justify-center items-center">
                <x-icon name="fas-chevron-down" class="text-secondary w-12 h-5"/>
            </div>
        @endif
    </div>
    <div class="col-span-2 flex justify-start items-center space-x-2 px-5">
        <div class="w-14 h-14 flex justify-center items-center rounded-lg">
            <x-icon name="{{ $icon }}" class="w-full h-full"></x-icon>
        </div>
        <div>
            <p class="text-lg font-semibold ">{{ $name }}</p>
            <p class="text-gray-400 text-sm">{{ $type }}</p>
        </div>
    </div>
    <div class="col-span-1 flex justify-end items-center space-x-2">
        <p class="text-lg">{{ $price }}</p>
    </div>
    <div class="col-span-3 flex justify-center items-center space-x-2">
        <div id="{{ $id }}" class="-my-10"></div>
    </div>
    <div class="col-span-1 flex justify-start items-center space-x-2">
        <div>
            <p class="text-lg text-primary">{{ $holdingBtc }}</p>
            <p class="text-lg text-primary">{{ $holdingUsd }}</p>
        </div>
    </div>
    <div class="col-span-1 flex justify-end items-center space-x-2">
        <p class="text-xl font-bold">{{ $percent }} %</p>
    </div>
    <div class="col-span-2 flex justify-center items-center space-x-2">
        <div>
            <p class="text-lg pb-2">{{ $pnlPrice }}</p>
            <x-badge >+{{ $pnlPercent }}%</x-badge>
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
                    name: 'sales',
                    data: [10,30,25, 35,10,15,70,30,50,123,89,70,231,110,50]
                }],
                grid: {
                    show: false,
                    padding: {
                        left: 40,
                        right: 40,
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
                    tooltip: {
                        enabled: false
                    }
                },
                yaxis: {
                    show: false
                },
                legend: {
                    show: false
                },
                stroke: {
                    curve: 'straight',
                    width: 2
                },
                colors: ["{{ $lingColor }}"],              
            }
            const chart = new ApexCharts(document.getElementById(`{{ $id }}`), options);
            chart.render();
        }());
    </script>
@endpush