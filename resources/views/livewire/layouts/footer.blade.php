<div class="footer py-12 px-3 md:px-6 bg-grenteel-200/50 dark:bg-midnight-400/80 z-50">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="overflow-hidden mx-3 sm:rounded-lg items-top md:justify-between block md:flex">
            
            <div class="md:w-2/4 justify-center">
                <a class="flex items-center" href="/">
                    <x-jet-application-mark class="block h-10 w-auto rounded" />
                    <p class="text-2xl font-bold text-midnight-800 dark:text-neutral-100">{{ __('Blog') }}</p>
                </a>
                <p class="mt-2 text-sm text-justify text-slate-700 dark:text-slate-400">
                    Nsmle Blog adalah sebuah layanan blogging dari nsmle - Fiki Pratama.
                    Blog ini tercipta sebagai wadah developer using android (Develop web/app menggunakan android bukan developer android) untuk berkeluh kesah
                    tentang lingkup pengembangan web/app menggunakan android.
                    Seiring berjalanya waktu, Postingan-postingan didalamnya mungkin akan berubah tetapi tidak akan menghilangkan ciri khas seputar pengembangan menggunakan android.
                </p>
            </div>
            
            <div class="md:w-1/5 mt-8 md:mt-0">
                <h2 class="mb-2 font-bold tracking-widest text-slate-900 dark:text-slate-100">Navigate</h2>
                <ul class="mb-8 space-y-2 text-sm">
                    <li>
                        <a href="{{ Auth::check() ? route('dashboard') : route('home') }}" class="text-slate-600 hover:text-slate-800 dark:text-slate-400 dark:hover:text-slate-300">Home</a>
                    </li>
                    <li>
                        <a href="{{ route('post') }}" class="text-slate-600 hover:text-slate-800 dark:text-slate-400 dark:hover:text-slate-300">Post</a>
                    </li>
                    <li>
                        <a href="{{ route('about.show') }}" class="text-slate-600 hover:text-slate-800 dark:text-slate-400 dark:hover:text-slate-300">About</a>
                    </li>
                    @if (!Auth::check())
                    <li>
                        <a href="{{ route('login') }}" class="text-slate-600 hover:text-slate-800 dark:text-slate-400 dark:hover:text-slate-300">Login</a>
                    </li>
                    <li>
                        <a href="{{ route('register') }}" class="text-slate-600 hover:text-slate-800 dark:text-slate-400 dark:hover:text-slate-300">Join</a>
                    </li>
                    @else
                    <li>
                        <a href="{[ route('dashboard') }}" class="text-slate-600 hover:text-slate-800 dark:text-slate-400 dark:hover:text-slate-300">Dashboard</a>
                    </li>
                    @endif
                    <li>
                        <a href="{{ route('policy.show') }}" class="text-slate-600 hover:text-slate-800 dark:text-slate-400 dark:hover:text-slate-300">Privacy Policy</a>
                    </li>
                    <li>
                        <a href="{{ route('terms.show') }}" class="text-slate-600 hover:text-slate-800 dark:text-slate-400 dark:hover:text-slate-300">Terms of Service</a>
                    </li>
                </ul>
            </div>
            
            <div class="md:w-1/5 ">
                <h2 class="mb-2 font-bold tracking-widest text-slate-900 dark:text-slate-100">Social</h2>
                <ul class="mb-8 space-y-2 text-sm list-none">
                    <li>
                        <a class="text-slate-600 hover:text-slate-800 dark:text-slate-400 dark:hover:text-slate-300" target="_blank" href="https://github.com/nsmle"><i class="fa-brands fa-github"></i> Github</a>
                    </li>
                    <li>
                        <a class="text-slate-600 hover:text-slate-800 dark:text-slate-400 dark:hover:text-slate-300" target="_blank" href="https://twitter.com/nsmle_"><i class="fa-brands fa-twitter"></i> Twitter</a>
                    </li>
                    <li>
                        <a class="text-slate-600 hover:text-slate-800 dark:text-slate-400 dark:hover:text-slate-300" target="_blank" href="https://instagram.com/nsmle_"><i class="fa-brands fa-instagram-square"></i> Instagram</a>
                    </li>
                    <li>
                        <a class="text-slate-600 hover:text-slate-800 dark:text-slate-400 dark:hover:text-slate-300" target="_blank" href="https://t.me/nsmle"><i class="fa-brands fa-telegram"></i> Telegram</a>
                    </li>
                    <li>
                        <a class="text-slate-600 hover:text-slate-800 dark:text-slate-400 dark:hover:text-slate-300" target="_blank" href="https://facebook.com/nsmlee"><i class="fa-brands fa-facebook"></i> Facebook</a>
                    </li>
                    <li>
                        <a class="text-slate-600 hover:text-slate-800 dark:text-slate-400 dark:hover:text-slate-300" target="_blank" href="https://m.youtube.com/channel/UCBUBKjEMIeoJERXKjnDtkgg"><i class="fa-brands fa-youtube"></i> YouTube</a>
                    </li>
                </ul>
            </div>
            
            
        </div>
        <div class="flex justify-center mt-8">
            <p class="text-sm md:text-base text-slate-600 dark:text-slate-500">
                 Copyright © {{ date('Y') }} Nsmle - Fiki Pratama.
            </p>
        </div>
    </div>
</div>