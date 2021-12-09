<div class="py-5 px-3 border rounded-lg">
    {{-- The Master doesn't talk, he acts. --}}
    <div class="p-5 flex items-center justify-between">
        <div>
            <p>Total Income</p>
            <div class="flex items-start space-x-2">
                <p class="text-lg font-bold">$</p>
                <h2 class="text-5xl font-extrabold">36,806</h2>
            </div>
        </div>
        <div class="flex items-center space-x-2">
            <button class="font-bold">1D</button>
            <button class="font-bold">1W</button>
            <button class="font-bold">1M</button>
            <button class="font-bold">3M</button>
            <button class="font-bold">1Y</button>
            <button class="font-bold">ALL</button>
        </div>
    </div>
    <div class="px-4 h-90">
        <livewire:livewire-line-chart
            key="{{ $lineChartModel->reactiveKey() }}"
            :line-chart-model="$lineChartModel"
        />
    </div>
</div>
