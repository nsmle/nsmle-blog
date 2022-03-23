<x-guest-layout>
    <x-jet-authentication-card>
        <x-slot name="logo">
            <x-jet-authentication-card-logo />
        </x-slot>
        
        <x-slot name="title">
            <h1 class="text-2xl mt-4 text-center text-slate-800 dark:text-slate-100">Sign in to {{ config('app.name') }}</h1>
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
        
        <form method="POST" action="{{ route('login') }}">
            @csrf

            <div>
                <x-jet-label for="username" value="{{ __('Username') }}" />
                <x-jet-input id="username" class="block mt-1 w-full" type="text" name="username" :value="old('username')" required autofocus />
            </div>

            <div class="mt-4">
                <x-jet-label for="password" value="{{ __('Password') }}" />
                <x-jet-input id="password" class="block mt-1 w-full" type="password" name="password" required autocomplete="current-password" />
            </div>

            <div class="flex justify-between mt-4">
                <label for="remember_me" class="flex items-center">
                    <x-jet-checkbox id="remember_me" name="remember" />
                    <span class="ml-2 text-sm whitespace-nowrap text-gray-600 dark:text-slate-300">{{ __('Remember me') }}</span>
                </label>
                @if (Route::has('password.request'))
                    <a class="text-sm font-medium whitespace-nowrap text-blue-600 dark:text-blue-500 hover:text-blue-700 dark:hover:text-blue-400" href="{{ route('password.request') }}">
                        {{ __('Lupa password?') }}
                    </a>
                @endif
            </div>
            
            
            <div class="flex w-full justify-center mt-4">
                <x-jet-button class="w-full">
                    {{ __('Masuk') }}
                </x-jet-button>
            </div>
            
            
            <x-slot name="another">
                <div class="text-center">
                    <span class="text-sm text-slate-700 dark:text-slate-200">
                        Belum punya akun?
                        <a class="text-sm font-semibold whitespace-nowrap text-blue-600 dark:text-blue-500 hover:text-blue-700 dark:hover:text-blue-400" href="{{ route('register') }}">
                            {{ __('Buat akun') }}
                        </a>.
                    </span>
                </div>
            </x-slot>
            
            <x-slot name="policy">
                <div class="flex text-center md:mx-8 justify-between">
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
        
        </form>
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
