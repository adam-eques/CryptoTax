<div class="text-center relative">
    <div class="absolute left-1/2 -translate-x-1/2">
        <img src="{{ asset('assets/img/subpage_images/landing_logo_bg_pattern.svg') }}" class="mx-auto"/>
    </div>
    <div class="relative">
        <p class="text-lg">{{ __('Simple & Easy') }}</p>
        <p class="text-2xl lg:text-3xl xl:text-4xl font-bold my-5">{{ __('Our Pricing') }}</p>
        <p class="text-gray-400">{{ __('Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et') }}</p>
        <P class="text-gray-400 mt-3">{{ __('dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation') }}</P>
        <div class="relative mt-10 main-carousel">
            @php
                $plans = [
                    [ 'name' => 'Freemium', 'description_1' => 'Have a go and test your', 'description_2' => 'superpowers', 'cost' => "0.00", 'service' => [
                        ' 1 Team', '1 Installed Agent', 'Real-Time Feedback', 'Real-Time Feedback'], 'button_title' => 'Signup for free'],
                    [ 'name' => 'PRO', 'description_1' => 'Experiment the power of', 'description_2' => 'infinite possibilities', 'cost' => "80.00", 'service' => [
                        ' 1 Team', '1 Installed Agent', 'Real-Time Feedback', 'Video Dedicated Support', '1 Attacked Targets Per Month'], 'button_title' => 'Go to Pro' ],
                    [ 'name' => 'Business', 'description_1' => 'Have a go and test your', 'description_2' => 'superpowers', 'cost' => "16.00", 'service' => [
                        ' 1 Team', '1 Installed Agent', 'Real-Time Feedback', 'Real-Time Feedback'], 'button_title' => 'Signup for free'],
                ]
            @endphp
            @foreach ($plans as $plan)
            <div class="w-full md:w-1/2 xl:w-1/3 carousel-cell">
                <div class="mx-0 md:mx-2 2xl:mx-10">                        
                    <div class="p-4 rounded relative @if ($plan['name'] !== 'PRO') mt-6 bg-gray-300 text-primary @else bg-primary text-white @endif">
                        <img src="{{ asset('assets/img/subpage_images/membership_bg.svg') }}" class="absolute left-1/2 -translate-x-1/2"/>                      
                        <p class="my-4 @if ($plan['name'] !== 'PRO') text-2xl font-bold  @else text-3xl font-extrabold  @endif">{{ __($plan['name']) }}</p>
                        <p class="text-gray-400">{{ __($plan['description_1']) }}</p>
                        <p class="text-gray-400">{{ __($plan['description_2']) }}</p>
                        <div class="flex justify-center space-x-3 items-start mt-4">
                            <p class="text-lg">$</p>
                            <p class="text-5xl font-extrabold">{{ $plan['cost'] }}</p>
                        </div>
                        <div class="bg-white rounded mt-4 p-6 space-y-8 text-primary">
                            @foreach ($plan['service'] as $service)                                    
                                <div class="flex items-center space-x-2 xl:space-x-8">
                                    <x-icon name="check" class="w-4 h-4 rounded-full"/>
                                    <p class="font-bold">{{ __($service) }}</p>
                                </div>
                            @endforeach
                            @if ($plan['name'] == 'PRO')                                    
                                <x-button variant="primary" class="w-full justify-center">{{ __($plan['button_title']) }}</x-button>
                            @else
                                <x-button variant="secondary" class="w-full justify-center">{{ __($plan['button_title']) }}</x-button>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</div>

@push('scripts')
<script type="module">
    var elem = document.querySelector('.main-carousel');
    var flkty = new Flickity( elem, {
        prevNextButtons: false,
        cellAlign: 'left',
        contain: true,
        pageDots: false
    });
</script>
@endpush