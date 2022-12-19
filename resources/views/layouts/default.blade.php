<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'BlueLight') }}</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Almarai:wght@300;400;700;800&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="{{ mix('css/app.css') }}">

    <link rel="icon" href="/favicon.png">

@livewireStyles
@stack('styles')
<!-- Scripts -->
    <script src="{{ mix('js/app.js') }}" defer></script>

    <noscript>
        <style>
            .simplebar-content-wrapper {
                overflow: auto;
            }
        </style>
    </noscript>
</head>

<body class="bg-grad h-screen min-w-300">

<header class="py-8 flex items-end text-white">
    <div class="w-1/4 pb-2 pl-12">
        <img src="/img/logo.svg" class="max-w-[16rem] pr-4">
    </div>
    <div class="text-5xl font-light w-7/12">Major Construction Frameworks</div>
    <div class="ml-3 relative w-1/6 text-right pr-12">
        @if(Auth::check())
        <x-jet-dropdown align="right" width="48">
            <x-slot name="trigger">
                @if (Laravel\Jetstream\Jetstream::managesProfilePhotos())
                    <button class="flex text-sm border-2 border-transparent rounded-full focus:outline-none focus:border-gray-300 transition">
                        <img class="h-8 w-8 rounded-full object-cover" src="{{ Auth::user()->profile_photo_url }}" alt="{{ Auth::user()->name }}" />
                    </button>
                @else
                    <span class="inline-flex">
                        <button type="button" class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium text-gray-200 hover:text-white focus:outline-none transition">
                            {{ Auth::user()->name }}

                            <svg class="ml-2 -mr-0.5 h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                            </svg>
                        </button>
                    </span>
                @endif
            </x-slot>

            <x-slot name="content">
                <div class="block px-4 py-2 text-xs text-gray-400">
                    {{ __('Manage Account') }}
                </div>

                <x-jet-dropdown-link href="{{ route('profile.show') }}">
                    {{ __('Profile') }}
                </x-jet-dropdown-link>

                @if (Laravel\Jetstream\Jetstream::hasApiFeatures())
                    <x-jet-dropdown-link href="{{ route('api-tokens.index') }}">
                        {{ __('API Tokens') }}
                    </x-jet-dropdown-link>
                @endif

                <div class="border-t border-gray-100"></div>

                <form method="POST" action="{{ route('logout') }}">
                    @csrf

                    <x-jet-dropdown-link href="{{ route('logout') }}"
                                         onclick="event.preventDefault();
                                                this.closest('form').submit();">
                        {{ __('Log Out') }}
                    </x-jet-dropdown-link>
                </form>
            </x-slot>
        </x-jet-dropdown>
    @else
        <a href="/login">login</a>
    @endif
    </div>
</header>

<div class="bg-gray-500 w-full flex bg-bar">
    <img src="/img/bar.png" class="w-full">
</div>

<main class="mb-12">
    @yield('content')
</main>

<footer class="bg-f-grad mt-24 p-8 flex">
    <div class="w-1/3 2xl:w-1/4">
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 92.46 400 113.96" class="w-48">
        <g fill="#FFFFFF"><path d="M127.83,206.42c-12.73,0-19.44-10.34-19.44-21.72c0-11.39,6.77-21.2,19.85-21.2c9.11,0,15.76,4.73,16.76,13.84h-5.31c-0.7-5.72-5.31-9.17-11.68-9.17c-9.64,0-14.48,7.82-14.48,16.47c0,8.82,4.96,17.05,14.77,17.05c6.54,0,11.5-3.62,11.68-10.68h5.26C145.06,200.52,137.47,206.42,127.83,206.42 M176.88,190.65c0,9.52-5.9,15.35-14.25,15.35c-8.29,0-14.19-5.83-14.19-15.35c0-9.46,5.9-15.36,14.19-15.36C170.98,175.29,176.88,181.2,176.88,190.65 M162.57,179.73c-5.55,0-9.17,4.21-9.17,10.92c0,7.13,4.03,10.92,9.34,10.92c5.55,0,9.17-4.21,9.17-10.92C171.92,183.52,167.89,179.73,162.57,179.73 M222.72,184.57v20.79h-4.85v-19.21c0-4.49-2.51-6.42-5.9-6.42c-4.49,0-7.29,3.44-7.29,9.69v15.95h-4.79v-19.21c0-4.44-2.51-6.42-5.9-6.42c-4.38,0-7.29,3.39-7.29,9.64v16h-4.85v-29.55h4.73v4.79c1.64-3.79,4.67-5.31,8.17-5.31c4.62,0,7.88,2.75,8.7,6.25c0.94-2.57,3.21-6.25,9.41-6.25C218.46,175.29,222.72,178.33,222.72,184.57 M270.31,184.57v20.79h-4.85v-19.21c0-4.49-2.51-6.42-5.9-6.42c-4.5,0-7.3,3.44-7.3,9.69v15.95h-4.79v-19.21c0-4.44-2.51-6.42-5.9-6.42c-4.38,0-7.3,3.39-7.3,9.64v16h-4.85v-29.55h4.73v4.79c1.64-3.79,4.67-5.31,8.18-5.31c4.62,0,7.88,2.75,8.7,6.25c0.93-2.57,3.21-6.25,9.4-6.25C266.05,175.29,270.31,178.33,270.31,184.57 M279.71,191.83c0.18,6.65,4.15,9.87,9.23,9.87c3.68,0,6.72-1.75,7.7-4.9h4.79c-1.52,6.31-7.13,9.23-12.73,9.23c-7.07,0-13.72-4.85-13.72-15.42c0-10.63,6.72-15.3,13.78-15.3c7.07,0,12.9,4.56,12.9,14.25v2.28L279.71,191.83L279.71,191.83z M279.82,187.91h16.99c0-5.14-3.39-8.41-8.18-8.41C284.38,179.51,280.47,181.83,279.82,187.91M321.87,180.14h-1.34c-5.78,0-9.05,3.27-9.05,9.87v15.36h-4.85v-29.55h4.79v5.14c1.52-3.62,4.67-5.43,9.05-5.43h1.4L321.87,180.14L321.87,180.14z M349.25,194.8c-0.47,7.36-6.31,11.21-12.73,11.21c-7.54,0-13.78-4.85-13.78-15.18c0-10.05,5.95-15.54,14.3-15.54c6.77,0,12.03,3.74,12.26,10.8h-4.73c-0.23-3.85-3.09-6.6-7.77-6.6c-5.14,0-9.17,3.44-9.17,11.03c0,8,4.49,11.09,8.99,11.09c4.15,0,7.66-2.62,7.82-6.83L349.25,194.8L349.25,194.8z M354.16,175.82H359v29.55h-4.85V175.82z M388.43,184.69v20.67h-4.73v-4.79c-2.69,4.26-7.18,5.43-10.45,5.43c-5.14,0-9.4-2.92-9.4-8.58c0-7.07,6.24-8.23,8.93-8.7l5.84-1c3.03-0.52,5.02-1.11,5.02-3.91c0-2.98-2.39-4.26-6.01-4.26c-4.56,0-7.18,1.99-7.94,5.2h-4.9c0.88-6.13,6.25-9.46,13.08-9.46C384.28,175.29,388.43,178.1,388.43,184.69 M378.57,191.36l-3.56,0.58c-2.98,0.47-6.25,1.11-6.25,5.08c0,3.45,2.46,4.67,5.49,4.67c4.67,0,9.35-2.98,9.35-8.99v-2.69C382.19,190.65,381.02,190.95,378.57,191.36 M400,205.37h-4.85v-41.52H400V205.37z M356.58,162.93c-1.83,0-3.32,1.48-3.32,3.32c0,1.83,1.48,3.32,3.32,3.32c1.83,0,3.32-1.48,3.32-3.32C359.89,164.41,358.41,162.93,356.58,162.93"/><path d="M140.91,141.99c0,5.84-4.67,11.8-13.67,11.8h-16.82v-40.88h17.64c7.54,0,11.03,4.44,11.03,9.23c0,3.68-2.05,7.7-6.13,9.52C138.35,133.47,140.91,137.61,140.91,141.99 M126.37,130.03c5.26,0,7.71-3.44,7.71-6.72c0-3.03-2.05-5.89-6.77-5.89H115.4v12.61H126.37z M135.78,141.87c0-3.85-2.63-7.47-7.94-7.47h-12.44v14.89h12.03C133.33,149.3,135.78,145.61,135.78,141.87 M151.02,153.79h-4.85v-41.52h4.85V153.79z M182.02,153.79h-4.73v-5.2c-2.05,3.92-5.37,5.55-9.29,5.55c-5.72,0-10.28-3.74-10.28-10.63v-19.28h4.85v18.46c0,4.73,2.81,7.12,6.48,7.12c4.15,0,8.11-3.39,8.11-10.63v-14.95h4.85V153.79L182.02,153.79z M191.71,140.24c0.17,6.66,4.15,9.87,9.22,9.87c3.68,0,6.72-1.75,7.71-4.9h4.79c-1.52,6.31-7.13,9.23-12.73,9.23c-7.07,0-13.72-4.85-13.72-15.42c0-10.63,6.72-15.3,13.78-15.3c7.07,0,12.9,4.56,12.9,14.25v2.28h-21.96V140.24z M191.83,136.32h17c0-5.14-3.39-8.41-8.18-8.41C196.38,127.92,192.48,130.25,191.83,136.32 M245.02,153.79h-25.7v-40.88h5.02v36.38h20.67V153.79z M248.99,124.23h4.85v29.55h-4.85V124.23z M317.95,133.76v20.03h-4.85v-19.56c0-3.21-1.93-6.13-6.42-6.13c-5.26,0-8.7,4.03-8.7,10.57v15.13h-4.85v-41.52h4.85v17.22c1.69-3.27,4.61-5.78,9.57-5.78C313.63,123.72,317.95,127.34,317.95,133.76 M339.03,153.79h-4.26c-4.26,0-8.23-1-8.23-7.88v-17.34h-5.67v-4.33h5.67v-7.88l4.85-1.34v9.23h6.95v4.32h-6.95v16.76c0,2.46,0.52,4.14,3.91,4.14h3.74V153.79L339.03,153.79z M251.4,111.36c-1.83,0-3.32,1.48-3.32,3.32c0,1.83,1.48,3.32,3.32,3.32s3.32-1.49,3.32-3.32S253.24,111.36,251.4,111.36 M286.27,151.98c0,9.34-5.9,13.67-13.61,13.67c-6.13,0-12.56-2.75-13.61-10.4h4.85c0.46,3.39,3.15,6.13,8.82,6.13c5.26,0,8.88-2.34,8.88-9.17v-4.96c-2.05,4.03-6.02,5.31-9.81,5.31c-7.3,0-13.26-4.78-13.26-14.31c0-9.53,5.9-14.54,13.08-14.54c3.85,0,7.82,1.4,9.99,5.14v-4.61h4.67V151.98L286.27,151.98z M281.25,138.14c0-7.13-4.15-10.22-8.82-10.22c-5.08,0-9.17,3.51-9.17,10.22c0,6.72,4.15,10.16,9.17,10.16C277.11,148.3,281.25,145.27,281.25,138.14"/>
    </g>
    <g><defs><path id="SVGID_1_" d="M5.25,92.47C2.4,92.53,0.11,94.79,0,97.62v0.4c0.11,2.86,2.46,5.15,5.35,5.15h68.49c-5.12-6.46-13.01-10.63-21.88-10.71L5.25,92.47L5.25,92.47z"/></defs><use xlink:href="#SVGID_1_"  overflow="visible" fill="#FFFFFF"/><clipPath id="SVGID_2_"><use xlink:href="#SVGID_1_"  overflow="visible"/></clipPath><rect x="0" y="92.47" clip-path="url(#SVGID_2_)" fill="#FFFFFF" width="73.84" height="10.71"/></g>
    <g><defs><path id="SVGID_3_" d="M5.35,112.92c-2.89,0-5.24,2.29-5.35,5.14v0.41c0.11,2.86,2.46,5.15,5.35,5.15H79.8c0.1-0.96,0.15-1.93,0.15-2.92c0-2.7-0.39-5.31-1.1-7.78H5.35L5.35,112.92z"/></defs><use xlink:href="#SVGID_3_"  overflow="visible" fill="#FFFFFF"/><clipPath id="SVGID_4_"><use xlink:href="#SVGID_3_"  overflow="visible"/></clipPath><rect x="0" y="112.92" clip-path="url(#SVGID_4_)" fill="#FFFFFF" width="79.95" height="10.7"/></g>
    <g><defs><path id="SVGID_5_" d="M5.35,133.35c-2.89,0-5.24,2.29-5.35,5.15v0.41c0.11,2.84,2.42,5.12,5.28,5.15h62.29c3.97-2.7,7.21-6.39,9.38-10.7L5.35,133.35L5.35,133.35z"/></defs><use xlink:href="#SVGID_5_"  overflow="visible" fill="#FFFFFF"/><clipPath id="SVGID_6_"><use xlink:href="#SVGID_5_"  overflow="visible"/></clipPath><rect x="0" y="133.35" clip-path="url(#SVGID_6_)" fill="#FFFFFF" width="76.95" height="10.7"/></g>
    <g><defs><path id="SVGID_7_" d="M5.35,153.79c-2.89,0-5.24,2.29-5.35,5.15v0.41c0.11,2.86,2.46,5.15,5.35,5.15h71.6c-2.17-4.32-5.41-8.01-9.38-10.71H5.35L5.35,153.79z"/></defs><use xlink:href="#SVGID_7_"  overflow="visible" fill="#FFFFFF"/><clipPath id="SVGID_8_"><use xlink:href="#SVGID_7_"  overflow="visible"/></clipPath><rect x="0" y="153.79" clip-path="url(#SVGID_8_)" fill="#FFFFFF" width="76.95" height="10.71"/></g>
    <g><defs><path id="SVGID_9_" d="M5.35,174.22c-2.89,0-5.24,2.29-5.35,5.15v0.4c0.11,2.84,2.42,5.11,5.28,5.15h73.57c0.71-2.47,1.1-5.08,1.1-7.78c0-0.99-0.05-1.96-0.15-2.92H5.35L5.35,174.22z"/></defs><use xlink:href="#SVGID_9_"  overflow="visible" fill="#FFFFFF"/><clipPath id="SVGID_10_"><use xlink:href="#SVGID_9_"  overflow="visible"/></clipPath><rect x="0" y="174.22" clip-path="url(#SVGID_10_)" fill="#FFFFFF" width="79.95" height="10.7"/></g>
    <g><defs><path id="SVGID_11_" d="M5.35,194.67c-2.89,0-5.24,2.28-5.35,5.14v0.43c0.11,2.86,2.46,5.14,5.35,5.14h46.37c8.97,0,16.95-4.19,22.12-10.71H5.35z"/></defs><use xlink:href="#SVGID_11_"  overflow="visible" fill="#FFFFFF"/><clipPath id="SVGID_12_"><use xlink:href="#SVGID_11_"  overflow="visible"/></clipPath><rect x="0" y="194.67" clip-path="url(#SVGID_12_)" fill="#FFFFFF" width="73.84" height="10.71"/></g>
</svg>
        <address class="mt-8 text-sm text-white not-italic">Lloyd House,<br>
            Colmore Circus Queensway,<br>
            Birmingham,<br>
            B4 6DG</address>
        <p class="mt-12 text-sm text-primary-100 not-italic">Registered Company Address:</p>
        <p class="mt-4 text-sm text-primary-100 not-italic">
            Lower Ground 5-8 The Sanctuary,<br>
            Westminster,<br>
            London,<br>
            United Kingdom,<br>
            SW1P 3JS
        </p>
    </div>
    <div class="text-white text-base w-1/3 pr-24">
        <p class="font-bold">How to use</p>
        <ul class="mt-4 list-disc ml-4">
            <li class="mb-2">Your region will be automatically allocated aligned to your home
                Force, but you can alter the region if required, by clicking any
                regional box.</li>
            <li class="mb-2">Choose your estimated project budget to ensure the correct value
                Framework Lot is shown.</li>
            <li class="mb-2">You can search by supplier, but this is sensitive to the regions that
                they work in and the value bands that they have been awarded to.</li>
            <li class="mb-2">The available frameworks, along with the supporting information
                for each framework will then be shown.</li>
        </ul>
        <p class="font-bold mt-8 text-lg">Email any questions to <a href="mailto:estatesandenergy@bluelight.police.uk" class="text-primary-200">estatesandenergy@bluelight.police.uk</a></p>
    </div>
    <div class="w-1/12 hidden 2xl:block"></div>
    <div class="text-white text-base w-1/3 pr-24">
        <p class="font-bold">Notes</p>
        <ul class="mt-4 list-disc ml-4">
            <li class="mb-2">Fees and levies are not included as they are commercially
                sensitive but can be obtained by contacting us.</li>
            <li class="mb-2">Any Dynamic Purchasing System (DPS) will not show the
                supplier lists due to potential new entrants, this can be obtained
                by contacting us or the framework provider.</li>
        </ul>
    </div>
</footer>

@livewireScripts

@stack('scripts')
</body>
</html>
