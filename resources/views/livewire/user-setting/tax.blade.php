<div>
    <div class="w-full px-10 py-6 bg-gray-100 rounded">
        <span class="text-2xl font-bold">{{ __('Tax Settings') }}</span>
    </div>

    <div class="px-5 py-5 md:px-10 md:py-10">
        <form wire:submit.prevent='submit'>

            <div>
                <x-jet-label>{{ __('Default Transaction Time Zone') }}</x-jet-label>
                <div class="border flex items-center rounded mt-4 px-5 @error('timezone_id') border-danger @enderror">
                    <x-icon name="iconpark-time" class="w-9 h-9"/>
                    <select class="w-full h-full py-4 border-0 outline-none ring-0 focus:outline-none focus:ring-0" wire:model.defer="timezone_id">
                        <option value="0" disabled selected hidden>{{ __('Timezone') }}</option>
                        @foreach ($timezone as $zone)                        
                            <option value="{{ $zone->id }}" @if($timezone_id && $timezone_id == $zone->id) selected @endif>
                                {{ str_replace('/', ' ', $zone->name) }}
                            </option>
                        @endforeach
                    </select>
                </div>
                @error('timezone_id') <span class="text-sm text-danger">{{ $message }}</span> @enderror
            </div>

            <div class="mt-10">
                <p>{{ __('Tax Jurisdiction') }}</p>
                <x-jet-label>{{ __('Note: All the set net worth amount would be cleared after switching to another jurisdiction.') }}</x-jet-label>
                <div class="border flex items-center rounded mt-4 px-5 @error('tax_country_id') border-danger @enderror">
                    <x-icon name="{{ 'flag.tax_country_' . $tax_country_id }}" class="w-9 h-9"/>
                    <select class="w-full h-full py-4 border-0 outline-none ring-0 focus:outline-none focus:ring-0" wire:model.defer="tax_country_id">
                        <option value="0" disabled selected hidden>{{ __('Tax Jurisdiction') }}</option>
                        @foreach ($tax_countries as $country)                        
                            <option value="{{ $country->id }}" @if($tax_country_id == $country->id) selected @endif>{{ __($country->name) }}</option>
                        @endforeach
                    </select>
                </div>
                @error('tax_country_id') <span class="text-sm text-danger">{{ $message }}</span> @enderror
            </div>

            <div class="mt-10">
                <p>{{ __('Base Currency') }}</p>
                <div class="border flex items-center rounded mt-4 px-5 @error('tax_currency_id') border-danger @enderror">
                    <x-icon name="{{ 'flag.tax_currency_' . $tax_currency_id }}" class="w-9 h-9"/>
                    <select class="w-full h-full py-4 border-0 outline-none ring-0 focus:outline-none focus:ring-0" wire:model.defer="tax_currency_id">
                        <option value="0" disabled selected hidden>{{ __('Base Currency') }}</option>
                        @foreach ($basic_currency as $currency)                        
                            <option value="{{ $currency->id }}" @if($tax_currency_id == $currency->id) selected @endif>{{ __($currency->name) }}</option>
                        @endforeach
                    </select>
                </div>
                @error('tax_currency_id') <span class="text-sm text-danger">{{ $message }}</span> @enderror
            </div>
    
            <div class="mt-10">
                <p>{{ __('Cost Basis Method') }}</p>
                <div class="border flex items-center rounded mt-4 px-5 @error('tax_cost_model_id') border-danger @enderror">
                    <x-icon name="ri-money-dollar-circle-fill" class="w-9 h-9"/>
                    <select class="w-full h-full py-4 border-0 outline-none ring-0 focus:outline-none focus:ring-0" wire:model.defer="tax_cost_model_id">
                        <option value="0" disabled selected hidden>{{ __('Cost Basis Method') }}</option>
                        @foreach ($basic_cost_method as $method)
                            <option value="{{ $method->id }}" @if($tax_cost_model_id == $method->id) selected @endif>{{ $method->name }}</option>
                        @endforeach
                    </select>
                </div>
                @error('tax_cost_model_id') <span class="text-sm text-danger">{{ $message }}</span> @enderror
            </div>

            <x-jet-label class="mt-10">{{ __('Note: You can change these settings anytime by clicking your profile at the top right,') }}</x-jet-label>
            <x-jet-label class="mt-3">{{ __('then selecting Settings > Tax Settings.') }}</x-jet-label>
            <label for="email_update" class="flex items-center my-8">
                <x-jet-checkbox id="email_update" name="email_receive" />
                <span class="ml-2 text-sm text-gray-600">{{ __('I agree to the United States of America Tax Disclaimer.') }}</span>
            </label>
            <x-jet-button class="px-10" type="submit">{{ __('Save') }}</x-jet-button>
        </form>
    </div>
</div>
