<x-forms::field-wrapper
    :id="$getId()"
    :label="$getLabel()"
    :label-sr-only="$isLabelHidden()"
    :helper-text="$getHelperText()"
    :hint="$getHint()"
    :hint-icon="$getHintIcon()"
    :required="$isRequired()"
    :state-path="$getStatePath()"
>
    <div x-data="{ state: $wire.entangle('{{ $getStatePath() }}') }">
        <x-button size="xs" tag="a" href="{{ $getHref() }}" :target="$isTargetBlank() ? '_blank': ''">{{ $getContent() }}</x-button>
    </div>
</x-forms::field-wrapper>
