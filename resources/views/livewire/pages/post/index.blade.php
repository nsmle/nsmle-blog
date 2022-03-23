@section('title', 'Post - Nsmle Blog')

@if (session('alert'))
    <div  x-data="{ alert: {{ session('alert') ? true : false }} }">
        <div class="fixed z-50 w-full justify-center top-3" x-show="alert">
            <div class="flex justify-center">
                <div class="bg-red-100/90 border border-red-400 text-red-700 px-4 py-3 rounded relative w-11/12 md:w-4/5" role="alert">
                    <strong class="font-bold">Maaf!</strong>
                    <span class="block sm:inline md:ml-2">{{ session('alert') }}</span>
                    <span class="absolute top-0 bottom-0 right-0 px-4 py-3">
                      <svg x-on:click="$wire.clearAlert(); alert = false" class="fill-current h-6 w-6 text-red-500" role="button" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><title>Close</title><path d="M14.348 14.849a1.2 1.2 0 0 1-1.697 0L10 11.819l-2.651 3.029a1.2 1.2 0 1 1-1.697-1.697l2.758-3.15-2.759-3.152a1.2 1.2 0 1 1 1.697-1.697L10 8.183l2.651-3.031a1.2 1.2 0 1 1 1.697 1.697l-2.758 3.152 2.758 3.15a1.2 1.2 0 0 1 0 1.698z"/></svg>
                    </span>
                </div>
            </div>
        </div>
    </div>
@endif


<div class="py-8">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div x-data="{ 
                filter: '{{ session('alert') ? 'all' : (request('category') ? 'category' : ( request('tag') ? 'tags' : 'all')) }}',
                category: '{{ session('alert') ? 'undefined' : (request('category') ?? 'undefined') }}',
                tags: '{{ session('alert') ? 'undefined' : (request('tag') ?? 'undefined') }}'
            }"
        >
            
            <div class="text-center overflow-hidden mx-3 sm:rounded-lg">
                <div class="hidden" :class="{'visible' : filter === 'all', 'hidden' : filter !== 'all'}">
                    <h2 class="text-xl text-midnight-800 dark:text-neutral-100 md:text-4xl font-semibold">Semua Post</h2>
                    <p class="text-md mx-2 text-midnight-800/70 dark:text-neutral-100/70 md:text-xl mt-2">Semua post dari berbagai Kategori, Tags dan Pengguna.</p>
                </div>
                <div class="hidden" :class="{'visible' : filter === 'category', 'hidden' : filter !== 'category'}">
                    <h2 class="text-xl text-midnight-800 dark:text-neutral-100 md:text-4xl font-semibold">Post Berdasarkan Kategori {{ $filters['filterName'] ?? '' }}</h2>
                    <p class="text-md mx-2 text-midnight-800/70 dark:text-neutral-100/70 md:text-xl mt-2">Berikut beberapa post dari berbagai Pengguna berdasarkan Kategori {{ $filters['filterName'] ?? '' }}</p>
                </div>
                <div class="hidden" :class="{'visible' : filter === 'tags', 'hidden' : filter !== 'tags'}">
                    <h2 class="text-xl text-midnight-800 dark:text-neutral-100 md:text-4xl font-semibold">Post Berdasarkan Tag {{ $filters['filterName'] ?? '' }}</h2>
                    <p class="text-md mx-2 text-midnight-800/70 dark:text-neutral-100/70 md:text-xl mt-2">Berikut beberapa post dari berbagai Pengguna berdasarkan Tag {{ $filters['filterName'] ?? '' }}</p>
                </div>
            </div>
            
            <div class="flex justify-center mt-8 md:mt-12">
                <!-- Button Filter Post -->
                <div class="flex w-10/12 md:w-4/5 text-center text-sm font-semibold leading-2">
                    
                    <div @click="$wire.filter('all', '', '', ''); filter = 'all'" class="py-2 cursor-pointer" :class="{ 'w-6/12' : filter === 'all', 'w-3/12' : filter !== 'all' }">
                        <p class="py-1 mr-1 md:mx-2 rounded-md" :class="{ 'bg-indigo-700 text-slate-200' : filter === 'all', 'bg-indigo-600/90 dark:bg-indigo-900/80 text-slate-200' : filter !== 'all' }">All</p>
                    </div>
                    
                    <div @click="$wire.resets(); filter = 'category'; category = undefined" class="py-2 cursor-pointer" :class="{ 'w-6/12' : filter === 'category', 'w-3/12' : filter !== 'category' }">
                        <p class="py-1 md:mx-2 rounded-md" :class="{ 'bg-indigo-700 text-slate-200' : filter === 'category', 'bg-indigo-600/90 dark:bg-indigo-900/80 text-slate-200' : filter !== 'category' }">Category</p>
                    </div>
                    
                    <div @click="$wire.resets(); filter = 'tags'; tags = undefined" class="py-2" :class="{ 'w-6/12' : filter === 'tags', 'w-3/12' : filter !== 'tags' }">
                        <p class="py-1 ml-1 md:mx-2 rounded-md cursor-pointer" :class="{ 'bg-indigo-700 text-slate-200' : filter === 'tags', 'bg-indigo-600/90 dark:bg-indigo-900/80 text-slate-200' : filter !== 'tags' }">Tags</p>
                    </div>
                    
                </div>
            </div>
            
            
            <div class="flex justify-center">
                <div class="flex w-10/12 md:w-4/5 hidden" :class="{'visible' : filter === 'category', 'hidden' : filter !== 'category'}">
                    <div class="flex overflow-x-auto no-scrollbar bg-neutral-400 dark:bg-midnight-500 rounded-md py-4">
                    @foreach ($categories as $category)
                            <button 
                                class="inline-flex whitespace-nowrap items-center px-4 mx-2 py-3 text-sm md:text-md px-3 py-2 leading-4 bg-blue-500 dark:bg-indigo-600 border border-transparent rounded-md font-semibold text-white hover:bg-blue-700 dark:hover:bg-indigo-700 active:bg-blue-400 dark:active:bg-indigo-500 focus:outline-none focus:ring focus:ring-blue-300/50 dark:focus:ring-indigo-900/50 disabled:opacity-85 transition duration-150"
                                x-on:click="$wire.filter('category', {{ $category->id }}, 'Kategori', '{{ $category->name }}'); category = '{{ $category->slug }}'"
                                
                                :class="{ 'bg-blue-800 dark:bg-blue-500 dark:hover:bg-blue-400/80 dark:active:bg-blue-500' : category === '{{ $category->slug }}', '' : category !== '{{ $category->slug }}' }"
                            >
                                {{ $category->name }}
                            </button>
                    @endforeach
                    </div>
                </div>
                
                <div class="flex w-10/12 md:w-4/5 hidden" :class="{'visible' : filter === 'tags', 'hidden' : filter !== 'tags'}">
                    <div class="flex overflow-x-auto no-scrollbar bg-neutral-400 dark:bg-midnight-500 rounded-md py-4">
                    @foreach ($tags as $tag)
                            <button 
                                class="inline-flex whitespace-nowrap items-center px-4 mx-2 py-3 text-sm md:text-md px-3 py-2 leading-4 bg-blue-500 dark:bg-indigo-600 border border-transparent rounded-md font-semibold text-white hover:bg-blue-700 dark:hover:bg-indigo-700 active:bg-blue-400 dark:active:bg-indigo-500 focus:outline-none focus:ring focus:ring-blue-300/50 dark:focus:ring-indigo-900/50 disabled:opacity-85 transition"
                                x-on:click="$wire.filter('tags', {{ $tag->id }}, 'Tag', '{{ $tag->name }}'); tags = '{{ $tag->slug }}'"
                                
                                :class="{ 'bg-blue-800 dark:bg-blue-500 dark:hover:bg-blue-500/80 dark:active:bg-blue-400' : tags === '{{ $tag->slug }}', '' : tags !== '{{ $tag->slug }}' }"
                            >
                                {{ $tag->name }}
                            </button>
                    @endforeach
                    </div>
                </div>
                
            </div>
            
        </div>
                    
        
        @if (count($posts))
            <!-- Post Content -->
            <div class="flex justify-center mt-8 md:mt-12">
                <div class="w-10/12 md:w-4/5  block md:flex justify-center md:justify-between md:grid md:grid-cols-2 md:gap-8">
                    @foreach ($posts as $post)
                        <x-card.post-card :post="$post" :page="'home.post'"/>
                    @endforeach
                </div>
            </div>
            <!-- Pagination Content -->
            <div class="bg-transparant px-4 py-12 flex items-center justify-center sm:px-6">
                <div class="justify-center" wire:loading.remove>
                    @if ($posts->hasMorePages())
                    <x-buttons.button-bunglon-lond wire:click="loadMore('{{ $perPage+10 }}')">
                        Muat Lebih Banyak
                    </x-buttons.button-bunglon-lond>
                    @endif
                </div>
                <div class="justify-center" wire:loading>
                    <div class="flex justify-center">
                        <div style="border-top-color:transparent"
                            class="w-8 h-8 border-4 border-blue-400 border-solid rounded-full animate-spin"></div>
                    </div>
                </div>
            </div>
        @else 
            <div class="text-center overflow-hidden mx-8 bg-neutral-200/50 dark:bg-midnight-500/50 rounded mx-3 mt-8 md:mt-12 sm:rounded-lg">
                <div class="my-4 mt-8"></div>
                @if (Auth::check())
                    @if (count($filters))
                        <h12 class="text-xl text-midnight-800 dark:text-neutral-100 md:text-4xl font-semibold">Tidak ada post berdasarkan {{ $filters['filterType'] . ' ' . $filters['filterName'] }}</h2>
                        <p class="text-sm text-midnight-800/80 dark:text-neutral-100/80 md:text-xl mt-3 mx-3 md:mx-20">Tuliskan ide-ide maupun cerita dan pengalamanmu tentang {{ $filters['filterName'] }} melalui tulisan-tulisan indah disini.</p>
                    @else
                        <h2 class="text-xl text-midnight-800 dark:text-neutral-100 md:text-4xl font-semibold">Tidak ada post terbaru</h2>
                        <p class="text-sm text-midnight-800/80 dark:text-neutral-100/80 md:text-xl mt-3 mx-3 md:mx-20">Tuliskan ide-ide maupun cerita dan pengalamanmu melalui tulisan-tulisan indah disini.</p>
                    @endif
                    <x-buttons.button-secondary class="my-5" wire:click="redirectCreatePost">
                        Mulai Menulis
                    </x-buttons.button-secondary>
                @else
                    @if (count($filters))
                        <h2 class="text-xl text-midnight-800 dark:text-neutral-100 md:text-4xl font-semibold">Tidak ada post berdasarkan {{ $filters['filterType'] . ' ' . $filters['filterName'] }}</h2>
                        <p class="text-sm text-midnight-800/80 dark:text-neutral-100/80 md:text-xl mt-3 mx-3 md:mx-20">Bergabunglah bersama kami dan tuliskan ide-ide maupun cerita dan pengalamanmu tentang {{ $filters['filterName'] }} melalui tulisan-tulisan indah disini.</p>
                    @else
                        <h2 class="text-xl text-midnight-800 dark:text-neutral-100 md:text-4xl font-semibold">Tidak ada post terbaru</h2>
                        <p class="text-sm text-midnight-800/80 dark:text-neutral-100/80 md:text-xl mt-3 mx-3 md:mx-20">Bergabunglah bersama kami dan tuliskan ide-ide maupun cerita dan pengalamanmu melalui tulisan-tulisan indah disini.</p>
                    @endif
                    <x-buttons.button-secondary class="my-5" wire:click="redirectLogin">
                        Gabung
                    </x-buttons.button-secondary>
                @endif
                
            </div>
        @endif
    </div>
</div>


