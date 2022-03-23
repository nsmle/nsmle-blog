@props(['active'])

@php
$classes = ($active ?? false)
            ? 'inline-flex items-center px-1 my-4 font-semibold dark:text-gray-200 text-sm font-medium leading-5 text-gray-900 focus:outline-none focus:border-neutral-500 transition'
            : 'inline-flex items-center px-1 my-4 rounded-lg text-sm font-medium leading-5 text-gray-500 dark:text-gray-400 hover:text-gray-700 hover:cursor-pointer dark:hover:text-gray-600 hover:border-gray-300 focus:outline-none focus:text-gray-800 dark:focus:text-gray-700 focus:border-gray-300 transition';
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</a>
