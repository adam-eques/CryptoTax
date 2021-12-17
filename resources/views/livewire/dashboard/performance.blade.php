<div class="bg-white shadow-md rounded-md p-5 w-full mt-5 sm:mt-10">
    {{-- Because she competes with no one, no one can compete with her. --}}
    <div class="grid grid-cols-1 2xl:grid-cols-4 md:grid-cols-2 gap-0 md:gap-x-6 md:gap-y-5">
        <div class="flex items-center space-x-2 py-5">
            <x-icon name="donut" class="w-8 h-8 text-primary"/>
            <p class="mr-3 text-xl font-extrabold">My Performance</p>
        </div>
        <x-status-card-dashboard id="status_1" title="24h Portfolio Change" amount="1,254" :increase="true" incdecamount="2.5"></x-status-card-dashboard>
        <x-status-card-dashboard id="status_2" title="Total profit loss" amount="95,422" :increase="true" incdecamount="2.5"></x-status-card-dashboard>
        <x-status-card-dashboard id="status_3" title="24h Portfolio Change" amount="3,566" :increase="true" incdecamount="2.5"></x-status-card-dashboard>
    </div>
    <div class="grid grid-cols-1 xl:grid-cols-8 gap-0 md:gap-6 mt-14">
        <div class="col-span-3">
            <div class="col-span-4">
                <select class="px-7 py-2 border-gray-300 border">
                    <option>Top 5 Coins</option>
                    <option>Top 10 Coins</option>
                </select>
            </div>
            <div class="mt-8">
                <div id="column_chart" class="-my-5"></div>
            </div>
        </div>
        <div class="col-span-5 h-full">
            <div class="flex justify-end space-x-2 col-span-8">
                <x-speech-button :active="false"> 24H </x-speech-button>
                <x-speech-button :active="true"> 7D </x-speech-button>
                <x-speech-button :active="false"> IM </x-speech-button>
                <x-speech-button :active="false"> IY </x-speech-button>
            </div>
            <div class="mt-8">
                <div id="line-chart" class="-my-5"></div>
            </div>
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

        var options_status_1 = {
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
        const chart_status_1 = new ApexCharts(document.getElementById(`status_1`), options_status_1);
        chart_status_1.render();

        var options_status_2 = {
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
        const chart_status_2 = new ApexCharts(document.getElementById(`status_2`), options_status_2);
        chart_status_2.render();

        var options_status_3 = {
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
        const chart_status_3 = new ApexCharts(document.getElementById(`status_3`), options_status_3);
        chart_status_3.render();

        var options_4 = {
            series: [
                {
                    data: [213.3, 123.1, 154.0, 234.1, 312.0],
                }
            ],
            colors: ['#FFAB2D', '#DA31C9', '#2B98D6', '#5A5A5A', '#7A6CFF'],
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
                    borderRadius: 5,
                    dataLabels: {
                        position: 'top',
                    },
                    distributed: true
                }
            },
            dataLabels: {
                enabled: true,
                formatter: function (val) {
                    return "$"+val;
                },
                offsetY: -20,
                style: {
                    fontSize: '16px',
                    colors: ["#000"],
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
                axisBorder: {
                    show: false,
                }       
            },
            legend: {
                show: false
            },
            grid: {
                show: false
            }

        };

        var chart_4 = new ApexCharts(document.getElementById(`column_chart`), options_4);
        chart_4.render();
    }());
</script>
@endpush