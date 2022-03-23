<div>
    <div class="p-4 bg-neutral-100 rounded-lg border shadow-md sm:p-8 dark:bg-midnight-300 dark:border-gray-700">
        @if (count($followers))
            <div class="flex justify-between items-center mb-4">
                <h5 class="text-xl font-bold leading-none text-gray-900 dark:text-white">
                    @if (Auth::check() && $user->id === Auth::id())
                        Pengikut {{ !empty($this->pageMode) ? $user->name : 'anda' }}
                    @else
                        Pengikut {{ $user->name }}
                    @endif
                </h5>
           </div>
        @endif
       <div class="flow-root">
            @if (count($followers))
                <ul role="list" class="divide-y divide-slate-300 dark:divide-slate-600/50">
                    @foreach ($followers as $follower)
                    <li class="py-3 sm:py-4">
                        <div class="flex items-center space-x-4">
                            <div class="flex-shrink-0 justify-center">
                                <a href="/{{ $follower->username }}">
                                    <img class="w-14 h-14 hover:scale-105 object-cover rounded-full" src="{{ asset($follower->profile_photo_url) }}" alt="{{ $follower->name }}" loading="lazy">
                                </a>
                            </div>
                            <div class="flex-1 min-w-0">
                                <p class="text-sm font-medium text-gray-900 truncate dark:text-white">
                                    <a class="hover:text-blue-500" href="/{{ $follower->username }}">
                                        {{ $follower->name }}
                                    </a>
                                </p>
                                <p class="text-sm text-gray-500 truncate dark">
                                    <a class="hover:text-blue-500" href="/{{ $follower->username }}">
                                        {{ '@'.$follower->username }}
                                    </a>
                                </p>
                            </div>
                            @if (Auth::check() && empty($this->pageMode) && $follower->id !== Auth::id())
                            <div class="inline-flex items-center text-base font-semibold text-gray-900 dark:text-white">
                                <button type="button" wire:click="follow({{ $follower->id }})" wire:target="follow" wire:loading.attr="disabled" class="{{ ($follower->followStatus() == 'Mengikuti') ? 'items-center px-3 py-2 border border-grenteel-200/10 text-sm leading-4 font-medium rounded text-slate-800 dark:text-slate-100 dark:font-semibold bg-neutral-300 dark:bg-midnight-100 dark:border-midnight-100 dark:active:bg-midnight-90 dark:active:border-midnight-90 hover:shadow-neutral-300 hover:text-gray-700 focus:outline-none focus:bg-neutral-200 focus:text-gray-500 focus:shadow-grenteel-200 active:scale-95 disabled:opacity-70 transition' : 'items-center text-center px-4 py-1 bg-blue-600 border border-transparent rounded font-medium text-sm text-white font-bold tracking-wide hover:bg-blue-700 active:bg-blue-600 dark:active:bg-sky-600 focus:outline-none focus:ring focus:ring-sky-600/30 cursor-pointer disabled:opacity-70 disabled:hover:bg-blue-600 active:scale-95 disabled:cursor-not-allowed transition' }} ">
                                    {{ $follower->followStatus() }}
                                </button>
                            </div>
                            @endif
                        </div>
                    </li>
                    @endforeach
                </ul>
            @elseif (Auth::check() && $user->id === Auth::id() && empty($this->pageMode))
                <div class="py-4 text-center">
                    <p class="text-sm text-slate-800 dark:text-slate-200">Anda belum memiliki pengikut.</p>
                    <p class="text-xs mx-8 mt-2 text-slate-600 dark:text-slate-400">Ikutilah beberapa orang, biasanya mereka akan mengikutimu balik</p>
                </div>
            @else
                <div class="py-4 text-center">
                    <p class="text-sm text-slate-800 dark:text-slate-200">{{ $user->name }} belum memiliki pengikut.</p>
                    <p class="text-xs mx-8 mt-2 text-slate-600 dark:text-slate-400">Ikutilah untuk mendapatkan update terbaru dari {{ $user->name }}</p>
                </div>
            @endif
       </div>
       <div class="flex justify-center">
           @if ($followers->hasMorePages())
            <x-buttons.button-bunglon-lond wire:click="loadMore">
                Muat Lebih Banyak
            </x-buttons.button-bunglon-lond>
            @endif
        </div>
    </div>
</div>