<div>
    <div class="h-screen mx-auto max-w-3xl md:px-6 lg:px-8">
        <div class="max-w-md mx-auto bg-slate-50 md:bg-slate-50 dark:bg-midnight-500/50 md:shadow-lg rounded-lg overflow-hidden md:max-w-3xl">
            <div class="md:flex">
                <div class="w-full p-4">
                    <div class="relative">
                        <h5 class="text-xl p-2 font-bold leading-none text-gray-900 dark:text-white">Chats</h5>
                    </div>
                    <ul>
                        @foreach ($chatRooms as $chatRoom)
                        <li>
                            <a href="/chat/{{ $chatRoom->user->username }}" class="flex justify-between items-center bg-white dark:bg-midnight-400 mt-2 p-2 hover:shadow-lg dark:hover:bg-midnight-300 rounded cursor-pointer transition">
                                <div class="flex ml-1 w-full"> 
                                    <div class="flex relative w-16 h-12 justify-center">
                                        <img class="rounded-full object-cover w-12 h-12 bg-slate-200" src="{{ asset($chatRoom->user->profile_photo_url) }}" alt="Chat {{ $chatRoom->user->name . '@('.$chatRoom->user->username.')' }}" loading="lazy">
                                        @if (now()->parse($chatRoom->user->last_seen)->timestamp > now()->addMinutes(-1)->timestamp)
                                        <span class="absolute rounded-full text-green-500 right-0 top-0">
                                           <svg width="16" height="16" class="border-2 border-white dark:border-midnight-400 rounded-full">
                                              <circle cx="7" cy="7" r="10" fill="currentColor"></circle>
                                           </svg>
                                        </span>
                                        @endif
                                    </div>
                                    <div class="flex flex-col ml-2 w-full">
                                        <span class="font-medium text-gray-800 dark:text-gray-100 truncate w-44 md:w-80">{{ $chatRoom->user->name }}</span>
                                        <span class="text-sm text-gray-400 dark:text-slate-400/80 truncate w-44 md:w-80">{{ $chatRoom->getLatestChat()->message }}</span>
                                    </div>
                                </div>
                                <div class="flex flex-col">
                                    <time class="text-xs truncate text-gray-400/80 dark:text-slate-500">{{ ($chatRoom->getLatestChat()->created_at->timestamp > now()->subDays(1)->timestamp) ? $chatRoom->getLatestChat()->created_at->format("H:i") :$chatRoom->getLatestChat()->created_at->format("d-M-y") }}</time>
                                    @if ($chatRoom->unreadMessage($chatRoom->user->id)->count())
                                        <span>
                                            <div class="inline-flex float-right items-center px-1.5 py-0.5 border-2 border-neutral-100 dark:border-midnight-300 rounded-full text-xs font-semibold leading-4 bg-red-500 text-white"
                                                wire:target="getUpdateChats"
                                                wire:loading.class="animate-pinger"
                                            >
                                                {{ $chatRoom->unreadMessage($chatRoom->user->id)->count() }}
                                            </div>
                                        </span>
                                    @endif
                                </div>
                            </a>
                        </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>