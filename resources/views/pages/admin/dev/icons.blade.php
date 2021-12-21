<?php
/**
 * @var \Symfony\Component\Finder\SplFileInfo $icon
 */
?>

<x-app-layout>
    <x-slot name="title">Icons</x-slot>

    <div class="container my-12 mx-auto px-4 md:px-12">
        <div class="flex flex-wrap -mx-1 lg:-mx-4">
            @foreach($icons AS $icon)
                <div class="my-1 px-1 w-1/2 lg:my-4 lg:px-1 lg:w-1/4">
                    <div class="overflow-hidden rounded-lg shadow-lg">
                        <div>
                            <x-icon name="{{ $icon->getFilenameWithoutExtension() }}" class="h-8 m-auto" />
                        </div>

                        <header class="leading-tight p-2 md:p-4">
                            <h1 class="text-lg text-center">
                                {{ $icon->getFilenameWithoutExtension() }}
                            </h1>

                            <pre class="mt-3 text-xs text-center text-gray-500">&lt;x-icon name="{{ $icon->getFilenameWithoutExtension() }}" class="w-6" /&gt;</pre>
                        </header>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</x-app-layout>
