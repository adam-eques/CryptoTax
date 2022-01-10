<div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-4 gap-0 md:gap-4 py-5">
    {{-- Because she competes with no one, no one can compete with her. --}}
    <div class="shadow-md p-4 rounded-md bg-lightgreen my-2">
        <div class="flex items-center justify-start space-x-4 px-5">
            <div class="rounded-full w-6 h-6 bg-success-500 relative">
                <x-icon name='fas-arrow-up' class="text-white w-4 h-4 absolute top-1 left-1" />
            </div>
            <p class="font-bold">Total Return</p>
            <div class="bg-success-500 px-2 py-1 rounded-lg">
                <span class="text-lg font-bold text-white">+117.94%</span>
            </div>
            <img src="{{asset('assets/img/icon/noti.png')}}" class="w-4 h-4"/>
        </div>
        <div class="flex items-center justify-between">
            <div class="flex justify-start items-start px-5">
                <span class="text-xl font-bold">$</span>
                <span class=" text-5xl font-extrabold">20,806</span>
            </div>
            <div class="h-16">
                <div id="situation-line-1"></div>
            </div>
        </div>
    </div>
    <div class="shadow-md p-4 rounded-md bg-lightpink my-2">
        <div class="flex items-center justify-start space-x-4 px-5">
            <div class="rounded-full w-6 h-6 bg-danger-500 relative">
                <x-icon name='fas-arrow-down' class="text-white w-4 h-4 absolute top-1 left-1" />
            </div>
            <p class="font-bold">Past Day</p>
            <div class="bg-danger-500 px-2 py-1 rounded-lg">
                <span class="text-lg font-bold text-white">-117.94%</span>
            </div>
            <img src="{{asset('assets/img/icon/noti.png')}}" class="w-4 h-4"/>
        </div>
        <div class="flex items-center justify-between">
            <div class="flex justify-start items-start px-5">
                <span class="text-xl font-bold">$</span>
                <span class=" text-5xl font-extrabold">1,025</span>
            </div>
            <div class="h-16">
                <div id="situation-line-2"></div>
            </div>
        </div>
    </div>
    <div class="shadow-md p-4 rounded-md bg-lightblue my-2">
        <div class="flex items-center justify-start space-x-4 px-5">
            <div>
                <x-icon name="deposit" class="text-secondary w-6 h-6" />
            </div>
            <p class="font-bold">Net Deposits</p>
            <x-icon name="info" class="w-4 h-4"/>
        </div>
        <div class="flex justify-start items-start px-5 pt-4">
            <span class="text-xl font-bold">$</span>
            <span class=" text-5xl font-extrabold">12,259</span>
        </div>
    </div>
    <div class="shadow-md p-4 rounded-md bg-lightblue my-2">
        <div class="flex items-center justify-start space-x-4 px-5">
            <div>
                <x-icon name="coin-1" class="text-secondary w-6 h-6" />
            </div>
            <p class="font-bold">Net Proceeds</p>
            <x-icon name="info" class="w-4 h-4"/>
        </div>
        <div class="flex justify-start items-start px-5 pt-4">
            <span class="text-xl font-bold">$</span>
            <span class=" text-5xl font-extrabold">1,256</span>
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
                    width: 3
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
                    width: 3
                },
                colors: ["#73e26c"],              
            }
            const chart_1 = new ApexCharts(document.getElementById(`situation-line-1`), options_1);
            chart_1.render();
        }());
    </script>
@endpush