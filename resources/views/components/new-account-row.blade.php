@props([
    'selected' => false,
    'name' => null,
    'category' => 1
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
        case '1':
            $category_badge = ['name'=>'Exchange', 'icon' =>'ri-exchange-dollar-line'];
            break;
        case '3':
            $category_badge = ['name'=>'Blockchain', 'icon' =>'iconpark-blockchain'];
            break;
        default:
            break;
    }
@endphp
<button {{$att}}>
    <img src="{{ asset('assets/img/exchange_icon/' . $name . '.svg') }}"  class="h-auto w-full pr-2 text col-span-2 order-1"/>
    <p class="col-span-2 order-3 sm:order-2 text-left">{{ $name }}</p>
    <div class="flex items-center px-3 py-1 bg-primary rounded-md text-white col-span-2 order-2 sm:order-3">
        <x-icon :name="$category_badge['icon']" class="w-8 h-8 mr-2 text"/>
        <span class="text-md font-bold tracking-tight truncate">{{ __( $category_badge['name'] ) }}</span>
    </div>
    @if($selected) 
        <div class="w-full justify-end col-span-1 hidden sm:flex order-4">
            <x-icon name="heroicon-o-arrow-narrow-right" class="w-5 col-span-1"/>
        </div>
    @endif
</button>