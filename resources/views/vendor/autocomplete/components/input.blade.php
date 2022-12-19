<input
    type="text"
    autocomplete="off"
    {{ $attributes->class('w-full pl-4 py-2 text-gray-700 text-lg placeholder-gray-400') }}
    x-bind:class="[selected ? 'pr-9' : 'pr-4']"
    x-bind:disabled="selected" />
