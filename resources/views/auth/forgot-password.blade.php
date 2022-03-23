<x-guest-layout>
    <x-jet-authentication-card>
        <x-slot name="logo">
            <x-jet-authentication-card-logo />
        </x-slot>
        
        <x-slot name="title">
            <h1 class="text-2xl mt-4 text-center text-slate-800 dark:text-slate-100">{{ __('Forgot Password') }}</h1>
        </x-slot>
        
        
        <x-slot name="validation">
            <x-jet-validation-errors class="mb-4" />
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
            <strong class="m-0 p-0">{{ __('Lupa kata sandi anda? ') }}</strong>
            <p class="mt-4">Tidak masalah.</p>
            <p class="mt-1">Cukup beri tahu kami alamat email Anda.</p>
            <p>dan kami akan mengirim email kepada Anda tautan pengaturan ulang kata sandi yang baru.</p>
        </div>

        {{--
        @if (session('status'))
            <div class="mb-4 font-medium text-sm text-blue-500 dark:text-blue-300">
                {{ session('status') }}
            </div>
        @endif
        --}}

        <form method="POST" action="{{ route('password.email') }}">
            @csrf

            <div class="block">
                <x-jet-label for="email" value="{{ __('Email') }}" />
                <x-jet-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus />
            </div>

            <div class="flex items-center w-full justify-center mt-4">
                <x-jet-button class="w-full">
                    {{ __('Kirim Link Reset Password') }}
                </x-jet-button>
            </div>
        </form>
        
        
        
        <x-slot name="another">
            <div class="text-center">
                <span class="text-sm text-slate-700 dark:text-slate-200">
                    Kesulitan dan
                    <a class="text-sm font-semibold whitespace-nowrap text-blue-600 dark:text-blue-500 hover:text-blue-700 dark:hover:text-blue-400" href="{{ __('/about?help=forgot-password') }}">
                        {{ __('Butuh Bantuan') }}
                    </a>?
                </span>
            </div>
            
            <div class="flex px-4 mt-4 grid grid-cols-2 gap-6 justify-between">
                <a href="{{ route('login') }}" class="w-full items-center text-center px-4 py-1 border border-blue-600 dark:border-blue-500 hover:border-blue-800 dark:hover:border-blue-600 rounded-md font-semibold text-sm text-blue-600 dark:text-blue-500 hover:text-blue-800 dark:hover:text-blue-600 font-bold tracking-wide focus:outline-none focus:ring focus:ring-blue-600/20 disabled:opacity-25 transition">
                    {{ __('Masuk') }}
                </a>
                <a href="{{ route('register') }}" class="w-full items-center text-center px-4 py-1 border border-blue-600 dark:border-blue-500 hover:border-blue-800 dark:hover:border-blue-600 rounded-md font-semibold text-sm text-blue-600 dark:text-blue-500 hover:text-blue-800 dark:hover:text-blue-600 font-bold tracking-wide focus:outline-none focus:ring focus:ring-blue-600/20 disabled:opacity-25 transition">
                    {{ __('Daftar') }}
                </a>
            </div>
            
        </x-slot>
        
        
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
    </x-jet-authentication-card>
    
    
    @push('scripts')
    <script type="text/javascript">
    @if ($errors->any())
        let errors = document.querySelectorAll('.validation-error')
        if (!!errors) {
            errors.forEach((error) => {
                error.querySelector('.close-error').addEventListener('click', () => {
                    error.parentElement.classList.add('hidden')
                })
            });
        }
    @endif
    
    @if (session()->has('status') && session('status') !== 'verification-link-sent')
        let status = document.querySelector('.status')
        
        status.querySelector('.close-status').addEventListener('click', () => {
            status.parentElement.classList.add('hidden')
        })
    @endif
    </script>
    @endpush
</x-guest-layout>
