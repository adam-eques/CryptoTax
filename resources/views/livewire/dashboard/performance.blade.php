<div class="mt-14 bg-white shadow-md rounded-md py-12 px-8">
    {{-- Because she competes with no one, no one can compete with her. --}}
    <div class="grid grid-cols-1 2xl:grid-cols-4 md:grid-cols-2 md:gap-2 gap-0">
        <div class="flex items-center space-x-2 py-5">
            <img src="{{asset('assets/img/icon/donut.png')}}" class="w-8 h-8"/>
            <h1 class="text-lg text-black font-extrabold">My Performance</h1>
        </div>
        <div class="px-4 py-2 border rounded-sm">
            <p class="text-sm text-gray-400">24h Portfolio Change</p>
            <div class="flex items-center space-x-2 mt-3">
                <h1 class="text-2xl text-black font-extrabold">$1,254</h1>
                <span class="inline-flex items-center justify-center px-3 py-2 text-xs font-bold leading-none text-white bg-success-500 rounded-full">+2.5%</span>
            </div>
        </div>
        <div class="px-4 py-2 border rounded-sm">
            <p class="text-sm text-gray-400">Total Profit loss</p>
            <div class="flex items-center space-x-2 mt-3">
                <h1 class="text-2xl text-black font-extrabold">$95,432</h1>
                <div>
                    <span class="inline-flex items-center justify-center px-3 py-2 text-xs font-bold leading-none text-white bg-success-500 rounded-full">+13.5%</span>
                </div>
            </div>
        </div>
        <div class="px-4 py-2 border rounded-sm">
            <p class="text-sm text-gray-400">Total Balance</p>
            <div class="flex items-center space-x-2 mt-3">
                <h1 class="text-2xl text-black font-extrabold">$35,569</h1>
                <div>
                    <span class="inline-flex items-center justify-center px-3 py-2 text-xs font-bold leading-none text-white bg-green-500 rounded-full">+7.5%</span>
                </div>
            </div>
        </div>
    </div>
    <div class="flex justify-end mt-10 space-x-2">
        <button class="px-4 py-2 border rounded-sm cursor-pointer hover:bg-primary focus:bg-primary hover:text-white focus:text-white">
            <p>24H</p>
        </button>
        <button class="px-4 py-2 border rounded-sm cursor-pointer hover:bg-primary focus:bg-primary hover:text-white focus:text-white">
            <p>7D</p>
        </button>
        <button class="px-4 py-2 border rounded-sm cursor-pointer hover:bg-primary focus:bg-primary hover:text-white focus:text-white">
            <p>1M</p>
        </button>
        <button class="px-4 py-2 border rounded-sm cursor-pointer hover:bg-primary focus:bg-primary hover:text-white focus:text-white">
            <p>1Y</p>
        </button>
    </div>
    <div class="grid grid-cols-1 xl:grid-cols-8 gap-0 md:gap-4 mt-4 mb-8">
        <div class="col-span-3 p-4">
            <div id="line-chart_1"></div>
        </div>
        <div class="col-span-5 h-full">
            <div id="line-chart"></div>
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
                    show: false
                },
                height: "250",
            },
            stroke: {
                curve: 'smooth',
                width: 3
            },
            colors: ["#181C3A"],
            series: [{
                name: 'sales',
                data: [30,40,35,50,49,60,70,91,125]
            }],
            xaxis: {
                categories: [1991,1992,1993,1994,1995,1996,1997, 1998,1999]
            }
        }
        const chart = new ApexCharts(document.getElementById(`line-chart`), options);
        chart.render();


        var options_1 = {
            chart: {
                type: 'donut'
            },
            series: [44, 55, 13, 33],
            labels: ['Bitcoin', 'Ethereum', 'Ripple', 'Litecoin'],
            legend: {
                show: false,
                position: 'bottom'
            }
        }
        const chart_1 = new ApexCharts(document.getElementById(`line-chart_1`), options_1);
        chart_1.render();
    }());
</script>
@endpush