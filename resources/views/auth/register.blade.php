<x-guest-layout>
    <x-jet-authentication-card>
        <x-slot name="logo">
            <x-jet-authentication-card-logo class="w-60 block" />
        </x-slot>

        <x-slot name="action">
            <p>Already registered?</p>
            <a href="{{ route('login') }}" class="w-full mt-2 mb-12 justify-center inline-flex items-center px-4 py-4 bg-gray-500 text-white border border-transparent font-semibold text-xs text-white uppercase tracking-widest ">
                Go to log in
            </a>
        </x-slot>

        <div class="text-4axl text-white mt-4 mb-6">
            Major Construction<br>
            Framework Tool
        </div>
        <div class="text-3xl text-white mt-4 2xl:mt-8 mb-4 2xl:mb-8">
            Registration Application
        </div>

        <x-jet-validation-errors class="mb-4" />

        @if (session('status'))
            <div class="mb-4 font-medium text-sm text-green-600">
                {{ session('status') }}
            </div>
        @endif

        <form method="POST" action="{{ route('apply') }}">
            @csrf

            <div>
                <x-jet-label for="client" value="{{ __('Your organisation') }}" class="text-white" />
                <x-jet-input id="client" class="block mt-1 w-full leading-6" type="text" name="client" :value="old('client')" required autofocus />
            </div>

            <div class="mt-4">
                <x-jet-label for="name" value="{{ __('Your name') }}" class="text-white" />
                <x-jet-input id="name" class="block mt-1 w-full leading-6" type="text" name="name" :value="old('name')" required />
            </div>

            <div class="mt-4">
                <x-jet-label for="email" value="{{ __('Email') }}" class="text-white" />
                <x-jet-input id="email" class="block mt-1 w-full leading-6" type="email" name="email" :value="old('email')" required autofocus />
            </div>

            <div class="mt-4">
                <x-jet-label for="phone" value="{{ __('Phone') }}" class="text-white" />
                <x-jet-input id="phone" class="block mt-1 w-full leading-6" type="text" name="phone" :value="old('phone')" required />
            </div>

            <x-jet-button class="w-full justify-center mt-8 py-4">
                {{ __('Apply') }}
            </x-jet-button>
        </form>

    </x-jet-authentication-card>
</x-guest-layout>
