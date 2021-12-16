<div class="bg-white shadow-md rounded-md p-5 h-full">
    <div class="flex justify-between items-center">
        <div class="flex items-center space-x-2">
            <img src="{{asset('assets/img/icon/nav/portfolio_primary.svg')}}" class="w-8 h-8"/>
            <x-typography size="lg" class="mr-3 font-extrabold">My Cripto Portfolio</x-typography>
        </div>
        <div>
            <x-button variant="primary">See all assets</x-button>
        </div>
    </div>
    <div class="mt-6 overflow-x-auto" x-data="{selected:1}">
        <div class="border rounded-md bg-gray-100 grid grid-cols-11 py-6">
            <div class="col-span-1">
                <img src="{{asset('assets/img/icon/dashboard/updownarrow.svg')}}" class="w-2.5 h-2.5"/>
            </div>
        </div>
        <x-portfolio-list-item :id="1"></x-portfolio-list-item>   
        <x-portfolio-list-item :id="2"></x-portfolio-list-item>       
        <x-portfolio-list-item :id="3"></x-portfolio-list-item>   
    </div>
</div>
