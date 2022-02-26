<x-guest-layout>
    <div class="w-full bg-white">
        <x-sub-page-hero icon="blogs" subtitle="" title="Our Blog"></x-sub-page-hero>
        <x-container class="relative py-10 sm:py-20">
            @livewire('sub-pages.blogs.blog-list')
        </x-container>
        <x-footer-get-start/>
    </div>
    <x-footer/>
</x-guest-layout>