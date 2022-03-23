<!-- <button
  class="theme-toggle text-gray-500 dark:text-gray-400 hover:bg-neutral-400 dark:hover:bg-midnight-900/50  focus:outline-none focus:shadow rounded-xl text-sm p-2.5"
>
    {!! $darkmodeIcon !!}
</button> -->

<div>
    <div class="flex"
        x-data="{ 
            darkmodes: false,
            changeTheme() {
                const theme = window.darkmode().changeTheme()
                this.darkmodes = (theme === 'dark') ? true : false;
            },
            checkTheme() {
                if (!('theme' in localStorage)) {
                    window.darkmode.setTheme('light');
                    this.darkmodes = false;
                } else {
                    this.darkmodes = (localStorage.theme === 'dark') ? true : false;
                }
            }
        }"
        x-init="checkTheme()"
    >
        <button @click="changeTheme()"
                class="toggle-darkmode text-slate-500 dark:text-slate-400 hover:bg-neutral-400 dark:hover:bg-midnight-900/50  focus:outline-none focus:shadow rounded-xl text-sm p-2.5"
        >
            <svg :class="{'hidden': darkmodes, 'inline-flex': ! darkmodes }" class="w-5 h-5 hidden" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path d="M10 2a1 1 0 011 1v1a1 1 0 11-2 0V3a1 1 0 011-1zm4 8a4 4 0 11-8 0 4 4 0 018 0zm-.464 4.95l.707.707a1 1 0 001.414-1.414l-.707-.707a1 1 0 00-1.414 1.414zm2.12-10.607a1 1 0 010 1.414l-.706.707a1 1 0 11-1.414-1.414l.707-.707a1 1 0 011.414 0zM17 11a1 1 0 100-2h-1a1 1 0 100 2h1zm-7 4a1 1 0 011 1v1a1 1 0 11-2 0v-1a1 1 0 011-1zM5.05 6.464A1 1 0 106.465 5.05l-.708-.707a1 1 0 00-1.414 1.414l.707.707zm1.414 8.486l-.707.707a1 1 0 01-1.414-1.414l.707-.707a1 1 0 011.414 1.414zM4 11a1 1 0 100-2H3a1 1 0 000 2h1z" fill-rule="evenodd" clip-rule="evenodd"></path></svg>
            <svg :class="{'hidden': ! darkmodes, 'inline-flex': darkmodes }" class="w-5 h-5 hidden" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path d="M17.293 13.293A8 8 0 016.707 2.707a8.001 8.001 0 1010.586 10.586z"></path></svg>
        </button>
    </div>
    
</div>