<div class="h-full p-5 bg-white rounded-md shadow-lg">
    <div class="flex items-center justify-between">
        <div class="flex items-center space-x-2">
            <x-icon name="fluentui-news-24-o" class="w-8 h-8"/>
            <p class="mr-3 text-lg font-semibold">{{ __('Crypto News') }}</p>
        </div>
        <div class="flex items-center space-x-6">
            <button 
                id="news_prev_button"
                class="flex items-center justify-center w-8 h-8 text-sm bg-white border rounded-full hover:bg-primary text-primary hover:text-white"
            >
                <x-icon name="fas-angle-left" class="w-4 h-4"/>
            </button>
            <button 
                id="news_next_button"
                class="flex items-center justify-center w-8 h-8 text-sm bg-white border rounded-full hover:bg-primary text-primary hover:text-white"
            >
                <x-icon name="fas-angle-right" class="w-4 h-4"/>
            </button>
        </div>
    </div>
    <div class="h-full main-carousel mt-9">

        @foreach ($news as $item)          
            <div class="w-full px-1 carousel-cell sm:px-3 md:w-1/2">
                <div class="w-full h-full">
                    <img src="{{asset('assets/img/svg/news.svg')}}" class="object-cover w-full h-full"/>
                    <p class="mt-6 text-base font-bold text-primary"> {{ __( $item['title'] ) }}</p>
                    <p class="mt-2 text-sm text-gray-400"> {{ __( $item['content'] ) }} </p>
                </div>
            </div>
        @endforeach
        
    </div>
</div>

@push('scripts')
<script type="module">
    var elem = document.querySelector('.main-carousel');
    var flkty = new Flickity( elem, {
        prevNextButtons: false,
        cellAlign: 'left',
        contain: true,
        pageDots: false,
        wrapAround: true,
    });
   
    document.getElementById("news_prev_button").addEventListener("click", function(){
        flkty.previous();
    });
    document.getElementById("news_next_button").addEventListener("click", function(){
        flkty.next();
    });    

</script>
@endpush