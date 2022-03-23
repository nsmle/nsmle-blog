<x-guest-layout>
    <x-jet-authentication-card class="pb-5">
        <x-slot name="logo">
            <x-jet-authentication-card-logo />
        </x-slot>
        
        <x-slot name="title">
            <h1 class="text-2xl font-semibold mt-4 text-center text-slate-800 dark:text-slate-100">Sign up to {{ config('app.name') }}</h1>
        </x-slot>

        <x-slot name="validation">
            <x-jet-validation-errors class="mb-4" />
        </x-slot>

        <form method="POST" action="{{ route('register') }}">
            @csrf

            <div>
                <x-jet-label for="name" value="{{ __('Nama') }}" />
                <x-jet-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
            </div>

            <div class="mt-4">
                <x-jet-label for="username" value="{{ __('Username') }}" />
                <x-jet-input id="username" class="block mt-1 w-full" type="text" name="username" :value="old('username')" required autocomplete="username"/>
            </div>
            
            <div class="mt-4">
                <x-jet-label for="email" value="{{ __('Email') }}" />
                <x-jet-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required />
            </div>
            
            <div class="mt-8 border-t border-slate-400/80 dark:border-slate-600"></div>

            <div class="mt-5">
                <x-jet-label for="password" value="{{ __('Password') }}" />
                <x-jet-input id="password" class="block mt-1 w-full" type="password" name="password" required autocomplete="new-password" />
            </div>

            <div class="mt-4">
                <x-jet-label for="password_confirmation" value="{{ __('Konfirmasi Password') }}" />
                <x-jet-input id="password_confirmation" class="block mt-1 w-full" type="password" name="password_confirmation" required autocomplete="new-password" />
            </div>

            @if (Laravel\Jetstream\Jetstream::hasTermsAndPrivacyPolicyFeature())
                <div class="mt-4">
                    <x-jet-label for="terms">
                        <div class="flex items-center">
                            <x-jet-checkbox name="terms" id="terms"/>

                            <div class="ml-2 text-slate-600 dark:text-slate-300">
                                {!! __('Saya setuju dengan :terms_of_service dan :privacy_policy di situs ini.', [
                                        'terms_of_service' => '<a target="_blank" href="'.route('terms.show').'" class="text-sm font-medium whitespace-nowrap text-blue-600 dark:text-blue-500 hover:text-blue-700 dark:hover:text-blue-400">'.__('Ketentuan Layanan').'</a>',
                                        'privacy_policy' => '<a target="_blank" href="'.route('policy.show').'" class="text-sm font-medium whitespace-nowrap text-blue-600 dark:text-blue-500 hover:text-blue-700 dark:hover:text-blue-400">'.__('Kebijakan Privasi').'</a>',
                                ]) !!}
                            </div>
                        </div>
                    </x-jet-label>
                </div>
            @endif

            <div class="flex w-full justify-center mt-4">
                <x-jet-button class="w-full">
                    {{ __('Buat Akun') }}
                </x-jet-button>
            </div>
            
            
            <x-slot name="another">
                <div class="text-center">
                    <span class="text-sm text-slate-700 dark:text-slate-200">
                        Sudah punya akun?
                        <a class="text-sm font-semibold whitespace-nowrap text-blue-600 dark:text-blue-500 hover:text-blue-700 dark:hover:text-blue-400" href="{{ route('login') }}">
                            {{ __('Masuk') }}
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
    
    </script>
    @endpush
    
</x-guest-layout>
