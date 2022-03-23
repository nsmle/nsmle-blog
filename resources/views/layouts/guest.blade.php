<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="theme-color" content="#e6eaf7">
        <meta name="msapplication-navbutton-color" content="#e6eaf7" />
        <meta name="apple-mobile-web-app-status-bar-style" content="#e6eaf7" />
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <meta name="robots" content="index,follow" />
        <meta name="owner" content="nsmle">
        @yield('meta')
        <meta name="language" content="ID">
        <meta name="copyright"content="nsmle">
        <title>@yield('title')</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
        <!-- Fontawesome -->
        <script src="https://kit.fontawesome.com/ded8f6b2bd.js" crossorigin="anonymous"></script>
        <!-- Styles -->
        <link rel="stylesheet" href="{{ mix('css/app.css') }}">
        <link rel="stylesheet" href="{{ asset('/css/style.css') }}">
        <!--<meta name="theme-color" content="#1b2a4e" media="(prefers-color-scheme: dark)">
        <meta name="theme-color" content="#e6eaf7" media="(prefers-color-scheme: light)">
        @livewireStyles
        @stack('style')
        <!-- Scripts -->
        <script src="{{ mix('js/app.js') }}" defer></script>
        <script>let themeLists = ['theme-color', 'msapplication-navbutton-color', 'apple-mobile-web-app-status-bar-style']; themeLists.forEach((theme) => { let themeColor = document.querySelector(`meta[name="${theme}"]`); if (!!themeColor) { if (localStorage.theme === 'dark') { themeColor.setAttribute('content', '#1b2a4e'); } else { themeColor.setAttribute('content', '#e6eaf7'); } } }); (('theme' in localStorage)) ? document.documentElement.classList.add(localStorage.theme) : '';</script>
        <script src="https://js.pusher.com/7.0.3/pusher.min.js"></script>
    </head>
    <body class="font-sans antialiased bg-neutral-100 dark:bg-midnight-600">
    
        <x-jet-banner />

        <!-- <div class="min-h-screen"> -->
        @php
            $thisNotRouteAuth = (!request()->routeIs('register') && !request()->routeIs('login') && !request()->routeIs('password.*') && !request()->routeIs('verification.*') && !request()->routeIs('terms.*') && !request()->routeIs('policy.*')) ? true : false;
        @endphp
        
        <div>
            <!-- Navigation Top-->
            @if ($thisNotRouteAuth)
                @livewire('layouts.navigations.guest-navigation-menu')
            @endif
            <!-- Page Heading -->
            @if (isset($header))
                <header class="pt-16 bg-neutral-200 dark:bg-midnight-500/60 dark:text-neutral-100/80">
                    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                        {{ $header }}
                    </div>
                </header>
            @endif

            <!-- Page Content -->
            <main class="@if ($thisNotRouteAuth) pt-16 @endif">
                {{ $slot }}
            </main>
        </div>

        @stack('modals')
        
        <!-- Footer -->
        @if ($thisNotRouteAuth)
        <div class="{{ (empty(request()->routeIs('register')) || empty(request()->routeIs('login'))) ? '' : 'hidden' }}">
            <livewire:layouts.footer />
        </div>
        @endif
        
        @livewire('livewire-ui-modal')
        @livewireScripts
        
        <script src="{{ asset('vendor/sweetalert2/dist/sweetalert2.all.js') }}"></script>
        
        <script src="{{ asset('js/script.js') }}" type="text/javascript" charset="utf-8"></script>
        
        @stack('scripts')
    </body>
</html>
