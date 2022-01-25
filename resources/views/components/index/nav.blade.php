<nav class="bg-transparent absolute w-full z-10" x-data="{mobile:false}">
    <div class="mx-auto px-3 xs:px-4 xl:max-w-screen-2xl lg:px-5">
        <div class="flex items-center justify-between py-2 lg:py-0 lg:h-20">
            <div class="flex-shrink-0">
                <a href="{{ route("index") }}" class="flex items-center text-white group">
                    <img src="{{asset('/assets/img/logo_primary.svg')}}" alt="Logo" class="w-9">
                    <span class="ml-2 text-sm xl:text-xl font-bold text-primary">myCrypto Tax</span>
                </a>
            </div>

            <div class="ml-auto mr-5 flex items-center gap-4">
                <x-button tag="a" href="{{ route('login') }}" class="bg-transparent">{{ __('Sign in') }}</x-button>
                <x-button tag="a" href="{{ route('register') }}" variant="secondary" class="font-bold">{{ __('Sign Up') }}</x-button>
            </div>
        </div>
    </div>
</nav>