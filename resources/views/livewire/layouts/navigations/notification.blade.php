<div class="w-full justify-center inline-block">
    <a href="{{ route('dashboard.notification.index') }}" class="relative w-full justify-center inline-block text-center items-center py-2">
        @if (count($notifications))
        <span class="absolute inset-0 object-right-top -mr-6">
            <div class="inline-flex items-center px-1.5 py-0.5 border-2 border-neutral-100 dark:border-midnight-300 rounded-full text-xs font-semibold leading-4 bg-red-500 text-white"
                wire:target="getUpdateNotifications"
                wire:loading.class="animate-pinger"
            >
                {{ count($notifications) }}
            </div>
        </span>
        @endif
        @if ($this->activePage)
            <svg class="inline-block fill-slate-700 dark:fill-slate-200 dark:hover:fill-salte-300 dark:hover:fill-slate-200 h-8 w-8" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path fill d="M9.66385809,17.0850308 C10.1612052,17.0997055 10.6494874,17.2209963 11.0952733,17.4405986 L11.0952733,17.4405986 L11.1221123,17.4405986 C11.4945539,17.7444568 11.5578428,18.2868367 11.2652539,18.6673073 C10.7325,19.4297129 9.88007929,19.9104286 8.94815048,19.9740188 C7.99068936,20.0881969 7.02648958,19.8231391 6.26424693,19.2362157 C5.87223416,18.9673952 5.61748007,18.5422722 5.56643201,18.0717313 C5.56643201,17.5739365 6.03164196,17.3428174 6.46106652,17.2450363 C6.96403775,17.1390934 7.47674317,17.0854692 7.99089154,17.0850308 L7.99089154,17.0850308 Z M8.5366186,-1.59872116e-14 C11.632054,-1.59872116e-14 14.8258992,2.24007688 15.156914,5.48463268 C15.2105921,6.15132223 15.156914,6.84467936 15.2105921,7.5202581 C15.3862376,8.39147523 15.7905529,9.20107362 16.3825633,9.86700531 C16.7506233,10.4142844 16.9638305,11.04982 16.9999314,11.7070685 L16.9999314,11.7070685 L16.9999314,11.9115199 C17.0053658,12.7983874 16.6875755,13.6572551 16.1052266,14.3293807 C15.3671354,15.1185689 14.3656784,15.6145192 13.2871279,15.7249841 C10.1005486,16.1338607 6.87427876,16.1338607 3.68769953,15.7249841 C2.59644926,15.6229087 1.58089806,15.1262849 0.833815425,14.3293807 C0.269727524,13.6508093 -0.0260731338,12.7911986 0.00180532602,11.9115199 L0.00180532602,11.7070685 C0.0367179505,11.0522761 0.243355163,10.417938 0.601210451,9.86700531 C1.19585108,9.20045914 1.60588236,8.3917618 1.79107436,7.5202581 C1.84475243,6.84467936 1.79107436,6.16021142 1.84475243,5.48463268 C2.18471354,2.24007688 5.31593434,-1.59872116e-14 8.44715515,-1.59872116e-14 L8.44715515,-1.59872116e-14 Z" transform="translate(3.5 2)"/></svg>
        @else
            <svg class="inline-block stroke-midnight-700 dark:stroke-slate-300/80 dark:hover:stroke-salte-300 dark:hover:stroke-slate-200 h-8 w-8" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path fill="none" fill-rule="evenodd" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M.00082545485 11.7871203L.00082545485 11.568135C.0329512746 10.9202451.240598836 10.2924906.602355621 9.74960514 1.20450201 9.09746185 1.61670318 8.29830554 1.79571385 7.43597814 1.79571385 6.76950123 1.79571385 6.09350321 1.85392645 5.4270263 2.15469153 2.21841601 5.32727806 3.37507799e-14 8.46105618 3.37507799e-14L8.53867298 3.37507799e-14C11.6724511 3.37507799e-14 14.8450376 2.21841601 15.1555048 5.4270263 15.2137174 6.09350321 15.1555048 6.76950123 15.2040153 7.43597814 15.3854338 8.30030508 15.7972211 9.10194449 16.3973735 9.75912624 16.7618363 10.2972046 16.9698126 10.9226612 16.9989037 11.568135L16.9989037 11.7775992C17.0205591 12.6480449 16.720769 13.4968208 16.1548211 14.167395 15.4069586 14.9514753 14.392113 15.4392693 13.3024038 15.5384332 10.1069938 15.8812057 6.8830333 15.8812057 3.68762325 15.5384332 2.59914366 15.4349924 1.58575794 14.9479001.835206008 14.167395.278 13.496309-.0177593319 12.6525831.00082545485 11.7871203zM6.05493552 18.8517756C6.55421005 19.478449 7.28739599 19.8840184 8.09222803 19.978725 8.89706007 20.0734316 9.70716835 19.8494655 10.3432635 19.3563938 10.5389031 19.2105605 10.7149406 19.0410062 10.8671768 18.8517756" transform="translate(3.5 2)"/></svg>
        @endif
    </a>
    
</div>