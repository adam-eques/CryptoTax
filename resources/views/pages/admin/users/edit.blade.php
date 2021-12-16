<x-app-layout>
    <x-card :title='__(":name edit", ["name" => $label])'>
        <div class="p-4">
            <livewire:admin.user-edit :model="$user" />
        </div>
    </x-card>
</x-app-layout>
