<div class="min-h-screen flex flex-col sm:justify-center items-center py-4 bg-transparent">
    
    @if (isset($logo))
    <div>
        {{ $logo }}
    </div>
    @endif
    
    @if (isset($title))
    <div class="w-full xs:w-11/12 rounded-lg sm:max-w-md">
        {{ $title }}
    </div>
    @endif
    
    @if (isset($validation))
    <div class="w-full xs:w-11/12 -mb-2 mt-4 sm:max-w-md">
        {{ $validation }}
    </div>
    @endif
        
    <div class="w-full xs:w-11/12 rounded-lg sm:max-w-md mt-4 px-6 py-6 bg-neutral-200 dark:bg-midnight-400 dark:text-neutral-100/80 shadow-md shadow-blue-50 dark:shadow-midnight-600 overflow-hidden border border-slate-300 dark:border-slate-700">
        {{ $slot }}
    </div>
    
    @if (isset($another))
    <div class="w-full xs:w-11/12 rounded-lg sm:max-w-md mt-6 px-6 py-4 overflow-hidden border border-slate-300 dark:border-slate-700 bg-transparent">
        {{ $another }}
    </div>
    @endif
    
    @if (isset($policy))
    <div class="w-full xs:w-11/12 outline-none rounded-lg sm:max-w-md mt-12 px-4 md:px-8 py-4 bg-transparent">
        {{ $policy  }}
    </div>
    @endif
</div>
