<x-app-layout>
    <x-page icon="fas-wallet" :title="__('Show :name Transactions', ['name' => $name])">
        @if($error)
            <div class="flex items-center justify-center px-4 mb-6">
                <div role="alert" id="alert" class="flex flex-col items-center justify-between w-full py-4 mx-auto transition duration-150 ease-in-out bg-white rounded shadow lg:w-11/12 dark:bg-gray-800 md:flex-row md:py-0">
                    <div class="flex flex-col items-center md:flex-row">
                        <div class="p-4 mr-3 text-white bg-red-400 rounded md:rounded-tr-none md:rounded-br-none">
                            <svg tabindex="0" class="focus:outline-none" role="alert" aria-label="error" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="22" height="22" fill="currentColor">
                                <path class="heroicon-ui" d="M4.93 19.07A10 10 0 1 1 19.07 4.93 10 10 0 0 1 4.93 19.07zm1.41-1.41A8 8 0 1 0 17.66 6.34 8 8 0 0 0 6.34 17.66zM13.41 12l1.42 1.41a1 1 0 1 1-1.42 1.42L12 13.4l-1.41 1.42a1 1 0 1 1-1.42-1.42L10.6 12l-1.42-1.41a1 1 0 1 1 1.42-1.42L12 10.6l1.41-1.42a1 1 0 1 1 1.42 1.42L13.4 12z" />
                            </svg>
                        </div>
                        <p class="mt-2 mr-2 text-base font-bold text-gray-800 dark:text-gray-100 md:my-0">Error</p>
                        <div class="hidden w-1 h-1 mr-2 bg-gray-300 rounded-full dark:bg-gray-700 xl:block"></div>
                        <p class="mb-2 text-sm text-center text-gray-600 lg:text-base dark:text-gray-400 lg:pt-1 xl:pt-0 sm:mb-0 sm:text-left">
                            {{ $error }}
                        </p>
                    </div>
                </div>
            </div>
        @endif

        @if($data)
            <table class="w-full border border-gray-100 rounded-lg whitespace-nowrap">
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
        @endif
    </x-page>
</x-app-layout>
