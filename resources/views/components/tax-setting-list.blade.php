@props(
    [
        'active' => null
    ]
)

@php
    $list = [
        [ 'name' => 'Profile settings', 'icon' => 'user', 'route' => 'profile' ],
        [ 'name' => 'Email address', 'icon' => 'inbox', 'route' => 'email' ],
        [ 'name' => 'Password', 'icon' => 'password', 'route' => 'password' ],
        [ 'name' => 'Notification', 'icon' => 'bell', 'route' => 'notification' ],
        [ 'name' => 'Security', 'icon' => 'security', 'route' => 'security' ],
        [ 'name' => 'Payment Information', 'icon' => 'payment', 'route' => 'payment' ],
        [ 'name' => 'Billing', 'icon' => 'bill', 'route' => 'billing' ],
        [ 'name' => 'Other', 'icon' => 'other', 'route' => 'other' ],
        [ 'name' => 'Request Exchange', 'icon' => 'exchange-2', 'route' => 'exchange' ],
        [ 'name' => 'Tax Settings', 'icon' => 'tax-setting', 'route' => 'tax' ]
    ]
@endphp

<div class="divide-y">  
    @foreach ($list as $item)
        <a href="{{ route('tax-setting', ['category' => $item['route']]) }}">
            <div class="flex items-center justify-between w-full text-left py-6 px-8 @if($active == $item['route']) bg-gray-100 @endif ">
                <div class="flex items-center">
                    <x-icon name="{{$item['icon']}}" class="w-6 h-auto mr-6"/>
                    {{ __($item['name']) }}
                </div>
                @if ($active == $item['route'])                    
                    <x-icon name="arrow-right" class="w-6"/>
                @endif
            </div>
        </a>
    @endforeach
</div>