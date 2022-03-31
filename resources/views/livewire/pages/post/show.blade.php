<div>
    
    <div class="flex justify-center">
        
        <div class="w-full max-w-7xl mx-auto px-4 md:px-6 lg:px-8">
            <div class="flex w-full md:gap-4">
                <div class="block w-full md:w-9/12">
                    
                    <!-- Parent Post -->
                    @if ($post->parent)
                    <div class="mt-4 p-4 max-w-md bg-neutral-200 rounded-lg border border-slate-300 sm:p-8 dark:bg-midnight-400 dark:border-slate-700"
                        x-data="{
                            show: false,
                            textShow() {
                                return (this.show) ? 'Sembunyikan' : '{{ $post->parent->title }}';
                            }
                    }">
                        <div class="flex justify-between items-center">
                            <h5 class="text-lg font-bold leading-none text-gray-900 dark:text-white">Membalas Post</h5>
                            <span @click="show = !show" x-text="textShow" class="text-sm truncate font-medium text-blue-600 dark:text-blue-500 cursor-pointer">
                                {{ $post->parent->title }}
                            </span>
                       </div>
                       <div class="flow-root hidden"
                           x-show="show" x-ref="parentReplyPost" 
                            x-init="$refs.parentReplyPost.classList.remove('hidden')"
                            x-transition:enter="transition ease-out duration-200"
                            x-transition:enter-start="transform opacity-0 scale-95"
                            x-transition:enter-end="transform opacity-100 scale-100"
                            x-transition:leave="transition ease-in duration-200"
                            x-transition:leave-start="transform opacity-100 scale-100"
                            x-transition:leave-end="transform opacity-0 scale-95"
                            x-if="show"
                       >
                            <ul role="list" class="divide-y divide-slate-200 dark:divide-slate-700">
                                <li class="py-3 sm:py-4">
                                    <div class="flex items-center space-x-4">
                                        <div class="flex-shrink-0">
                                            <img class="w-8 h-8 object-cover rounded-lg" src="{{ asset($post->parent->cover) }}" alt="{{ $post->parent->title }}" loading="lazy">
                                        </div>
                                        <div class="flex-1 min-w-0">
                                            <p class="text-sm font-medium text-gray-900 truncate dark:text-white">
                                                {{ $post->parent->title }}
                                            </p>
                                            <p class="text-sm text-gray-500 truncate dark:text-gray-400">
                                                {{ $post->parent->user->name.'(@'.$post->parent->user->username.')' }}
                                            </p>
                                        </div>
                                        <div class="inline-flex items-center text-base font-semibold text-gray-900 dark:text-white">
                                            @if (Auth::check())
                                            <x-buttons.button-primary type="button" onclick="window.location.href='/posts/{{ $post->parent->slug }}'">
                                                Baca
                                            </x-buttons.button-primary>
                                            @else
                                            <x-buttons.button-primary type="button" onclick="window.location.href='/post/{{ $post->parent->slug }}'">
                                                Baca
                                            </x-buttons.button-primary>
                                            @endif
                                        </div>
                                    </div>
                                </li>
                            </ul>
                       </div>
                   </div>
                    @endif
                   
                    <h1 class="text-3xl text-slate-800 dark:text-slate-200 font-bold my-8">{{ $post->title }}</h1>
                    <img class="w-full aspect-video object-cover cursor-pointer rounded-lg bg-slate-400 dark:bg-slate-700" src="{{ ($post->cover) ? asset($post->cover) : 'https://source.unsplash.com/700x400?'.urlencode($post->title) }}" alt="{{ $post->title }}" loading="lazy">
                
                    <div class="flex w-full mt-4 px-2">
                        <div class="block w-full">
                            <ul role="list" class="divide-y divide-slate-200 dark:divide-slate-700">
                                <li class="py-3 sm:py-4">
                                    <div class="flex items-center space-x-3">
                                        <div class="flex-shrink-0">
                                            <a href="/{{ $post->user->username }}" class="cursor-pointer">
                                                <img class="w-10 h-10 md:w-12 md:h-12 object-cover rounded-full" src="{{ asset($post->user->profile_photo_url) }}" alt="{{ $post->user->name }}">
                                            </a>
                                        </div>
                                        <div class="flex-1 min-w-0">
                                            <p class="ml-2 text-base -mb-1 font-medium truncate">
                                                <a href="/{{ $post->user->username }}" class="text-slate-800 dark:text-slate-300 hover:text-blue-600 dark:hover:text-blue-400 truncate">
                                                    {{ $post->user->name }}
                                                </a>
                                            </p>
                                            <p class="ml-2 text-[14px] -mt-1 truncate">
                                                <a href="/{{ $post->user->username }}" class="text-slate-700 dark:text-slate-400 hover:text-blue-600 dark:hover:text-blue-400 truncate">
                                                    {{ '@'.$post->user->username }}
                                                </a>
                                            </p>
                                        </div>
                                        <div class="flex-0 min-w-0 text-right">
                                            <p class="text-xs font-semibold text-slate-500 dark:text-slate-400">
                                                <a class="hover:text-blue-500 dark:hover:text-blue-400" href="/post?category={{ $post->category->slug }}">
                                                    {{ $post->category->name }}
                                                </a>
                                            </p>
                                            <p class="text-xs text-slate-500 dark:text-slate-400">
                                                {{ \Carbon\Carbon::parse($post->published_at)->format("F d, Y") }}
                                            </p>
                                        </div>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                    
                    
                    <div class="flex w-full items-center mt-4 px-2">
                        <div class="flex overflow-x-auto no-scrollbar gap-2">
                        @foreach ($post->tags as $tag)
                            <a class="inline-flex" href="/post?tag={{ $tag->slug }}">
                                <p class="text-xs text-slate-700 hover:text-slate-700/90 hover:bg-neutral-400/70 whitespace-nowrap active:text-slate-700/80 active:bg-neutral-400/60 cursor-pointer bg-neutral-400 dark:text-neutral-100/70 dark:bg-midnight-100 dark:hover:bg-midnight-100/80 dark:hover:text-neutral-100/60 dark:active:bg-midnight-100/70 dark:active:text-neutral-100/50 rounded-md py-1 px-2">{{ $tag->name }}</p>
                            </a>
                        @endforeach
                        </div>
                    </div>
                    
                    <div class="fixed bottom-0 right-0 z-30"
                        x-data="{ navigationPage: false }"
                        x-init="
                            if (document.querySelectorAll('.navigation-page-mobile .navigation-content a')) {
                                document.querySelectorAll('.navigation-page-mobile .navigation-content a').forEach((a) => { 
                                    a.addEventListener('click', () => { navigationPage = false })
                                })
                            }
                        document.addEventListener('scroll', (e) => { (window.scrollY > document.querySelector('#content').getBoundingClientRect().bottom - document.body.getBoundingClientRect().top - 350) ? navigationPage = false : '' });"
                    >
                        <div class="float-right"
                            x-data="{ navigationMenuBtn: false }">
                            <div class="grid grid-rows-2 mb-2 invisible" :class="{ 'invisible' : !navigationMenuBtn, 'visible' : navigationMenuBtn }">
                                <a class="bg-neutral-400 dark:bg-flopy-500 border border-slate-300 dark:border-slate-500 cursor-pointer rounded-full p-2 mb-2 mr-4 group"
                                   x-data="{ tooltip: false, 
                                             scrollToTop() {
                                                 window.scroll(0, 10);
                                                 navigationPage = false;
                                                 navigationPageBtn = false;
                                             }
                                    }"
                                >
                                    <svg x-on:click="scrollToTop()" x-on:mouseover="tooltip = true" x-on:mouseleave="tooltip = false"
                                         class="h-4 w-4 fill-slate-500 dark:fill-slate-300"
                                         xmlns="http://www.w3.org/2000/svg" viewBox="0 0 384 512"><!--! Font Awesome Pro 6.0.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2022 Fonticons, Inc. --><path d="M374.6 246.6C368.4 252.9 360.2 256 352 256s-16.38-3.125-22.62-9.375L224 141.3V448c0 17.69-14.33 31.1-31.1 31.1S160 465.7 160 448V141.3L54.63 246.6c-12.5 12.5-32.75 12.5-45.25 0s-12.5-32.75 0-45.25l160-160c12.5-12.5 32.75-12.5 45.25 0l160 160C387.1 213.9 387.1 234.1 374.6 246.6z"
                                    /></svg>
                                    <div class="relative" x-cloak x-show.transition.origin.top="tooltip">
                                      <div class="absolute top-3 border border-slate-300 dark:border-slate-500 right-0 z-10 whitespace-nowrap w-auto p-2 text-sm leading-tight text-slate-600 dark:text-slate-300 transform -translate-x-9 -translate-y-full bg-neutral-400 dark:bg-flopy-500 rounded shadow-md">
                                        Scroll to Top
                                      </div>
                                      <svg class="absolute top-0 z-9 w-6 h-6 text-slate-300 dark:text-slate-500 transform -translate-x-9 -translate-y-3 fill-current stroke-current" width="8" height="8">
                                        <rect x="12" y="-10" width="8" height="8" transform="rotate(45)" />
                                      </svg>
                                    </div>
                                </a>
                                <a class="bg-neutral-400 dark:bg-flopy-500 border border-slate-300 dark:border-slate-500 cursor-pointer rounded-full p-2 mb-2 mr-4 group"
                                   x-data="{ tooltip: false, 
                                             scrollToBottom() {
                                                 window.scroll(0, document.body.scrollHeight);
                                                 navigationPage = false;
                                                 navigationPageBtn = false;
                                             }
                                    }"
                                >
                                    <svg x-on:click="scrollToBottom()" x-on:mouseover="tooltip = true" x-on:mouseleave="tooltip = false"
                                         class="h-4 w-4 fill-slate-500 dark:fill-slate-300"
                                         xmlns="http://www.w3.org/2000/svg" viewBox="0 0 384 512"><!--! Font Awesome Pro 6.0.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2022 Fonticons, Inc. --><path d="M374.6 310.6l-160 160C208.4 476.9 200.2 480 192 480s-16.38-3.125-22.62-9.375l-160-160c-12.5-12.5-12.5-32.75 0-45.25s32.75-12.5 45.25 0L160 370.8V64c0-17.69 14.33-31.1 31.1-31.1S224 46.31 224 64v306.8l105.4-105.4c12.5-12.5 32.75-12.5 45.25 0S387.1 298.1 374.6 310.6z"
                                    /></svg>
                                    <div class="relative" x-cloak x-show.transition.origin.top="tooltip">
                                      <div class="absolute top-3 border border-slate-300 dark:border-slate-500 right-0 z-10 whitespace-nowrap w-auto p-2 text-sm leading-tight text-slate-600 dark:text-slate-300 transform -translate-x-9 -translate-y-full bg-neutral-400 dark:bg-flopy-500 rounded shadow-md">
                                        Scroll to Bottom
                                      </div>
                                      <svg class="absolute top-0 z-9 w-6 h-6 text-slate-300 dark:text-slate-500 transform -translate-x-9 -translate-y-3 fill-current stroke-current" width="8" height="8">
                                        <rect x="12" y="-10" width="8" height="8" transform="rotate(45)" />
                                      </svg>
                                    </div>
                                </a>
                                <a class="bg-neutral-400 dark:bg-flopy-500 border border-slate-300 dark:border-slate-500 cursor-pointer rounded-full p-2 mb-2 mr-4 group"
                                   x-data="{ tooltip: false, 
                                             scrollToComment() {
                                                 window.scroll(0, document.querySelector('.page-comment').getBoundingClientRect().top - document.body.getBoundingClientRect().top);
                                                 navigationPage = false;
                                                 navigationPageBtn = false;
                                             }
                                    }"
                                >
                                    <svg x-on:click="scrollToComment()" x-on:mouseover="tooltip = true" x-on:mouseleave="tooltip = false"
                                         class="h-4 w-4 fill-slate-500 dark:fill-slate-300"
                                         xmlns="http://www.w3.org/2000/svg" viewBox="0 0 640 512"><!--! Font Awesome Pro 6.0.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2022 Fonticons, Inc. --><path d="M416 176C416 78.8 322.9 0 208 0S0 78.8 0 176c0 39.57 15.62 75.96 41.67 105.4c-16.39 32.76-39.23 57.32-39.59 57.68c-2.1 2.205-2.67 5.475-1.441 8.354C1.9 350.3 4.602 352 7.66 352c38.35 0 70.76-11.12 95.74-24.04C134.2 343.1 169.8 352 208 352C322.9 352 416 273.2 416 176zM599.6 443.7C624.8 413.9 640 376.6 640 336C640 238.8 554 160 448 160c-.3145 0-.6191 .041-.9336 .043C447.5 165.3 448 170.6 448 176c0 98.62-79.68 181.2-186.1 202.5C282.7 455.1 357.1 512 448 512c33.69 0 65.32-8.008 92.85-21.98C565.2 502 596.1 512 632.3 512c3.059 0 5.76-1.725 7.02-4.605c1.229-2.879 .6582-6.148-1.441-8.354C637.6 498.7 615.9 475.3 599.6 443.7z"
                                    /></svg>
                                    <div class="relative" x-cloak x-show.transition.origin.top="tooltip">
                                      <div class="absolute top-3 border border-slate-300 dark:border-slate-500 right-0 z-10 whitespace-nowrap w-auto p-2 text-sm leading-tight text-slate-600 dark:text-slate-300 transform -translate-x-9 -translate-y-full bg-neutral-400 dark:bg-flopy-500 rounded shadow-md">
                                        Scroll to Commentar
                                      </div>
                                      <svg class="absolute top-0 z-9 w-6 h-6 text-slate-300 dark:text-slate-500 transform -translate-x-9 -translate-y-3 fill-current stroke-current" width="8" height="8">
                                        <rect x="12" y="-10" width="8" height="8" transform="rotate(45)" />
                                      </svg>
                                    </div>
                                </a>
                                <a class="bg-neutral-400 dark:bg-flopy-500 border border-slate-300 dark:border-slate-500 cursor-pointer rounded-full p-2 mb-2 mr-4 group md:hidden"
                                   :class="{ 'hidden' : content.match(/#/g) === null, 'block' : content.match(/#/g) !== null }"
                                   x-data="{ tooltip: false }"
                                >
                                    <svg x-on:click="navigationPage = ! navigationPage" x-on:mouseover="tooltip = true" x-on:mouseleave="tooltip = false"
                                         class="h-4 w-4 fill-slate-500 dark:fill-slate-300"
                                         xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"><!--! Font Awesome Pro 6.0.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2022 Fonticons, Inc. --><path d="M0 96C0 78.33 14.33 64 32 64H416C433.7 64 448 78.33 448 96C448 113.7 433.7 128 416 128H32C14.33 128 0 113.7 0 96zM0 256C0 238.3 14.33 224 32 224H416C433.7 224 448 238.3 448 256C448 273.7 433.7 288 416 288H32C14.33 288 0 273.7 0 256zM416 448H32C14.33 448 0 433.7 0 416C0 398.3 14.33 384 32 384H416C433.7 384 448 398.3 448 416C448 433.7 433.7 448 416 448z"
                                    /></svg>
                                    <div class="relative" x-cloak x-show.transition.origin.top="tooltip">
                                      <div class="absolute top-3 border border-slate-300 dark:border-slate-500 right-0 z-10 whitespace-nowrap w-auto p-2 text-sm leading-tight text-slate-600 dark:text-slate-300 transform -translate-x-9 -translate-y-full bg-neutral-400 dark:bg-flopy-500 rounded shadow-md">
                                        Navigations
                                      </div>
                                      <svg class="absolute top-0 z-9 w-6 h-6 text-slate-300 dark:text-slate-500 transform -translate-x-9 -translate-y-3 fill-current stroke-current" width="8" height="8">
                                        <rect x="12" y="-10" width="8" height="8" transform="rotate(45)" />
                                      </svg>
                                    </div>
                                </a>
                            </div>
                            <div @click="navigationMenuBtn = ! navigationMenuBtn; navigationPage = false" class="bg-neutral-400 dark:bg-flopy-500 border border-slate-300 dark:border-slate-500 cursor-pointer rounded-full p-2 mb-4 mr-4 navigation-menu-btn">
                                <svg class="h-4 w-4 fill-slate-500 dark:fill-slate-300" :class="{ 'hidden' : navigationMenuBtn, 'block' : ! navigationMenuBtn }" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><!-- Font Awesome Pro 5.15.4 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) --><path d="M296 32h192c13.255 0 24 10.745 24 24v160c0 13.255-10.745 24-24 24H296c-13.255 0-24-10.745-24-24V56c0-13.255 10.745-24 24-24zm-80 0H24C10.745 32 0 42.745 0 56v160c0 13.255 10.745 24 24 24h192c13.255 0 24-10.745 24-24V56c0-13.255-10.745-24-24-24zM0 296v160c0 13.255 10.745 24 24 24h192c13.255 0 24-10.745 24-24V296c0-13.255-10.745-24-24-24H24c-13.255 0-24 10.745-24 24zm296 184h192c13.255 0 24-10.745 24-24V296c0-13.255-10.745-24-24-24H296c-13.255 0-24 10.745-24 24v160c0 13.255 10.745 24 24 24z"/></svg>
                                <svg class="h-4 w-4 fill-slate-500 dark:fill-slate-300 hidden" :class="{ 'hidden' : ! navigationMenuBtn, 'block' : navigationMenuBtn }" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 320 512"><!--! Font Awesome Pro 6.0.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2022 Fonticons, Inc. --><path d="M310.6 361.4c12.5 12.5 12.5 32.75 0 45.25C304.4 412.9 296.2 416 288 416s-16.38-3.125-22.62-9.375L160 301.3L54.63 406.6C48.38 412.9 40.19 416 32 416S15.63 412.9 9.375 406.6c-12.5-12.5-12.5-32.75 0-45.25l105.4-105.4L9.375 150.6c-12.5-12.5-12.5-32.75 0-45.25s32.75-12.5 45.25 0L160 210.8l105.4-105.4c12.5-12.5 32.75-12.5 45.25 0s12.5 32.75 0 45.25l-105.4 105.4L310.6 361.4z"/></svg>
                            </div>
                        </div>
                        
                        <div class="fixed hidden -top-2 right-0 float-center w-full navigation-page-mobile md:hidden"
                            x-show="navigationPage"
                            x-transition:enter="transition-transform transition-opacity ease-out duration-300"
                            x-transition:enter-start="opacity-0 transform -translate-y-80"
                            x-transition:enter-end="opacity-100 transform translate-y-0"
                            x-transition:leave="transition ease-in duration-300"
                            x-transition:leave-end="opacity-0 transform -translate-y-80"
                        >
                            <div class="mx-3 p-4 rounded-b-lg bg-neutral-400 dark:bg-midnight-500 text-slate-600 hover:text-slate-700 dark:text-slate-300 dark:hover:text-slate-200 border border-slate-300 dark:border-slate-600">
                                <h4 class="text-xl mb-4 font-bold text-slate-800 dark:text-slate-100">Navigations</h3>
                                <div class="bg-neutral-200 dark:bg-midnight-400 pt-4 px-4 mb-4 h-80 overflow-y-scroll rounded-md scrollbar-thin scrollbar-thumb-slate-300 scrollbar-track-slate-200 dark:scrollbar-thumb-midnight-100 dark:scrollbar-track-midnight-300 navigation-content"
                                    
                                >
                                    
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    
                    <div class="w-full my-8" id="content" wire:ignore>
                        <div class="bg-slate-400 dark:bg-slate-600 animate-pulse w-10/12 h-4 rounded mb-4"></div>
                        @for ($i = 0; $i < 5; $i++)
                        <div class="w-full my-8">
                            @for ($j = 0; $j < 3; $j++)
                                <div class="flex gap-2 w-11/12 my-2">
                                    <div class="bg-slate-400 dark:bg-slate-600 w-1/4 h-3 cursor-text transition animate-pulse animation-delay-300"></div>
                                    <div class="bg-slate-400 dark:bg-slate-600 w-1/4 h-3 cursor-text transition animate-pulse animation-delay-500"></div>
                                    <div class="bg-slate-400 dark:bg-slate-600 w-1/4 h-3 cursor-text transition animate-pulse animation-delay-700"></div>
                                    <div class="bg-slate-400 dark:bg-slate-600 w-1/4 h-3 cursor-text transition animate-pulse animation-delay-900"></div>
                                    <div class="bg-slate-400 dark:bg-slate-600 w-1/4 h-3 cursor-text transition animate-pulse animation-delay-1100"></div>
                                </div>
                                <div class="flex gap-2 w-full pr-4 my-2">
                                    <div class="bg-slate-400 dark:bg-slate-600 w-1/4 h-3 cursor-text transition animate-pulse animation-delay-300"></div>
                                    <div class="bg-slate-400 dark:bg-slate-600 w-1/4 h-3 cursor-text transition animate-pulse animation-delay-500"></div>
                                    <div class="bg-slate-400 dark:bg-slate-600 w-1/4 h-3 cursor-text transition animate-pulse animation-delay-700"></div>
                                    <div class="bg-slate-400 dark:bg-slate-600 w-1/4 h-3 cursor-text transition animate-pulse animation-delay-900"></div>
                                    <div class="bg-slate-400 dark:bg-slate-600 w-1/4 h-3 cursor-text transition animate-pulse animation-delay-1100"></div>
                                </div>
                                <div class="flex gap-2 w-11/12 my-2">
                                    <div class="bg-slate-400 dark:bg-slate-600 w-1/4 h-3 cursor-text transition animate-pulse animation-delay-300"></div>
                                    <div class="bg-slate-400 dark:bg-slate-600 w-1/4 h-3 cursor-text transition animate-pulse animation-delay-500"></div>
                                    <div class="bg-slate-400 dark:bg-slate-600 w-1/4 h-3 cursor-text transition animate-pulse animation-delay-700"></div>
                                    <div class="bg-slate-400 dark:bg-slate-600 w-1/4 h-3 cursor-text transition animate-pulse animation-delay-900"></div>
                                </div>
                                <div class="flex gap-2 w-full pr-4 my-2">
                                    <div class="bg-slate-400 dark:bg-slate-600 w-1/4 h-3 cursor-text transition animate-pulse animation-delay-300"></div>
                                    <div class="bg-slate-400 dark:bg-slate-600 w-1/4 h-3 cursor-text transition animate-pulse animation-delay-500"></div>
                                    <div class="bg-slate-400 dark:bg-slate-600 w-1/4 h-3 cursor-text transition animate-pulse animation-delay-700"></div>
                                    <div class="bg-slate-400 dark:bg-slate-600 w-1/4 h-3 cursor-text transition animate-pulse animation-delay-900"></div>
                                    <div class="bg-slate-400 dark:bg-slate-600 w-1/4 h-3 cursor-text transition animate-pulse animation-delay-1100"></div>
                                    <div class="bg-slate-400 dark:bg-slate-600 w-1/4 h-3 cursor-text transition animate-pulse animation-delay-1300"></div>
                                </div>
                            @endfor
                        </div>
                        @endfor
                    </div>
                </div>
                <div class="w-full md:w-4/12 hidden md:block">
                    <div class="navigation-page pl-6 h-screen hidden md:block pb-12" 
                        x-init="
                        if (content.match(/#/g) !== null) {
                            const navCont = document.querySelector('.navigation-page');
                            const navContHeightInit = navCont.getBoundingClientRect().top
                            
                            document.addEventListener('scroll', (e) => { 
                                if (navContHeightInit > 0) {
                                    if (window.scrollY < document.querySelector('#content').getBoundingClientRect().bottom - document.body.getBoundingClientRect().top - 350) {
                                        if (navCont.getBoundingClientRect().top < 0) {
                                            navCont.classList.remove('mt-10')
                                            navCont.classList.add('fixed', 'top-0', 'bg-neutral-400/50', 'dark:bg-midnight-500/80')
                                        } else if (window.scrollY < navContHeightInit) {
                                            navCont.classList.remove('fixed', 'top-0', 'bg-neutral-400/50', 'dark:bg-midnight-500/80')
                                            navCont.classList.add('mt-10')
                                        }
                                    } else {
                                            navCont.classList.remove('fixed', 'top-0', 'bg-neutral-400/50', 'dark:bg-midnight-500/80')
                                            navCont.classList.add('mt-10')
                                    }
                                
                                    let navContMenu = navCont.querySelectorAll('.navigation-content div a');
                                    for (let i = 0; i < navContMenu.length; i++) {
                                        let section = document.querySelector(navContMenu[i].hash).getBoundingClientRect().top - document.body.getBoundingClientRect().top - 10;
                                        let limit = Math.max( document.body.scrollHeight, document.body.offsetHeight, document.documentElement.clientHeight, document.documentElement.scrollHeight, document.documentElement.offsetHeight ) - document.body.getBoundingClientRect().top - 10;
                                        let nextSection = (i < navContMenu.length - 1) ? document.querySelector(navContMenu[i+1].hash).getBoundingClientRect().top - document.body.getBoundingClientRect().top - 10 : limit;
                                        
                                        if (window.scrollY >= section && window.scrollY <= nextSection) {
                                            navContMenu[i].classList.add('text-blue-500')
                                        } else {
                                            navContMenu[i].classList.remove('text-blue-500')
                                        }
                                    }
                                } else {
                                    let navContMenu = document.querySelectorAll('.navigation-page-mobile .navigation-content div a');
                                    for (let i = 0; i < navContMenu.length; i++) {
                                        let section = document.querySelector(navContMenu[i].hash).getBoundingClientRect().top - document.body.getBoundingClientRect().top - 10;
                                        let limit = Math.max( document.body.scrollHeight, document.body.offsetHeight, document.documentElement.clientHeight, document.documentElement.scrollHeight, document.documentElement.offsetHeight ) - document.body.getBoundingClientRect().top - 10;
                                        let nextSection = (i < navContMenu.length - 1) ? document.querySelector(navContMenu[i+1].hash).getBoundingClientRect().top - document.body.getBoundingClientRect().top - 10 : limit;
                                        
                                        if (window.scrollY >= section && window.scrollY <= nextSection) {
                                            navContMenu[i].classList.add('text-blue-500')
                                        } else {
                                            navContMenu[i].classList.remove('text-blue-500')
                                        }
                                    }
                                    
                                }
                                
                            });
                        } else {
                            (document.querySelector('.navigation-page')) ? document.querySelector('.navigation-page').parentElement.classList.remove('md:block') : '';
                        }"
                        >
                        <h4 class="text-xl mt-2 font-bold text-slate-800 dark:text-slate-100">Navigations</h3>
                        <div class="navigation-content mt-4 overflow-y-scroll max-h-screen text-slate-600 hover:text-slate-700 dark:text-slate-300 dark:hover:text-slate-200 pb-32">
                            <div class="w-full">
                                @for ($i = 1; $i <= 15; $i++)
                                    <div class="flex gap-2 w-11/12 my-2">
                                        <div class="bg-slate-400 dark:bg-slate-600 w-1/4 h-3 cursor-text transition animate-pulse animation-delay-300"></div>
                                        <div class="bg-slate-400 dark:bg-slate-600 w-1/2 h-3 cursor-text transition animate-pulse animation-delay-500"></div>
                                        <div class="bg-slate-400 dark:bg-slate-600 w-1/4 h-3 cursor-text transition animate-pulse animation-delay-700"></div>
                                    </div>
                                    <div class="flex gap-2 w-full my-2">
                                        <div class="bg-slate-400 dark:bg-slate-600 w-1/3 h-3 cursor-text transition animate-pulse animation-delay-300"></div>
                                        <div class="bg-slate-400 dark:bg-slate-600 w-1/4 h-3 cursor-text transition animate-pulse animation-delay-500"></div>
                                        <div class="bg-slate-400 dark:bg-slate-600 w-1/3 h-3 cursor-text transition animate-pulse animation-delay-700"></div>
                                    </div>
                                @endfor 
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Start Statistic -->
            <div class="flex w-full h-auto page-comment pb-2 pt-8">
                <div class="w-full h-auto">
                    @if ($post->read->count() > 0 || $post->user->id == Auth::id())
                    <button x-data="{ hover:false }" @click.outside="hover = false; $refs.postReadDesc.classList.add('hidden')" @mouseover="hover = !hover; (hover) ? $refs.postReadDesc.classList.remove('hidden') : $refs.postReadDesc.classList.add('hidden')" class="flex float-left active:scale-95 items-center px-2 py-1 border border-grenteel-200/30 dark:border-none text-xs leading-4 font-medium rounded-md text-slate-800 dark:text-slate-300 dark:font-semibold bg-neutral-400 dark:bg-midnight-100 dark:active:bg-midnight-100 dark:active:border-midnight-100 hover:shadow-neutral-300 hover:text-gray-700 focus:outline-none focus:bg-neutral-200 focus:text-gray-500 focus:shadow-grenteel-200 disabled:opacity-70 transition">
                        <svg class="inline-block mr-1 fill-slate-600 dark:fill-slate-400 hover:fill-slate-700 dark:hover:fill-slate-200 h-6 w-6" xmlns="http://www.w3.org/2000/svg" x="0" y="0" version="1.1" viewBox="0 0 29 29" xml:space="preserve"><path d="M7.601 20.98A9.16 9.16 0 004 21.719V6.88a7.155 7.155 0 018.875 1.205l.625.653v14.405a9.15 9.15 0 00-5.899-2.163zM25 21.719a9.138 9.138 0 00-9.5 1.424V8.738l.626-.653A7.157 7.157 0 0125 6.88v14.839z"/></svg>
                        @if ($post->read->count() > 0) <span class="font-semibold mr-1">{{ intWithStyle($post->read->count()) }}</span><span class="hidden" x-ref="postReadDesc">kali dibaca</span>@else<span class="hidden" x-ref="postReadDesc">Belum dibaca</span> @endif
                    </button>
                    @endif
                    <div class="flex float-left ml-2">
                        @livewire('components.post-action.like', ['post' => $post])
                    </div>
                    <button onclick="share()" class="flex float-right active:scale-90 items-center px-3 py-2 border border-grenteel-200/30 dark:border-none text-xs leading-4 font-medium rounded-md text-slate-800 dark:text-slate-300 dark:font-semibold bg-neutral-400 dark:bg-midnight-100 dark:active:bg-midnight-100 dark:active:border-midnight-100 hover:shadow-neutral-300 hover:text-gray-700 focus:outline-none focus:bg-neutral-200 focus:text-gray-500 focus:shadow-grenteel-200 disabled:opacity-70 transition">
                        <svg class="inline-block stroke-slate-600 dark:stroke-slate-400 hover:stroke-slate-700 dark:hover:stroke-slate-300 h-4 w-4" xmlns="http://www.w3.org/2000/svg" width="22" height="22" viewBox="0 0 22 22"><g fill="none" fill-rule="evenodd" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" transform="translate(1 1)"><circle cx="15" cy="3" r="3"/><circle cx="3" cy="10" r="3"/><circle cx="15" cy="17" r="3"/><path d="M5.59 11.51l6.83 3.98M12.41 4.51L5.59 8.49"/></g></svg>
                    </button>
                    <button wire:click="replyPost({{ $post }})" class="flex mr-2 float-right active:scale-90 items-center px-2 py-1 border border-grenteel-200/30 dark:border-none text-xs leading-4 font-medium rounded-md text-slate-800 dark:text-slate-300 dark:font-semibold bg-neutral-400 dark:bg-midnight-100 dark:active:bg-midnight-100 dark:active:border-midnight-100 hover:shadow-neutral-300 hover:text-gray-700 focus:outline-none focus:bg-neutral-200 focus:text-gray-500 focus:shadow-grenteel-200 disabled:opacity-70 transition">
                        <svg class="inline-block fill-slate-600 dark:fill-slate-400 hover:fill-slate-700 dark:hover:fill-slate-300 h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill-rule="evenodd" stroke-linejoin="round" stroke-miterlimit="2" clip-rule="evenodd" viewBox="0 0 500 500"><path d="M79.451,277.28L39.451,277.28L99.451,157.28L159.451,277.28L119.451,277.28L119.451,314.148C119.451,344.524 144.075,369.148 174.451,369.148L400.549,369.148C411.588,369.148 420.549,378.11 420.549,389.148C420.549,400.187 411.588,409.148 400.549,409.148L174.451,409.148C121.983,409.148 79.451,366.615 79.451,314.148L79.451,277.28ZM380.549,222.72L380.549,185.852C380.549,155.476 355.925,130.852 325.549,130.852L99.451,130.852C88.412,130.852 79.451,121.89 79.451,110.852C79.451,99.813 88.412,90.852 99.451,90.852L325.549,90.852C378.017,90.852 420.549,133.385 420.549,185.852L420.549,222.72L460.549,222.72L400.549,342.72L340.549,222.72L380.549,222.72Z"/></svg>
                    </button>
                    <button class="flex mr-2 float-right active:scale-90 items-center px-2 py-1 border border-grenteel-200/30 dark:border-none text-xs leading-4 font-medium rounded-md text-slate-800 dark:text-slate-300 dark:font-semibold bg-neutral-400 dark:bg-midnight-100 dark:active:bg-midnight-100 dark:active:border-midnight-100 hover:shadow-neutral-300 hover:text-gray-700 focus:outline-none focus:bg-neutral-200 focus:text-gray-500 focus:shadow-grenteel-200 disabled:opacity-70 transition">
                        <svg class="inline-block stroke-slate-600 dark:stroke-slate-400 hover:stroke-slate-700 dark:hover:stroke-slate-300 h-6 w-6" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><g fill="none" fill-rule="evenodd" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" transform="translate(3.5 2)"><path d="M8.16475977,16.631579 L2.23340962,19.881007 C1.75983818,20.1271252 1.17640846,19.9529066 0.915331812,19.4874143 L0.915331812,19.4874143 C0.839799009,19.3432192 0.79904873,19.1833528 0.796338677,19.0205951 L0.796338677,4.62242565 C0.796338677,1.87643022 2.67276889,0.778032041 5.37299774,0.778032041 L11.7162472,0.778032041 C14.3340962,0.778032041 16.2929063,1.80320367 16.2929063,4.43935929 L16.2929063,19.0205951 C16.2929063,19.2803494 16.1897192,19.5294649 16.0060452,19.713139 C15.8223711,19.8968131 15.5732556,20.0000001 15.3135012,20.0000001 C15.1478164,19.9973723 14.9849578,19.9566576 14.8375287,19.881007 L8.86956526,16.631579 C8.64965001,16.5127732 8.38467502,16.5127732 8.16475977,16.631579 Z"/><line x1="4.87" x2="12.165" y1="7.323" y2="7.323"/></g></svg>
                    </button>
                </div>
                
            </div>
            <!-- End Statistic -->
            
            <!-- Child Post -->
            @if ($post->child->count())
            <div class="block w-full h-auto page-comment pt-8 pb-4 border-t border-slate-300/80 dark:border-slate-600"
                x-data="{
                    show: false,
                    textShow() {
                        return (!this.show) ? 'Tampilkan' : 'Sembunyikan';
                    }
                }"
            >
                <div class="w-full md:w-8/12 p-4 max-w-md bg-neutral-200 rounded-lg border border-slate-300 shadow-md sm:p-8 dark:bg-midnight-400 dark:border-slate-700">
                    <div class="flex justify-between items-center mb-4">
                        <h5 class="text-xl font-bold leading-none text-gray-900 dark:text-white">Balasan Post</h5>
                        <span @click="show = !show" x-text="textShow" class="text-sm font-medium text-blue-600 dark:text-blue-500">
                            Tampilkan
                        </span>
                   </div>
                   <div class="flow-root hidden"
                        x-show="show" x-ref="childReplyPost" 
                        x-init="$refs.childReplyPost.classList.remove('hidden')"
                        x-transition:enter="transition ease-out duration-200"
                        x-transition:enter-start="transform opacity-0 scale-95"
                        x-transition:enter-end="transform opacity-100 scale-100"
                        x-transition:leave="transition ease-in duration-100"
                        x-transition:leave-start="transform opacity-100 scale-100"
                        x-transition:leave-end="transform opacity-0 scale-95"
                   >
                        <ul role="list" class="divide-y divide-slate-200 dark:divide-slate-700">
                            @foreach ($post->child as $childPost)
                                <li class="py-3 sm:py-4">
                                    <div class="flex items-center space-x-4">
                                        <div class="flex-shrink-0">
                                            <img class="w-8 h-8 object-cover rounded-lg" src="{{ asset($childPost->cover) }}" alt="{{ $childPost->name }}" loading="lazy">
                                        </div>
                                        <div class="flex-1 min-w-0">
                                            <p class="text-sm font-medium text-gray-900 truncate dark:text-white">
                                                {{ $childPost->title }}
                                            </p>
                                            <p class="text-sm text-gray-500 truncate dark:text-gray-400">
                                                {{ $childPost->user->name.'(@'.$childPost->user->username.')' }}
                                            </p>
                                        </div>
                                        <div class="inline-flex items-center text-base font-semibold text-gray-900 dark:text-white">
                                            @if (Auth::check())
                                            <x-buttons.button-primary type="button" onclick="window.location.href='/posts/{{ $childPost->slug }}'">
                                                Baca
                                            </x-buttons.button-primary>
                                            @else
                                            <x-buttons.button-primary type="button" onclick="window.location.href='/post/{{ $childPost->slug }}'">
                                                Baca
                                            </x-buttons.button-primary>
                                            @endif
                                        </div>
                                    </div>
                                </li>
                            @endforeach
                        </ul>
                   </div>
                   <div class="block hidden"
                        x-show="! show" x-ref="childReplyPostWrap" 
                        x-init="$refs.childReplyPostWrap.classList.remove('hidden')"
                        x-transition:enter="transition ease-out duration-200"
                        x-transition:enter-start="transform opacity-0 scale-95"
                        x-transition:enter-end="transform opacity-100 scale-100"
                        x-transition:leave="transition ease-in duration-100"
                        x-transition:leave-start="transform opacity-100 scale-100"
                        x-transition:leave-end="transform opacity-0 scale-95"
                   >
                        <div class="flex items-center">
                            <span class="flex mr-1 text-base items-center justify-center font-bold text-slate-600 dark:text-slate-400 text-xs w-8 h-8 rounded-full bg-neutral-500 dark:bg-midnight-300">
                                {{ ($post->child->count() <= 99) ? $post->child->count() : '+99' }}
                            </span>
                            <p class="text-slate-600 dark:text-slate-400">Postingan membalas post ini</p>
                        </div>
                   </div>
                </div>
            </div>
            @endif
            <!-- End Child Post -->
            
            <!-- Start Commentar -->
            <div class="flex w-full h-auto page-comment pt-2 pb-8">
                <div class="w-full h-auto border-t border-slate-300/80 dark:border-slate-600">
                    
                    <h4 class="text-3xl text-slate-800 dark:text-slate-200 font-bold my-4">Komentar</h4>
                    
                    <div class="w-full md:w-8/12" x-data="">
                        <ol class="relative border-l border-slate-300 dark:border-slate-700">                  
                            @foreach ($post->comment as $comment)
                                @if (empty($comment->parent_id))
                                    <li class="mt-5 ml-6 comment comment-{{ $comment->id }}" id="comment-{{ base64_encode($comment->user->username.$comment->id) }}">
                                        <span class="flex absolute -left-3 justify-center items-center w-6 h-6 bg-blue-200 rounded-full ring-8 ring-neutral-100 dark:ring-midnight-600 dark:bg-blue-900">
                                            <img class="rounded-full h-6 w-6 object-cover {{ ($comment->user->last_seen > now()->addMinutes(-1)) ? 'border border-green-500' : '' }} shadow-lg" src="{{ $comment->user->profile_photo_url }}" alt="{{ $comment->user->name . ' (@' . $comment->user->username . ')' }}" loading="lazy"/>
                                        </span>
                                        <div class="px-4 py-2 bg-white rounded-lg border border-slate-200 shadow-sm dark:bg-midnight-400 dark:border-slate-700">
                                            <div class="justify-between items-center mb-3 sm:flex">
                                                <div class="text-sm hidden md:block align-center font-normal text-gray-500 dark:text-gray-300"><a href="/{{ $comment->user->username }}" class="font-semibold text-gray-900 dark:text-white hover:underline">{{ (Auth::check() && Auth::id() === $comment->user->id) ? 'Anda' : $comment->user->name }}</a> Berkomentar</div>
                                                    <div class="align-center">
                                                        <time class="mb-1 text-xs font-normal text-gray-400 sm:order-last sm:mb-0">{{ ($comment->created_at->timestamp > now()->subDays(8)->timestamp) ? $comment->created_at->diffForHumans() : $comment->created_at->format("H:i, F d, Y")  }}</time>
                                                        @if ($comment->created_at != $comment->updated_at)
                                                            <edited class="float-right md:float-left md:mr-2 md:pr-2 md:border-r md:border-gray-200 dark:md:border-gray-600 mt-1 justify-center text-xs font-normal text-gray-400 sm:order-last sm:mb-0">diedit</edited>
                                                        @endif
                                                    </div>
                                                    <div class="text-sm md:hidden font-normal text-gray-500 dark:text-gray-300"><a href="/{{ $comment->user->username }}" class="font-semibold text-gray-900 dark:text-white hover:underline">{{ (Auth::check() && Auth::id() === $comment->user->id) ? 'Anda' : $comment->user->name }}</a> Berkomentar</div>
                                            </div>
                                            <!-- <div class="p-3 text-xs italic font-normal text-gray-500 bg-gray-50 rounded-lg border border-slate-200 dark:bg-gray-600 dark:border-gray-500 dark:text-gray-300">{{ $comment->content }}</div> -->
                                            <div class="content-comment text-slate-500 dark:text-slate-300">{{ $comment->content }}</div>
                                            @if (auth()->check())
                                                <div class="inline-block w-full my-2">
                                                    @if ($comment->user->id === Auth::id())
                                                        <button class="float-left active:scale-95 items-center px-2 py-1 border border-grenteel-200/30 text-xs leading-4 font-medium rounded-md text-slate-800 dark:text-slate-100 dark:font-semibold bg-neutral-400/30 dark:bg-midnight-100 dark:border-slate-600 dark:active:bg-midnight-100 dark:active:border-midnight-100 hover:shadow-neutral-300 hover:text-gray-700 focus:outline-none focus:bg-neutral-200 focus:text-gray-500 focus:shadow-grenteel-200 disabled:opacity-70 transition" @click="deleteComment({{ $comment->id }})">
                                                            <i class="fa-solid fa-trash opacity-50"></i>
                                                        </button>
                                                        <button class="align-center active:scale-95 items-center ml-2 px-2 py-1 border border-grenteel-200/30 text-xs leading-4 font-medium rounded-md text-slate-800 dark:text-slate-100 dark:font-semibold bg-neutral-400/30 dark:bg-midnight-100 dark:border-slate-600 dark:active:bg-midnight-100 dark:active:border-midnight-100 hover:shadow-neutral-300 hover:text-gray-700 focus:outline-none focus:bg-neutral-200 focus:text-gray-500 focus:shadow-grenteel-200 disabled:opacity-70 transition" @click="editComment({{ $comment->id }})">
                                                            <i class="fa-solid fa-pen opacity-50"></i>
                                                        </button>
                                                    @endif
                                                    <button class="float-right active:scale-95 items-center px-2 py-1 border border-grenteel-200/30 text-xs leading-4 font-medium rounded-md text-slate-800 dark:text-slate-100 dark:font-semibold bg-neutral-400/30 dark:bg-midnight-100 dark:border-slate-600 dark:active:bg-midnight-100 dark:active:border-midnight-100 hover:shadow-neutral-300 hover:text-gray-700 focus:outline-none focus:bg-neutral-200 focus:text-gray-500 focus:shadow-grenteel-200 disabled:opacity-70 transition" @click="addComment({{ $comment->id }}, {{ $comment->id }})">
                                                        <i class="fa-solid fa-reply opacity-50 mr-1"></i>Balas
                                                    </button>
                                                </div>
                                            @endif
                                        </div>
                                    </li>
                                @endif
                                @foreach ($post->comment as $commentChild)
                                    @if ($commentChild->parent_id === $comment->id)
                                        <div class="pt-3 ml-8 pl-6 border-l border-slate-300/80 dark:border-slate-700">
                                            <li class="comment comment-{{ $commentChild->id }}" id="comment-{{ base64_encode($commentChild->user->username.$commentChild->id) }}">
                                                <span class="flex absolute left-5 justify-center items-center w-6 h-6 bg-blue-200 rounded-full ring-8 ring-neutral-100 dark:ring-midnight-600 dark:bg-blue-900">
                                                    <img class="rounded-full h-6 w-6 {{ ($commentChild->user->last_seen > now()->addMinutes(-1)) ? 'border border-green-500' : '' }} object-cover shadow-lg" src="{{ $commentChild->user->profile_photo_url }}" alt="{{ $commentChild->user->name . ' (@' . $commentChild->user->username . ')' }}" loading="lazy"/>
                                                </span>
                                                <div class="px-4 py-2 bg-white rounded-lg border border-slate-200 shadow-sm dark:bg-midnight-400 dark:border-slate-700">
                                                    <div class="justify-between items-center mb-3 sm:flex">
                                                        <!-- start information user comment reply to comment MODE:Desktop-->
                                                        @if (Auth::check()) 
                                                            @if (Auth::id() == $commentChild->user->id && Auth::id() == $commentChild->replyTo()->user_id)
                                                                <div class="text-sm hidden md:block align-center font-normal text-gray-500 dark:text-gray-300"><a href="/{{ $commentChild->user->username }}" class="font-semibold text-gray-900 dark:text-white hover:underline">{{ ($commentChild->user->id == Auth::id()) ? 'Anda' : $commentChild->user->name }}</a> Membalas komentar <span @click="previewCommentReply({{ $commentChild->replyTo()->id }})" class="font-semibold text-gray-900 dark:text-white hover:underline">{{ (Auth::id() == $commentChild->replyTo()->user->id) ? 'anda sendiri' : $commentChild->replyTo()->user->name }}</span></div>
                                                            @else
                                                                <div class="text-sm hidden md:block align-center font-normal text-gray-500 dark:text-gray-300"><a href="/{{ $commentChild->user->username }}" class="font-semibold text-gray-900 dark:text-white hover:underline">{{ ($commentChild->user->id == Auth::id()) ? 'Anda' : $commentChild->user->name }}</a> Membalas komentar <span @click="previewCommentReply({{ $commentChild->replyTo()->id }})" class="font-semibold text-gray-900 dark:text-white hover:underline">{{ (Auth::id() == $commentChild->replyTo()->user->id) ? 'anda' : $commentChild->replyTo()->user->name }}</span></div>
                                                            @endif
                                                        @else
                                                            <div class="text-sm hidden md:block align-center font-normal text-gray-500 dark:text-gray-300"><a href="/{{ $commentChild->user->username }}" class="font-semibold text-gray-900 dark:text-white hover:underline">{{ $commentChild->user->name }}</a> Membalas komentar <span @click="previewCommentReply({{ $commentChild->replyTo()->id }})" class="font-semibold text-gray-900 dark:text-white hover:underline">{{ ($commentChild->user->id !== $commentChild->replyTo()->user->id) ? $commentChild->replyTo()->user->name : 'nya' }}</span></div>
                                                        @endif
                                                        <!-- start information user comment reply to comment MODE:Desktop-->
                                                        <!-- Start reply Comment Information like created comment time and comment edited -->
                                                        <div class="align-center">
                                                            <time class="mb-1 text-xs font-normal text-gray-400 sm:order-last sm:mb-0">{{ ($commentChild->created_at->timestamp > now()->subDays(8)->timestamp) ? $commentChild->created_at->diffForHumans() : $commentChild->created_at->format("H:i, F d, Y")  }}</time>
                                                            @if ($commentChild->created_at != $commentChild->updated_at)
                                                                <edited class="float-right md:float-left md:mr-2 md:pr-2 md:border-r md:border-gray-200 dark:md:border-gray-600 mt-1 justify-center text-xs font-normal text-gray-400 sm:order-last sm:mb-0">diedit</edited>
                                                            @endif
                                                        </div>
                                                        <!-- End reply Comment Information like created comment time and comment edited -->
                                                        <!-- start information user comment reply to comment MODE:Mobile-->
                                                        @if (Auth::check()) 
                                                            @if (Auth::id() == $commentChild->user->id && Auth::id() == $commentChild->replyTo()->user_id)
                                                                <div class="text-sm md:hidden font-normal text-gray-500 dark:text-gray-300"><a href="/{{ $commentChild->user->username }}" class="font-semibold text-gray-900 dark:text-white hover:underline">{{ ($commentChild->user->id == Auth::id()) ? 'Anda' : $commentChild->user->name }}</a> Membalas komentar <span @click="previewCommentReply({{ $commentChild->replyTo()->id }})" class="font-semibold text-gray-900 dark:text-white hover:underline">{{ (Auth::id() == $commentChild->replyTo()->user->id) ? 'anda sendiri' : $commentChild->replyTo()->user->name }}</span></div>
                                                            @else
                                                                <div class="text-sm md:hidden font-normal text-gray-500 dark:text-gray-300"><a href="/{{ $commentChild->user->username }}" class="font-semibold text-gray-900 dark:text-white hover:underline">{{ ($commentChild->user->id == Auth::id()) ? 'Anda' : $commentChild->user->name }}</a> Membalas komentar <span @click="previewCommentReply({{ $commentChild->replyTo()->id }})" class="font-semibold text-gray-900 dark:text-white hover:underline">{{ (Auth::id() == $commentChild->replyTo()->user->id) ? 'anda' : (($commentChild->user->id == $commentChild->replyTo()->user->id) ? 'nya' : $commentChild->replyTo()->user->name) }}</span></div>
                                                            @endif
                                                        @else
                                                            <div class="text-sm md:hidden font-normal text-gray-500 dark:text-gray-300"><a href="/{{ $commentChild->user->username }}" class="font-semibold text-gray-900 dark:text-white hover:underline">{{ $commentChild->user->name }}</a> Membalas komentar <span @click="previewCommentReply({{ $commentChild->replyTo()->id }})" class="font-semibold text-gray-900 dark:text-white hover:underline">{{ ($commentChild->user->id !== $commentChild->replyTo()->user->id) ? $commentChild->replyTo()->user->name : 'nya' }}</span></div>
                                                        @endif
                                                        <!-- start information user comment reply to comment MODE:Mobile-->
                                                    </div>
                                                    <!-- <div class="flex content-comment p-3 text-slate-500 bg-neutral-50 dark:bg-midnight-400 dark:text-slate-300 border-slate-300 rounded border dark:border-slate-700">{{ $commentChild->content }}</div> -->
                                                    <div class="content-comment text-slate-500 dark:text-slate-300">{{ $commentChild->content }}</div>
                                                    @if (auth()->check())
                                                        <div class="inline-block w-full my-2">
                                                            @if ($commentChild->user->id === auth()->id())
                                                                <button class="float-left active:scale-95 items-center px-2 py-1 border border-grenteel-200/30 text-xs leading-4 font-medium rounded-md text-slate-800 dark:text-slate-100 dark:font-semibold bg-neutral-400/30 dark:bg-midnight-100 dark:border-slate-600 dark:active:bg-midnight-100 dark:active:border-midnight-100 hover:shadow-neutral-300 hover:text-gray-700 focus:outline-none focus:bg-neutral-200 focus:text-gray-500 focus:shadow-grenteel-200 disabled:opacity-70 transition" @click="deleteComment({{ $commentChild->id }})">
                                                                    <i class="fa-solid fa-trash opacity-50"></i>
                                                                </button>
                                                                <button class="align-center active:scale-95 items-center ml-2 px-2 py-1 border border-grenteel-200/30 text-xs leading-4 font-medium rounded-md text-slate-800 dark:text-slate-100 dark:font-semibold bg-neutral-400/30 dark:bg-midnight-100 dark:border-slate-600 dark:active:bg-midnight-100 dark:active:border-midnight-100 hover:shadow-neutral-300 hover:text-gray-700 focus:outline-none focus:bg-neutral-200 focus:text-gray-500 focus:shadow-grenteel-200 disabled:opacity-70 transition" @click="editComment({{ $commentChild->id }})">
                                                                    <i class="fa-solid fa-pen opacity-50"></i>
                                                                </button>
                                                            @endif
                                                            <button class="float-right items-center active:scale-95 px-2 py-1 border border-grenteel-200/30 text-xs leading-4 font-medium rounded-md text-slate-800 dark:text-slate-100 dark:font-semibold bg-neutral-400/30 dark:bg-midnight-100 dark:border-slate-600 dark:active:bg-midnight-100 dark:active:border-midnight-100 hover:shadow-neutral-300 hover:text-gray-700 focus:outline-none focus:bg-neutral-200 focus:text-gray-500 focus:shadow-grenteel-200 disabled:opacity-70 transition" @click="addComment({{ $comment->id }}, {{ $commentChild->id }})">
                                                                <i class="fa-solid fa-reply opacity-50 mr-1"></i>Balas
                                                            </button>
                                                        </div>
                                                    @endif
                                                </div>
                                            </li>
                                        </div>
                                    @endif
                                @endforeach
                            
                            @endforeach
                        </ol>
                    </div>
                    
                    <!-- Add Comment -->
                    <div class="w-full md:w-8/12 add-comment">
                        <div class="w-full msg-comment">
                            <!-- xx -->
                        </div>
                        <div class="w-full editor-comment">
                            <div class="py-4">
                                @if (Auth::check())
                                <button class="items-center active:scale-95 w-full px-3 py-2 border border-grenteel-200 text-sm leading-4 font-medium rounded-md text-slate-800 dark:text-slate-100 dark:font-semibold bg-neutral-400 dark:bg-midnight-400 dark:border-midnight-400 dark:active:bg-midnight-100 dark:active:border-midnight-100 hover:shadow-neutral-300 hover:text-gray-700 focus:outline-none focus:bg-neutral-200 focus:text-gray-500 focus:shadow-grenteel-200 disabled:opacity-70 transition" onclick="addComment(null, null)" wire:loading.attr="disabled">
                                    <span wire:loading.remove wire:target="addComment"><i class="fa-solid fa-comment opacity-50 mr-2"></i>Tambah Komentar</span>
                                    <span style="border-top-color:transparent" class="w-4 h-4 border-2 border-blue-400 border-solid rounded-full animate-spin" wire:loading wire:target="addComment"></span>
                                </button>
                                @else
                                <button class="items-center active:scale-95 w-full px-3 py-2 border border-grenteel-200 text-sm leading-4 font-medium rounded-md text-slate-800 dark:text-slate-100 dark:font-semibold bg-neutral-400 dark:bg-midnight-400 dark:border-midnight-400 dark:active:bg-midnight-100 dark:active:border-midnight-100 hover:shadow-neutral-300 hover:text-gray-700 focus:outline-none focus:bg-neutral-200 focus:text-gray-500 focus:shadow-grenteel-200 disabled:opacity-70 transition" wire:click="redirectToModalsLogin">
                                    <span><i class="fa-solid fa-comment opacity-50 mr-2"></i>Tambah Komentar</span>
                                </button>
                                @endif
                            </div>
                        </div>
                        <div class="w-full post-comment hidden my-4">
                            <button class="inline-block active:scale-95 items-center float-right px-3 py-2 border border-grenteel-200 text-sm leading-4 font-medium rounded-md text-slate-800 dark:text-slate-100 dark:font-semibold bg-neutral-400 dark:bg-midnight-400 dark:border-midnight-400 dark:active:bg-midnight-100 dark:active:border-midnight-100 hover:shadow-neutral-300 hover:text-gray-700 focus:outline-none focus:bg-neutral-200 focus:text-gray-500 focus:shadow-grenteel-200 disabled:opacity-70 transition"
                               wire:click="addComment(addCommentar)"
                            >
                                <span wire:loading.remove wire:target="addComment"><i class="fa-solid fa-comment opacity-50 mr-2"></i>Post Komentar</span>
                                <span style="border-top-color:transparent" class="w-4 h-4 border-2 border-blue-400 border-solid rounded-full animate-spin" wire:loading wire:target="addComment"></span>
                            </button>
                        </div>
                        <div class="w-full post-edited-comment hidden my-4">
                            <button class="inline-block active:scale-95 items-center float-right px-3 py-2 border border-grenteel-200 text-sm leading-4 font-medium rounded-md text-slate-800 dark:text-slate-100 dark:font-semibold bg-neutral-400 dark:bg-midnight-400 dark:border-midnight-400 dark:active:bg-midnight-100 dark:active:border-midnight-100 hover:shadow-neutral-300 hover:text-gray-700 focus:outline-none focus:bg-neutral-200 focus:text-gray-500 focus:shadow-grenteel-200 disabled:opacity-70 transition"
                               wire:click="editComment(editCommentar)"
                            >
                                <span wire:loading.remove wire:target="editComment"><i class="fa-solid fa-comment opacity-50 mr-2"></i>Edit Komentar</span>
                                <span style="border-top-color:transparent" class="w-4 h-4 border-2 border-blue-400 border-solid rounded-full animate-spin" wire:loading wire:target="editComment"></span>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
            <!-- End Commentar -->
            
        </div>
    </div>
</div>

<!-- Push Style -->
@push('style')
<link rel="stylesheet" href="{{ asset('vendor/toastui/editor/toastui-editor.css') }}" />
<link rel="stylesheet" href="{{ asset('vendor/toastui/editor/toastui-editor-dark.css') }}"/>
<link rel="stylesheet" href="{{ asset('vendor/toastui/plugins/toastui-editor-plugin-code-syntax-highlight.min.css') }}"/>
<link rel="stylesheet" href="{{ asset('vendor/katex/katex.min.css') }}">
<link rel="stylesheet" href="{{ asset('vendor/katex/contrib/copy-tex.css') }}">
@endpush

<!-- Push Script -->
@push('scripts')
<!-- Editor -->
<script src="{{ asset('vendor/toastui/editor/toastui-editor-all.min.js') }}"></script>
<!-- Prism.js -->
<script src="{{ asset('vendor/prism/prism.js') }}"></script>
<!-- Editor's Plugin -->
<script src="{{ asset('vendor/toastui/plugins/toastui-editor-plugin-code-syntax-highlight-all.min.js') }}"></script>
<script src="{{ asset('vendor/toastui/plugins/toastui-editor-plugin-uml.min.js') }}"></script>
<!-- Katex.js -->
<script src="{{ asset('vendor/katex/katex.min.js') }}"></script>
<script src="{{ asset('vendor/katex/contrib/copy-tex.js') }}"></script>

<script type="text/javascript">
//  Base64 encode and decode
let Base64={_keyStr:"ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789+/=",encode:function(e){var t="";var n,r,i,s,o,u,a;var f=0;e=Base64._utf8_encode(e);while(f<e.length){n=e.charCodeAt(f++);r=e.charCodeAt(f++);i=e.charCodeAt(f++);s=n>>2;o=(n&3)<<4|r>>4;u=(r&15)<<2|i>>6;a=i&63;if(isNaN(r)){u=a=64}else if(isNaN(i)){a=64}t=t+this._keyStr.charAt(s)+this._keyStr.charAt(o)+this._keyStr.charAt(u)+this._keyStr.charAt(a)}return t},decode:function(e){var t="";var n,r,i;var s,o,u,a;var f=0;e=e.replace(/[^A-Za-z0-9\+\/\=]/g,"");while(f<e.length){s=this._keyStr.indexOf(e.charAt(f++));o=this._keyStr.indexOf(e.charAt(f++));u=this._keyStr.indexOf(e.charAt(f++));a=this._keyStr.indexOf(e.charAt(f++));n=s<<2|o>>4;r=(o&15)<<4|u>>2;i=(u&3)<<6|a;t=t+String.fromCharCode(n);if(u!=64){t=t+String.fromCharCode(r)}if(a!=64){t=t+String.fromCharCode(i)}}t=Base64._utf8_decode(t);return t},_utf8_encode:function(e){e=e.replace(/\r\n/g,"\n");var t="";for(var n=0;n<e.length;n++){var r=e.charCodeAt(n);if(r<128){t+=String.fromCharCode(r)}else if(r>127&&r<2048){t+=String.fromCharCode(r>>6|192);t+=String.fromCharCode(r&63|128)}else{t+=String.fromCharCode(r>>12|224);t+=String.fromCharCode(r>>6&63|128);t+=String.fromCharCode(r&63|128)}}return t},_utf8_decode:function(e){var t="";var n=0;var r=c1=c2=0;while(n<e.length){r=e.charCodeAt(n);if(r<128){t+=String.fromCharCode(r);n++}else if(r>191&&r<224){c2=e.charCodeAt(n+1);t+=String.fromCharCode((r&31)<<6|c2&63);n+=2}else{c2=e.charCodeAt(n+1);c3=e.charCodeAt(n+2);t+=String.fromCharCode((r&15)<<12|(c2&63)<<6|c3&63);n+=3}}return t}}

// Set Prism Auto Highlighter
Prism.manual = false;

let post = {!! $post !!}

let content = post.content;
//content = content.replaceAll(/=-=/g, '\u0060');
//content = content.replaceAll(/\u0060\u0060\u0060}/g, '\u0060\u0060\u0060');


const  Editor = toastui.Editor;
const { codeSyntaxHighlight, uml } = Editor.plugin;

let renderer = {
    heading(node,{ entering, getChildrenText }) {
      const tagName = `h${node.level}`;
      
      if (entering) {
          if (node.id === 1) {
              (document.querySelector('.navigation-page .navigation-content') !== null) ? document.querySelector('.navigation-page .navigation-content').innerHTML = '' : '';
              (document.querySelector('.navigation-page-mobile .navigation-content') !== null) ? document.querySelector('.navigation-page-mobile').classList.remove('hidden') : '';
          }
          
          let navPageMenu = document.querySelectorAll('.navigation-content');
          if (navPageMenu) {
              for (let i = 0; i < navPageMenu.length; i++) {
                  navPageMenu[i].innerHTML += `<div class="mb-4"><a href="#${getChildrenText(node).trim().replace(/([^\d\w])/g, '-')}">${getChildrenText(node)}</a></div>`
              }
          }
          
          return {
            type: 'openTag',
            tagName,
            attributes: {
                id: getChildrenText(node)
                    .trim()
                    .replace(/([^\d\w])/g, '-')
            }
        };
      }
      return { type: 'closeTag', tagName };
    },
    codeBlock(node, { origin }) {
        let result = origin()
        
        result.unshift({ type: 'openTag', tagName: 'div', classNames: ["wrapper-pre-viewer"] })
        result.push({ type: 'closeTag', tagName: 'div' })
        
        result.unshift({ type: 'closeTag', tagName: 'div' })
        result.unshift({ type: 'html', content: `<svg class="w-4 h-4 copy-icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><!--! Font Awesome Pro 6.0.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2022 Fonticons, Inc. --><path d="M384 96L384 0h-112c-26.51 0-48 21.49-48 48v288c0 26.51 21.49 48 48 48H464c26.51 0 48-21.49 48-48V128h-95.1C398.4 128 384 113.6 384 96zM416 0v96h96L416 0zM192 352V128h-144c-26.51 0-48 21.49-48 48v288c0 26.51 21.49 48 48 48h192c26.51 0 48-21.49 48-48L288 416h-32C220.7 416 192 387.3 192 352z"/></svg>` })
        result.unshift({ type: 'openTag', tagName: 'div', classNames: ['copy right-6 md:right-64 md:mr-5 hidden'], attributes: { "data-node-copy": Base64.encode(node.literal) } })
        
        result.unshift({ type: 'openTag', tagName: 'div' })
        result.push({ type: 'closeTag', tagName: 'div' })
        return result;
    },
    latex(node) {
        let latex =  katex.renderToString(node.literal, {
            throwOnError: false
        });
      
      return [
        { type: 'openTag', tagName: 'div', outerNewLine: true },
        { type: 'html', content: latex },
        { type: 'closeTag', tagName: 'div', outerNewLine: true }
      ];
    },
};

const viewer = new Editor.factory({
    el: document.getElementById('content'),
    viewer: true,
    events: {
        load: () => {
            const table = document.querySelector('.toastui-editor-contents div table');
            if (table !== null) {
                table.classList = "scrollbar-thin scrollbar-thumb-slate-300 scrollbar-track-slate-200 dark:scrollbar-thumb-midnight-300 dark:scrollbar-track-midnight-500";
            }
            
        },
        //change: viewerLoad()
    },
    initialValue: content,
    customHTMLRenderer: renderer,
    plugins: [uml, [codeSyntaxHighlight, { highlighter: Prism }]],
    theme: localStorage.theme
});

const btnCopy = document.querySelectorAll(".copy");
if (btnCopy) {
    for (let i = 0; i < btnCopy.length; i++) {
        btnCopy[i].addEventListener('click', () => {
            const content = btnCopy[i].getAttribute('data-node-copy')
            navigator.clipboard.writeText(Base64.decode(content));
            document.querySelector(`[data-nodeid="${btnCopy[i].parentElement.attributes['data-nodeid'].value}"]`).querySelector('.copy').classList.add('copy-success');
            btnCopy[i].innerHTML = '<svg class="w-4 h-4 copy-icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"><!--! Font Awesome Pro 6.0.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2022 Fonticons, Inc. --><path d="M438.6 105.4C451.1 117.9 451.1 138.1 438.6 150.6L182.6 406.6C170.1 419.1 149.9 419.1 137.4 406.6L9.372 278.6C-3.124 266.1-3.124 245.9 9.372 233.4C21.87 220.9 42.13 220.9 54.63 233.4L159.1 338.7L393.4 105.4C405.9 92.88 426.1 92.88 438.6 105.4H438.6z"/></svg>';
            let cp = setInterval(function () {
                btnCopy[i].innerHTML = '<svg class="w-4 h-4 copy-icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><!--! Font Awesome Pro 6.0.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2022 Fonticons, Inc. --><path d="M384 96L384 0h-112c-26.51 0-48 21.49-48 48v288c0 26.51 21.49 48 48 48H464c26.51 0 48-21.49 48-48V128h-95.1C398.4 128 384 113.6 384 96zM416 0v96h96L416 0zM192 352V128h-144c-26.51 0-48 21.49-48 48v288c0 26.51 21.49 48 48 48h192c26.51 0 48-21.49 48-48L288 416h-32C220.7 416 192 387.3 192 352z"/></svg>';
                clearInterval(cp)
                document.querySelector(`[data-nodeid="${btnCopy[i].parentElement.attributes['data-nodeid'].value}"]`).querySelector('.copy').classList.remove('copy-success');
            }, 4000);
        });
        
        btnCopy[i].parentElement.addEventListener('mouseover', () => {
            document.querySelector(`[data-nodeid="${btnCopy[i].parentElement.attributes['data-nodeid'].value}"]`).querySelector('.copy').classList.remove('hidden');
        });
        
        btnCopy[i].parentElement.addEventListener('mouseleave', () => {
            document.querySelector(`[data-nodeid="${btnCopy[i].parentElement.attributes['data-nodeid'].value}"]`).querySelector('.copy').classList.add('hidden');
        });
        
    }
}



//Adding Commentar
let addCommentar = null;
function addComment(parent, replyTo) {
    let wrapperComment = document.querySelector('.add-comment');
    wrapperComment.setAttribute("wire:ignore");
    wrapperComment.classList.add('border-t', 'border-slate-400', 'py-4', 'my-8', 'rounded');
    wrapperComment.querySelector('.post-edited-comment').classList.add('hidden');
    wrapperComment.querySelector('.post-comment').classList.remove('hidden');
    let editorComment = wrapperComment.querySelector('.editor-comment');
    editorComment.classList.add('border', 'border-[#dadde6]', 'dark:border-slate-600', 'bg-neutral-400', 'rounded')
    
    addCommentar = {
        'post': post,
        'parent_id': parent,
        'reply_to': replyTo,
        'content': null
    };
    
    if (parent !== null) {
        let replyToCommentContent = document.querySelector(`.comment-${replyTo} div div a`).textContent;
        let child = `<h5 class="text-lg font-semibold mb-3 text-slate-800 dark:text-slate-100">Membalas komentar <span onclick="previewCommentReply(${replyTo})" class="text-blue-500 cursor-pointer">${replyToCommentContent}</span></h5>`;
        wrapperComment.querySelector('.msg-comment').innerHTML = child;
    } else {
        let child = '<h5 class="text-lg font-semibold mb-3 text-slate-800 dark:text-slate-100">Tambah Komentar</h5>';
        wrapperComment.querySelector('.msg-comment').innerHTML = child;
    }
    
    editorComment.innerHTML = '';
    
    const editor = new Editor({
        el: editorComment,
        initialEditType: 'markdown',
        previewStyle: 'tab',
        toolbarItems: [],
        height: '400px',
        placeholder: 'Berikan masukan maupun kritik tentang post ini!',
        plugins: [uml, [codeSyntaxHighlight, { highlighter: Prism }]],
        theme: localStorage.theme
    });
    
    editorComment.addEventListener('keyup', () => {
        let markdown = editor.getMarkdown();
        //markdown = markdown.replaceAll(/\u0060/g, "=-=");
        
        addCommentar.content = markdown;
    });
    
    wrapperComment.querySelector('.post-comment button').addEventListener('click', () => {
       wrapperComment.removeAttribute("wire:ignore"); 
    });
}

// Edit Commentar
let editCommentar = null;
function editComment(commentId) {
    let wrapperComment = document.querySelector('.add-comment');
    wrapperComment.setAttribute("wire:ignore");
    wrapperComment.classList.add('border-t', 'border-slate-400', 'py-4', 'my-8', 'rounded');
    wrapperComment.querySelector('.post-comment').classList.add('hidden');
    wrapperComment.querySelector('.post-edited-comment').classList.remove('hidden');
    let editorComment = wrapperComment.querySelector('.editor-comment');
    editorComment.classList.add('border', 'border-[#dadde6]', 'dark:border-slate-600', 'bg-neutral-400', 'rounded')
    
    editCommentar = {
        'post': post,
        'comment_id': commentId
    };
    
    let content = document.querySelector(`.comment-${commentId} .content-comment`).textContent;
    
    editorComment.innerHTML = '';
    
    const editor = new Editor({
        el: editorComment,
        previewStyle: 'tab',
        toolbarItems: [],
        height: '400px',
        placeholder: 'Berikan masukan maupun kritik tentang post ini!',
        initialValue: content,
        plugins: [uml, [codeSyntaxHighlight, { highlighter: Prism }]],
        theme: localStorage.theme
    });
    
    let child = `<h5 class="text-lg font-semibold mb-3 text-slate-800 dark:text-slate-100">Edit komentar <span onclick="previewCommentReply(${commentId})" class="text-blue-500 cursor-pointer">${content}</span></h5>`;
    wrapperComment.querySelector('.msg-comment').innerHTML = child;
    
    editorComment.addEventListener('keyup', () => {
        let markdown = editor.getMarkdown();
        //markdown = markdown.replaceAll(/\u0060/g, "=-=");
        
        editCommentar.content = markdown;
        console.log(editCommentar);
    });
    
    wrapperComment.querySelector('.post-edited-comment button').addEventListener('click', () => {
       wrapperComment.removeAttribute("wire:ignore"); 
    });
}

function deleteComment(commentId) {
    Swal.fire({
        title: '<h5 class="text-midnight-800 dark:text-slate-100">Apakah kamu yakin?</h5>',
        html: `<div><p class="text-midnight-800/70 dark:text-slate-400">Kamu ingin menghapus komentar ini?</p></div>`,
        showCloseButton: true,
        showConfirmButton: true,
        confirmButtonText: 'Hapus',
        showCancelButton: true,
        cancelButtonText: 'Batal',
        focusConfirm: false,
        background: (localStorage.theme === 'light') ? '#f3f6fe' : '#20315a', 
    }).then((result) => {
        if (result.value === true) {
            Livewire.emit('deleteComment', commentId);
        }
    })
}


function previewCommentReply(replyToId) {
    let comment = document.querySelector(`.comment-${replyToId}`);
    window.scroll(0, comment.getBoundingClientRect().top - document.body.getBoundingClientRect().top - 30);
    comment.classList.add('animate-pulse', 'rounded-lg', 'border-2', 'border-blue-500/80', 'dark:border-purple-400/80');
    let intVal = setInterval(() => { 
        clearInterval(intVal);
        comment.classList.remove('animate-pulse', 'rounded-lg', 'border-2', 'border-blue-500/80', 'dark:border-purple-400/80');
    }, 4000);
}



printMarkdownComment();
function printMarkdownComment() {
    let allComment = document.querySelectorAll('.comment');
    if (allComment !== null) {
        allComment.forEach((comment) => {
            let contentComment = comment.querySelector('.content-comment');
            let commentValue = contentComment.outerText;
            //commentValue = commentValue.replaceAll(/=-=/g, '\u0060');
            const viewerComment = new Editor.factory({
                el: contentComment,
                viewer: true,
                initialValue: commentValue,
                customHTMLRenderer: renderer,
                plugins: [uml, [codeSyntaxHighlight, { highlighter: Prism }]],
                theme: localStorage.theme
            });
        });
    }
}

function share() {
    navigator.share({
        title: "{{ config('app.name') }}",
        text: post.title + ' - ' + post.user.name + '(@'+post.user.username+') | {{ config("app.name") }}',
        url: window.location.href,
    });
}


window.addEventListener('toastStatus', event => {
    //let wrapperComment = document.querySelector('.add-comment');
    //let editorComment = wrapperComment.querySelector('.editor-comment');
    //editorComment.removeAttribute("wire:ignore");
    printMarkdownComment(); 
});



</script>
@endpush