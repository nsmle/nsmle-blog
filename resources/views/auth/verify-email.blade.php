<x-guest-layout>
    <x-jet-authentication-card>
        <x-slot name="logo">
            <x-jet-authentication-card-logo />
        </x-slot>
        
        <x-slot name="title">
            <h1 class="text-2xl mt-4 text-center text-slate-800 dark:text-slate-100">Verifikasi Email</h1>
        </x-slot>
        
        <x-slot name="validation">
            @if (session()->has('status') && session('status') !== 'verification-link-sent')
                <div class="status w-full mb-4 bg-blue-100/50 dark:bg-blue-100 border border-blue-200 dark:border-blue-300 text-blue-900 px-4 py-3 rounded-lg relative" role="status">
                    <strong class="font-bold text-sm">Yapp!</strong>
                    <span class="block sm:inline text-sm">{{ session('status') }}</span>
                    <span class="absolute close-status top-0 bottom-0 right-0 px-4 py-3">
                        <svg class="fill-current h-5 w-5 text-blue-500" role="button" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><title>Close</title><path d="M14.348 14.849a1.2 1.2 0 0 1-1.697 0L10 11.819l-2.651 3.029a1.2 1.2 0 1 1-1.697-1.697l2.758-3.15-2.759-3.152a1.2 1.2 0 1 1 1.697-1.697L10 8.183l2.651-3.031a1.2 1.2 0 1 1 1.697 1.697l-2.758 3.152 2.758 3.15a1.2 1.2 0 0 1 0 1.698z"/></svg>
                    </span>
                </div>
            @endif
        </x-slot>
        
        <div class="mb-4 text-sm text-slate-600 dark:text-slate-300">
            <strong>{{ __('Terima kasih telah mendaftar!') }}</strong>
            @if (session('status') !== 'verification-link-sent')
                <p class="mt-2">{{ __('Kami telah mengirimkan email ke') }} <a class="text-sm font-semibold whitespace-nowrap text-slate-600 dark:text-slate-300 hover:text-blue-700 dark:hover:text-blue-400" href="mailto:{{ auth()->user()->email }}">{{ auth()->user()->email }}</a></p>
            @endif
            <p class="mt-4">Untuk melengkapi profil anda dan mulai menulis di {{ config('app.name') }}, Anda harus memverifikasi alamat email anda.</p>
            <p class="mt-2">Jika email verifikasi tidak ditemukan, silahkan klik tombol dibawah dan periksa email pada bagian spam.</p>
        </div>

        @if (session('status') == 'verification-link-sent')
            <div class="mb-4 font-medium text-sm text-blue-500 dark:text-blue-300">
                {{ __('Tautan verifikasi baru telah dikirim ke.') }} <a class="text-sm font-semibold whitespace-nowrap text-blue-500 hover:text-blue-700 dark:text-blue-300 dark:hover:text-blue-500" href="mailto:{{ auth()->user()->email }}">{{ auth()->user()->email }}</a>
            </div>
        @endif

        <div class="mt-4 flex justify-center">
            <form class="w-full inline-flex justify-center" method="POST" action="{{ route('verification.send') }}">
                @csrf

                <div class="w-full">
                    <x-jet-button class="w-full" type="submit">
                        {{ __('Kirim ulang email verifikasi') }}
                    </x-jet-button>
                </div>
            </form>
            
        </div>
        
        <x-slot name="another">
            <div class="text-center">
                <span class="text-sm text-slate-700 dark:text-slate-200">
                    Kesulitan dan
                    <a class="text-sm font-semibold whitespace-nowrap text-blue-600 dark:text-blue-500 hover:text-blue-700 dark:hover:text-blue-400" href="{{ __('/about?help=email-verification') }}">
                        {{ __('Butuh Bantuan') }}
                    </a>?
                </span>
            </div>
            
            <div class="flex mt-4 grid grid-cols-2 gap-6 justify-between">
                <a href="{{ route('verification.change-email') }}" class="w-full items-center text-center px-4 py-1 border border-blue-600 dark:border-blue-500 hover:border-blue-800 dark:hover:border-blue-600 rounded-md font-semibold text-sm text-blue-600 dark:text-blue-500 hover:text-blue-800 dark:hover:text-blue-600 font-bold tracking-wide focus:outline-none focus:ring focus:ring-blue-600/20 disabled:opacity-25 transition">
                    {{ __('Ganti email') }}
                </a>
                <form class="justify-center w-full" method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="w-full items-center text-center px-4 py-1 border border-red-600 dark:border-red-500 hover:border-red-800 dark:hover:border-red-600 rounded-md font-semibold text-sm text-red-600 dark:text-red-500 hover:text-red-800 dark:hover:text-red-600 font-bold tracking-wide focus:outline-none focus:ring focus:ring-red-600/20 disabled:opacity-25 transition">
                        {{ __('Log Out') }}
                    </button>
                </form>
            </div>
            
            <x-slot name="policy">
                <div class="flex -mt-3 text-center md:mx-8 justify-between">
                    <a class="text-xs md:text-md font-semibold whitespace-nowrap text-blue-600 dark:text-blue-500 hover:text-blue-700 dark:hover:text-blue-400" href="{{ route('terms.show') }}">
                        {{ __('Persyaratan Layanan') }}
                    </a>
                    <a class="text-xs md:text-md font-semibold whitespace-nowrap text-blue-600 dark:text-blue-500 hover:text-blue-700 dark:hover:text-blue-400" href="{{ route('policy.show') }}">
                        {{ __('Kebijakan Privasi') }}
                    </a>
                    <a class="text-xs md:text-md font-semibold whitespace-nowrap text-blue-600 dark:text-blue-500 hover:text-blue-700 dark:hover:text-blue-400" href="{{ route('about.show') }}">
                        {{ __('Tentang') }}
                    </a>
                </div>
            </x-slot>
        </x-slot>
        
    </x-jet-authentication-card>
    
    @push('scripts')
    <script type="text/javascript">
        @if (session()->has('status') && session('status') !== 'verification-link-sent')
            let status = document.querySelector('.status')
            
            status.querySelector('.close-status').addEventListener('click', () => {
                status.parentElement.classList.add('hidden')
            })
        @endif
    </script>
    @endpush
</x-guest-layout>
