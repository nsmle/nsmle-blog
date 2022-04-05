<div>
    <div class="w-full fixed inset-x-0 bottom-0 z-40 ">
        @if(!request()->mode)
        <section id="bottom-navigation" class="w-full fixed inset-x-0 bottom-0 z-50 md:hidden block bg-neutral-100 dark:bg-midnight-300 shadow-3xl shadow-slate-500 dark:shadow-none dark:drop-shadow-md"
        >
        <!-- <section id="bottom-navigation" class="md:hidden block fixed inset-x-0 bottom-0 z-10 bg-white shadow"> -->
    <!-- <section id="bottom-navigation" class="block fixed inset-x-0 bottom-0 z-10 bg-white shadow"> -->
    		<div id="tabs" class="flex items-center justify-between">
    			<a href="{{ route('dashboard.home.index') }}" class="w-full justify-center inline-block text-center items-center py-2">
    				@if (request()->routeIs('dashboard.home.index'))
    				    <svg class="inline-block fill-midnight-800 dark:fill-slate-200 dark:hover:fill-salte-300 dark:hover:fill-slate-200 h-8 w-8" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path d="M6.63477851,18.7733424 L6.63477851,15.7156161 C6.63477851,14.9350667 7.27217143,14.3023065 8.05843544,14.3023065 L10.9326107,14.3023065 C11.310188,14.3023065 11.6723007,14.4512083 11.9392882,14.7162553 C12.2062757,14.9813022 12.3562677,15.3407831 12.3562677,15.7156161 L12.3562677,18.7733424 C12.3538816,19.0978491 12.4820659,19.4098788 12.7123708,19.6401787 C12.9426757,19.8704786 13.2560494,20 13.5829406,20 L15.5438266,20 C16.4596364,20.0023499 17.3387522,19.6428442 17.9871692,19.0008077 C18.6355861,18.3587712 19,17.4869804 19,16.5778238 L19,7.86685918 C19,7.13246047 18.6720694,6.43584231 18.1046183,5.96466895 L11.4340245,0.675869015 C10.2736604,-0.251438297 8.61111277,-0.221497907 7.48539114,0.74697893 L0.967012253,5.96466895 C0.37274068,6.42195254 0.0175522924,7.12063643 0,7.86685918 L0,16.568935 C0,18.4638535 1.54738155,20 3.45617342,20 L5.37229029,20 C6.05122667,20 6.60299723,19.4562152 6.60791706,18.7822311 L6.63477851,18.7733424 Z" transform="translate(2.5 2)"/></svg>
    				@else
    				    <svg class="inline-block stroke-midnight-700 dark:stroke-slate-300/80 dark:hover:stroke-salte-300 dark:hover:stroke-slate-200 h-8 w-8" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M6.65721519,18.7714023 L6.65721519,15.70467 C6.65719744,14.9246392 7.29311743,14.2908272 8.08101266,14.2855921 L10.9670886,14.2855921 C11.7587434,14.2855921 12.4005063,14.9209349 12.4005063,15.70467 L12.4005063,15.70467 L12.4005063,18.7809263 C12.4003226,19.4432001 12.9342557,19.984478 13.603038,20 L15.5270886,20 C17.4451246,20 19,18.4606794 19,16.5618312 L19,16.5618312 L19,7.8378351 C18.9897577,7.09082692 18.6354747,6.38934919 18.0379747,5.93303245 L11.4577215,0.685301154 C10.3049347,-0.228433718 8.66620456,-0.228433718 7.51341772,0.685301154 L0.962025316,5.94255646 C0.362258604,6.39702249 0.00738668938,7.09966612 0,7.84735911 L0,16.5618312 C0,18.4606794 1.55487539,20 3.47291139,20 L5.39696203,20 C6.08235439,20 6.63797468,19.4499381 6.63797468,18.7714023 L6.63797468,18.7714023" transform="translate(2.5 2)"/></svg>
    				@endif
    			</a>
    			@livewire('layouts.navigations.chat')
    			<a href="{{ route('dashboard.post.index') }}" class="w-full justify-center inline-block text-center items-center py-2">
    			    @if (request()->routeIs('dashboard.post.*'))
    			        <svg class="inline-block fill-midnight-800 dark:fill-slate-200 dark:hover:fill-salte-300 dark:hover:fill-slate-200 h-8 w-8" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path d="M13.191,0 C16.28,0 18,1.78 18,4.83 L18,4.83 L18,15.16 C18,18.26 16.28,20 13.191,20 L13.191,20 L4.81,20 C1.77,20 0,18.26 0,15.16 L0,15.16 L0,4.83 C0,1.78 1.77,0 4.81,0 L4.81,0 Z M5.08,13.74 C4.78,13.71 4.49,13.85 4.33,14.11 C4.17,14.36 4.17,14.69 4.33,14.95 C4.49,15.2 4.78,15.35 5.08,15.31 L5.08,15.31 L12.92,15.31 C13.319,15.27 13.62,14.929 13.62,14.53 C13.62,14.12 13.319,13.78 12.92,13.74 L12.92,13.74 Z M12.92,9.179 L5.08,9.179 C4.649,9.179 4.3,9.53 4.3,9.96 C4.3,10.39 4.649,10.74 5.08,10.74 L5.08,10.74 L12.92,10.74 C13.35,10.74 13.7,10.39 13.7,9.96 C13.7,9.53 13.35,9.179 12.92,9.179 L12.92,9.179 Z M8.069,4.65 L5.08,4.65 L5.08,4.66 C4.649,4.66 4.3,5.01 4.3,5.44 C4.3,5.87 4.649,6.22 5.08,6.22 L5.08,6.22 L8.069,6.22 C8.5,6.22 8.85,5.87 8.85,5.429 C8.85,5 8.5,4.65 8.069,4.65 L8.069,4.65 Z" transform="translate(3 2)"/></svg>
    		        @else
    				    <svg class="inline-block stroke-midnight-700 dark:stroke-slate-300/80 dark:hover:stroke-salte-300 dark:hover:stroke-slate-200 h-8 w-8" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><g fill="none" fill-rule="evenodd" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" transform="translate(3 2)"><line x1="12.716" x2="5.496" y1="14.223" y2="14.223"/><line x1="12.716" x2="5.496" y1="10.037" y2="10.037"/><line x1="8.251" x2="5.496" y1="5.86" y2="5.86"/><path d="M12.9086,0.7498 C12.9086,0.7498 5.2316,0.7538 5.2196,0.7538 C2.4596,0.7708 0.7506,2.5868 0.7506,5.3568 L0.7506,14.5528 C0.7506,17.3368 2.4726,19.1598 5.2566,19.1598 C5.2566,19.1598 12.9326,19.1568 12.9456,19.1568 C15.7056,19.1398 17.4156,17.3228 17.4156,14.5528 L17.4156,5.3568 C17.4156,2.5728 15.6926,0.7498 12.9086,0.7498 Z"/></g></svg>
    				@endif
    			</a>
    			@livewire('layouts.navigations.notification')
    			<a href="/{{ Auth::user()->username }}" class="w-full justify-center inline-block text-center items-center py-2">
    				<img class="h-8 w-8 border border-midnight-700 inline-block rounded-full object-cover" src="{{ Auth::user()->profile_photo_url }}" alt="{{ Auth::user()->name . ' (@' . Auth::user()->username . ')'}}" />
    			</a>
    		</div>
    	</section>
        @endif
    </div>
</div>