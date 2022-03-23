<x-guest-layout>
    @section('title', ($user->username) ? "{$user->firstname} {$user->lastname} (@{$user->username}) • Blog" : "Pengguna (@{request()->username}) Tidak Ditemukan")
    
   <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
       <div class="bg-neutral-200 dark:bg-midnight-500/60 dark:text-neutral-100/80 border border-slate-300 dark:border-midnight-500 rounded-t-3xl md:rounded-3xl py-8 px-6 md:my-8">
            <!-- Header Profile Mobile -->
            <div class="flex items-center justify-center">
                
                <div class="w-1/3">
                    <img  class="w-16 md:w-32 rounded-full shadow-xl" src="{{ $user->profile_photo_url }}" alt="">
                </div>
                <div class="w-1/3 text-center text-sm flex-wrap grid grid-rows-2">
                    <p class="font-bold">23</p>
                    <p class="text-xs">Postingan</p>
                </div>
                <div class="w-1/3 text-center text-sm flex-wrap grid grid-rows-2">
                    <p class="font-bold">0</p> 
                    <p class="text-xs">Pengikut</p>
                </div>
                <div class="w-1/3 text-center text-sm flex-wrap grid grid-rows-2">
                    <p class="font-bold">97</p>
                    <p class="text-xs">Mengikuti</p>
                </div>
            </div>
            <div class="flex mt-3">
                <div class="w-full my-4">
                    <div class="Name my-0 py-0">
                        <p class="font-bold my-0 py-0">{{ $user->firstname . ' ' . $user->lastname }}</p>
                    </div>
                    <div class="Username my-1 py-0">
                        <p class="text-xs my-0 py-0">{{ '@' . $user->username }}</p>
                    </div>
                    <div class="Bio my-5 py-0">
                        <p class="text-sm my-0 py-0">{{ $user->biography }}</p>
                    </div>
                </div>
            </div>
            
            @if (Auth::user()->username === $user->username && !request()->view)
                <div class="flex grid grid-cols-2 text-center justify-center pb-6">
                    <div class="">
                        <livewire:components.button-primary-link :text="'Edit'"/>
                    </div>
                    <div class="">
                        <livewire:components.button-secondary-link :text="'Lihat'" href="/{{ $user->username . '?view=visitor' }}"/>
                    </div>
                </div>
            @else
            <div class="flex grid grid-cols-2 text-center justify-center pb-6">
                <div class="">
                    @if (Auth::user()->username === $user->username)
                    <livewire:components.button-primary-link :text="'Ikuti'"/>
                    @else
                    <livewire:components.button-primary-link :text="'Ikuti'" {!! __(':redirected="/' . $user->username . '/follow"') !!} :redirected="true"/>
                    @endif
                </div>
                
                <div class="">
                    <livewire:components.button-secondary-link :text="'Kirim Pesan'"/>
                </div>
            </div>
            @endif
            
            <div class="border-t border-slate-300 dark:border-slate-700"></div>
            
            <div class="flex justify-center md:mt-8">
                <div class="w-full md:w-10/12 block md:flex justify-center md:justify-center md:grid md:grid-cols-2 md:gap-8"> 
                     @for ($i = 1; $i <= 6; $i++)
                    <div class="mt-8 md:mt-1 shadow-lg shadow-neutral-400 dark:shadow-midnight-800 rounded-xl bg-white dark:bg-midnight-400">
                        <img class="rounded-t-xl cursor-pointer" src="https://www.dwinawan.com/blog/thumb_article19.jpg" alt="">
                        <div class="p-4">
                            <span class="text-gray-400 text-xs">January, 08 2022</span>
                            <h3 class="font-semibold my-3 text-lg cursor-pointer text-midnight-800 dark:text-neutral-100">Pembuatan UI Design harus selalu pakai riset?</h3>
                            
                            <p class="text-sm text-gray-700 cursor-pointer text-midnight-800/90 dark:text-neutral-100/90">Apakah mengubah bentuk tombol dari kotak menjadi rounded juga harus menggunakan riset? Terlalu memakan waktu enggak sih?</p>
                        </div>
                    </div>
                    @endfor
                </div>
            </div>
            
            <div class="justify-center text-center py-12">
                <livewire:components.button-secondary-link :text="'Muat Lebih Banyak'" :class="'px-10'"/>
            </div>
            
       </div>
   </div>
    
    <!-- <div class="relative bg-transparent">
        <img class="rounded-t-xl cursor-pointer" src="https://www.dwinawan.com/blog/thumb_article19.jpg" alt="">
    </div>
    <div class="absolute top-41 -z-50 t-5 left-0 ...">
        <img  class="w-16 rounded-full shadow-xl" src="http://localhost:8000/img/logo.png" alt="">
    </div> -->
    
    
    
    
</x-guest-layout>