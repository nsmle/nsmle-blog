
<div class="md:hover:scale-105">
    <div class="h-full mt-8 md:mt-1 shadow-lg shadow-neutral-400 hover:shadow-slate-500/30 dark:shadow-midnight-800/50 dark:hover:shadow-midnight-800/70 rounded-xl bg-white dark:bg-midnight-400">
        
        <div class="relative w-full ">
            <a href="/{{ (Auth::check()) ? 'posts' : 'post' }}/{{ $post->slug }}">
                <img class="aspect-[16/10] md:aspect-video w-full object-cover rounded-t-xl cursor-pointer bg-slate-800" src="{{ $post->cover ? asset(`'`.$post->cover.`'`) : 'https://source.unsplash.com/700x400?'.urlencode($post->title) }}" alt="{{ $post->title }}" loading="lazy">
            </a>
            @if ($page !== 'profile.show')
                <div class="absolute bottom-0 pb-2 pt-8 bg-gradient-to-t from-slate-800/60 to-red-slate-800/40 w-full z-2">
                    <div class="flex items-center">
                        <div class="w-1/5 flex justify-center">
                            <a href="/{{ $post->user->username }}">
                                <img class="h-10 md:h-12 w-10 md:w-12 object-cover rounded-full cursor-pointer" src="{{ $post->user->profile_photo_url }}" alt="{{ $post->user->name . ' (@'.$post->user->username.')' }}" loading="lazy">
                            </a>
                        </div>
                        <div class="w-3/5">
                            <div class="flex grid grid-cold-2 gap-0">
                                <a href="/{{ $post->user->username }}" class="text-sm text-slate-100 leading-2 font-semibold cursor-pointer">{{ $post->user->name }}</a>
                                <a href="/{{ $post->user->username }}" class="text-xs text-slate-200/80 leading-2 font-medium cursor-pointer">{{ '@'. $post->user->username }}</a>
                            </div>
                        </div>
                    </div>
                </div>
            @endif
        </div>
    
        <div class="p-4">
            <div class="flex justify-between">
                <!-- Post Published -->
                <span class="text-gray-400 text-xs">{{ (now()->parse($post->published_at)->timestamp > now()->subDays(15)->timestamp) ?  now()->parse($post->published_at)->diffForHumans() : $post->published_at->format("H:i, F d, Y") }}</span>
                <!-- Post Category -->
                <a href="/{{ (Auth::check()) ? 'explore' : 'post' }}?category={{ $post->category->slug }}">
                    <p class="text-sm text-gray-700 py-1 px-2 rounded shadow shadow-neutral-400/50 bg-neutral-400/20 dark:bg-midnight-100/30 dark:shadow-midnight-100/50 hover:text-gray-600 active:text-gray-500 cursor-pointer dark:text-neutral-100/90 dark:hover:text-neutral-100/80 dark:active:text-neutral-100/60">{{ $post->category->name }}</p>
                </a>
            </div>
            
            <!-- Post Title -->
            <a href="/{{ (Auth::check()) ? 'posts' : 'post' }}/{{ $post->slug }}">
                <h3 class="font-semibold my-3 text-lg cursor-pointer text-midnight-800 hover:text-midnight-800/80 active:text-midnight-800/60 dark:text-neutral-100 dark:hover:text-neutral-100/80 dark:active:text-neutral-100/60">{{ $post->title }}</h3>
            </a>
            <a href="/{{ (Auth::check()) ? 'posts' : 'post' }}/{{ $post->slug }}">
                <p class="text-sm text-gray-700 hover:text-gray-600 active:text-gray-500 cursor-pointer dark:text-neutral-100/90 dark:hover:text-neutral-100/80 dark:active:text-neutral-100/60">{{ strip_tags(Str::markdown($post->summary)); }}</p>
            </a>
            
            <!-- Post Tags -->
            <div class="my-4 flex gap-2 overflow-x-auto no-scrollbar">
                @foreach ($post->tags as $tags)
                    <a href="/{{ (Auth::check()) ? 'explore' : 'post' }}?tag={{ $tags->slug }}">
                        <p class="text-xs whitespace-nowrap text-gray-700 hover:text-gray-700/90 hover:bg-neutral-400/70 active:text-gray-700/80 active:bg-neutral-400/60 cursor-pointer  bg-neutral-400 dark:text-neutral-100/70 dark:bg-midnight-100 dark:hover:bg-midnight-100/80 dark:hover:text-neutral-100/60 dark:active:bg-midnight-100/70 dark:active:text-neutral-100/50 rounded-full py-1 px-2">{{ $tags->name }}</p>
                    </a>
                @endforeach
            </div>
            
        </div>
    </div>
    
</div>