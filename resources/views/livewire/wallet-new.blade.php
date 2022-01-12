<form wire:submit.prevent="submit">
    {{ $this->form }}

    <div class="grid justify-items-center mt-5">
        <x-jet-button type="submit">{{ __("Add Blockchain") }}</x-jet-button>
    </div>
</form>
