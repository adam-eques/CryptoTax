<div>
    <div class="text-right mb-4">
        @if($createRoute)
            <x-button :href="$createRoute" tag="a" variant="primary">{{ __("Add") }}</x-button>
        @endif
    </div>

    {{ $this->table }}

    <x-spinner wire:loading.delay.longer />
</div>
