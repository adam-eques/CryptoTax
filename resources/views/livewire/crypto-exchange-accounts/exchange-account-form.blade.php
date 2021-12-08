<form wire:submit.prevent="submit">
    <p class="mb-4 text-sm">Last fetched: {{ $account->fetched_at ? $account->fetched_at->format("Y-m-d H:i") : "never" }}</p>

    {{ $this->form }}

    <div class="grid justify-items-center mt-5">
        <x-jet-button type="submit">{{ __("Save") }}</x-jet-button>
    </div>
</form>
