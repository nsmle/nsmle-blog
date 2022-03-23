@props(['active'])

@php
$classes = ($active ?? false)
            ? 'block pl-3 pr-4 py-2 border-l-4 border-blue-400 dark:border-blue-800 font-medium text-slate-900 dark:text-slate-200 text-semibold bg-blue-200/50 dark:bg-midnight-200 focus:outline-none focus:text-blue-800 dark:focus:text-blue-200 focus:bg-blue-200/70 dark:focus:bg-midnight-100 dark:focus:border-blue-700 focus:border-blue-700 transition'
            : 'block pl-3 pr-4 py-2 border-l-4 border-transparent text-base font-medium text-slate-700 dark:text-slate-400 hover:text-slate-800 hover:bg-blue-100 dark:hover:bg-midnight-100/40 dark:hover:bg-midnight-500 dark:hover:border-midnight-100 hover:border-blue-400 focus:outline-none focus:text-blue-800 focus:bg-blue-200/50 dark:focus:bg-midnight-100 focus:border-blue-500 dark:focus:border-blue-900 transition';
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</a>
