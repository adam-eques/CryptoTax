<div>
    <p class="text-xl font-bold">Portfolio Allocation</p>
    <div class="p-4 flex-1 h-98">
        <livewire:livewire-pie-chart
            key="{{ $pieChartModel->reactiveKey() }}"
            :pie-chart-model="$pieChartModel"
        />
    </div>
</div>
