<div>
    <div class="flex bg-neutral-100 dark:bg-midnight-300">
        <div class="flex float-right">
            <button type="button" class="bg-transparent rounded-md p-2 inline-flex items-center justify-center text-red-500 hover:text-red-700 focus:outline-none hover:bg-neutral-400/50 dark:hover:bg-midnight-400/50 active:bg-neutral-400/50 dark:active:bg-midnight-400/50 active:text-slate-400 absolute float-right" wire:click="$emit('closeModal')">
                <span class="sr-only">Close menu</span>
                <!-- Heroicon name: outline/x -->
                <svg class="h-6 w-6 md:h-8 md:w-8" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
        </div>
        <img src="{{ $profilePhoto }}" class="w-full">
    </div>
</div>
