<div class="bg-white shadow-lg rounded-md p-5 h-full">
    <div class="flex justify-between items-center">
        <div class="flex items-center space-x-2">
            <x-icon name="news" class="w-8 h-8"/>
            <p class="mr-3 text-xl font-extrabold">Crypto News</p>
        </div>
        <div class="flex items-center space-x-6">
            <button class="border rounded-full w-8 h-8 text-sm flex items-center justify-center bg-white hover:bg-primary text-primary hover:text-white">
                <x-icon name="fas-angle-left" class="w-4 h-4"/>
            </button>
            <button class="border rounded-full w-8 h-8 text-sm flex items-center justify-center bg-white hover:bg-primary text-primary hover:text-white">
                <x-icon name="fas-angle-right" class="w-4 h-4"/>
            </button>
        </div>
    </div>
    <div class="main-carousel pt-5 h-full">
        <div class="carousel-cell px-1 sm:px-3 w-full md:w-1/2">
            <div class="h-full w-full">
                <img src="{{asset('assets/img/svg/news_1.svg')}}" class="w-full"/>
                <p class="text-lg text-primary font-bold">Cryptocurrency exchanges start blocking accounts </p>
                <p class="text-gray-400">Data is a real-time snapshot *Data is delayed at least 15 minutes. Global Business and Financial News, Stock Quotes, and Market Data and</p>
            </div>
        </div>
        <div class="carousel-cell px-1 sm:px-3 w-full md:w-1/2">
            <div class="h-full w-full">
                <img src="{{asset('assets/img/svg/news_2.svg')}}" class="w-full"/>
                <p class="text-lg text-primary font-bold">Cryptocurrency exchanges start blocking accounts </p>
                <p class="text-gray-400">Data is a real-time snapshot *Data is delayed at least 15 minutes. Global Business and Financial News, Stock Quotes, and Market Data and</p>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
   var elem = document.querySelector('.main-carousel');
    var flkty = new Flickity( elem, {
        prevNextButtons: false,
        cellAlign: 'left',
        contain: true,
        pageDots: false
    });
</script>
@endpush