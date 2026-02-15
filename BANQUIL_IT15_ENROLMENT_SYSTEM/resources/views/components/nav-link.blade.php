@props(['active'])

@php
$classes = 'inline-flex items-center px-3 py-2 text-base font-medium text-gray-600 hover:text-gray-900 shrink-0';
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</a>
