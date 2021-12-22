@php($val = $getValue())
@if($val)
    <div {{ $attributes->merge() }}>
        <label class="text-sm font-medium leading-4 text-gray-700 -mb-1">
            {{ $getLabel() }}
        </label>

        <div>
            {{ $getValue() }}
        </div>
    </div>
@endif
