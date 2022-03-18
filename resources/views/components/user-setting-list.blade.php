@props(
    [
        'active' => null
    ]
)

@php
    $list = [
        [ 'name' => 'Profile settings', 'route' => 'profile' ],
        [ 'name' => 'Tax Settings', 'route' => 'tax' ],
        [ 'name' => 'Email address', 'route' => 'email' ],
        [ 'name' => 'Password', 'route' => 'password' ],
        [ 'name' => 'Notification', 'route' => 'notification' ],
        [ 'name' => 'Security', 'route' => 'security' ],
        [ 'name' => 'Request Exchange', 'route' => 'exchange' ],
        [ 'name' => 'Other', 'route' => 'other' ],
        [ 'name' => 'Delete Account', 'route' => 'delete' ],
    ]
@endphp

<div class="hidden divide-y md:block">
    @foreach ($list as $item)
        <a href="{{ route('customer.user-setting', ['category' => $item['route']]) }}">
            <div class="flex items-center justify-between w-full text-left py-6 px-8 @if($active == $item['route']) bg-gray-100 @endif ">
                <div class="flex items-center">
                    @switch($item['route'])
                        @case('profile')
                            <x-ri-user-settings-line class="w-6 mr-4"/>
                            @break
                        @case('tax')
                            <x-heroicon-o-receipt-tax class="w-6 mr-4"/>
                            @break
                        @case('email')
                            <x-heroicon-o-mail class="w-6 mr-4"/>
                            @break
                        @case('password')
                            <x-fluentui-password-16-o class="w-6 mr-4"/>
                            @break
                        @case('notification')
                            <x-heroicon-o-bell class="w-6 mr-4"/>
                            @break
                        @case('security')
                            <x-carbon-security class="w-6 mr-4"/>
                            @break
                        @case('exchange')
                            <x-tabler-exchange class="w-6 mr-4"/>
                            @break
                        @case('other')
                            <x-gmdi-settings-backup-restore-o class="w-6 mr-4"/>
                            @break
                        @case('delete')
                            <x-ri-delete-bin-6-line class="w-6 mr-4"/>
                            @break
                        @default
                            
                    @endswitch
                    {{ __($item['name']) }}
                </div>
                @if ($active == $item['route'])
                    <x-icon name="heroicon-o-arrow-narrow-right" class="w-6"/>
                @endif
            </div>
        </a>
    @endforeach
</div>
<div class="block md:hidden">
    <div class="relative" x-data="{open:false}">
        <button
            @click="open = true"
            class="flex justify-start w-full h-full px-5 py-3 text-gray-600"
        >
            <x-icon name="list" class="h-8" />
        </button>
        <div
            class="absolute right-0 w-full py-1 mt-2 overflow-auto origin-top-right bg-white rounded-md shadow-lg ring-1 ring-black ring-opacity-5 focus:outline-none scrollbar"
            x-show="open" @click.away="open=false"
            x-transition:enter-start="transition ease-in duration-3000"
        >
            <div class="h-80">
                @foreach ($list as $item)
                    <a href="{{ route('customer.user-setting', ['category' => $item['route']]) }}">
                        <div class="flex items-center justify-between w-full text-left py-6 px-8 @if($active == $item['route']) bg-gray-100 @endif ">
                            <div class="flex items-center">
                                @switch($item['route'])
                                    @case('profile')
                                        <x-ri-user-settings-line class="w-6 mr-4"/>
                                        @break
                                    @case('tax')
                                        <x-heroicon-o-receipt-tax class="w-6 mr-4"/>
                                        @break
                                    @case('email')
                                        <x-heroicon-o-mail class="w-6 mr-4"/>
                                        @break
                                    @case('password')
                                        <x-fluentui-password-16-o class="w-6 mr-4"/>
                                        @break
                                    @case('notification')
                                        <x-heroicon-o-bell class="w-6 mr-4"/>
                                        @break
                                    @case('security')
                                        <x-carbon-security class="w-6 mr-4"/>
                                        @break
                                    @case('exchange')
                                        <x-tabler-exchange class="w-6 mr-4"/>
                                        @break
                                    @case('other')
                                        <x-gmdi-settings-backup-restore-o class="w-6 mr-4"/>
                                        @break
                                    @case('delete')
                                        <x-ri-delete-bin-6-line class="w-6 mr-4"/>
                                        @break
                                    @default
                                        
                                @endswitch
                                {{ __($item['name']) }}
                            </div>
                            @if ($active == $item['route'])
                                <x-icon name="heroicon-o-arrow-narrow-right" class="w-6"/>
                            @endif
                        </div>
                    </a>
                @endforeach
            </div>
        </div>
    </div>
</div>
