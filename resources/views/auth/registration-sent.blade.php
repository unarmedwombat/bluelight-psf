<x-guest-layout>
    <x-jet-authentication-card>
        <x-slot name="logo">
            <x-jet-authentication-card-logo class="w-60 block" />
        </x-slot>

        <x-slot name="action">
            <a href="https://bluelightcommercial.police.uk" class="w-full mt-2 mb-12 justify-center inline-flex items-center px-4 py-4 bg-gray-500 text-white border border-transparent font-semibold text-xs text-white uppercase tracking-widest ">
                Visit BlueLight Commercial
            </a>
        </x-slot>

        <div class="text-4axl text-white mt-4 mb-6">
            Major Construction<br>
            Framework Tool
        </div>
        <div class="text-3xl text-white mt-4 2xl:mt-8 mb-4 2xl:mb-8">
            Application received
        </div>

        <p class="text-white text-xl">Thank you for your application. We will be in touch with you with an update as soon as we can.</p>

        <x-jet-validation-errors class="mb-4" />

        @if (session('status'))
            <div class="mb-4 font-medium text-sm text-green-600">
                {{ session('status') }}
            </div>
        @endif


    </x-jet-authentication-card>
</x-guest-layout>
