<x-guest-layout>
    <x-jet-authentication-card>
        <x-slot name="logo">
            <x-jet-authentication-card-logo />
        </x-slot>
        <div class="text-center mt-3 sm:mt-5">
            <h2 class="text-3xl font-extrabold">{{ __('Sign in to myCrypto Tax') }}</h2>
            <p class="text-base mt-3">{{__('Welcome back! Please enter your details')}}</p>
        </div>
        {{-- <x-jet-validation-errors class="mb-4" /> --}}

        {{-- @if (session('status'))
            <div class="mb-4 font-medium text-sm text-green-600">
                {{ session('status') }}
            </div>
        @endif --}}
        <div class="mt-5 sm:mt-20 grid grid-cols-1 md:grid-cols-2 gap-0 md:gap-44 relative">
            <div class="absolute left-1/2 top-1/2 -translate-y-1/2 -translate-x-1/2 hidden md:block">
                <div class="w-12 h-12 bg-primary rounded-full text-white text-lg font-bold flex justify-center items-center">
                    <p>OR</p>
                </div>
            </div>
            <div class="px-2">
                <p class="text-lg font-bold">{{ __('Free Sign In') }}</p>
                <div class="h-full flex items-center">
                    <div class="space-y-0 md:space-y-6 space-x-4 md:space-x-0 grid grid-cols-2 md:grid-cols-1">
                        <x-social-auth-item name="google" icon="google-circle">{{ __("Sign in with Google") }}</x-social-auth-item>
                        <x-social-auth-item name="facebook" icon="facebook-circle">{{ __("Sign in with Facebook") }}</x-social-auth-item>
                    </div>
                </div>
            </div>
            <div class="px-2">
                <form method="POST" action="{{ route('login') }}">
                    @csrf
        
                    <div>
                        <x-jet-label for="email" value="{{ __('Email Address') }}" />
                        <x-jet-input id="email" class="block mt-3 w-full" type="email" name="email" :value="old('email')" required autofocus />
                    </div>
        
                    <div class="mt-9">
                        <x-jet-label for="password" value="{{ __('Password') }}" />
                        <x-jet-input id="password" class="block mt-3 w-full" type="password" name="password" required autocomplete="current-password" />
                    </div>
        
                    <div class="my-8 flex justify-between items-center">
                        <label for="remember_me" class="flex items-center">
                            <x-jet-checkbox id="remember_me" name="remember" />
                            <span class="ml-2 text-sm text-gray-600">{{ __('Remember me') }}</span>
                        </label>
                        @if (Route::has('password.request'))
                            <a class="font-bold text-sm text-gray-600 hover:text-gray-900" href="{{ route('password.request') }}">
                                {{ __('Forgot your password?') }}
                            </a>
                        @endif
                    </div>
                    <x-jet-button class="w-full font-bold flex justify-center text-lg tracking-tighter">
                        {{ __('SIGN IN') }}
                    </x-jet-button>
                    <div class="mt-7 text-sm tracking-tight">{{ __("Don't have an account?.") }} <a href="{{ route('register') }}" class="font-bold">{{ __('Sign up Now') }}</a></span>
                </form>
            </div>
        </div>

    </x-jet-authentication-card>
</x-guest-layout>
