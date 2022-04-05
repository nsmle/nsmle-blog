<div>
    <div class="max-w-3xl mx-auto md:px-6 lg:px-8"
        x-data
    >
        <div class="mx-auto md:flex md:grid md:grid-cols-2 md:gap-8 justify-center">
        <!--  Post  -->
        @foreach ($posts as $post)
            <div class="md:rounded overflow-hidden w-full md:shadow-lg md:shadow-neutral-400 hover:md:shadow-slate-500/30 dark:md:shadow-midnight-800/50 dark:hover:md:shadow-midnight-800/70 bg-slate-50 dark:bg-midnight-400 my-4"
              wire:key="post-{{ $post->slug }}"
            >
                <div class="w-full flex justify-between items-center p-3">
                    <div class="flex items-center">
                        <a href="/{{ $post->user->username }}" class="rounded-full h-8 w-8 bg-slate-200 dark:bg-slate-800 flex items-center justify-center overflow-hidden">
                            <img class="object-cover hover:scale-105" src="{{ $post->user->profile_photo_url }}" alt="{{ $post->user->name }}" loading="lazy">
                        </a>
                        <a href="/{{ $post->user->username }}" class="ml-2 font-bold text-gray-800 dark:text-gray-200 hover:text-slate-500 dark:hover:text-slate-300 text-sm truncate">
                            {{ $post->user->name }}
                        </a>
                        @if ($post->user->followStatus() !== "Mengikuti" && $post->user->id !== Auth::id())
                        <small class="h-1 w-1 bg-gray-300 dark:bg-gray-400/50 rounded-full mx-2"></small>
                        <button type="button" wire:click="follow({{ $post->user->id }})" class="font-bold text-blue-400 active:text-blue-300 dark:text-blue-500 dark:active:text-blue-600 text-xs disabled:opacity-50" wire:target="follow({{ $post->user->id }})">
                            <svg role="status" class="w-3 h-3 text-gray-300 animate-spin dark:text-gray-400/10 fill-blue-600" viewBox="0 0 100 101" fill="none" xmlns="http://www.w3.org/2000/svg" wire:loading wire:target="follow({{ $post->user->id }})">
                                <path d="M100 50.5908C100 78.2051 77.6142 100.591 50 100.591C22.3858 100.591 0 78.2051 0 50.5908C0 22.9766 22.3858 0.59082 50 0.59082C77.6142 0.59082 100 22.9766 100 50.5908ZM9.08144 50.5908C9.08144 73.1895 27.4013 91.5094 50 91.5094C72.5987 91.5094 90.9186 73.1895 90.9186 50.5908C90.9186 27.9921 72.5987 9.67226 50 9.67226C27.4013 9.67226 9.08144 27.9921 9.08144 50.5908Z" fill="currentColor"/>
                                <path d="M93.9676 39.0409C96.393 38.4038 97.8624 35.9116 97.0079 33.5539C95.2932 28.8227 92.871 24.3692 89.8167 20.348C85.8452 15.1192 80.8826 10.7238 75.2124 7.41289C69.5422 4.10194 63.2754 1.94025 56.7698 1.05124C51.7666 0.367541 46.6976 0.446843 41.7345 1.27873C39.2613 1.69328 37.813 4.19778 38.4501 6.62326C39.0873 9.04874 41.5694 10.4717 44.0505 10.1071C47.8511 9.54855 51.7191 9.52689 55.5402 10.0491C60.8642 10.7766 65.9928 12.5457 70.6331 15.2552C75.2735 17.9648 79.3347 21.5619 82.5849 25.841C84.9175 28.9121 86.7997 32.2913 88.1811 35.8758C89.083 38.2158 91.5421 39.6781 93.9676 39.0409Z" fill="currentFill"/>
                            </svg>
                            <span wire:loading.remove wire:target="follow({{ $post->user->id }})" >{{ $post->user->followStatus() }}</span>
                        </button>
                        @endif
                    </div>
                    <x-jet-dropdown align="right" contentClasses="-mt-2">
                        <x-slot name="trigger">
                            <div class="p-1 hover:bg-slate-100 dark:hover:bg-slate-700/20 cursor-pointer rounded">
                                <svg class="h-5 w-5 fill-gray-500 dark:fill-gray-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"><!--! Font Awesome Pro 6.1.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2022 Fonticons, Inc. --><path d="M120 256C120 286.9 94.93 312 64 312C33.07 312 8 286.9 8 256C8 225.1 33.07 200 64 200C94.93 200 120 225.1 120 256zM280 256C280 286.9 254.9 312 224 312C193.1 312 168 286.9 168 256C168 225.1 193.1 200 224 200C254.9 200 280 225.1 280 256zM328 256C328 225.1 353.1 200 384 200C414.9 200 440 225.1 440 256C440 286.9 414.9 312 384 312C353.1 312 328 286.9 328 256z"/></svg>
                            </div>
                        </x-slot>
                        <x-slot name="content">
                            <ul class="text-sm font-medium text-gray-900 bg-white border border-gray-200 rounded-lg dark:bg-midnight-90 dark:border-slate-600 dark:text-gray-200">
                                @if ($post->user->followStatus() == "Mengikuti" && $post->user->id !== Auth::id())
                                <li class="flex w-full hover:text-blue-600 text-sm px-4 py-2 border-b border-gray-200 rounded-t-lg dark:border-slate-600 items-center disabled:opacity-50 disabled:text-gray-600 dark:disabled:text-gray-400" wire:target="follow({{ $post->user->id }})" wire:click="follow({{ $post->user->id }})">
                                    <svg wire:loading.remove wire:target="follow({{ $post->user->id }})" class="h-4 w-4 mr-2 fill-slate-700 dark:fill-slate-200" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path d="M5.84846399,13.5498221 C7.28813318,13.433801 8.73442297,13.433801 10.1740922,13.5498221 C10.9580697,13.5955225 11.7383286,13.6935941 12.5099314,13.8434164 C14.1796238,14.1814947 15.2696821,14.7330961 15.73685,15.6227758 C16.0877167,16.317132 16.0877167,17.1437221 15.73685,17.8380783 C15.2696821,18.727758 14.2228801,19.3149466 12.4926289,19.6174377 C11.7216312,19.7729078 10.9411975,19.873974 10.1567896,19.9199288 C9.43008411,20 8.70337858,20 7.96802179,20 L6.64437958,20 C6.36753937,19.9644128 6.09935043,19.9466192 5.83981274,19.9466192 C5.05537891,19.9062698 4.27476595,19.8081536 3.50397353,19.6530249 C1.83428106,19.3327402 0.744222763,18.7633452 0.277054922,17.8736655 C0.0967111971,17.5290284 0.00163408158,17.144037 0.000104217816,16.752669 C-0.00354430942,16.3589158 0.0886574605,15.9704652 0.268403665,15.6227758 C0.72692025,14.7330961 1.81697855,14.1548043 3.50397353,13.8434164 C4.27816255,13.6914539 5.06143714,13.5933665 5.84846399,13.5498221 Z M8.00262682,-1.16351373e-13 C10.9028467,-1.16351373e-13 13.2539394,2.41782168 13.2539394,5.40035587 C13.2539394,8.38289006 10.9028467,10.8007117 8.00262682,10.8007117 C5.10240696,10.8007117 2.75131423,8.38289006 2.75131423,5.40035587 C2.75131423,2.41782168 5.10240696,-1.16351373e-13 8.00262682,-1.16351373e-13 Z" transform="translate(4 2)"/></svg>
                                    <svg role="status" class="w-4 h-4 text-gray-300 animate-spin dark:text-gray-400/10 fill-blue-600 mr-2" viewBox="0 0 100 101" fill="none" xmlns="http://www.w3.org/2000/svg" wire:loading wire:target="follow({{ $post->user->id }})">
                                        <path d="M100 50.5908C100 78.2051 77.6142 100.591 50 100.591C22.3858 100.591 0 78.2051 0 50.5908C0 22.9766 22.3858 0.59082 50 0.59082C77.6142 0.59082 100 22.9766 100 50.5908ZM9.08144 50.5908C9.08144 73.1895 27.4013 91.5094 50 91.5094C72.5987 91.5094 90.9186 73.1895 90.9186 50.5908C90.9186 27.9921 72.5987 9.67226 50 9.67226C27.4013 9.67226 9.08144 27.9921 9.08144 50.5908Z" fill="currentColor"/>
                                        <path d="M93.9676 39.0409C96.393 38.4038 97.8624 35.9116 97.0079 33.5539C95.2932 28.8227 92.871 24.3692 89.8167 20.348C85.8452 15.1192 80.8826 10.7238 75.2124 7.41289C69.5422 4.10194 63.2754 1.94025 56.7698 1.05124C51.7666 0.367541 46.6976 0.446843 41.7345 1.27873C39.2613 1.69328 37.813 4.19778 38.4501 6.62326C39.0873 9.04874 41.5694 10.4717 44.0505 10.1071C47.8511 9.54855 51.7191 9.52689 55.5402 10.0491C60.8642 10.7766 65.9928 12.5457 70.6331 15.2552C75.2735 17.9648 79.3347 21.5619 82.5849 25.841C84.9175 28.9121 86.7997 32.2913 88.1811 35.8758C89.083 38.2158 91.5421 39.6781 93.9676 39.0409Z" fill="currentFill"/>
                                    </svg>
                                    Berhenti mengikuti
                                </li>
                                @endif
                                <li wire:click="sendMessage('{{ $post->user->username }}')" class="flex w-full hover:text-blue-600 text-sm px-4 py-2 border-b border-gray-200 dark:border-slate-600 items-center">
                                    <svg class="h-4 w-4 mr-2 stroke-slate-700 dark:stroke-slate-200" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><g fill="none" fill-rule="evenodd" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" transform="translate(2 3.5)"><path d="M15.2677346,5.56112535 L11.0022884,8.99539646 C10.1950744,9.62826732 9.06350694,9.62826732 8.25629295,8.99539646 L3.95423343,5.56112535"/><path d="M4.88787188,4.13786652e-14 L14.3157895,4.13786652e-14 C15.6751779,0.015246851 16.9690267,0.589927916 17.8960035,1.59020219 C18.8229802,2.59047647 19.3021688,3.92902958 19.2219681,5.29411767 L19.2219681,11.8219949 C19.3021688,13.187083 18.8229802,14.5256361 17.8960035,15.5259104 C16.9690267,16.5261847 15.6751779,17.1008658 14.3157895,17.1161126 L4.88787188,17.1161126 C1.9679634,17.1161126 -2.4308041e-14,14.740665 -2.4308041e-14,11.8219949 L-2.4308041e-14,5.29411767 C-2.4308041e-14,2.37544758 1.9679634,4.13786652e-14 4.88787188,4.13786652e-14 Z"/></g></svg>
                                    Kirim Pesan
                                </li>
                                <li wire:click="replyPost({{ $post }})" class="flex w-full hover:text-blue-600 text-sm px-4 py-2 border-b border-gray-200 dark:border-slate-600 items-center">
                                    <svg class="h-4 w-4 mr-2 fill-slate-700 dark:fill-slate-200" xmlns="http://www.w3.org/2000/svg" fill-rule="evenodd" stroke-linejoin="round" stroke-miterlimit="2" clip-rule="evenodd" viewBox="0 0 500 500"><path d="M79.451,277.28L39.451,277.28L99.451,157.28L159.451,277.28L119.451,277.28L119.451,314.148C119.451,344.524 144.075,369.148 174.451,369.148L400.549,369.148C411.588,369.148 420.549,378.11 420.549,389.148C420.549,400.187 411.588,409.148 400.549,409.148L174.451,409.148C121.983,409.148 79.451,366.615 79.451,314.148L79.451,277.28ZM380.549,222.72L380.549,185.852C380.549,155.476 355.925,130.852 325.549,130.852L99.451,130.852C88.412,130.852 79.451,121.89 79.451,110.852C79.451,99.813 88.412,90.852 99.451,90.852L325.549,90.852C378.017,90.852 420.549,133.385 420.549,185.852L420.549,222.72L460.549,222.72L400.549,342.72L340.549,222.72L380.549,222.72Z"/></svg>
                                    Balas post
                                </li>
                                <li class="flex w-full hover:text-blue-600 text-sm px-4 py-2 rounded-b-lg items-center"
                                    onclick="navigator.share({
                                        title: `{{ config('app.name') }}`,
                                        text: `{{ $post->title }} - {{ $post->user->name }} ({{ '@'.$post->user->username }}) | {{ config("app.name") }}`,
                                        url: '/post/{{ $post->slug }}',
                                    });"
                                >
                                    <svg class="h-3 w-3 ml-1 mr-2.5 stroke-slate-700 dark:stroke-slate-200" xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 22 22"><g fill="none" fill-rule="evenodd" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" transform="translate(1 1)"><circle cx="15" cy="3" r="3"/><circle cx="3" cy="10" r="3"/><circle cx="15" cy="17" r="3"/><path d="M5.59 11.51l6.83 3.98M12.41 4.51L5.59 8.49"/></g></svg>
                                    Share
                                </li>
                            </ul>
                        </x-slot>
                    </x-jet-dropdown>
                    
                </div>
                
                <a href="/posts/{{ $post->slug }}" class="aspect-video bg-slate-200 dark:bg-slate-800 flex overflow-hidden">
                    <img class="hover:scale-105 aspect-video object-cover cursor-pointer bg-slate-200 dark:bg-slate-800" src="{{ $post->cover ? asset(`'`.$post->cover.`'`) : 'https://source.unsplash.com/700x400?'.urlencode($post->title) }}" alt="{{ $post->title }}" loading="lazy">
                </a>
                
                <div class="px-3 pb-2">
                    <div class="pt-2">
                        {{--
                        <i class="far fa-heart cursor-pointer"></i>
                        <span class="text-sm text-gray-800 font-medium">12 likes</span>
                        --}}
                        <livewire:components.post-action.like :post="$post" :wire:key="'post-like-'.$post->slug" :class="'flex active:scale-90 items-center text-xs leading-4 font-medium rounded-md text-slate-800 dark:text-slate-300 dark:font-semibold hover:text-gray-700'" :hw="22" :afterText="' likes'"/>
                    </div>
                     <div class="pt-1">
                        <div class="mb-2 text-sm">
                            <a href="/{{ $post->slug }}" class="font-semibold text-gray-800 dark:text-gray-200 hover:text-slate-500 dark:hover:text-slate-300 mr-1">
                                {{ $post->title }}
                            </a>
                            <a href="/posts/{{ $post->slug }}" class="text-gray-700 dark:text-slate-300/80 hover:text-slate-500 dark:hover:text-slate-400/80">
                                {{ $post->summary }}
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
        </div>
        
        @if ($posts->hasMorePages())
        <div class="flex my-4 justify-center" wire:poll.visible.1000ms="loadMorePost">
            <svg role="status" class="w-8 h-8 text-gray-300 animate-spin dark:text-gray-400/10 fill-blue-600" viewBox="0 0 100 101" fill="none" xmlns="http://www.w3.org/2000/svg" wire:loading>
                <path d="M100 50.5908C100 78.2051 77.6142 100.591 50 100.591C22.3858 100.591 0 78.2051 0 50.5908C0 22.9766 22.3858 0.59082 50 0.59082C77.6142 0.59082 100 22.9766 100 50.5908ZM9.08144 50.5908C9.08144 73.1895 27.4013 91.5094 50 91.5094C72.5987 91.5094 90.9186 73.1895 90.9186 50.5908C90.9186 27.9921 72.5987 9.67226 50 9.67226C27.4013 9.67226 9.08144 27.9921 9.08144 50.5908Z" fill="currentColor"/>
                <path d="M93.9676 39.0409C96.393 38.4038 97.8624 35.9116 97.0079 33.5539C95.2932 28.8227 92.871 24.3692 89.8167 20.348C85.8452 15.1192 80.8826 10.7238 75.2124 7.41289C69.5422 4.10194 63.2754 1.94025 56.7698 1.05124C51.7666 0.367541 46.6976 0.446843 41.7345 1.27873C39.2613 1.69328 37.813 4.19778 38.4501 6.62326C39.0873 9.04874 41.5694 10.4717 44.0505 10.1071C47.8511 9.54855 51.7191 9.52689 55.5402 10.0491C60.8642 10.7766 65.9928 12.5457 70.6331 15.2552C75.2735 17.9648 79.3347 21.5619 82.5849 25.841C84.9175 28.9121 86.7997 32.2913 88.1811 35.8758C89.083 38.2158 91.5421 39.6781 93.9676 39.0409Z" fill="currentFill"/>
            </svg>
        </div>
        @endif
    </div>
    
</div>