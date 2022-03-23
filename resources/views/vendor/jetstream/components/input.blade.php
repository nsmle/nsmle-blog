@props(['disabled' => false])

<input {{ $disabled ? 'disabled' : '' }} {!! $attributes->merge(['class' => 'border-slate-300 text-slate-800 dark:text-midnight-800 dark:bg-neutral-400 focus:border-indigo-300 focus:ring focus:ring-indigo-200 dark:focus:ring-indigo-400 focus:ring-opacity-50 dark:focus:ring-opacity-40 rounded-md shadow-sm']) !!}>
