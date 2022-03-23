<div>
    <div class="p-4 max-w-sm bg-neutral-100 rounded-lg border border-gray-200 shadow-md sm:p-6 lg:p-8 dark:bg-midnight-400 dark:border-slate-700">
        <form class="space-y-6" wire:submit.prevent="authenticate">
            @csrf
            
            <div class="text-center">
                <h5 class="text-xl mt-2 font-medium text-gray-900 dark:text-slate-200">Masuk ke {{ config('app.name') }}</h5>
                @if ($message)
                    <span class="text-sm mt-2 px-2 font-medium text-slate-500 dark:text-slate-400">{!! $message !!}</span>
                @endif
            </div>
            
            
            <div>
                <x-jet-label for="username" value="{{ __('Username') }}" />
                <input wire:model="username"
                    id="username"
                    type="text"
                    name="username"
                    placeholder="nsmle"
                    class="block mt-1 w-full @error('username') border-red-500 dark:border-red-500 focus:ring-red-500 dark:focus:ring-red-500 @enderror border-slate-300 text-slate-800 dark:text-midnight-800 dark:bg-neutral-400 focus:border-indigo-300 focus:ring focus:ring-indigo-200 dark:focus:ring-indigo-400 focus:ring-opacity-50 dark:focus:ring-opacity-40 rounded-md shadow-sm"
                    required
                    autofocus
                />
                @error('username')
                    <span class="text-xs text-red-500">{{ $message }}</span>
                @enderror
            </div>
            
            
            <div>
                <x-jet-label for="password" value="{{ __('Password') }}" />
                <input wire:model="password"
                    id="password" 
                    type="password"
                    name="password"
                    placeholder="••••••••"
                    autocomplete="current-password" 
                    class="block mt-1 w-full @error('password') border-red-500 dark:border-red-500 focus:ring-red-500 dark:focus:ring-red-500 @enderror border-slate-300 text-slate-800 dark:text-midnight-800 dark:bg-neutral-400 focus:border-indigo-300 focus:ring focus:ring-indigo-200 dark:focus:ring-indigo-400 focus:ring-opacity-50 dark:focus:ring-opacity-40 rounded-md shadow-sm" 
                    required 
                />
                @error('password')
                    <span class="text-xs text-red-500">{{ $message }}</span>
                @enderror
            </div>
            
            <div class="flex items-start">
                <div class="flex items-start">
                    <div class="flex items-center h-5">
                        <input wire:model="remember" id="remember" aria-describedby="remember" type="checkbox" class="w-4 h-4 bg-gray-50 rounded border border-gray-300 focus:ring-3 focus:ring-blue-300 dark:bg-midnight-500 dark:border-gray-600 dark:focus:ring-blue-600 dark:ring-offset-gray-800">
                    </div>
                    <div class="ml-3 text-sm">
                        <label for="remember" class="font-medium text-gray-900 dark:text-gray-300">Remember me</label>
                    </div>
                </div>
                @if (Route::has('password.request'))
                    <a href="{{ route('password.request') }}" class="ml-auto text-sm text-blue-700 hover:underline dark:text-blue-500">Lupa Password?</a>
                @endif
            </div>
            
            <x-buttons.button-primary type="submit" class="w-full">
                {{ __('Masuk') }}
            </x-buttons.button-primary>
            
            <div class="text-sm font-medium text-gray-500 dark:text-gray-300">
                Belum punya akun? <a href="{{ route('register') }}" class="text-blue-700 hover:underline dark:text-blue-500">Buat akun</a>
            </div>
        </form>
    </div>
    
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

@if (session()->has('status') && session('status') !== 'verification-link-sent')
    let status = document.querySelector('.status')
    
    status.querySelector('.close-status').addEventListener('click', () => {
        status.parentElement.classList.add('hidden')
    })
@endif
</script>
@endpush