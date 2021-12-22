@php($breadcrumbs = [
    ["label" => $resource->labelPlural()]
])
<x-app-layout title="{{ $resource->labelPlural() }}" :breadcrumbs="$breadcrumbs">
    <div class="py-6">
        @livewire($resource->livewire("table"))
    </div>
</x-app-layout>
