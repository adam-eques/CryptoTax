<div class="my-3 border rounded-lg sm:my-0">
    <div class="w-full px-3 py-2">
        <div class="flex items-center justify-between space-x-2">
            <h1 class="text-xl font-bold text-primary">${{ $amount }}</h1>
            @if ($increase)                
                <x-badge variant="success" size='sm' type='rounded'>+{{ $incdecamount }}%</x-badge>               
            @else
                <x-badge variant="danger" size='sm' type='rounded'>-{{ $incdecamount }}%</x-badge>
            @endif
        </div>
        <p class="text-xs text-primary">{{ $title }}</p>
    </div>
    <div id="{{ $id }}" class="-my-4"></div>
</div>

@push('scripts')
    <script>
        (function () {
            var options_status = {
                chart: {
                    type: 'area',
                    toolbar: {
                        show: false
                    },
                    height: 50
                },
                colors: ['#7A6CFF'],
                series: [{
                    name: 'sales',
                    data: @json($line)
                }],
                legend: {
                    show: false,
                    position: 'bottom'
                },
                grid: {
                    show: false,
                    padding: {
                        left: -5,
                        right: -5,
                        top: -10,
                        bottom: -16
                    },
                },
                stroke: {
                    width: 2
                },
                dataLabels: {
                    enabled: false
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
                    }
                },
                tooltip: {
                    enabled: false
                },
                yaxis: {
                    floating: true,
                    axisTicks: {
                        show: false
                    },
                    axisBorder: {
                        show: false
                    },
                    labels: {
                        show: false
                    },
                },
                fill: {
                    type: 'gradient'
                }
            }
            const chart_status = new ApexCharts(document.getElementById(`{{ $id }}`), options_status);
            chart_status.render();
        }());
    </script>
@endpush