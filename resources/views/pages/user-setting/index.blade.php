@php(\App\Services\NavigationService::instance()->overwriteSubnavi([
    ["label" => "profile", "icon" => "user", "route" => "customer.account"],
    ["label" => "Setting", "icon" => "setting", "route" => "customer.transactions"],
], [
    ["label" => "Invite a Friend", "icon" => "invite", "route" => "customer.invite", "color" => "text-white bg-primary"],
]))
<x-app-layout>
    <div class="px-3 py-5 mx-auto my-5 bg-white rounded-sm shadow xl:max-w-screen-2xl xs:px-4 lg:px-6">
        <div class="w-full py-5 border-b">
            <div class="flex items-center justify-between">
                <div class="flex items-center justify-start space-x-3">
                    <x-uni-setting-o class="w-9"/>
                    <h1 class="font-bold sm:text-xl lg:text-2xl text-primary">{{ __('Settings') }}</h1>
                </div>
                <div>
                    <x-button class="justify-center tracking-tight" tag="a" href="{{ route('customer.account.new') }}">
                        {{ __('Upgrade') }}
                    </x-button>
                </div>
            </div>
        </div>
        <div class="mt-12" x-data="{selected: 'profile'}">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-x-0 md:gap-x-10 gap-y-5 md:gap-y-0">
                <div class="col-span-1 border rounded">
                    <x-user-setting-list :active="$category"/>
                </div>
                <div class="col-span-3 border rounded">
                    @if ($category)
                        @livewire('user-setting.' . $category)
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
