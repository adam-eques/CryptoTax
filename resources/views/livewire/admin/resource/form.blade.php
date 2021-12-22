<form wire:submit.prevent="save">
    {{ $this->form }}

    <div class="mt-5 text-center">
        <x-button tag="a" :href="$this->resource->getRoute('index')">{{ __("Back") }}</x-button>
        <x-button variant="success" type="submit">{{ __("Save") }}</x-button>
    </div>

    <x-spinner wire:loading.delay.long />
</form>
