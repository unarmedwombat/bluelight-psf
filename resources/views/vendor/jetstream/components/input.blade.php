@props(['disabled' => false])

<input {{ $disabled ? 'disabled' : '' }} {!! $attributes->merge(['class' => 'border-gray-300 focus:border-primary-300 focus:ring focus:ring-primary-300 focus:ring-opacity-50']) !!}>
