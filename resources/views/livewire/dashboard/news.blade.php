<div class="bg-white shadow-lg rounded-md py-4 px-8 mt-5">
    {{-- Success is as dangerous as failure. --}}
    <div class="flex justify-between items-center py-1">
        <div class="flex items-center space-x-2">
            <img src="{{asset('assets/img/icon/news.png')}}" class="w-8 h-8"/>
            <h1 class="text-lg text-black font-extrabold py-2">Crypto News</h1>
        </div>
        <div class="flex items-center space-x-6">
            <button class="bg-primary text-white rounded-full w-8 h-8 text-sm relative cursor-pointer hover:bg-secondary">
                <x-icon name="fas-angle-left" class="w-6 h-6 absolute top-1 left-1"/>
            </button>
            <button class="bg-primary text-white rounded-full w-8 h-8 text-sm relative cursor-pointer hover:bg-secondary">
                <x-icon name="fas-angle-right" class="w-6 h-6 absolute top-1 right-1"/>
            </button>
        </div>
    </div>
    <div class="grid grid-cols-1 md:grid-cols-2 gap-0 md:gap-6 items-center">
        <div>
            <img src="{{asset('assets/img/png/news_img.png')}}" class="w-full h-full object-cover"/>
        </div>
        <div>
            <h5 class="font-bold">Cryptocurrency exchanges start blocking account</h5>
            <p class="text-sm text-gray-500">Data is real time snapshot * Data is delayed at least 15 minuits, Global Business and Financial News, Stocks</p>
        </div>
    </div>
</div>
