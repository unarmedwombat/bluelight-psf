<x-guest-layout>
    <x-jet-authentication-card>
        <x-slot name="logo">
            <x-jet-authentication-card-logo class="w-60 block" />
        </x-slot>

        <x-slot name="action">
            <p>Think this tool might be useful?</p>
            <a href="{{ route('register') }}" class="w-full block mt-2 mb-12 justify-center inline-flex items-center px-4 py-4 bg-gray-500 text-white border border-transparent font-semibold text-xs text-white uppercase tracking-widest ">
                Apply for registration
            </a>
        </x-slot>

        <div class="text-4axl text-white mt-12 2xl:mt-20 mb-12 2xl:mb-16">
            Major Construction<br>
            Framework Tool
        </div>

        <x-jet-validation-errors class="mb-4" />

        @if (session('status'))
            <div class="mb-4 font-medium text-sm text-green-600">
                {{ session('status') }}
            </div>
        @endif

        <form method="POST" action="{{ route('login') }}">
            @csrf

            <div>
                <x-jet-label for="email" value="{{ __('Email') }}" class="text-white" />
                <x-jet-input id="email" class="block mt-1 w-full leading-6" type="email" name="email" :value="old('email')" required autofocus />
            </div>

            <div class="mt-4">
                <x-jet-label for="password" value="{{ __('Password') }}" class="text-white" />
                <x-jet-input id="password" class="block mt-1 w-full leading-6" type="password" name="password" required autocomplete="current-password" />
            </div>

            <div class="block mt-4">
                <label for="remember_me" class="flex items-center">
                    <x-jet-checkbox id="remember_me" name="remember" />
                    <span class="ml-2 text-sm text-white">{{ __('Remember me') }}</span>
                </label>
            </div>

            <x-jet-button class="w-full justify-center my-6 py-4">
                {{ __('Log in') }}
            </x-jet-button>

            <div class="text-centre">
                @if (Route::has('password.request'))
                    <a class="underline text-sm text-gray-400 hover:text-gray-200" href="{{ route('password.request') }}">
                        {{ __('Forgot your password?') }}
                    </a>
                @endif
            </div>
        </form>

    </x-jet-authentication-card>
</x-guest-layout>
