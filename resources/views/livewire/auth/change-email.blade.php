<div>
    <x-jet-authentication-card>
        <x-slot name="logo">
            <x-jet-authentication-card-logo />
        </x-slot>
        
        <x-slot name="title">
            <h1 class="text-2xl mt-4 text-center text-slate-800 dark:text-slate-100">{{ __('Ganti email') }}</h1>
        </x-slot>
        
        @if (session('status'))
            <div class="mb-4 text-center font-medium text-sm text-blue-500">
                {{ session('status') }}
            </div>
        @endif
        
        @if ($validEmail)
        <form wire:submit.prevent="changeEmailConfirm">
        @else
        <form wire:submit.prevent="changeEmail">
        @endif
            @csrf

            <div>
                @if ($validEmail)
                    <x-jet-label for="password" value="{{ __('Password') }}" />
                    <input type="password" id="password" name="password" class="@error('password') border-red-400 focus:border-red-400 focus:ring-red-400/20 dark:focus:ring-red-400/30 @enderror block mt-1 w-full border-slate-300 text-slate-800 dark:text-midnight-800 dark:bg-neutral-400 focus:border-indigo-300 focus:ring focus:ring-indigo-200 dark:focus:ring-indigo-400 focus:ring-opacity-50 dark:focus:ring-opacity-40 rounded-md shadow-sm" required autofocus wire:model="password">
                    @error('password')<span class="text-xs text-red-400">{{ $message }}</span>@enderror
                    <p class="my-4 text-slate-600 dark:text-slate-300 text-xs">Untuk menyimpan dan mengganti email anda, masukkan kata sandi anda sebagai bentuk konfirmasi.</p>
                @else
                    <x-jet-label for="email" value="{{ __('Email') }}" />
                    <input type="email" id="email" name="email" class="@error('email') border-red-400 focus:border-red-400 focus:ring-red-400/20 dark:focus:ring-red-400/30 @enderror block mt-1 w-full border-slate-300 text-slate-800 dark:text-midnight-800 dark:bg-neutral-400 focus:border-indigo-300 focus:ring focus:ring-indigo-200 dark:focus:ring-indigo-400 focus:ring-opacity-50 dark:focus:ring-opacity-40 rounded-md shadow-sm" required autofocus wire:model="email">
                    @error('email')<span class="text-xs text-red-400">{{ $message }}</span>@enderror
                @endif
            </div>
            
            <div class="flex w-full justify-center mt-4">
                @if ($validEmail)
                <x-jet-button type="submit" class="w-full" wire:loading.class="cursor-wait">
                    <span wire:loading.remove>{{ __('Konfirmasi') }}</span>
                    <svg wire:loading role="status" class="w-4 h-4 text-gray-200 animate-spin fill-blue-600" viewBox="0 0 100 101" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M100 50.5908C100 78.2051 77.6142 100.591 50 100.591C22.3858 100.591 0 78.2051 0 50.5908C0 22.9766 22.3858 0.59082 50 0.59082C77.6142 0.59082 100 22.9766 100 50.5908ZM9.08144 50.5908C9.08144 73.1895 27.4013 91.5094 50 91.5094C72.5987 91.5094 90.9186 73.1895 90.9186 50.5908C90.9186 27.9921 72.5987 9.67226 50 9.67226C27.4013 9.67226 9.08144 27.9921 9.08144 50.5908Z" fill="currentColor"/>
                        <path d="M93.9676 39.0409C96.393 38.4038 97.8624 35.9116 97.0079 33.5539C95.2932 28.8227 92.871 24.3692 89.8167 20.348C85.8452 15.1192 80.8826 10.7238 75.2124 7.41289C69.5422 4.10194 63.2754 1.94025 56.7698 1.05124C51.7666 0.367541 46.6976 0.446843 41.7345 1.27873C39.2613 1.69328 37.813 4.19778 38.4501 6.62326C39.0873 9.04874 41.5694 10.4717 44.0505 10.1071C47.8511 9.54855 51.7191 9.52689 55.5402 10.0491C60.8642 10.7766 65.9928 12.5457 70.6331 15.2552C75.2735 17.9648 79.3347 21.5619 82.5849 25.841C84.9175 28.9121 86.7997 32.2913 88.1811 35.8758C89.083 38.2158 91.5421 39.6781 93.9676 39.0409Z" fill="currentFill"/>
                    </svg>
                </x-jet-button>
                @else
                <x-jet-button type="submit" class="w-full" wire:loading.class="cursor-wait">
                    <span wire:loading.remove>{{ __('Ganti email') }}</span>
                    <svg wire:loading role="status" class="w-4 h-4 text-gray-200 animate-spin fill-blue-600" viewBox="0 0 100 101" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M100 50.5908C100 78.2051 77.6142 100.591 50 100.591C22.3858 100.591 0 78.2051 0 50.5908C0 22.9766 22.3858 0.59082 50 0.59082C77.6142 0.59082 100 22.9766 100 50.5908ZM9.08144 50.5908C9.08144 73.1895 27.4013 91.5094 50 91.5094C72.5987 91.5094 90.9186 73.1895 90.9186 50.5908C90.9186 27.9921 72.5987 9.67226 50 9.67226C27.4013 9.67226 9.08144 27.9921 9.08144 50.5908Z" fill="currentColor"/>
                        <path d="M93.9676 39.0409C96.393 38.4038 97.8624 35.9116 97.0079 33.5539C95.2932 28.8227 92.871 24.3692 89.8167 20.348C85.8452 15.1192 80.8826 10.7238 75.2124 7.41289C69.5422 4.10194 63.2754 1.94025 56.7698 1.05124C51.7666 0.367541 46.6976 0.446843 41.7345 1.27873C39.2613 1.69328 37.813 4.19778 38.4501 6.62326C39.0873 9.04874 41.5694 10.4717 44.0505 10.1071C47.8511 9.54855 51.7191 9.52689 55.5402 10.0491C60.8642 10.7766 65.9928 12.5457 70.6331 15.2552C75.2735 17.9648 79.3347 21.5619 82.5849 25.841C84.9175 28.9121 86.7997 32.2913 88.1811 35.8758C89.083 38.2158 91.5421 39.6781 93.9676 39.0409Z" fill="currentFill"/>
                    </svg>
                </x-jet-button>
                @endif
            </div>
            
            
            <x-slot name="another">
                <div class="text-center">
                    <span class="text-sm text-slate-700 dark:text-slate-200">
                        Yakin email sudah benar?
                        <a class="text-sm font-semibold whitespace-nowrap text-blue-600 dark:text-blue-500 hover:text-blue-700 dark:hover:text-blue-400" href="{{ route('register') }}">
                            {{ __('Verifikasi email') }}
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
    
</div>

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