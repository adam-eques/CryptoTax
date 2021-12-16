<x-app-layout>
    <x-slot name="title">{{ __($labelPlural) }}</x-slot>

    <livewire:admin.user-table :account-type-ids="$account_type_ids" />
</x-app-layout>
