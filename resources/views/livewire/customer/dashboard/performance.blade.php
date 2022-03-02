<div class="w-full p-5 mt-6 bg-white rounded-md shadow-md sm:mt-10">
    <div class="grid grid-cols-1 gap-0 2xl:grid-cols-4 md:grid-cols-2 md:gap-x-6 md:gap-y-5">
        <div class="flex items-center py-5 space-x-2">
            <x-icon name="ri-pie-chart-line" class="w-8 h-8 text-primary"/>
            <p class="mr-3 text-lg font-semibold">{{ __('My Performance') }}</p>
        </div>
        @foreach ($over_view as $item)            
            <x-status-card-dashboard 
                :id="$item['id']" 
                :title="$item['category']" 
                :amount="$item['balance']" 
                :increase="$item['increase']" 
                :incdecamount="$item['incdec_percent']" 
                :line="$item['line']"
            />
        @endforeach
    </div>
    <div class="grid grid-cols-1 gap-0 xl:grid-cols-8 md:gap-6 mt-9">
        <div class="col-span-3">
            <div class="col-span-4">
                <select class="py-2 border border-gray-300 px-7">
                    <option>{{ __('Top 5 Coins') }}</option>
                    <option>{{ __('Top 5 Coins') }}</option>
                </select>
            </div>
            <div class="mt-8">
                <div id="column_chart" class="-my-5"></div>
            </div>
        </div>
        <div class="h-full col-span-5">
            <div class="flex justify-end col-span-8 space-x-2">
                <x-speech-button :active="$selected_category == 'day'" wire:click="select_category('day')"> {{ __('24H') }} </x-speech-button>
                <x-speech-button :active="$selected_category == 'week'" wire:click="select_category('week')"> {{ __('7D') }} </x-speech-button>
                <x-speech-button :active="$selected_category == 'month'" wire:click="select_category('month')"> {{ __('1M') }} </x-speech-button>
                <x-speech-button :active="$selected_category == 'year'" wire:click="select_category('year')"> {{ __('1Y') }} </x-speech-button>
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
        var options_bar = {
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

        var chart_bar = new ApexCharts(document.getElementById(`column_chart`), options_bar);
        chart_bar.render();

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
                data: [30,40,35,50,49,60,70]
            }],
            xaxis: {
                categories: @json($label),
                tooltip: {
                    enabled: false
                }
            },
        }
        const chart = new ApexCharts(document.getElementById(`line-chart`), options);
        chart.render();

        document.addEventListener('livewire:load', () => {
            @this.on(`refresh-line-chart`, (chartData) => {
                console.log("Reload");
                chart.updateOptions({
                    xaxis: {
                        categories: chartData.label
                    }
                });
            })
        })

    }());
</script>
@endpush