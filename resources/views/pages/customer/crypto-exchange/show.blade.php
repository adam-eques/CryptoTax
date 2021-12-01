<x-app-layout>
    <x-page icon="fas-wallet" :title="__('Show Kucoin')">
        <div class="pb-8 flex flex-col md:flex-row -mx-2 lg:-mx-5 space-y-10 md:space-y-0">
            <table class="w-full whitespace-nowrap border-gray-100 border rounded-lg">
                <thead class="bg-gray-100">
                    <tr>
                        @foreach(current($data) AS $name => $col)
                            <td class="p-2">{{ $name }}</td>
                        @endforeach
                    </tr>
                </thead>

                @foreach($data AS $row)
                    <tr>
                        @foreach($row AS $col)
                            <td class="p-2 border-t">{{ $col }}</td>
                        @endforeach
                    </tr>
                @endforeach
            </table>
        </div>
    </x-page>
</x-app-layout>
