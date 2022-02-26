<div class="main-carousel">
    <div class="w-full px-2 lg:w-1/2 2xl:w-1/3">
        <x-advisor-recommended-item/>
    </div>
    <div class="w-full px-2 lg:w-1/2 2xl:w-1/3">
        <x-advisor-recommended-item/>
    </div>
    <div class="w-full px-2 lg:w-1/2 2xl:w-1/3">
        <x-advisor-recommended-item/>
    </div>
</div>

@push('scripts')
<script type="module">
    var elem = document.querySelector('.main-carousel');
    var flkty = new Flickity( elem, {
        prevNextButtons: false,
        cellAlign: 'left',
        contain: true,
        pageDots: false
    });
</script>
@endpush