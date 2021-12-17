<div class="bg-white shadow-md rounded-md p-5 h-full">
    <div class="flex justify-between items-center">
        <div class="flex items-center space-x-2">
            <x-icon name="portfolio" class="w-8 h-8 text-primary"/>
            <p class="mr-3 text-xl font-extrabold">My Crypto Portfolio</p>
        </div>
        <div>
            <x-button variant="primary">See all assets</x-button>
        </div>
    </div>
    <div class="mt-6 overflow-x-auto" x-data="{selected:null}">
        <div class="border rounded-md bg-gray-100 text-primary grid grid-cols-11 py-6 min-w-clg">
            <div class="col-span-1 flex justify-center items-center">
                <x-icon name="biarrow" class="w-2 h-3"/>
            </div>
            <div class="col-span-2 flex justify-start items-center space-x-2 px-5">
                <p class="text-lg">Coin</p>
                <x-icon name="biarrow" class="w-2 h-3"/>
            </div>
            <div class="col-span-1 flex justify-end items-center space-x-2">
                <p class="text-lg">Price</p>
                <x-icon name="biarrow" class="w-2 h-3"/>
            </div>
            <div class="col-span-3 flex justify-center items-center space-x-2">
                <p class="text-lg">Last 7 Days</p>
                <x-icon name="biarrow" class="w-2 h-3"/>
            </div>
            <div class="col-span-1 flex justify-start items-center space-x-2">
                <p class="text-lg">Holdings</p>
                <x-icon name="biarrow" class="w-2 h-3"/>
            </div>
            <div class="col-span-1 flex justify-end items-center space-x-2">
                <p class="text-lg">Percentage</p>
                <x-icon name="biarrow" class="w-2 h-3"/>
            </div>
            <div class="col-span-2 flex justify-center items-center space-x-2">
                <p class="text-lg">PNL</p>
                <x-icon name="biarrow" class="w-2 h-3"/>
            </div>
        </div>
        <x-portfolio-list-item 
            :selectedId="1" 
            id="portfolio-1" 
            icon="bitcoin"
            name="Bitcoin"
            type="BIT"
            lingColor="#FF0303"
        >
        </x-portfolio-list-item>   
        <x-portfolio-list-item 
            :selectedId="2" 
            id="portfolio-2" 
            icon="bitcoin"
            name="Lite Coin"
            type="BIT"
            lingColor="#1DB737"
        >
        </x-portfolio-list-item>   
        <x-portfolio-list-item 
            :selectedId="3" 
            id="portfolio-3" 
            icon="bitcoin"
            name="Tether"
            type="USDT"
            lingColor="#FF0303"
        >
        </x-portfolio-list-item>   
        <x-portfolio-list-item 
            :selectedId="4" 
            id="portfolio-4" 
            icon="bitcoin"
            name="Ethereum"
            type="BIT"
            lingColor="#1DB737"
        >
        </x-portfolio-list-item>   
    </div>
</div>
