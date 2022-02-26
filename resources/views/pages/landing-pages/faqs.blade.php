<x-guest-layout>
    <x-sub-page-hero icon="faqs" subtitle="We're here to help" title="Frequently Asked Questions"></x-sub-page-hero>
    <div class="relative py-12 bg-white">
        @livewire('sub-pages.faqs.faqs-list')
    </div>
    <div class="bg-white">
        <x-footer-get-start class="bg-white"/>
    </div>
    <x-footer/>
</x-guest-layout>