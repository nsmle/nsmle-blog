@section('title', ($user->username) ? "{$user->name} (@{$user->username}) • Blog | Nsmle Blog" : "Pengguna (@{request()->username}) Tidak Ditemukan | Nsmle Blog")
@section('meta')
<meta name="og:title" content="The Rock"/>
<meta name="og:type" content="movie"/>
<meta name="og:url" content="http://www.imdb.com/title/tt0117500/"/>
<meta name="og:image" content="http://ia.media-imdb.com/rock.jpg"/>
<meta name="og:site_name" content="IMDb"/>
<meta name="og:description" content="A group of U.S. Marines, under command of..."/>
@endsection
    
   <div class="max-w-3xl mx-auto sm:px-6 lg:px-8 scroll-smooth">
        <div class="flex mb-4 w-full px-6 md:px-4">
            @if (request()->mode)
                @if (Auth::check() && Auth::id() == $user->id)
                    <x-buttons.button-bunglon class="float-left uppercase" type="button" onclick="window.location='/{{ auth()->user()->username }}'">
                        <i class="fa-solid fa-arrow-left mr-1"></i>Kembali
                    </x-buttons.button-bunglon>
                @endif
            @endif
        </div>
       <div class="block bg-neutral-200 dark:bg-midnight-500/60 dark:text-neutral-100/80 border border-slate-300 dark:border-midnight-500 rounded-t-3xl md:rounded-3xl py-8 px-6 md:my-8">
            <!-- Header Profile Mobile -->
            <div class="flex w-full justify-center">
                <div class="w-full md:w-10/12 md:my-9">
                    <div class="flex items-center justify-center">
                        <div class="w-1/3 flex space-x-2 md:w-3/6 md:h-3/6 flex justify-center">
                            <div class="relative w-48 md:w-full h-24 md:h-48">
                                <img class="rounded-full mx-auto w-24 h-24 object-cover md:w-48 md:h-48 shadow-lg cursor-zoom-in" src="{{ $user->profile_photo_url }}" alt="{{ $user->username }}" wire:click='$emit("openModal", "components.modals-profile-photos", {{ json_encode([$user->profile_photo_url]) }})' loading="lazy"/>
                                @if (request()->mode || Auth::check() && Auth::user()->username !== $user->username)
                                    @if ($user->last_seen > \Carbon\Carbon::yesterday())
                                        <div>
                                            @if ($user->last_seen > now()->addMinutes(-1))
                                                <div class="absolute top-0 right-4 md:top-0 md:right-10 h-4 w-4 md:h-7 md:w-7 my-1 border-2 md:border-4 border-neutral-200 dark:border-midnight-500 rounded-full bg-green-400 z-2"></div>
                                            @endif
                                        </div>
                                    @endif
                                @endif
                            </div>
                        </div>
                        <div class="w-1/4 text-center text-sm flex-wrap grid grid-rows-2 active:text-blue-500 hover:opacity-80" onclick="window.location='#posts'">
                            <p class="font-bold md:text-xl cursor-pointer">{{ $posts->total() }}</p>
                            <p class="text-xs md:text-lg cursor-pointer">Postingan</p>
                        </div>
                        
                        <div wire:click='$emit("openModal", "components.modals.modals-followers", {{ json_encode(["user" => $user, "pageMode" => request()->mode]) }})' class="w-1/4 md:w-1/4 text-center text-sm flex-wrap grid grid-rows-2 active:text-blue-500 hover:opacity-80">
                        {{-- <div wire:click="getFollowers" class="w-1/4 md:w-1/4 text-center text-sm flex-wrap grid grid-rows-2 active:text-blue-500 hover:opacity-80"> --}}
                            <p class="font-bold md:text-xl cursor-pointer">{{ $user->followers->count() ?? 0 }}</p> 
                            <p class="text-xs md:text-lg cursor-pointer">Pengikut</p>
                        </div>
                        <div wire:click='$emit("openModal", "components.modals.modals-followings", {{ json_encode(["user" => $user, "pageMode" => request()->mode]) }})' class="w-1/4 md:w-1/4 text-center text-sm flex-wrap grid grid-rows-2 active:text-blue-500 hover:opacity-80">
                            <p class="font-bold md:text-xl cursor-pointer">{{ $user->followings->count() ?? 0 }}</p>
                            <p class="text-xs md:text-lg  cursor-pointer">Mengikuti</p>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="flex justify-center mt-3">
                <div class="w-full md:w-10/12 my-4">
                    <div class="Name my-0 py-0">
                        <p class="font-bold text-md md:text-2xl my-0 py-0">{{ $user->name }}</p>
                    </div>
                    <div class="Username my-1 py-0">
                        <p class="text-xs md:text-lg -mt-1 my-0 py-0">{{ '@' . $user->username }}</p>
                    </div>
                    <div class="Bio my-5 py-0">
                        {!! print_bio($user->biography) !!}
                    </div>
                </div>
            </div>
            
            @if (Auth::check() && Auth::id() === $user->id)
                @if (!request()->mode)
                <div class="flex grid grid-cols-2 text-center justify-center pb-6">
                    <div class="" >
                        <x-buttons.button-primary type="button"  onclick="window.location='/{{ Auth::user()->username }}/edit'">
                            <i class="fa-solid fa-pen-to-square mr-2 text-slate-200"></i>{{ __('Edit') }}
                        </x-buttons.button-primary>
                    </div>
                    <div>
                        <x-buttons.button-secondary class="items-center" type="button"  onclick="window.location='/{{ Auth::user()->username }}?mode=preview'">
                            <i class="fa-solid fa-eye mr-2 text-slate-200"></i>{{ __('Preview') }}
                        </x-buttons.button-secondary>
                    </div>
                </div>
                @else
                    <div class="flex grid grid-cols-2 text-center justify-center pb-6">
                        <div class="" >
                            <x-buttons.button-primary type="button" disabled>
                                Ikuti
                            </x-buttons.button-primary>
                        </div>
                        <div class="" >
                            <x-buttons.button-secondary type="button" disabled>
                                Kirim Pesan
                            </x-buttons.button-secondary>
                        </div>
                    </div>
                @endif
            @else
                <div class="flex grid grid-cols-2 text-center justify-center pb-6">
                    <div class="" >
                        <x-buttons.button-primary  type="button" wire:click="follow" wire:loading.attr="disabled" wire:target="follow">
                            {{ $user->followStatus() }}
                        </x-buttons.button-primary>
                    </div>
                    
                    <div class="" >
                        <x-buttons.button-secondary wire:click="sendMessage" type="button">
                            Kirim Pesan
                        </x-buttons.button-secondary>
                    </div>
                </div>
            @endif
            
            <div class="border-t border-slate-300 dark:border-slate-700"></div>
            
            
            @if (Auth::check() && Auth::id() === $user->id && !request()->mode)
                <div class="flex">
                    <div class="block w-full justify-center mt-8"
                        x-data="{ published: true }"
                    >
                        <div class="flex w-full justify-center">
                            <!-- Button Filter Post -->
                            <div class="flex w-full md:w-10/12 text-center text-sm font-semibold leading-2">
                                
                                <div @click="$wire.changeShowPostByStatus(true); published = true" class="py-2 cursor-pointer" :class="{ 'w-3/5' : published , 'w-2/5' : ! published }">
                                    <p class="py-1 rounded-l-md" :class="{ 'bg-indigo-500 dark:bg-indigo-600/80 text-slate-200' : published, 'bg-indigo-400/90 dark:bg-indigo-900/80 text-slate-200' : ! published }">
                                        <span wire:target="changeShowPostByStatus(true)" wire:loading.remove>Published</span>
                                        <span wire:target="changeShowPostByStatus(true)" wire:loading style="border-top-color:transparent" class="w-3 h-3 border-2 border-blue-400 border-solid rounded-full animate-spin"></span>
                                    </p>
                                </div>
                                
                                <div @click="$wire.changeShowPostByStatus(false); published = false" class="py-2 cursor-pointer" :class="{ 'w-3/5' : ! published, 'w-2/5' : published }">
                                    <p class="py-1 text-center align-center items-center rounded-r-md" :class="{ 'bg-indigo-500 dark:bg-indigo-600/80 text-slate-200' : !  published, 'bg-indigo-400/90 dark:bg-indigo-900/80 text-slate-200' : published }">
                                        <span wire:target="changeShowPostByStatus(false)" wire:loading.remove>Draft</span>
                                        <span wire:target="changeShowPostByStatus(false)" wire:loading style="border-top-color:transparent" class="w-3 h-3 border-2 border-blue-400 border-solid rounded-full animate-spin"></span>
                                    </p>
                                </div>
                                
                            </div>
                        </div>
                        
                        <div class="flex w-full justify-center text-center">
                            @if ($posts->count())
                                <p class="hidden text-slate-600 dark:text-slate-300/70 mt-2" :class="{ 'block' : published, 'hidden' : ! published }">Postingan yang anda Publish yang semua orang bisa lihat dan baca.</p>
                                <p class="hidden text-slate-600 dark:text-slate-300/70 mt-2" :class="{ 'block' : ! published, 'hidden' : published }">Postingan Draft yang belum anda Publish yang hanya anda yang bisa lihat dan baca.</p>
                            @else
                                <p class="hidden text-slate-600 dark:text-slate-300/70 mt-4" wire:loading.remove :class="{ 'block' : published, 'hidden' : ! published }">Anda belum memiliki postingan yang dapat dibaca oleh publik.</p>
                                <p class="hidden text-slate-600 dark:text-slate-300/70 mt-4" wire:loading.remove :class="{ 'block' : ! published, 'hidden' : published }">Anda tidak memiliki Draf postingan yang masih tersimpan.</p>
                            @endif
                        </div>
                        
                    </div>
                </div>
            @endif
            
            <div class="flex justify-center @if (Auth::check() && Auth::id() === $user->id && !request()->mode) -mt-4 md:mt-4 @else md:mt-8 @endif" id="posts">
                @if ($posts->count())
                    <div class="w-full md:w-10/12 block md:flex justify-center md:justify-center md:grid md:grid-cols-2 md:gap-8"> 
                        @foreach ($posts as $post)
                            <x-card.post-card :post="$post" :page="'profile.show'"/>
                        @endforeach
                    </div>
                    @else
                    <div class="block w-full md:w-10/12 block md:flex justify-center"> 
                        <div class="w-full text-center justify-center">
                            {{-- <x-illustrations.illustration-easter-egg-hunt class="-mt-12 md:-mt-20 w-full md:w-10/12 mx-auto"/> --}}
                            <x-illustrations.illustration-easter-egg-hunt class="w-10/12 mx-auto"/>
                            @if (Auth::check() && Auth::id() === $user->id && !request()->mode) 
                                <p class="text-slate-600 dark:text-slate-300/70 -mt-8 md:text-xl md:-mt-20 mb-8 md:mb-48">Mulailah menulis postingan pribadi anda sendiri.</p>
                            @else
                                <p class="text-slate-600 dark:text-slate-300/70 -mt-8 md:text-xl md:-mt-20 mb-8 md:mb-48">{{ $user->name }} belum memiliki Postingan.</p>
                            @endif
                        </div>
                    </div>
                    @endif
            </div>
            
            <!-- Pagination Content -->
            <div class="bg-transparant px-4 py-12 flex items-center justify-center sm:px-6">
                <div class="justify-center" wire:loading.remove wire:target="loadMorePost">
                    @if ($posts->hasMorePages())
                    <x-buttons.button-bunglon-lond wire:click="loadMorePost">
                        Muat Lebih Banyak
                    </x-buttons.button-bunglon-lond>
                    @endif
                </div>
                <div class="justify-center" wire:loading wire:target="loadMorePost">
                    <div class="flex justify-center">
                        <div style="border-top-color:transparent"
                            class="w-8 h-8 border-4 border-blue-400 border-solid rounded-full animate-spin"></div>
                    </div>
                </div>
            </div>
            
       </div>
   </div>
   
   
