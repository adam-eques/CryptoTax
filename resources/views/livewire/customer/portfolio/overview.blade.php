<div class="grid grid-cols-1 gap-3 py-5 sm:grid-cols-2 xl:grid-cols-4 md:gap-6">
    {{-- Because she competes with no one, no one can compete with her. --}}
    <div class="px-2 py-5 my-1 border rounded-md md:px-5">
        <div class="flex items-center justify-start px-5 space-x-4">
            <div class="relative rounded-full w-7 h-7 bg-success-500">
                <x-icon name='fas-arrow-up' class="absolute w-4 h-4 text-white -translate-x-1/2 -translate-y-1/2 top-1/2 left-1/2"/>
            </div>
            <p class="font-semibold">Total Return</p>
            <x-badge type="square">+ 117.94%</x-badge>
            <x-icon name="info" class="w-4 h-4"/>
        </div>
        <div class="flex items-end justify-between">
            <div class="flex items-start justify-start px-5">
                <span class="text-xl font-semibold">$</span>
                <span class="text-2xl font-semibold md:text-4xl">2,080</span>
            </div>
            <div class="h-16">
                <div id="situation-line-1"></div>
            </div>
        </div>
    </div>
    <div class="px-2 py-5 my-1 border rounded-md md:px-5">
        <div class="flex items-center justify-start px-5 space-x-4">
            <div class="relative rounded-full w-7 h-7 bg-danger">
                <x-icon name='fas-arrow-down' class="absolute w-4 h-4 text-white -translate-x-1/2 -translate-y-1/2 top-1/2 left-1/2"/>
            </div>
            <p class="font-semibold">Past Day</p>
            <x-badge type="square" variant="danger">- 117.94%</x-badge>
            <x-icon name="info" class="w-4 h-4"/>
        </div>
        <div class="flex items-end justify-between">
            <div class="flex items-start justify-start px-5">
                <span class="text-xl font-semibold">$</span>
                <span class="text-2xl font-semibold md:text-4xl">1,025</span>
            </div>
            <div class="h-16">
                <div id="situation-line-2"></div>
            </div>
        </div>
    </div>
    <div class="flex flex-col justify-between px-2 py-5 my-1 border rounded-md md:px-5">
        <div class="flex items-center justify-start px-5 space-x-4">
            <div>
                <x-icon name="deposit" class="w-6 h-6 text-secondary" />
            </div>
            <p class="text-sm font-semibold">Net Deposits</p>
            <x-icon name="info" class="w-4 h-4"/>
        </div>
        <div class="flex items-start justify-start px-5 pt-4">
            <span class="text-xl font-semibold">$</span>
            <span class="text-2xl font-semibold md:text-4xl">12,259</span>
        </div>
    </div>
    <div class="flex flex-col justify-between px-2 py-5 my-1 border rounded-md md:px-5">
        <div class="flex items-center justify-start px-5 space-x-4">
            <div>
                <x-icon name="coin-1" class="w-6 h-6 text-secondary" />
            </div>
            <p class="font-semibold">Net Proceeds</p>
            <x-icon name="info" class="w-4 h-4"/>
        </div>
        <div class="flex items-start justify-start px-5 pt-4">
            <span class="text-xl font-semibold">$</span>
            <span class="text-2xl font-semibold md:text-4xl">1,256</span>
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
                    height: '100%'
                },
                series: [{
                    name: 'sales',
                    data: [30,50,35,50,49,20,70,30,50]
                }],
                grid: {
                    show: false
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
                yaxis: {
                    show: false
                },
                legend: {
                    show: false
                },
                stroke: {
                    curve: 'smooth',
                    width: 1
                },
                colors: ["#ee8f8d"],              
            }
            const chart = new ApexCharts(document.getElementById(`situation-line-2`), options);
            chart.render();

            var options_1 = {
                chart: {
                    type: 'line',
                    toolbar: {
                        show: false,
                    },
                    height: '100%'
                },
                series: [{
                    name: 'sales',
                    data: [30,50,35,50,49,20,70,30,50]
                }],
                grid: {
                    show: false
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
                yaxis: {
                    show: false
                },
                legend: {
                    show: false
                },
                stroke: {
                    curve: 'smooth',
                    width: 1
                },
                colors: ["#73e26c"],              
            }
            const chart_1 = new ApexCharts(document.getElementById(`situation-line-1`), options_1);
            chart_1.render();
        }());
    </script>
@endpush