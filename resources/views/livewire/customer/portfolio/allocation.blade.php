<div>
    <p class="text-xl font-bold  md:text-2xl">Portfolio Allocation</p>
    <div class="flex-1 pt-5">
        <div class="" id="doghnut-chart"></div>
    </div>
</div>
@push('scripts')
<script>
    (function () {
        var options = {
            chart: {
                type: 'donut'
            },
            series: [44, 55, 13, 33],
            labels: ['Bitcoin', 'Ethereum', 'Ripple', 'Litecoin'],
            legend: {
                show: true,
                position: 'bottom'
            }
            
        }
        const chart = new ApexCharts(document.getElementById(`doghnut-chart`), options);
        chart.render();
    }());
</script>
@endpush