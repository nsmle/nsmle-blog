@section('title', 'Home - Nsmle Blog')

<div>
    <x-slot name="header">
        <div class="px-6 py-1 md:py-2 flex items-center md:justify-between md:grid md:grid-cols-2">
            <div class="float-left">
                <div class="block md:hidden">
                    <!-- <img width="auto" src="/img/illustration/pair-programming.png" alt="Nsmle Blog Pair Programming" loading="lazy"> -->
                    <x-illustrations.illustration-remote-team/>
                </div>
                @if (Auth::check())
                    @if (date('H:i') > '05:00' && date('H:i') < '10:00')
                        <h2 class="font-semibold text-xl md:text-4xl text-midnight-800 dark:text-neutral-100 leading-tight">
                            {{ __('Selamat pagi ') . Auth::user()->name }}
                        </h2>
                    @elseif (date('H:i') > '10:00' && date('H:i') < '15:00')
                        <h2 class="font-semibold text-xl md:text-4xl text-midnight-800 dark:text-neutral-100 leading-tight">
                            {{ __('Selamat siang ') . Auth::user()->name }}
                        </h2>
                    @elseif (date('H:i') > '15:00' && date('H:i') < '18:00')
                        <h2 class="font-semibold text-xl md:text-4xl text-midnight-800 dark:text-neutral-100 leading-tight">
                            {{ __('Selamat sore ') . Auth::user()->name }}
                        </h2>
                    @elseif (date('H:i') > '18:00' && date('H:i') < '21:00')
                        <h2 class="font-semibold text-xl md:text-4xl text-midnight-800 dark:text-neutral-100 leading-tight">
                            {{ __('Selamat malam ') . Auth::user()->name }}
                        </h2>
                    @else
                        <h2 class="font-semibold text-xl md:text-4xl text-midnight-800 dark:text-neutral-100 leading-tight">
                            {{ __("Selamat malam ".Auth::user()->name.", Selamat istirahat.") }}
                        </h2>
                    @endif
                @else
                    <h2 class="font-semibold text-xl md:text-4xl text-midnight-800 dark:text-neutral-100 leading-tight">
                        Selamat datang di {{ config('app.name') }}.
                    </h2>
                @endif
                <div class="text-md md:text-xl pt-6 opacity-90">
                    <p class="mt-2 mb-4">
                        Hai {{ Auth::check() ? Auth::user()->name : 'para penikmat kopi' }}, apa kabar?
                    </p>
                    @if (Auth::check())
                        <p class="mt-4 font-semibold">
                            “Those who are crazy enough to think they can change the world usually do”
                        </p>
                        <span>-Steve Jobs</span>
                    @else
                        <p class="mt-4">
                            Nsmle Blog adalah tempat yang cocok untuk kamu membagikan cerita melalui tulisan-tulisan tentang apapun.
                        </p>
                    @endif
                    <div class="flex items-center justify-between md:justify-start md:gap-4 my-6">
                        @if (!Auth::check())
                            <x-buttons.button-primary type="button" onclick="window.location.href = '{{ route('register') }}'">
                                Mulai Menulis
                            </x-buttons.button-primary>
                        @endif
                        <x-buttons.button-bunglon-lond type="button" onclick="window.location.href = '{{ route('about.show') }}'">
                            Tentang Kita
                        </x-buttons.button-bunglon-lond>
                        
                    </div>
                </div>
            </div>
            <div class="float-right hidden md:block">
                <!-- <img width="auto" src="/img/illustration/pair-programming.png" alt="Nsmle Blog Pair Programming" loading="lazy"> -->
                <x-illustrations.illustration-remote-team/>
            </div>
        </div>
    </x-slot>
    
    
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="text-center overflow-hidden mx-3 sm:rounded-lg">
                <h2 class="text-xl text-midnight-800 dark:text-neutral-100 md:text-4xl font-semibold">Post Terbaru</h2>
                <p class="text-md text-midnight-800/80 dark:text-neutral-100/80 md:text-xl mt-2">Apa aja sih yang baru di Nsmle Blog?</p>
            </div>
            @if (count($posts))
                <!-- New Post Content -->
                <div class="flex justify-center mt-8 md:mt-12">
                    <div class="w-10/12 md:w-4/5 block md:flex justify-center md:justify-between md:grid md:grid-cols-2 md:gap-8">
                        @foreach ($posts as $post)
                            <x-card.post-card :post="$post" :page="'home.section.post'"/>
                        @endforeach
                    </div>
                </div>
                <!-- See All Content -->
                <div class="bg-transparant px-4 py-12 flex items-center justify-center sm:px-6">
                    <div class="inline-flex justify-center">
                        <x-buttons.button-bunglon-lond wire:click="seeAllPosts">
                            Lihat Semua
                        </x-buttons.button-bunglon-lond>
                    </div>
                </div>
            @else 
                <div class="text-center overflow-hidden mx-8 bg-neutral-200/50 dark:bg-midnight-500/50 rounded mx-3 mt-8 md:mt-12 sm:rounded-lg">
                    <div class="my-4 mt-8"></div>
                    @if (Auth::check())
                        <h2 class="text-xl text-midnight-800 dark:text-neutral-100 md:text-4xl font-semibold">Tidak ada post terbaru</h2>
                        <p class="text-md text-midnight-800/80 dark:text-neutral-100/80 md:text-xl mt-3 mx-3 md:mx-20">Tuliskan ide-ide maupun cerita dan pengalamanmu melalui tulisan-tulisan indah disini.</p>
                        
                        <x-buttons.button-secondary class="my-5">
                            Tulis
                        </x-buttons.button-secondary>
                    @else
                        <h2 class="text-xl text-midnight-800 dark:text-neutral-100 md:text-4xl font-semibold">Tidak ada post terbaru</h2>
                        <p class="text-md text-midnight-800/80 dark:text-neutral-100/80 md:text-xl mt-3 mx-3 md:mx-20">Bergabunglah bersama kami dan tuliskan ide-ide maupun cerita dan pengalamanmu melalui tulisan-tulisan indah disini.</p>
                        
                        <x-buttons.button-secondary class="my-5">
                            Buat akun
                        </x-buttons.button-secondary>
                    @endif
                    
                </div>
            @endif
        </div>
    </div>
    
    
    <div class="py-16 bg-grenteel-200/40 dark:bg-midnight-400/80">
        <div class="px-6 max-w-7xl mx-auto sm:px-6 lg:px-8 py-10">
            <div class="overflow-hidden mx-3 sm:rounded-lg flex items-center md:justify-between md:grid md:grid-cols-2">
                <div class="hidden md:flex justify-center">
                    <x-illustrations.illustration-support-team />
                </div>
                <div>
                    <div class="block md:hidden flex justify-center">
                        <x-illustrations.illustration-support-team />
                    </div>
                    <div class="pt-3">
                        <h3 class="text-xl md:text-4xl font-semibold text-midnight-800 dark:text-slate-100">Siapa sih yang boleh nulis disini?</h3>
                        <div class="text-md md:text-xl text-slate-600 dark:text-slate-300/80 mt-8">
                            <p class="mt-3">Mungkin kamu bertanya-tanya apakah blog ini hanya untuk pribadi atau semua orang juga bisa ikut menulis dan membagikan ceritanya disini.</p>
                            <p class="mt-3">Jawabannya tentu saja semua orang bisa. Mengapa demikian?</p>
                            <p class="mt-8">Baca selengkapnya <a class="text-sky-700 hover:text-sky-400 dark:text-sky-400" href="">di sini</a>.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="text-center overflow-hidden mx-3 sm:rounded-lg">
                <h3 class="text-xl md:text-4xl font-semibold text-midnight-800 dark:text-neutral-100">Post Berdasarkan Kategori</h3>
                <p class="text-md md:text-xl mt-2 text-midnight-800/80 dark:text-neutral-100/80">Terkadang yang ingin kamu baca cuma kategori tertentu</p>
            </div>
            <!-- Post by Category -->
            <div class="flex justify-center mt-8 md:mt-12">
                <div class="w-10/12 md:w-4/5 block md:flex justify-center md:justify-between md:grid md:grid-cols-2 md:gap-8">
                    @foreach ($categories as $category)
                        {{-- @if($category->posts->count()); --}}
                        <div class="block w-full">
                            <div class="relative h-full pb-8 mt-8 md:mt-1 border border-slate-200 dark:border-none shadow-md shadow-neutral-400 dark:shadow-midnight-600 rounded-xl bg-white dark:bg-midnight-400">
                                <h3 class="text-center bg-grenteel-100/40 dark:bg-midnight-300 rounded-t-md px-6 py-3 text-xl text-slate-700 dark:text-slate-200">{{ $category->name }}</h3>
                                <div class="p-4">
                                    @foreach ($category->posts->take(4) as $post)
                                    <a href="/post/{{ $post->slug }}" class="flex items-center py-2 mb-2 shadow shadow-neutral-100/50 dark:shadow-midnight-700/40 px-2 rounded-md active:opacity-70">
                                        <div class="w-1/5">
                                            <img class="h-12 w-12 rounded-md border-2 border-neutral-400 dark:border-midnight-700/20 cursor-pointer" src="{{ $post->cover ?? 'https://source.unsplash.com/400x400?'.$post->title }}" alt="{{ $post->title }}" loading="lazy">
                                        </div>
                                        <h4 class="w-4/5 font-semibold text-sm ml-2 md:text-lg cursor-pointer text-slate-800 dark:text-slate-200">{{ $post->title }}</h4>
                                    </a>
                                    @endforeach
                                </div>
                                <div class="absolute w-full bottom-0 bg-grenteel-100/40 dark:bg-midnight-300 rounded-b-md px-6 py-3">
                                    <h3 class="text-center text-md text-slate-700 hover:text-slate-500 active:text-slate-500/80 cursor-pointer dark:text-slate-200 dark:hover:text-slate-300 dark:active:text-slate-400"><a href="/post?category={{ $category->slug }}">Lihat semua posts</a></h3>
                                </div>
                            </div>
                        </div>
                        {{-- @endif --}}
                    @endforeach
                </div>
            </div>
            
            <!-- See All Categories -->
            <div class="bg-transparant px-4 py-12 flex items-center justify-center sm:px-6">
                <div class="inline-flex justify-center">
                    <x-buttons.button-bunglon-lond wire:click="seeAllCategory">
                        Lihat Semua
                    </x-buttons.button-bonglon-lond>
                </div>
            </div>
            
        </div>
    </div>
</div>