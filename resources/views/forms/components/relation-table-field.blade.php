@php($resource = $getResource())
<style>
    .relation-table-field .border.border-gray-300.rounded-xl {
        border: none;
        box-shadow: none;
    }
</style>
<div class="-mx-6 -my-4 relation-table-field">
    @livewire($resource->modelCamelCase() . '.' . $resource->modelCamelCase() . '-table', [
        "disableAdd" => $isDisableAdd()
    ])
</div>
