<!--{{--
<nav x-data="{ open: false }" class="fixed z-50 w-screen {{ request()->routeIs('home') ? 'bg-neutral-200 dark:bg-midnight-500/60' : '' }}"
--}}-->
<nav class="fixed z-50 w-screen transition duration-700"
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
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8" :class="{'{{ !request()->routeIs('profile.*') ? 'block rounded-b-lg bg-neutral-100 dark:bg-midnight-300' : '' }}': open, '': ! open }">
        <div class="flex justify-between h-16">
            <div class="flex">
                <!-- Logo -->
                <div class="shrink-0 flex">
                    <a href="{{ route('home') }}" class="inline-flex items-center justify-center">
                        <x-jet-application-mark class="block h-10 w-auto rounded" />
                        <p class="text-2xl font-bold text-midnight-800 dark:text-neutral-100">{{ __('Blog') }}</p>
                    </a>
                </div>

                <!-- Navigation Links -->
                <div class="hidden space-x-2 sm:-my-px sm:ml-10 sm:flex justify-center text-center">
                    <x-jet-nav-link href="{{ route('home') }}" :active="request()->routeIs('home')">
                        {{ __('Home') }}
                    </x-jet-nav-link>
                    <x-jet-nav-link href="{{ route('post') }}" :active="request()->routeIs('post')">
                        {{ __('Post') }}
                    </x-jet-nav-link>
                </div>
                
            </div>

            <div class="hidden sm:flex sm:items-center sm:ml-6">
                <!-- Notification Desktop -->
                
                
                <!-- Toggle Darkmode -->
                <!-- <div id="theme-toggle-desktop"> -->
                @livewire('toggle-darkmode')
                <!-- </div> -->
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
                            <div class="block px-4 py-2 text-xs text-gray-400 dark:text-gray-500">
                                {{ __('Beralih ke Dashboard') }}
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
                                            <a href="{{ route('dashboard') }}">{{ __('My Dashboard') }}</a>
                                        </li>
                                        <li class="inline-flex w-full float-left text-left py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-midnight-600 hover:text-blue-500 dark:text-slate-400/80 dark:hover:text-slate-300 focus:outline-none transition">
                                            <a href="{{ route('dashboard.post.index') }}">{{ __('My Post') }}</a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            
                            <!-- <x-jet-dropdown-link href="{{ route('dashboard') }}">
                                {{ __('My Dashboard') }}
                            </x-jet-dropdown-link> -->
                            
                            <div class="border-t border-slate-300 dark:border-slate-700"></div>
                            
                            <!-- Account Management -->
                            <div class="block px-4 py-2 text-xs text-gray-400 dark:text-gray-500">
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
                                    {{ __('Log Out') }}
                                </x-jet-dropdown-link>
                            </form>
                        </x-slot>
                    </x-jet-dropdown>
                    @else
                        <!-- Button Login -->
                        <x-buttons.button-bunglon-lond type="button" onclick="window.location.href= '{{ route('login') }}'">
                            Masuk
                        </x-buttons.button-bunglon-lond>
                    @endif
                </div>
            </div>

            <!-- Hamburger -->
            <div class="-mr-2 flex items-center sm:hidden">
                <!-- Toggle Darkmode Mobile -->
                <div id="theme-toggle-mobile">
                    @livewire('toggle-darkmode')
                </div> 
                
                <div>
                    <button @click="navMobile()" class="inline-flex items-center justify-center p-2 rounded-md text-slate-400 hover:text-slate-500 hover:bg-transparent focus:outline-none focus:bg-transparent focus:text-slate-500 hover:bg-neutral-400 dark:hover:bg-midnight-900/50  focus:outline-none focus:shadow rounded-xl transition">
                        <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                            <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                            <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>
                
            </div>
        </div>
    </div>

    <!-- Responsive Navigation Menu -->
    <div x-show="open" x-ref="responsiveNavigationMenu" 
        x-init="$refs.responsiveNavigationMenu.classList.remove('hidden')"
        x-transition:enter="transition ease-out duration-200"
        x-transition:enter-start="transform opacity-0 scale-95"
        x-transition:enter-end="transform opacity-100 scale-100"
        x-transition:leave="transition ease-in duration-100"
        x-transition:leave-start="transform opacity-100 scale-100"
        x-transition:leave-end="transform opacity-0 scale-95"
        class="hidden w-full border-b border-gray-200 dark:border-midnight-700"
        :class="{'{{ !request()->routeIs('profile.*') ? 'rounded-b-xl bg-neutral-100 dark:bg-midnight-300' : '' }}': open, '': ! open}"
    >
        <div class="pt-2 pb-3 space-y-1">
            <x-jet-responsive-nav-link href="{{ route('home') }}" :active="request()->routeIs('home')">
                {{ __('Home') }}
            </x-jet-responsive-nav-link>
            <x-jet-responsive-nav-link href="{{ route('post') }}" :active="request()->routeIs('post')">
                {{ __('Post') }}
            </x-jet-responsive-nav-link>
        </div>

        <!-- Responsive Settings Options -->
        <div class="pt-4 pb-1 border-t border-gray-200 dark:border-midnight-700">
            @if (Auth::check())
                <div class="flex items-center px-4">
                    @if (Laravel\Jetstream\Jetstream::managesProfilePhotos())
                        <div class="shrink-0 mr-3">
                            <img class="h-10 w-10 rounded-full object-cover" src="{{ Auth::user()->profile_photo_url }}" alt="{{ Auth::user()->name . ' (' . Auth::user()->username . ')'}}" />
                        </div>
                    @endif
    
                    <div>
                        <div class="font-medium text-base text-slate-800 dark:text-slate-400">{{ Auth::user()->name }}</div>
                        <div class="font-medium -mt-1 text-sm text-slate-500 dark:text-slate-500">{{ '@'.Auth::user()->username }}</div>
                    </div>
                </div>
                
                
                <div class="mt-3 space-y-1">
                    <!-- Account Management -->
                    <div x-data="{ open: false }">
                        <div :class="{ 'bg-neutral-200/60 dark:bg-midnight-400' : open, 'bg-none' : ! open }" class="duration-700 transition">
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
                                        <a href="{{ route('dashboard') }}">{{ __('My Dashboard') }}</a>
                                    </li>
                                    <li class="inline-flex w-full float-left text-left py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-midnight-600 hover:text-blue-500 dark:text-slate-400/80 dark:hover:text-slate-300 focus:outline-none transition">
                                        <a href="{{ route('dashboard.post.index') }}">{{ __('My Post') }}</a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    
                    <x-jet-responsive-nav-link href="{{ Auth::user()->username }}" :active="request()->routeIs('profile.show') && request()->route()->username == Auth::user()->username">
                        <i class="fa-solid fa-user opacity-70 mr-2"></i>{{ __('Profile') }}
                    </x-jet-responsive-nav-link>
                    
                    <x-jet-responsive-nav-link href="" :active="request()->routeIs('profile.show')">
                        <i class="fa-solid fa-gear opacity-70 mr-2"></i>{{ __('Settings') }}
                    </x-jet-responsive-nav-link>
                    
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
                            <i class="fa-solid fa-arrow-right-from-bracket opacity-70 mr-2"></i> {{ __('Log Out') }}
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
            @else 
            <!-- Button Mobile Login -->
            <div class="flex grid grid-cols-2 gap-4 px-4 pb-4">
                <x-buttons.button-bunglon-lond class="w-full" onclick="window.location.href = '{{ route('login') }}'">
                    Masuk
                </x-buttons.button-bunglon-lond>
                <x-buttons.button-bunglon-lond class="w-full" onclick="window.location.href = '{{ route('register') }}'">
                    Buat Akun
                </x-buttons.button-bunglon-lond>
            </div>
            @endif
        </div>
    </div>
</nav>
