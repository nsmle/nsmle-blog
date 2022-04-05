<div class="w-full justify-center inline-block">
    <a href="{{ route('dashboard.chat.index') }}" class="relative md:hidden w-full justify-center inline-block text-center items-center py-2">
        @if (count($unreadChats))
        <span class="absolute inset-0 object-right-top -mr-6">
            <div class="inline-flex items-center px-1.5 py-0.5 border-2 border-neutral-100 dark:border-midnight-300 rounded-full text-xs font-semibold leading-4 bg-red-500 text-white"
                wire:target="getUpdateChats"
                wire:loading.class="animate-pinger"
            >
                {{ count($unreadChats) }}
            </div>
        </span>
        @endif
        @if ($this->activePage)
            <svg class="inline-block fill-slate-700 dark:fill-slate-200 dark:hover:fill-salte-300 dark:hover:fill-slate-200 h-8 w-8" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path d="M14.939,0 C16.28,0 17.57,0.53 18.519,1.481 C19.469,2.43 20,3.71 20,5.05 L20,5.05 L20,12.95 C20,15.74 17.73,18 14.939,18 L14.939,18 L5.06,18 C2.269,18 0,15.74 0,12.95 L0,12.95 L0,5.05 C0,2.26 2.259,0 5.06,0 L5.06,0 Z M16.07,5.2 C15.86,5.189 15.66,5.26 15.509,5.4 L15.509,5.4 L11,9 C10.42,9.481 9.589,9.481 9,9 L9,9 L4.5,5.4 C4.189,5.17 3.759,5.2 3.5,5.47 C3.23,5.74 3.2,6.17 3.429,6.47 L3.429,6.47 L3.56,6.6 L8.11,10.15 C8.67,10.59 9.349,10.83 10.06,10.83 C10.769,10.83 11.46,10.59 12.019,10.15 L12.019,10.15 L16.53,6.54 L16.61,6.46 C16.849,6.17 16.849,5.75 16.599,5.46 C16.46,5.311 16.269,5.22 16.07,5.2 Z" transform="translate(2 3)"/></svg>
        @else
            <svg class="inline-block stroke-midnight-700 dark:stroke-slate-300/80 dark:hover:stroke-salte-300 dark:hover:stroke-slate-200 h-8 w-8" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><g fill="none" fill-rule="evenodd" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" transform="translate(2 3.5)"><path d="M15.2677346,5.56112535 L11.0022884,8.99539646 C10.1950744,9.62826732 9.06350694,9.62826732 8.25629295,8.99539646 L3.95423343,5.56112535"/><path d="M4.88787188,4.13786652e-14 L14.3157895,4.13786652e-14 C15.6751779,0.015246851 16.9690267,0.589927916 17.8960035,1.59020219 C18.8229802,2.59047647 19.3021688,3.92902958 19.2219681,5.29411767 L19.2219681,11.8219949 C19.3021688,13.187083 18.8229802,14.5256361 17.8960035,15.5259104 C16.9690267,16.5261847 15.6751779,17.1008658 14.3157895,17.1161126 L4.88787188,17.1161126 C1.9679634,17.1161126 -2.4308041e-14,14.740665 -2.4308041e-14,11.8219949 L-2.4308041e-14,5.29411767 C-2.4308041e-14,2.37544758 1.9679634,4.13786652e-14 4.88787188,4.13786652e-14 Z"/></g></svg>
        @endif
    </a>
    <x-jet-nav-link href="{{ route('dashboard.chat.index') }}" :active="request()->routeIs('dashboard.chat*')" class="relative hidden md:flex items-center">
        @if ($this->activePage)
            <svg class="inline-block @if (count($unreadChats)) animate-pulse fill-red-500 @else fill-slate-700 dark:fill-slate-200 dark:hover:fill-salte-300 dark:hover:fill-slate-200 @endif h-4 w-4 mr-1 ml-2" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path d="M14.939,0 C16.28,0 17.57,0.53 18.519,1.481 C19.469,2.43 20,3.71 20,5.05 L20,5.05 L20,12.95 C20,15.74 17.73,18 14.939,18 L14.939,18 L5.06,18 C2.269,18 0,15.74 0,12.95 L0,12.95 L0,5.05 C0,2.26 2.259,0 5.06,0 L5.06,0 Z M16.07,5.2 C15.86,5.189 15.66,5.26 15.509,5.4 L15.509,5.4 L11,9 C10.42,9.481 9.589,9.481 9,9 L9,9 L4.5,5.4 C4.189,5.17 3.759,5.2 3.5,5.47 C3.23,5.74 3.2,6.17 3.429,6.47 L3.429,6.47 L3.56,6.6 L8.11,10.15 C8.67,10.59 9.349,10.83 10.06,10.83 C10.769,10.83 11.46,10.59 12.019,10.15 L12.019,10.15 L16.53,6.54 L16.61,6.46 C16.849,6.17 16.849,5.75 16.599,5.46 C16.46,5.311 16.269,5.22 16.07,5.2 Z" transform="translate(2 3)"/></svg>
        @else
            <svg class="inline-block @if (count($unreadChats)) animate-pulse stroke-red-500 @else stroke-midnight-700 dark:stroke-slate-300/80 dark:hover:stroke-salte-300 dark:hover:stroke-slate-200 @endif h-4 w-4 mr-1 ml-2" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><g fill="none" fill-rule="evenodd" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" transform="translate(2 3.5)"><path d="M15.2677346,5.56112535 L11.0022884,8.99539646 C10.1950744,9.62826732 9.06350694,9.62826732 8.25629295,8.99539646 L3.95423343,5.56112535"/><path d="M4.88787188,4.13786652e-14 L14.3157895,4.13786652e-14 C15.6751779,0.015246851 16.9690267,0.589927916 17.8960035,1.59020219 C18.8229802,2.59047647 19.3021688,3.92902958 19.2219681,5.29411767 L19.2219681,11.8219949 C19.3021688,13.187083 18.8229802,14.5256361 17.8960035,15.5259104 C16.9690267,16.5261847 15.6751779,17.1008658 14.3157895,17.1161126 L4.88787188,17.1161126 C1.9679634,17.1161126 -2.4308041e-14,14.740665 -2.4308041e-14,11.8219949 L-2.4308041e-14,5.29411767 C-2.4308041e-14,2.37544758 1.9679634,4.13786652e-14 4.88787188,4.13786652e-14 Z"/></g></svg>
        @endif
        {{ __('Chat') }}
    </x-jet-nav-link>
</div>