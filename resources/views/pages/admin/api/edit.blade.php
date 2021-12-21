<x-app-layout>
    <x-card :title='__(":name edit", ["name" => $label])'>
        <div class="p-4">
            @livewire("admin." . $slug . "-form", ["model" => $model])
        </div>
    </x-card>
</x-app-layout>
