<div class="grid grid-cols-11 min-w-clg py-6 rounded-md  cursor-pointer bg-white hover:bg-gray-100 border">
    <div class="col-span-1 flex justify-center items-center">
        @if ( $node == "parent")                
            <div class="w-8 h-8 bg-white shadow-md rounded-full flex justify-center items-center">
                <x-icon name="fas-chevron-down" class="text-secondary w-12 h-5"/>
            </div>
        @endif
    </div>
    <div class="col-span-2 flex justify-start items-center space-x-2 px-5">
        <div class="w-14 h-14 flex justify-center items-center bg-warning rounded-lg">
            <x-icon name="{{ $icon }}" class="w-10 h-10 text-white"></x-icon>
        </div>
        <div>
            <p class="text-xl font-semibold ">{{ $name }}</p>
            <p class="text-gray-400">{{ $type }}</p>
        </div>
    </div>
    <div class="col-span-1 flex justify-end items-center space-x-2">
        <p class="text-xl font-semibold ">{{ $price }}</p>
    </div>
    <div class="col-span-3 flex justify-center items-center space-x-2">
        <div id="{{ $id }}" class="-my-5"></div>
    </div>
    <div class="col-span-1 flex justify-start items-center space-x-2">
        <div>
            <p class="text-basic font-semibold text-primary">{{ $holdingBtc }}</p>
            <p class="text-primary">{{ $holdingUsd }}</p>
        </div>
    </div>
    <div class="col-span-1 flex justify-end items-center space-x-2">
        <p class="text-xl font-bold">{{ $percent }} %</p>
    </div>
    <div class="col-span-2 flex justify-center items-center space-x-2">
        <div>
            <p>{{ $pnlPrice }}</p>
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
                    height: 80,
                    dropShadow: {
                        enabled: true,
                        top: 3,
                        left: 0,
                        blur: 2,
                        color: '#000',
                        opacity: 0.75
                    }
                },
                series: [{
                    name: 'sales',
                    data: [30,50,35,50,49,20,70,30,50,90,89,70,120,110,50]
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