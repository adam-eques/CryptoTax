<div class="bg-white shadow-md rounded-md p-5 w-full mt-5 sm:mt-10">
    {{-- Because she competes with no one, no one can compete with her. --}}
    <div class="grid grid-cols-1 2xl:grid-cols-4 md:grid-cols-2 gap-0 md:gap-2">
        <div class="flex items-center space-x-2 py-5">
            <img src="{{asset('assets/img/icon/dashboard/performance.svg')}}" class="w-8 h-8"/>
            <x-typography size="lg" class="mr-3 font-extrabold">My Performance</x-typography>
        </div>
        <div class="border rounded-lg">
            <div class="w-full px-3 py-2">
                <div class="flex items-center space-x-2 justify-between">
                    <h1 class="text-2xl text-black font-extrabold">$1,254</h1>
                    <x-badge variant="success" size='sm' type='rounded'>{{ __('+2.5%')}}</x-badge>
                </div>
                <p class="text-sm text-gray-400">24h Portfolio Change</p>
            </div>
            <div id="areachart-1" class="-mt-5 -mb-5"></div>
        </div>
        <div class="border rounded-lg">
            <div class="w-full px-3 py-2">
                <div class="flex items-center space-x-2 justify-between">
                    <h1 class="text-2xl text-black font-extrabold">$95,254</h1>
                    <x-badge variant="success" size='sm' type='rounded'>{{ __('+2.5%')}}</x-badge>
                </div>
                <p class="text-sm text-gray-400">Total profit loss</p>
            </div>
            <div id="areachart-2" class="-mt-5 -mb-5"></div>
        </div>
        <div class="border rounded-lg">
            <div class="w-full px-3 py-2">
                <div class="flex items-center space-x-2 justify-between">
                    <h1 class="text-2xl text-black font-extrabold">$3,554</h1>
                    <x-badge variant="success" size='sm' type='rounded'>{{ __('+2.5%')}}</x-badge>
                </div>
                <p class="text-sm text-gray-400">24h Portfolio Change</p>
            </div>
            <div id="areachart-3" class="-mt-5 -mb-5"></div>
        </div>
    </div>
    <div class="flex justify-end mt-10 space-x-2">
        <x-button>
            <p>24H</p>
        </x-button>
        <x-button>
            <p>7D</p>
        </x-button>
        <x-button>
            <p>1M</p>
        </x-button>
        <x-button>
            <p>1Y</p>
        </x-button>
    </div>
    <div class="grid grid-cols-1 xl:grid-cols-8 gap-0 md:gap-4 mt-8">
        <div class="col-span-3">
            <div id="column_chart" class="-my-5"></div>
        </div>
        <div class="col-span-5 h-full">
            <div id="line-chart" class="-my-5"></div>
        </div>
    </div>
</div>

@push('scripts')
<script>

    (function () {
        var options = {
            chart: {
                type: 'area',
                toolbar: {
                    show: false
                },
                height: "300",
            },
            grid: {
                show: false,
                padding: {
                    left: 0,
                    right: 0,
                    top: 0,
                    bottom: 0
                },
            },
            dataLabels: {
                enabled: false
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
                type: 'area',
                toolbar: {
                    show: false
                },
                height: 50
            },
            colors: ['#7A6CFF'],
            series: [{
                name: 'sales',
                data: [143,24,34,123,23,25,100,91,23]
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
                    bottom: -10
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
            yaxis: {
                show: false
            },
            fill: {
                type: 'gradient'
            }
        }
        const chart_1 = new ApexCharts(document.getElementById(`areachart-1`), options_1);
        chart_1.render();

        var options_2 = {
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
                data: [143,24,34,123,23,25,100,91,23]
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
                    bottom: -10
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
            yaxis: {
                show: false
            },
            fill: {
                type: 'gradient'
            }
        }
        const chart_2 = new ApexCharts(document.getElementById(`areachart-2`), options_2);
        chart_2.render();

        var options_3 = {
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
                data: [143,24,34,123,23,25,100,91,23]
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
                    bottom: -10
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
        const chart_3 = new ApexCharts(document.getElementById(`areachart-3`), options_3);
        chart_3.render();

        var options_4 = {
            series: [
                {
                    name: 'Inflation',
                    data: [2.3, 3.1, 4.0, 10.1, 4.0],
                }
            ],
            chart: {
                height: 300,
                type: 'bar',
                toolbar: {
                    show: false
                },
            },
            theme: {
                palette: 'palette1'
            },
            plotOptions: {
                bar: {
                    borderRadius: 10,
                    dataLabels: {
                        position: 'top',
                    },
                }
            },
            dataLabels: {
                enabled: true,
                formatter: function (val) {
                    return val + "$";
                },
                offsetY: -20,
                style: {
                    fontSize: '16px',
                    colors: ["#304758"]
                }
            },        
            xaxis: {
                categories: ["Lite Coin", "Bit Coin", "Ripple", "Kraken", "Kucoin"],
                position: 'bottom',
                labels: {
                    show: true,
                },
                axisBorder: {
                    show: false
                },
                axisTicks: {
                    show: false
                }
            },
            yaxis: {
                show: false,       
            },
        };

        var chart_4 = new ApexCharts(document.getElementById(`column_chart`), options_4);
        chart_4.render();
    }());
</script>
@endpush