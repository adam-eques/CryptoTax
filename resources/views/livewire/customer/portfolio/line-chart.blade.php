<div class="py-5 border rounded-lg">
    {{-- The Master doesn't talk, he acts. --}}
    <div class="flex flex-wrap items-center justify-between p-2 md:p-7">
        <div>
            <p class="py-2">Total Income</p>
            <div class="flex items-start space-x-2">
                <p class="text-lg font-bold">$</p>
                <h2 class="text-3xl font-bold md:text-5xl">36,806</h2>
            </div>
        </div>
        <div class="flex items-center space-x-2">
            @foreach ($buttons as $button)                
                <button 
                    class="px-3 py-1 font-bold rounded-md hover:text-white hover:bg-primary @if($button['id'] == $selected) bg-primary text-white @else text-primary @endif"
                    wire:click="get_selected({{ $button['id'] }})""
                >
                    {{ $button['name'] }}
                </button>
            @endforeach
        </div>
    </div>
    <div class="h-90">
        <div id="chart"></div>
    </div>
</div>
@push('scripts')
<script>
    (function () {
        var options = {
            chart: {
                height: "100%",
                type: "area",
                stacked: false,
                chartTopMargin: "40",
                toolbar:{
                    show: false
                }
            },
            dataLabels: {
                enabled: false
            },
            colors: ["#796cff", "#a69dff"],
            series: [
                {
                    data: @json($line_data['value'])
                },
                // {
                //     data: [2.6, 3.3, 3.8, 2.7, 3.6, 3.9, 5.2, 5.9]
                // }
            ],
            stroke: {
                curve: 'smooth',
                dashArray: [0, 8],
                width: 2
            },
            plotOptions: {
                
            },
            fill: {
                type: "gradient",
                colors: ['#796cff', '#eae8fe'],
                opacity:[0.8],
                gradient: {
                    shadeIntensity: 1,
                    opacityFrom: 0.7,
                    opacityTo: 0.9,
                    stops: [0, 90, 100]
                }
            },
            xaxis: {
                categories: @json($line_data['label'])
            },
            yaxis: {
                axisTicks: {
                    show: true
                },
                axisBorder: {
                    show: true,
                    color: "#cfcfcf"
                },
                labels: {
                        style: {
                        colors: "#cfcfcf"
                    }
                },
            },
            legend: {
                show: false
            }
        };
        const chart = new ApexCharts(document.getElementById(`chart`), options);
        chart.render();

        document.addEventListener('livewire:load', () => {
            @this.on(`refresh-line-chart`, (chartData) => {
                chart.updateOptions({
                    xaxis: {
                        categories: chartData.line_data.label
                    },
                    series: [{
                        data: chartData.line_data.value
                    }],
                });
            })
        })
    }());
</script>
@endpush
