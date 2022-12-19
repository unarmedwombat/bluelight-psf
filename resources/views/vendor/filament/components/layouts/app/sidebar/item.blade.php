@props([
    'active' => false,
    'icon',
    'url',
])

<li>
    <a
        href="{{ $url }}"
        @class([
            'flex items-center gap-3 px-3 py-2 rounded-lg font-medium transition',
            'hover:bg-primary-400 focus:bg-primary-400' => ! $active,
            'bg-primary-200 text-gray-800' => $active,
        ])
    >
        <x-dynamic-component :component="$icon" class="h-5 w-5" />

        <span>
            {{ $slot }}
        </span>
    </a>
</li>
