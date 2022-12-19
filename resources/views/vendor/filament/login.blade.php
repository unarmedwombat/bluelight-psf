<x-guest-layout>
    <x-jet-authentication-card>
        <x-slot name="logo">
            <x-jet-authentication-card-logo class="w-60 block" />
        </x-slot>

        <div class="text-2xl md:text-4xl xl:text-5xl 2xl:text-6xl text-white mt-8 mb-20">
            Construction<br>
            Frameworks
        </div>

        <x-jet-validation-errors class="mb-4" />

        @if (session('status'))
            <div class="mb-4 font-medium text-sm text-green-600">
                {{ session('status') }}
            </div>
        @endif

        <form method="POST" action="{{ route('filament.auth.login') }}">
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

            <x-jet-button class="w-full bg-primary-200 justify-center text-primary-800 my-6 hover:bg-primary-300 active:bg-primary-300 focus:outline-none focus:bg-primary-700 focus:ring focus:bg-primary-200 py-4">
                {{ __('Sign in') }}
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
