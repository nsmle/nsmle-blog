<nav class="fixed z-40 w-screen transition duration-700"
    :class="{'rounded-b-xl': open, 'rounded-none': ! open }"
    x-data="{ 
        open: false,
        navMobile() {
            this.open = ! this.open;
            
            if (this.open && window.scrollY < 30) {
                document.querySelector('nav').classList.add('drop-shadow-md', 'bg-neutral-100', 'dark:bg-midnight-300')
            } else if (!this.open && window.scrollY < 30) {
                document.querySelector('nav').classList.remove('drop-shadow-md', 'bg-neutral-100', 'dark:bg-midnight-300')
            }
        }
    }"
    x-init="(window.scrollY > 0) ? document.querySelector('nav').classList.add('drop-shadow-md', 'bg-neutral-100', 'dark:bg-midnight-300') : '';">
    <!-- Primary Navigation Menu -->
    <div class="max-w-7xl sm:hidden md:block mx-auto px-4 sm:px-6 lg:px-8" :class="{'bg-neutral-400 dark:bg-midnight-500/60': open, '': ! open }">
        <div class="flex justify-between h-16">
            <div class="flex">
                <!-- Logo -->
                <div class="shrink-0 flex">
                    <a href="{{ route('dashboard') }}" class="inline-flex items-center justify-center">
                        <x-jet-application-mark class="block h-10 w-auto rounded" />
                        <p class="text-2xl font-bold text-midnight-800 dark:text-neutral-100">{{ (config('app.name') !== 'Nsmle Blog') ? config('app.name') : __('Blog') }}</p>
                    </a>
                </div>

                <!-- Navigation Links -->
                <div class="hidden space-x-2 sm:-my-px sm:ml-10 sm:flex justify-center items-center text-center">
                    <x-jet-nav-link href="{{ route('dashboard.home.index') }}" :active="request()->routeIs('dashboard')">
                        @if (request()->routeIs('dashboard.home.index'))
        				    <svg class="inline-block fill-midnight-800 dark:fill-slate-200 dark:hover:fill-salte-300 dark:hover:fill-slate-200 h-4 w-4 mr-1 ml-2" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path d="M6.63477851,18.7733424 L6.63477851,15.7156161 C6.63477851,14.9350667 7.27217143,14.3023065 8.05843544,14.3023065 L10.9326107,14.3023065 C11.310188,14.3023065 11.6723007,14.4512083 11.9392882,14.7162553 C12.2062757,14.9813022 12.3562677,15.3407831 12.3562677,15.7156161 L12.3562677,18.7733424 C12.3538816,19.0978491 12.4820659,19.4098788 12.7123708,19.6401787 C12.9426757,19.8704786 13.2560494,20 13.5829406,20 L15.5438266,20 C16.4596364,20.0023499 17.3387522,19.6428442 17.9871692,19.0008077 C18.6355861,18.3587712 19,17.4869804 19,16.5778238 L19,7.86685918 C19,7.13246047 18.6720694,6.43584231 18.1046183,5.96466895 L11.4340245,0.675869015 C10.2736604,-0.251438297 8.61111277,-0.221497907 7.48539114,0.74697893 L0.967012253,5.96466895 C0.37274068,6.42195254 0.0175522924,7.12063643 0,7.86685918 L0,16.568935 C0,18.4638535 1.54738155,20 3.45617342,20 L5.37229029,20 C6.05122667,20 6.60299723,19.4562152 6.60791706,18.7822311 L6.63477851,18.7733424 Z" transform="translate(2.5 2)"/></svg>
        				@else
        				    <svg class="inline-block stroke-midnight-700 dark:stroke-slate-300/80 dark:hover:stroke-salte-300 dark:hover:stroke-slate-200 h-4 w-4 mr-1 ml-2" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M6.65721519,18.7714023 L6.65721519,15.70467 C6.65719744,14.9246392 7.29311743,14.2908272 8.08101266,14.2855921 L10.9670886,14.2855921 C11.7587434,14.2855921 12.4005063,14.9209349 12.4005063,15.70467 L12.4005063,15.70467 L12.4005063,18.7809263 C12.4003226,19.4432001 12.9342557,19.984478 13.603038,20 L15.5270886,20 C17.4451246,20 19,18.4606794 19,16.5618312 L19,16.5618312 L19,7.8378351 C18.9897577,7.09082692 18.6354747,6.38934919 18.0379747,5.93303245 L11.4577215,0.685301154 C10.3049347,-0.228433718 8.66620456,-0.228433718 7.51341772,0.685301154 L0.962025316,5.94255646 C0.362258604,6.39702249 0.00738668938,7.09966612 0,7.84735911 L0,16.5618312 C0,18.4606794 1.55487539,20 3.47291139,20 L5.39696203,20 C6.08235439,20 6.63797468,19.4499381 6.63797468,18.7714023 L6.63797468,18.7714023" transform="translate(2.5 2)"/></svg>
        				@endif
        				{{ __('Home') }}
                    </x-jet-nav-link>
                    <x-jet-nav-link href="{{ route('dashboard.post.index') }}" :active="request()->routeIs('dashboard.post*')">
                        <svg class="inline-block stroke-midnight-700 dark:stroke-slate-300/80 dark:hover:stroke-salte-300 dark:hover:stroke-slate-200 h-4 w-4 mr-1 ml-2" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><g fill="none" fill-rule="evenodd" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" transform="translate(2 3.5)"><path d="M15.2677346,5.56112535 L11.0022884,8.99539646 C10.1950744,9.62826732 9.06350694,9.62826732 8.25629295,8.99539646 L3.95423343,5.56112535"/><path d="M4.88787188,4.13786652e-14 L14.3157895,4.13786652e-14 C15.6751779,0.015246851 16.9690267,0.589927916 17.8960035,1.59020219 C18.8229802,2.59047647 19.3021688,3.92902958 19.2219681,5.29411767 L19.2219681,11.8219949 C19.3021688,13.187083 18.8229802,14.5256361 17.8960035,15.5259104 C16.9690267,16.5261847 15.6751779,17.1008658 14.3157895,17.1161126 L4.88787188,17.1161126 C1.9679634,17.1161126 -2.4308041e-14,14.740665 -2.4308041e-14,11.8219949 L-2.4308041e-14,5.29411767 C-2.4308041e-14,2.37544758 1.9679634,4.13786652e-14 4.88787188,4.13786652e-14 Z"/></g></svg>
                        {{ __('Chat') }}
                    </x-jet-nav-link>
                    <x-jet-nav-link href="{{ route('dashboard.post.index') }}" :active="request()->routeIs('dashboard.post*')">
                        @if (request()->routeIs('dashboard.post.*'))
        			        <svg class="inline-block fill-midnight-800 dark:fill-slate-200 dark:hover:fill-salte-300 dark:hover:fill-slate-200 h-4 w-4 mr-1 ml-2" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path d="M13.191,0 C16.28,0 18,1.78 18,4.83 L18,4.83 L18,15.16 C18,18.26 16.28,20 13.191,20 L13.191,20 L4.81,20 C1.77,20 0,18.26 0,15.16 L0,15.16 L0,4.83 C0,1.78 1.77,0 4.81,0 L4.81,0 Z M5.08,13.74 C4.78,13.71 4.49,13.85 4.33,14.11 C4.17,14.36 4.17,14.69 4.33,14.95 C4.49,15.2 4.78,15.35 5.08,15.31 L5.08,15.31 L12.92,15.31 C13.319,15.27 13.62,14.929 13.62,14.53 C13.62,14.12 13.319,13.78 12.92,13.74 L12.92,13.74 Z M12.92,9.179 L5.08,9.179 C4.649,9.179 4.3,9.53 4.3,9.96 C4.3,10.39 4.649,10.74 5.08,10.74 L5.08,10.74 L12.92,10.74 C13.35,10.74 13.7,10.39 13.7,9.96 C13.7,9.53 13.35,9.179 12.92,9.179 L12.92,9.179 Z M8.069,4.65 L5.08,4.65 L5.08,4.66 C4.649,4.66 4.3,5.01 4.3,5.44 C4.3,5.87 4.649,6.22 5.08,6.22 L5.08,6.22 L8.069,6.22 C8.5,6.22 8.85,5.87 8.85,5.429 C8.85,5 8.5,4.65 8.069,4.65 L8.069,4.65 Z" transform="translate(3 2)"/></svg>
        		        @else
        				    <svg class="inline-block stroke-midnight-700 dark:stroke-slate-300/80 dark:hover:stroke-salte-300 dark:hover:stroke-slate-200 h-4 w-4 mr-1 ml-2" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><g fill="none" fill-rule="evenodd" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" transform="translate(3 2)"><line x1="12.716" x2="5.496" y1="14.223" y2="14.223"/><line x1="12.716" x2="5.496" y1="10.037" y2="10.037"/><line x1="8.251" x2="5.496" y1="5.86" y2="5.86"/><path d="M12.9086,0.7498 C12.9086,0.7498 5.2316,0.7538 5.2196,0.7538 C2.4596,0.7708 0.7506,2.5868 0.7506,5.3568 L0.7506,14.5528 C0.7506,17.3368 2.4726,19.1598 5.2566,19.1598 C5.2566,19.1598 12.9326,19.1568 12.9456,19.1568 C15.7056,19.1398 17.4156,17.3228 17.4156,14.5528 L17.4156,5.3568 C17.4156,2.5728 15.6926,0.7498 12.9086,0.7498 Z"/></g></svg>
        				@endif
        				{{ __('Post') }}
                    </x-jet-nav-link>
                    @livewire('layouts.navigations.notification')
                </div>
                
            </div>

            <div class="hidden sm:flex sm:items-center sm:ml-6">
                <!-- Notification Desktop -->
                
                <!-- Toggle Darkmode -->
                <div id="theme-toggle-desktop">
                    @livewire('toggle-darkmode')
                </div>
                <!-- Teams Dropdown -->
                @if (Laravel\Jetstream\Jetstream::hasTeamFeatures())
                    <div class="ml-3 relative">
                        <x-jet-dropdown align="right" width="60">
                            <x-slot name="trigger">
                                <span class="inline-flex rounded-md">
                                    <button type="button" class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 bg-white hover:bg-gray-50 hover:text-gray-700 focus:outline-none focus:bg-gray-50 active:bg-gray-50 transition">
                                        {{ Auth::user()->currentTeam->name }}

                                        <svg class="ml-2 -mr-0.5 h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                            <path fill-rule="evenodd" d="M10 3a1 1 0 01.707.293l3 3a1 1 0 01-1.414 1.414L10 5.414 7.707 7.707a1 1 0 01-1.414-1.414l3-3A1 1 0 0110 3zm-3.707 9.293a1 1 0 011.414 0L10 14.586l2.293-2.293a1 1 0 011.414 1.414l-3 3a1 1 0 01-1.414 0l-3-3a1 1 0 010-1.414z" clip-rule="evenodd" />
                                        </svg>
                                    </button>
                                </span>
                            </x-slot>

                            <x-slot name="content">
                                <div class="w-60">
                                    <!-- Team Management -->
                                    <div class="block px-4 py-2 text-xs text-gray-400">
                                        {{ __('Manage Team') }}
                                    </div>

                                    <!-- Team Settings -->
                                    <x-jet-dropdown-link href="{{ route('teams.show', Auth::user()->currentTeam->id) }}">
                                        {{ __('Team Settings') }}
                                    </x-jet-dropdown-link>

                                    @can('create', Laravel\Jetstream\Jetstream::newTeamModel())
                                        <x-jet-dropdown-link href="{{ route('teams.create') }}">
                                            {{ __('Create New Team') }}
                                        </x-jet-dropdown-link>
                                    @endcan

                                    <div class="border-t border-gray-100"></div>

                                    <!-- Team Switcher -->
                                    <div class="block px-4 py-2 text-xs text-gray-400">
                                        {{ __('Switch Teams') }}
                                    </div>

                                    @foreach (Auth::user()->allTeams() as $team)
                                        <x-jet-switchable-team :team="$team" />
                                    @endforeach
                                </div>
                            </x-slot>
                        </x-jet-dropdown>
                    </div>
                @endif

                
                <!-- Settings Dropdown -->
                <div class="ml-3 relative">
                    @if (Auth::check())
                    <x-jet-dropdown align="right" width="48">
                        <x-slot name="trigger">
                        
                            @if (Laravel\Jetstream\Jetstream::managesProfilePhotos())
                                <button class="flex text-sm border-2 border-transparent rounded-full focus:outline-none focus:border-neutral-300 dark:focus:border-midnight-700 transition">
                                    <img class="h-8 w-8 rounded-full object-cover" src="{{ Auth::user()->profile_photo_url }}" alt="{{ Auth::user()->name }}" />
                                </button>
                            @else
                                <span class="inline-flex rounded-md">
                                    <button type="button" class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 bg-white hover:text-gray-700 focus:outline-none transition">
                                        {{ Auth::user()->name }}

                                        <svg class="ml-2 -mr-0.5 h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                            <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                        </svg>
                                    </button>
                                </span>
                            @endif
                        </x-slot>

                        <x-slot name="content">
                                    
                            <!-- Dashboard Management -->
                            <div class="block px-4 py-2 text-xs text-gray-400 dark:text-gray-400">
                                {{ __('Beralih ke Halaman Depan') }}
                            </div>
                            
                            <div x-data="{ open: false }">
                                <div :class="{ 'bg-neutral-200/60 dark:bg-midnight-400' : open, 'bg-none' : ! open }" class="duration-700 transition">
                                    <div @click="open = ! open" type="button" class="block w-full items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-t-md text-midnight-800/80 dark:text-slate-400 focus:outline-none transition">
                                        <i class="fa-solid fa-repeat opacity-70 mr-2"></i>{{ __('Beralih') }}<svg class="float-right duration-700 transition" :class="{ 'rotate-180' : open }" fill="currentColor" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24" height="24"><path d="M15.3 9.3a1 1 0 0 1 1.4 1.4l-4 4a1 1 0 0 1-1.4 0l-4-4a1 1 0 0 1 1.4-1.4l3.3 3.29 3.3-3.3z" ></path></svg>
                                    </div>
                                    <ul x-show="open"
                                        x-transition:enter="transition ease-out duration-200"
                                        x-transition:enter-start="transform opacity-0 scale-95"
                                        x-transition:enter-end="transform opacity-100 scale-100"
                                        x-transition:leave="transition ease-in duration-75"
                                        x-transition:leave-start="transform opacity-100 scale-100"
                                        x-transition:leave-end="transform opacity-0 scale-95"
                                        class="flex w-full list-disc px-6 rounded-b-md text-left grid grid-rows-2"
                                        >
                                        <li class="inline-flex w-full float-left text-left py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-midnight-600 hover:text-blue-500 dark:text-slate-400/80 dark:hover:text-slate-300 focus:outline-none transition">
                                            <a href="{{ route('dashboard') }}">{{ __('Home') }}</a>
                                        </li>
                                        <li class="inline-flex w-full float-left text-left py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-midnight-600 hover:text-blue-500 dark:text-slate-400/80 dark:hover:text-slate-300 focus:outline-none transition">
                                            <a href="{{ route('post') }}">{{ __('Post') }}</a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            
                            {{-- <x-jet-dropdown-link href="{{ route('home') }}">
                                {{ __('Home') }}
                            </x-jet-dropdown-link> --}}
                            
                            <div class="block border-t border-slate-300 dark:border-slate-700"></div>
                            
                            <!-- Account Management -->
                            <div class="block px-4 py-2 text-xs text-gray-400 dark:text-gray-400">
                                {{ __('Manage Account') }}
                            </div>

                            <x-jet-dropdown-link href="{{ url(Auth::user()->username) }}">
                                <i class="fa-solid fa-user opacity-70 mr-2"></i>{{ __('Account') }}
                            </x-jet-dropdown-link>
                            
                            <x-jet-dropdown-link href="">
                                <i class="fa-solid fa-gear opacity-70 mr-2"></i>{{ __('Settings') }}
                            </x-jet-dropdown-link>

                            @if (Laravel\Jetstream\Jetstream::hasApiFeatures())
                                <x-jet-dropdown-link href="{{ route('api-tokens.index') }}">
                                    {{ __('API Tokens') }}
                                </x-jet-dropdown-link>
                            @endif

                            <div class="border-t border-slate-300 dark:border-slate-700"></div>

                            <!-- Authentication -->
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf

                                <x-jet-dropdown-link href="{{ route('logout') }}"
                                         onclick="event.preventDefault();
                                                this.closest('form').submit();">
                                    <i class="fa-solid fa-arrow-right-from-bracket opacity-70 mr-2"></i>{{ __('Log Out') }}
                                </x-jet-dropdown-link>
                            </form>
                        </x-slot>
                    </x-jet-dropdown>
                    @else
                        <!-- Button Login -->
                        <livewire:components.button-secondary-link :text="'Masuk'" :href="'/login'">
                    @endif
                </div>
            </div>

            <!-- Hamburger -->
            <div class="-mr-2 flex items-center sm:hidden">
                
                <!-- Toggle Darkmode Mobile -->
                <div id="theme-toggle-mobile">
                    @livewire('toggle-darkmode')
                </div> 
                
                @if (request()->routeIs('profile.*'))
                <button @click="navMobile()" class="inline-flex items-center justify-center p-2 rounded-md text-slate-400 hover:text-slate-500 hover:bg-transparent focus:outline-none focus:bg-transparent focus:text-slate-500 hover:bg-neutral-400 dark:hover:bg-midnight-900/50  focus:outline-none focus:shadow rounded-xl transition">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
                @else
                <button class="inline-flex items-center justify-center p-2 rounded-md text-slate-400 hover:text-slate-500 hover:bg-transparent focus:outline-none focus:bg-transparent focus:text-slate-500 hover:bg-neutral-400 dark:hover:bg-midnight-900/50  focus:outline-none focus:shadow rounded-xl transition">
                    <svg class="h-6 w-6 stroke-slate-500 dark:stroke-slate-400" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><g fill="none" fill-rule="evenodd" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" transform="translate(2 2)"><circle cx="9.767" cy="9.767" r="8.989"/><line x1="16.018" x2="19.542" y1="16.485" y2="20"/></g></svg>
                </button>
                @endif
                
            </div>
        </div>
    </div>

    <!-- Responsive Navigation Menu -->
    @if (request()->routeIs('profile.*'))
    <div x-show="open" x-ref="responsiveNavigationMenu" 
        x-init="$refs.responsiveNavigationMenu.classList.remove('hidden')"
        x-transition:enter="transition ease-out duration-200"
        x-transition:enter-start="transform opacity-0 scale-95"
        x-transition:enter-end="transform opacity-100 scale-100"
        x-transition:leave="transition ease-in duration-100"
        x-transition:leave-start="transform opacity-100 scale-100"
        x-transition:leave-end="transform opacity-0 scale-95"
        class="hidden md:hidden w-full border-b border-gray-200 dark:border-midnight-700"
        :class="{'rounded-b-lg bg-neutral-400 dark:bg-midnight-500/60': open, '': ! open}"
    >
        <div class="pt-2 pb-3 space-y-1">
            <x-jet-responsive-nav-link href="{{ Auth::user()->username }}" :active="request()->routeIs('profile.show') && request()->route()->username == Auth::user()->username">
                <i class="fa-solid fa-user opacity-70 mr-2"></i>{{ __('Profile') }}
            </x-jet-responsive-nav-link>
            
            <x-jet-responsive-nav-link href="">
                <svg class="inline-flex h-6 w-6 stroke-slate-500 dark:stroke-slate-400 mr-1" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><g fill="none" fill-rule="evenodd" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" transform="translate(2.5 1.5)"><path d="M18.3066362,6.12356982 L17.6842106,5.04347829 C17.1576365,4.12955711 15.9906873,3.8142761 15.0755149,4.33867279 L15.0755149,4.33867279 C14.6398815,4.59529992 14.1200613,4.66810845 13.6306859,4.54104256 C13.1413105,4.41397667 12.7225749,4.09747295 12.4668193,3.66132725 C12.3022855,3.38410472 12.2138742,3.06835005 12.2105264,2.74599544 L12.2105264,2.74599544 C12.2253694,2.22917739 12.030389,1.72835784 11.6700024,1.3576252 C11.3096158,0.986892553 10.814514,0.777818938 10.2974829,0.778031878 L9.04347831,0.778031878 C8.53694532,0.778031878 8.05129106,0.97987004 7.69397811,1.33890085 C7.33666515,1.69793166 7.13715288,2.18454839 7.13958814,2.69107553 L7.13958814,2.69107553 C7.12457503,3.73688099 6.27245786,4.57676682 5.22654465,4.57665906 C4.90419003,4.57331126 4.58843537,4.48489995 4.31121284,4.32036615 L4.31121284,4.32036615 C3.39604054,3.79596946 2.22909131,4.11125048 1.70251717,5.02517165 L1.03432495,6.12356982 C0.508388616,7.03634945 0.819378585,8.20256183 1.72997713,8.73226549 L1.72997713,8.73226549 C2.32188101,9.07399614 2.68650982,9.70554694 2.68650982,10.3890161 C2.68650982,11.0724852 2.32188101,11.704036 1.72997713,12.0457667 L1.72997713,12.0457667 C0.820534984,12.5718952 0.509205679,13.7352837 1.03432495,14.645309 L1.03432495,14.645309 L1.6659039,15.7345539 C1.9126252,16.1797378 2.3265816,16.5082503 2.81617164,16.6473969 C3.30576167,16.7865435 3.83061824,16.7248517 4.27459956,16.4759726 L4.27459956,16.4759726 C4.71105863,16.2212969 5.23116727,16.1515203 5.71931837,16.2821523 C6.20746948,16.4127843 6.62321383,16.7330005 6.87414191,17.1716248 C7.03867571,17.4488473 7.12708702,17.764602 7.13043482,18.0869566 L7.13043482,18.0869566 C7.13043482,19.1435014 7.98693356,20.0000001 9.04347831,20.0000001 L10.2974829,20.0000001 C11.3504633,20.0000001 12.2054882,19.1490783 12.2105264,18.0961099 L12.2105264,18.0961099 C12.2080776,17.5879925 12.4088433,17.0999783 12.7681408,16.7406809 C13.1274382,16.3813834 13.6154524,16.1806176 14.1235699,16.1830664 C14.4451523,16.1916732 14.7596081,16.2797208 15.0389017,16.4393593 L15.0389017,16.4393593 C15.9516813,16.9652957 17.1178937,16.6543057 17.6475973,15.7437072 L17.6475973,15.7437072 L18.3066362,14.645309 C18.5617324,14.2074528 18.6317479,13.6859659 18.5011783,13.1963297 C18.3706086,12.7066935 18.0502282,12.2893121 17.6109841,12.0366133 L17.6109841,12.0366133 C17.17174,11.7839145 16.8513595,11.3665332 16.7207899,10.876897 C16.5902202,10.3872608 16.6602358,9.86577384 16.9153319,9.42791767 C17.0812195,9.13829096 17.3213574,8.89815312 17.6109841,8.73226549 L17.6109841,8.73226549 C18.5161253,8.20284891 18.8263873,7.04344892 18.3066362,6.13272314 L18.3066362,6.13272314 L18.3066362,6.12356982 Z"/><circle cx="9.675" cy="10.389" r="2.636"/></g></svg>{{ __('Settings') }}
            </x-jet-responsive-nav-link>
        </div>

        <!-- Responsive Settings Options -->
        <div class="pt-4 pb-1 border-t border-slate-300/80 dark:border-slate-700/70">
            @if (Auth::check())
                {{--
                <div class="flex items-center px-4">
                    @if (Laravel\Jetstream\Jetstream::managesProfilePhotos())
                        <div class="shrink-0 mr-3">
                            <img class="h-10 w-10 rounded-full object-cover" src="{{ Auth::user()->profile_photo_url }}" alt="{{ Auth::user()->name . ' (@' . Auth::user()->username . ')'}}" />
                        </div>
                    @endif
    
                    <div>
                        <div class="font-medium text-base text-gray-800 dark:text-gray-400">{{ Auth::user()->name }}</div>
                        <div class="font-medium text-sm text-gray-500 dark:text-gray-500">{{ '@'.Auth::user()->username }}</div>
                    </div>
                </div>
                --}}
                
                <div class="mt-3 space-y-1">
                    <!-- Account Management -->
                    {{--
                    <div x-data="{ open: false }">
                        <div :class="{ 'bg-neutral-500 dark:bg-midnight-300' : open, 'bg-none' : ! open }" class="border-b border-slate-300/80 dark:border-slate-700/70 duration-700 transition">
                            <div @click="open = ! open" type="button" class="block w-full items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-t-md text-midnight-800/80 dark:text-slate-400 focus:outline-none transition">
                                <i class="fa-solid fa-repeat opacity-70 mr-2"></i>{{ __('Beralih') }}<svg class="float-right duration-700 transition" :class="{ 'rotate-180' : open }" fill="currentColor" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24" height="24"><path d="M15.3 9.3a1 1 0 0 1 1.4 1.4l-4 4a1 1 0 0 1-1.4 0l-4-4a1 1 0 0 1 1.4-1.4l3.3 3.29 3.3-3.3z" ></path></svg>
                            </div>
                            <div x-show="open"
                                x-transition:enter="transition ease-out duration-200"
                                x-transition:enter-start="transform opacity-0 scale-95"
                                x-transition:enter-end="transform opacity-100 scale-100"
                                x-transition:leave="transition ease-in duration-75"
                                x-transition:leave-start="transform opacity-100 scale-100"
                                x-transition:leave-end="transform opacity-0 scale-95"
                                class="block w-full px-6 rounded-b-md"
                                >
                                <ul class="block w-full grid grid-rows-2 list-disc">
                                    <li class="inline-flex w-full float-left text-left py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-midnight-600 hover:text-blue-500 dark:text-slate-400/80 dark:hover:text-slate-300 focus:outline-none transition">
                                        <a href="{{ route('dashboard') }}">{{ __('Home') }}</a>
                                    </li>
                                    <li class="inline-flex w-full float-left text-left py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-midnight-600 hover:text-blue-500 dark:text-slate-400/80 dark:hover:text-slate-300 focus:outline-none transition">
                                        <a href="{{ route('post') }}">{{ __('Post') }}</a>
                                    </li>
                                </ul>
                            </div>
                        <divlink>
                    </div>
                    --}}
                    
                    @if (Laravel\Jetstream\Jetstream::hasApiFeatures())
                        <x-jet-responsive-nav-link href="{{ route('api-tokens.index') }}" :active="request()->routeIs('api-tokens.index')">
                            {{ __('API Tokens') }}
                        </x-jet-responsive-nav-link>
                    @endif
    
                    <!-- Authentication -->
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
    
                        <x-jet-responsive-nav-link href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                        this.closest('form').submit();">
                            <i class="fa-solid fa-arrow-right-from-bracket opacity-70 mr-2"></i>{{ __('Log Out') }}
                        </x-jet-responsive-nav-link>
                    </form>
    
                    <!-- Team Management -->
                    @if (Laravel\Jetstream\Jetstream::hasTeamFeatures())
                        <div class="border-t border-gray-200"></div>
    
                        <div class="block px-4 py-2 text-xs text-gray-400">
                            {{ __('Manage Team') }}
                        </div>
    
                        <!-- Team Settings -->
                        <x-jet-responsive-nav-link href="{{ route('teams.show', Auth::user()->currentTeam->id) }}" :active="request()->routeIs('teams.show')">
                            {{ __('Team Settings') }}
                        </x-jet-responsive-nav-link>
    
                        @can('create', Laravel\Jetstream\Jetstream::newTeamModel())
                            <x-jet-responsive-nav-link href="{{ route('teams.create') }}" :active="request()->routeIs('teams.create')">
                                {{ __('Create New Team') }}
                            </x-jet-responsive-nav-link>
                        @endcan
    
                        <div class="border-t border-gray-200"></div>
    
                        <!-- Team Switcher -->
                        <div class="block px-4 py-2 text-xs text-gray-400">
                            {{ __('Switch Teams') }}
                        </div>
    
                        @foreach (Auth::user()->allTeams() as $team)
                            <x-jet-switchable-team :team="$team" component="jet-responsive-nav-link" />
                        @endforeach
                    @endif
                </div>
            @endif
        </div>
    </div>
    @endif
    
</nav>