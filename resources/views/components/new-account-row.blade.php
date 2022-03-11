@props([
    'selected' => false,
    'name' => null,
    'category' => "E"
])

@php    
    $att = $attributes->merge([
            'class' => 'grid grid-cols-4 sm:grid-cols-7 items-center py-5 px-6 border-b cursor-pointer hover:bg-gray-100 w-full'
    ]);
    if ($selected) {
        $att = $attributes->merge([
            'class' => 'grid grid-cols-4 sm:grid-cols-7 gap-2 items-center py-5 px-6 border-b cursor-pointer bg-gray-100 w-full'
        ]);
    }
    $category_badge = ['name'=>'Exchange', 'icon' =>'exchange-1'];
    switch ($category) {
        case 'E':
            $category_badge = ['name'=>'Exchange', 'icon' =>'ri-exchange-dollar-line'];
            break;
        case 'B':
            $category_badge = ['name'=>'Blockchain', 'icon' =>'iconpark-blockchain'];
            break;
        default:
            break;
    }
@endphp
<button {{$att}}>
    <img src="{{ asset('assets/img/exchange_icon/' . $name . '.svg') }}"  class="order-1 w-full col-span-2 pr-2 text"/>
    <p class="order-3 col-span-2 text-left sm:order-2">{{ $name }}</p>
    <div class="flex items-center order-2 col-span-2 px-3 py-1 text-white rounded-md bg-primary sm:order-3">
        <x-icon :name="$category_badge['icon']" class="w-8 h-8 mr-2 text"/>
        <span class="font-bold tracking-tight truncate text-md">{{ __( $category_badge['name'] ) }}</span>
    </div>
    @if($selected) 
        <div class="justify-end order-4 hidden w-full col-span-1 sm:flex">
            <x-icon name="heroicon-o-arrow-narrow-right" class="w-5 col-span-1"/>
        </div>
    @endif
</button>