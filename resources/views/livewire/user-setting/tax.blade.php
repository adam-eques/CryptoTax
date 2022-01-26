<div>
    <div class="bg-gray-100 w-full px-10 py-6 rounded">
        <span class="text-xl font-extrabold">{{ __('Tax Settings') }}</span>
    </div>
    <div class="px-5 py-5 md:px-10 md:py-10">
        <div>
            <x-jet-label>{{ __('Default Transaction Time Zone') }}</x-jet-label>
            <div class="border shadow flex items-center rounded-sm mt-4 px-5">
                <x-icon name="clock" class="w-9 h-9"/>
                <select class="h-full border-0 py-4 w-full outline-none ring-0 focus:outline-none focus:ring-0">
                    <option>{{ __('Time') }}</option>
                    <option>{{ __('Time') }}</option>
                    <option>{{ __('Time') }}</option>
                </select>
            </div>
        </div>

        <div class="mt-10">
            <p>{{ __('Tax Jurisdiction') }}</p>
            <x-jet-label>{{ __('Default Transaction Time Zone') }}</x-jet-label>
            <div class="border shadow flex items-center rounded-sm mt-4 px-5">
                <x-icon name="us_flag" class="w-9 h-9"/>
                <select class="h-full border-0 py-4 w-full outline-none ring-0 focus:outline-none focus:ring-0">
                    <option>{{ __('Time') }}</option>
                    <option>{{ __('Time') }}</option>
                    <option>{{ __('Time') }}</option>
                </select>
            </div>
        </div>

        <div class="mt-10">
            <p>{{ __('Tax Year') }}</p>
            <div class="border shadow flex items-center rounded-sm mt-4 px-5">
                <x-icon name="calendar-1" class="w-9 h-9"/>
                <select class="h-full border-0 py-4 w-full outline-none ring-0 focus:outline-none focus:ring-0">
                    <option>{{ __('Time') }}</option>
                    <option>{{ __('Time') }}</option>
                    <option>{{ __('Time') }}</option>
                </select>
            </div>
        </div>

        <div class="mt-10">
            <p>{{ __('Base Currency') }}</p>
            <div class="border shadow flex items-center rounded-sm mt-4 px-5">
                <x-icon name="us_flag" class="w-9 h-9"/>
                <select class="h-full border-0 py-4 w-full outline-none ring-0 focus:outline-none focus:ring-0">
                    <option>{{ __('Time') }}</option>
                    <option>{{ __('Time') }}</option>
                    <option>{{ __('Time') }}</option>
                </select>
            </div>
        </div>

        <div class="mt-10">
            <p>{{ __('Cost Basis Method') }}</p>
            <div class="border shadow flex items-center rounded-sm mt-4 px-5">
                <x-icon name="money-1" class="w-9 h-9"/>
                <select class="h-full border-0 py-4 w-full outline-none ring-0 focus:outline-none focus:ring-0">
                    <option>{{ __('Time') }}</option>
                    <option>{{ __('Time') }}</option>
                    <option>{{ __('Time') }}</option>
                </select>
            </div>
        </div>
        <x-jet-label class="mt-10">{{ __('Note: You can change these settings anytime by clicking your profile at the top right,') }}</x-jet-label>
        <x-jet-label class="mt-3">{{ __('then selecting Settings > Tax Settings.') }}</x-jet-label>
        <label for="email_update" class="flex items-center my-8">
            <x-jet-checkbox id="email_update" name="email_receive" />
            <span class="ml-2 text-sm text-gray-600">{{ __('I agree to the United States of America Tax Disclaimer.') }}</span>
        </label>
        <x-jet-button class="px-10">{{ __('Save') }}</x-jet-button>
    </div>
</div>
