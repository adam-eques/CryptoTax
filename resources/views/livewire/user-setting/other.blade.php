<div>
    <div class="w-full px-10 py-6 bg-gray-100 rounded">
        <span class="text-2xl font-bold">{{ __('Other') }}</span>
    </div>
    <div class="px-10 py-10 divide-y">
        <div class="items-center justify-between block py-6 md:flex">
            <p>{{ __('Close your zenledger account and delete all the data asscociated with it.') }}</p>
            <x-button>{{ __('Close') }}</x-button>
        </div>
        <div class="items-center justify-between block py-6 md:flex">
            <p>{{ __('Recalculate Missing Fair Market Price.') }}</p>
            <x-button>{{ __('Resync Prices') }}</x-button>
        </div>
        <div class="items-center justify-between block py-6 md:flex">
            <p>{{ __('Reset Self Transfer.') }}</p>
            <x-button>{{ __('Reset Self Transfer') }}</x-button>
        </div>
        <div class="items-center justify-between block py-6 md:flex">
            <p>{{ __('Reset and Delete All Transaction Update Histories.') }}</p>
            <x-button>{{ __('Cleanup Updated Data History') }}</x-button>
        </div>
        <div class="items-center justify-between block py-6 md:flex">
            <p>{{ __('Resync Portfolio Graph.') }}</p>
            <x-button>{{ __('Resync Portfolio') }}</x-button>
        </div>
    </div>
</div>

