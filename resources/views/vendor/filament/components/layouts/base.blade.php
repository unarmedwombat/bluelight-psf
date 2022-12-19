@props([
    'title' => null,
])

<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" dir="{{ __('filament::layout.direction') ?? 'ltr' }}" class="antialiased bg-gray-100 js-focus-visible">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ $title ? "{$title} - " : null }} {{ config('app.name') }}</title>

        <style>[x-cloak] { display: none !important; }</style>

        @livewireStyles

        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Almarai:wght@300;400;700;800&display=swap" rel="stylesheet">

        @foreach (\Filament\Facades\Filament::getStyles() as $name => $path)
            @if (Str::of($path)->startsWith(['http://', 'https://']))
                <link rel="stylesheet" href="{{ $path }}" />
            @else
                <link rel="stylesheet" href="{{ route('filament.asset', [
                    'file' => "{$name}.css",
                ]) }}" />
            @endif
        @endforeach

        <link rel="stylesheet" href="{{ \Filament\Facades\Filament::getThemeUrl() }}" />

        <link rel="icon" href="/favicon.png">

    </head>

    <body class="bg-grad">
        {{ $slot }}

        @livewireScripts

        <script>
            window.filamentData = @json(\Filament\Facades\Filament::getScriptData());
        </script>

        <script src="{{ route('filament.asset', [
            'id' => Filament\get_asset_id('app.js'),
            'file' => 'app.js',
        ]) }}"></script>

        @foreach (\Filament\Facades\Filament::getScripts() as $name => $path)
            @if (Str::of($path)->startsWith(['http://', 'https://']))
                <script src="{{ $path }}"></script>
            @else
                <script src="{{ route('filament.asset', [
                    'file' => "{$name}.js",
                ]) }}"></script>
            @endif
        @endforeach

        @stack('scripts')
    </body>
</html>
