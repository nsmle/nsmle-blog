<div>
    
    <div class="flex w-full max-w-3xl mx-auto px-4 md:px-6 lg:px-8 justify-center md:justify-none mb-8">
        <div class="w-full mt-4 px-2 py-4 @if (count($notifications)) bg-white @else bg-slate-50 @endif rounded-lg border shadow-md sm:p-8 dark:bg-midnight-500 dark:border-none">
            <div class="flex justify-between items-center mb-4">
                <h5 class="text-xl px-2 font-bold leading-none text-gray-900 dark:text-white">@if (count($notifications)) Semua @endif Notifikasi</h5>
                @if (count($unreadNotifications))
                <span wire:click="readAllUnreadNotif" class="text-sm font-medium text-blue-600 dark:text-blue-500">
                    Tandai semua dibaca
                </span>
                @endif
           </div>
           <div class="flow-root">
               @if (count($notifications))
                <ul role="list" class="divide-y divide-gray-200 dark:divide-gray-700">
                    
                    @foreach($notifications as $notif)
                        <!-- Notify Post Reply -->
                        @if ($notif->entity_type === 'post' && $notif->entity_event_type === "reply") 
                        
                            <li wire:click="readNotif({{ $notif->id }}, '/posts/{{ $notif->post->slug }}')" class="flex items-center px-2 py-3 sm:py-4 @if (!$notif->read) bg-blue-50 dark:bg-midnight-200 hover:bg-blue-50/80 dark:hover:bg-midnight-200/80 @else hover:bg-blue-50/40 dark:hover:bg-midnight-400 @endif active:bg-blue-100/70 dark:active:bg-midnight-300 cursor-pointer rounded">
                                <div class="inline-block relative shrink-0">
                                    <a href="/{{ $notif->triggerUser->username }}">
                                        <img class="w-12 h-12 rounded-full" src="{{ asset($notif->triggerUser->profile_photo_url) }}" alt="{{ $notif->triggerUser->name }}" loading="lazy"/>
                                    </a>
                                    <span class="inline-flex absolute right-0 bottom-0 justify-center items-center w-6 h-6 bg-blue-600 rounded-full">
                                        <svg class="w-4 h-4 text-white" fill="currentColor" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path d="M13.191,0 C16.28,0 18,1.78 18,4.83 L18,4.83 L18,15.16 C18,18.26 16.28,20 13.191,20 L13.191,20 L4.81,20 C1.77,20 0,18.26 0,15.16 L0,15.16 L0,4.83 C0,1.78 1.77,0 4.81,0 L4.81,0 Z M5.08,13.74 C4.78,13.71 4.49,13.85 4.33,14.11 C4.17,14.36 4.17,14.69 4.33,14.95 C4.49,15.2 4.78,15.35 5.08,15.31 L5.08,15.31 L12.92,15.31 C13.319,15.27 13.62,14.929 13.62,14.53 C13.62,14.12 13.319,13.78 12.92,13.74 L12.92,13.74 Z M12.92,9.179 L5.08,9.179 C4.649,9.179 4.3,9.53 4.3,9.96 C4.3,10.39 4.649,10.74 5.08,10.74 L5.08,10.74 L12.92,10.74 C13.35,10.74 13.7,10.39 13.7,9.96 C13.7,9.53 13.35,9.179 12.92,9.179 L12.92,9.179 Z M8.069,4.65 L5.08,4.65 L5.08,4.66 C4.649,4.66 4.3,5.01 4.3,5.44 C4.3,5.87 4.649,6.22 5.08,6.22 L5.08,6.22 L8.069,6.22 C8.5,6.22 8.85,5.87 8.85,5.429 C8.85,5 8.5,4.65 8.069,4.65 L8.069,4.65 Z" transform="translate(3 2)"/></svg>
                                    </span>
                                </div>
                                <div class="ml-3 text-sm font-normal">
                                    <h4 class="text-sm font-semibold text-gray-900 dark:text-white">
                                        <a href="/{{ $notif->triggerUser->username }}" class="hover:text-blue-500">
                                            {{ $notif->triggerUser->name }}
                                        </a>
                                    </h4>
                                    <div class="text-sm font-normal text-gray-700 dark:text-gray-300">
                                        Membalas postingan anda {{ mb_strimwidth(str_replace('.', '', strtolower($notif->post->parent->title)), 0, 70, '...') }} dengan postingan {{ mb_strimwidth(str_replace('.', '', strtolower($notif->post->title)), 0, 70, '...') }}
                                    </div> 
                                    <span class="text-xs font-medium text-blue-600 dark:text-blue-500">
                                        {{ $notif->created_at->diffForHumans() }}
                                    </span>
                                </div>
                            </li>
                        @endif
                        
                        <!-- Notify Post Liked -->
                        @if ($notif->entity_type === 'post' && $notif->entity_event_type === "like") 
                            <li wire:click="readNotif({{ $notif->id }}, '/posts/{{ $notif->post->slug }}')" class="flex items-center px-2 py-3 sm:py-4 @if (!$notif->read) bg-blue-50 dark:bg-midnight-200 hover:bg-blue-50/80 dark:hover:bg-midnight-200/80 @else hover:bg-blue-50/40 dark:hover:bg-midnight-400 @endif active:bg-blue-100/70 dark:active:bg-midnight-300 cursor-pointer rounded">
                                <div class="inline-block relative shrink-0">
                                    <a href="/{{ $notif->triggerUser->username }}">
                                        <img class="w-12 h-12 rounded-full" src="{{ asset($notif->triggerUser->profile_photo_url) }}" alt="{{ $notif->triggerUser->name }}" loading="lazy"/>
                                    </a>
                                    <span class="inline-flex absolute right-0 bottom-0 justify-center items-center w-6 h-6 bg-blue-600 rounded-full">
                                        <svg class="w-4 h-4 text-white" fill="currentColor" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path d="M6.28001656,3.46389584e-14 C6.91001656,0.0191596721 7.52001656,0.129159672 8.11101656,0.330159672 L8.11101656,0.330159672 L8.17001656,0.330159672 C8.21001656,0.349159672 8.24001656,0.370159672 8.26001656,0.389159672 C8.48101656,0.460159672 8.69001656,0.540159672 8.89001656,0.650159672 L8.89001656,0.650159672 L9.27001656,0.820159672 C9.42001656,0.900159672 9.60001656,1.04915967 9.70001656,1.11015967 C9.80001656,1.16915967 9.91001656,1.23015967 10.0000166,1.29915967 C11.1110166,0.450159672 12.4600166,-0.00984032788 13.8500166,3.46389584e-14 C14.4810166,3.46389584e-14 15.1110166,0.0891596721 15.7100166,0.290159672 C19.4010166,1.49015967 20.7310166,5.54015967 19.6200166,9.08015967 C18.9900166,10.8891597 17.9600166,12.5401597 16.6110166,13.8891597 C14.6800166,15.7591597 12.5610166,17.4191597 10.2800166,18.8491597 L10.2800166,18.8491597 L10.0300166,19.0001597 L9.77001656,18.8391597 C7.48101656,17.4191597 5.35001656,15.7591597 3.40101656,13.8791597 C2.06101656,12.5301597 1.03001656,10.8891597 0.390016562,9.08015967 C-0.739983438,5.54015967 0.590016562,1.49015967 4.32101656,0.269159672 C4.61101656,0.169159672 4.91001656,0.0991596721 5.21001656,0.0601596721 L5.21001656,0.0601596721 L5.33001656,0.0601596721 C5.61101656,0.0191596721 5.89001656,3.46389584e-14 6.17001656,3.46389584e-14 L6.17001656,3.46389584e-14 Z M15.1900166,3.16015967 C14.7800166,3.01915967 14.3300166,3.24015967 14.1800166,3.66015967 C14.0400166,4.08015967 14.2600166,4.54015967 14.6800166,4.68915967 C15.3210166,4.92915967 15.7500166,5.56015967 15.7500166,6.25915967 L15.7500166,6.25915967 L15.7500166,6.29015967 C15.7310166,6.51915967 15.8000166,6.74015967 15.9400166,6.91015967 C16.0800166,7.08015967 16.2900166,7.17915967 16.5100166,7.20015967 C16.9200166,7.18915967 17.2700166,6.86015967 17.3000166,6.43915967 L17.3000166,6.43915967 L17.3000166,6.32015967 C17.3300166,4.91915967 16.4810166,3.65015967 15.1900166,3.16015967 Z" transform="translate(2 2.5)"/></svg>
                                    </span>
                                </div>
                                <div class="ml-3 text-sm font-normal">
                                    <h4 class="text-sm font-semibold text-gray-900 dark:text-white">
                                        <a href="/{{ $notif->triggerUser->username }}" class="hover:text-blue-500">
                                            {{ $notif->triggerUser->name }}
                                        </a>
                                    </h4>
                                    <div class="text-sm font-normal text-gray-700 dark:text-gray-300">
                                        Menyukai postingan {{ mb_strimwidth(str_replace('.', '', strtolower($notif->post->title)), 0, 70, '...') }} yang anda
                                    </div> 
                                    <span class="text-xs font-medium text-blue-600 dark:text-blue-500">
                                        {{ $notif->created_at->diffForHumans() }}
                                    </span>
                                </div>
                            </li>
                        @endif
                        
                        <!-- Notify Post Comment -->
                        @if ($notif->entity_type === 'post' && $notif->entity_event_type === "comment") 
                            <li wire:click="readNotif({{ $notif->id }}, '/posts/{{ $notif->post->slug }}#comment-{{ base64_encode($notif->comment->user->username.$notif->comment->id) }}')" class="flex items-center px-2 py-3 sm:py-4 @if (!$notif->read) bg-blue-50 dark:bg-midnight-200 hover:bg-blue-50/80 dark:hover:bg-midnight-200/80 @else hover:bg-blue-50/40 dark:hover:bg-midnight-400 @endif active:bg-blue-100/70 dark:active:bg-midnight-300 cursor-pointer rounded">
                                <div class="inline-block relative shrink-0">
                                    <a href="/{{ $notif->triggerUser->username }}">
                                        <img class="w-12 h-12 rounded-full" src="{{ asset($notif->triggerUser->profile_photo_url) }}" alt="{{ $notif->triggerUser->name }}" loading="lazy"/>
                                    </a>
                                    <span class="inline-flex absolute right-0 bottom-0 justify-center items-center w-6 h-6 bg-blue-600 rounded-full">
                                        <svg class="w-4 h-4 text-white" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M18 13V5a2 2 0 00-2-2H4a2 2 0 00-2 2v8a2 2 0 002 2h3l3 3 3-3h3a2 2 0 002-2zM5 7a1 1 0 011-1h8a1 1 0 110 2H6a1 1 0 01-1-1zm1 3a1 1 0 100 2h3a1 1 0 100-2H6z" clip-rule="evenodd"></path></svg>
                                    </span>
                                </div>
                                <div class="ml-3 text-sm font-normal">
                                    <h4 class="text-sm font-semibold text-gray-900 dark:text-white">
                                        <a href="/{{ $notif->triggerUser->username }}" class="hover:text-blue-500">
                                            {{ $notif->triggerUser->name }}
                                        </a>
                                    </h4>
                                    <div class="text-sm font-normal text-gray-700 dark:text-gray-300">
                                        @if (!empty($notif->comment->reply_to_id) && $notif->comment->replyTo()->user->id == Auth::id())
                                            Membalas komentar anda {{ mb_strimwidth(str_replace('.', '', strtolower($notif->comment->content)), 0, 70, '...') }} pada postingan {{ mb_strimwidth(str_replace('.', '', strtolower($notif->post->title)), 0, 70, '...') }} yang anda miliki
                                        @else
                                            Berkomentar {{ mb_strimwidth(str_replace('.', '', strtolower($notif->comment->content)), 0, 70, '...') }} pada postingan {{ mb_strimwidth(str_replace('.', '', strtolower($notif->post->title)), 0, 70, '...') }} yang anda miliki
                                        @endif
                                    </div> 
                                    <span class="text-xs font-medium text-blue-600 dark:text-blue-500">
                                        {{ $notif->created_at->diffForHumans() }}
                                    </span>   
                                </div>
                            </li>
                        @endif
                        
                        <!-- Notify User Follow -->
                        @if ($notif->entity_type === 'user' && $notif->entity_event_type === "follow") 
                            <li wire:click="readNotif({{ $notif->id }}, '/{{ $notif->triggerUser->username }}')" class="flex items-center px-2 py-3 sm:py-4 @if (!$notif->read) bg-blue-50 dark:bg-midnight-200 hover:bg-blue-50/80 dark:hover:bg-midnight-200/80 @else hover:bg-blue-50/40 dark:hover:bg-midnight-400 @endif active:bg-blue-100/70 dark:active:bg-midnight-300 cursor-pointer rounded">
                                <div class="inline-block relative shrink-0">
                                    <a href="/{{ $notif->triggerUser->username }}">
                                        <img class="w-12 h-12 rounded-full" src="{{ asset($notif->triggerUser->profile_photo_url) }}" alt="{{ $notif->triggerUser->name }}" loading="lazy"/>
                                    </a>
                                    <span class="inline-flex absolute right-0 bottom-0 justify-center items-center w-6 h-6 bg-blue-600 rounded-full">
                                        <svg class="w-4 h-4 text-white" fill="currentColor" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path d="M5.84846399,13.5498221 C7.28813318,13.433801 8.73442297,13.433801 10.1740922,13.5498221 C10.9580697,13.5955225 11.7383286,13.6935941 12.5099314,13.8434164 C14.1796238,14.1814947 15.2696821,14.7330961 15.73685,15.6227758 C16.0877167,16.317132 16.0877167,17.1437221 15.73685,17.8380783 C15.2696821,18.727758 14.2228801,19.3149466 12.4926289,19.6174377 C11.7216312,19.7729078 10.9411975,19.873974 10.1567896,19.9199288 C9.43008411,20 8.70337858,20 7.96802179,20 L6.64437958,20 C6.36753937,19.9644128 6.09935043,19.9466192 5.83981274,19.9466192 C5.05537891,19.9062698 4.27476595,19.8081536 3.50397353,19.6530249 C1.83428106,19.3327402 0.744222763,18.7633452 0.277054922,17.8736655 C0.0967111971,17.5290284 0.00163408158,17.144037 0.000104217816,16.752669 C-0.00354430942,16.3589158 0.0886574605,15.9704652 0.268403665,15.6227758 C0.72692025,14.7330961 1.81697855,14.1548043 3.50397353,13.8434164 C4.27816255,13.6914539 5.06143714,13.5933665 5.84846399,13.5498221 Z M8.00262682,-1.16351373e-13 C10.9028467,-1.16351373e-13 13.2539394,2.41782168 13.2539394,5.40035587 C13.2539394,8.38289006 10.9028467,10.8007117 8.00262682,10.8007117 C5.10240696,10.8007117 2.75131423,8.38289006 2.75131423,5.40035587 C2.75131423,2.41782168 5.10240696,-1.16351373e-13 8.00262682,-1.16351373e-13 Z" transform="translate(4 2)"/></svg>
                                    </span>
                                </div>
                                <div class="ml-3 text-sm font-normal">
                                    <h4 class="text-sm font-semibold text-gray-900 dark:text-white">
                                        <a href="/{{ $notif->triggerUser->username }}" class="hover:text-blue-500">
                                            {{ $notif->triggerUser->name }}
                                        </a>
                                    </h4>
                                    <div class="text-sm font-normal text-gray-700 dark:text-gray-300">
                                        Mulai mengikuti anda
                                    </div> 
                                    <span class="text-xs font-medium text-blue-600 dark:text-blue-500">
                                        {{ $notif->created_at->diffForHumans() }}
                                    </span>   
                                </div>
                            </li>
                        @endif
                        
                    @endforeach
                    
                </ul>
                @else
                <div class="inline h-96 justify-center text-center">
                    <x-illustrations.illustration-easter-egg-hunt class="inline"/>
                    <p class="-mt-8 md:-mt-20 mb-20 text-sm md:text-lg font-medium text-slate-700 dark:text-slate-300">Anda belum memiliki notifikasi</p>
                </div>
                @endif
           </div>
           
           
           @if ($notifications->hasMorePages())
            <div class="flex w-full mt-4 justify-center">
                <x-buttons.button-primary class="py-2" wire:click="loadMore">
                    Muat Lebih Banyak
                </x-buttons.button-primary>
            </div>
            @endif
        </div>
    </div>
    
    
    
</div>
