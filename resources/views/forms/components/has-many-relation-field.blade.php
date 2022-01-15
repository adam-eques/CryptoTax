@php
$resource = $component->getResource();
$name = $getName();
$record = $getRecord();
$foreignKeyName = $record->$name()->getForeignKeyName();
@endphp

@livewire($resource->livewire("table"), [
    "resourceClass" => $resource::class,
    "relationConditions" => [
        $foreignKeyName => $getRecord->id
    ]
])
