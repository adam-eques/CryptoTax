<x-forms::field-wrapper
    :id="$getId()"
    :label="$getLabel()"
    :label-sr-only="$isLabelHidden()"
    :helper-text="$getHelperText()"
    :hint="$getHint()"
    :hint-icon="$getHintIcon()"
    :state-path="$getStatePath()"
>
    <div {{ $attributes->merge($getExtraAttributes())->class('filament-forms-placeholder-component') }}>
        <x-button size="xs" tag="a" href="{{ $getHref() }}" :target="$isTargetBlank() ? '_blank': ''">{{ $getContent() }}</x-button>
    </div>
</x-forms::field-wrapper>
