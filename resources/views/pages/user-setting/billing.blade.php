@php
(\App\Services\NavigationService::instance()->overwriteSubnavi([
    ["label" => "profile", "icon" => "tabler-user", "route" => "customer.account"],
    ["label" => "Setting", "icon" => "uni-setting-o", "route" => "customer.user-setting"],
], [
    ["label" => "Invite a Friend", "icon" => "go-person-add-16", "route" => "customer.invite", "color" => "text-white bg-primary"],
]))
@endphp
<x-app-layout>
    <x-container class="p-8 my-5 bg-white border rounded-sm">
        <x-customers.customer-header-bar icon="ri-bill-line" name="Billings">
        </x-customers.customer-header-bar>
        <div class="mt-8">
            <div class="flex items-center justify-between">
                <div class="">
                    <p class="text-lg font-semibold">{{ __('Billing History and Invoicing') }}</p>
                    <p class="text-gray-400">{{ __("Pick an account plan that's fits your workflow") }}</p>
                </div>
                <x-button>
                    <x-iconoir-download-square-outline class="w-6 h-6" />
                    <p class="ml-3">{{ __('Download all') }}</p>
                </x-button>
            </div>
            <div class="overflow-auto mt-18">
                <div class="divide-y min-w-[720px]">
                    <div class="grid grid-cols-12 pb-4">
                        <div class="col-span-4 ml-12">
                            <p class="font-semibold">{{ __('Description') }}</p>
                        </div>
                        <div class="col-span-2">
                            <p class="font-semibold">{{ __('Status') }}</p>
                        </div>
                        <div class="col-span-2">
                            <p class="font-semibold">{{ __('Amount') }}</p>
                        </div>
                        <div class="col-span-2">
                            <p class="font-semibold">{{ __('Plane') }}</p>
                        </div>
                    </div>
                    @php
                        $items = [
                            [], [], [], [], []
                        ]
                    @endphp
                    @foreach ($items as $item)                        
                        <div class="grid items-center grid-cols-12 py-8">
                            <div class="col-span-4">
                                <div class="flex items-center pl-2 space-x-6">
                                    <input type="checkbox"/>
                                    <div class="">
                                        <p class="font-base">{{ __('100 Credits for 100 $') }}</p>
                                        <p class="text-sm text-gray-400">{{ __('Lorem ipsum dolor sit amet, consectetur adipiscing elit,') }}</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-span-2">
                                <x-badge variant="transparent" type="square" class="text-success-600">
                                    <x-icon name="bi-check-circle" class="w-4 h-4 mr-2"/>
                                    {{__("Paid")}}
                                </x-badge>
                            </div>
                            <div class="col-span-2">
                                <p class="font-base">{{ __('USD $ 100.0') }}</p>
                            </div>
                            <div class="col-span-2">
                                <p class="font-base">{{ __('PRO') }}</p>
                            </div>
                            <div class="col-span-2 pr-8 text-right download">
                                <button class="font-base hover:text-secondary">{{ __('Download') }}</button>
                            </div>
                        </div>
                    @endforeach                    
                </div>
            </div>
        </div>
        </div>
    </x-container>
</x-app-layout>