<div>
    @if (!empty($toastNotifyPostLiked) && $toastNotifyPostLiked['info']['status'] === 'like')
        <div x-data="" x-ref="notifyPostLiked"
            x-init="setTimeout(() => {
                $wire.toastNotifyPostLiked = null;
                $refs.notifyPostLiked.remove()
            }, 8000)"
        >
            <div class="fixed top-2 right-2 z-50 p-4 w-full max-w-xs text-gray-900 bg-white rounded-lg shadow dark:bg-midnight-40 dark:text-gray-30 animate-pop transition" role="alert">
                <div class="flex items-center mb-3">
                    <span class="mb-1 text-sm font-semibold text-gray-900 dark:text-white">New notification</span>
                    <button type="button" class="ml-auto -mx-1.5 -my-1.5 bg-white text-gray-400 hover:text-gray-900 rounded-lg focus:ring-2 focus:ring-gray-300 p-1.5 hover:bg-gray-100 inline-flex h-8 w-8 dark:text-gray-500 dark:hover:text-white dark:bg-midnight-40 dark:hover:bg-midnight-90" data-collapse-toggle="toast-notification" aria-label="Close"
                          @click="$wire.toastNotifyPostLiked = null; $refs.notifyPostLiked.remove()"
                    >
                        <span class="sr-only">Close</span>
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
                    </button>
                </div>
                <div class="flex items-center">
                    <div class="inline-block relative shrink-0">
                        <a href="/{{ $toastNotifyPostLiked['trigger_user']['username'] }}">
                            <img class="w-12 h-12 rounded-full" src="{{ asset($toastNotifyPostLiked['trigger_user']['profile_photo_url']) }}" alt="{{ $toastNotifyPostLiked['trigger_user']['name'] }}" loading="lazy"/>
                        </a>
                        <span class="inline-flex absolute right-0 bottom-0 justify-center items-center w-6 h-6 bg-blue-600 rounded-full">
                            <svg class="w-4 h-4 text-white" fill="currentColor" viewBox="0 0 24 22" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path d="M6.28001656,3.46389584e-14 C6.91001656,0.0191596721 7.52001656,0.129159672 8.11101656,0.330159672 L8.11101656,0.330159672 L8.17001656,0.330159672 C8.21001656,0.349159672 8.24001656,0.370159672 8.26001656,0.389159672 C8.48101656,0.460159672 8.69001656,0.540159672 8.89001656,0.650159672 L8.89001656,0.650159672 L9.27001656,0.820159672 C9.42001656,0.900159672 9.60001656,1.04915967 9.70001656,1.11015967 C9.80001656,1.16915967 9.91001656,1.23015967 10.0000166,1.29915967 C11.1110166,0.450159672 12.4600166,-0.00984032788 13.8500166,3.46389584e-14 C14.4810166,3.46389584e-14 15.1110166,0.0891596721 15.7100166,0.290159672 C19.4010166,1.49015967 20.7310166,5.54015967 19.6200166,9.08015967 C18.9900166,10.8891597 17.9600166,12.5401597 16.6110166,13.8891597 C14.6800166,15.7591597 12.5610166,17.4191597 10.2800166,18.8491597 L10.2800166,18.8491597 L10.0300166,19.0001597 L9.77001656,18.8391597 C7.48101656,17.4191597 5.35001656,15.7591597 3.40101656,13.8791597 C2.06101656,12.5301597 1.03001656,10.8891597 0.390016562,9.08015967 C-0.739983438,5.54015967 0.590016562,1.49015967 4.32101656,0.269159672 C4.61101656,0.169159672 4.91001656,0.0991596721 5.21001656,0.0601596721 L5.21001656,0.0601596721 L5.33001656,0.0601596721 C5.61101656,0.0191596721 5.89001656,3.46389584e-14 6.17001656,3.46389584e-14 L6.17001656,3.46389584e-14 Z M15.1900166,3.16015967 C14.7800166,3.01915967 14.3300166,3.24015967 14.1800166,3.66015967 C14.0400166,4.08015967 14.2600166,4.54015967 14.6800166,4.68915967 C15.3210166,4.92915967 15.7500166,5.56015967 15.7500166,6.25915967 L15.7500166,6.25915967 L15.7500166,6.29015967 C15.7310166,6.51915967 15.8000166,6.74015967 15.9400166,6.91015967 C16.0800166,7.08015967 16.2900166,7.17915967 16.5100166,7.20015967 C16.9200166,7.18915967 17.2700166,6.86015967 17.3000166,6.43915967 L17.3000166,6.43915967 L17.3000166,6.32015967 C17.3300166,4.91915967 16.4810166,3.65015967 15.1900166,3.16015967 Z" transform="translate(2 2.5)"/></svg>
                        </span>
                    </div>
                    <div class="ml-3 text-sm font-normal">
                        <h4 class="text-sm font-semibold text-gray-900 dark:text-white"><a class="hover:bg-blue-500" href="/{{ $toastNotifyPostLiked['trigger_user']['username'] }}">{{ $toastNotifyPostLiked['trigger_user']['name'] }}</a></h4>
                        <div class="text-sm font-normal text-gray-700 dark:text-gray-300">Menyukai postingan {{ str_replace('.', '', strtolower($toastNotifyPostLiked['post']['title'])) }} anda</div> 
                        <a href="/posts/{{ $toastNotifyPostLiked['post']['slug'] }}" class="text-xs font-medium text-blue-600 dark:text-blue-400">Lihat post yang disukai</a>
                    </div>
                </div>
            </div>
        </div>
    @endif
    
    @if (!empty($toastNotifyPostCommented) && $toastNotifyPostCommented['info']['status'] === 'comment')
        <div x-data="" x-ref="notifyPostCommented"
            x-init="setTimeout(() => {
                //$wire.notifyPostCommented = null;
                $refs.notifyPostCommented.remove()
            }, 8000)"
        >
            <div class="fixed top-2 right-2 z-50 p-4 w-full max-w-xs text-gray-900 bg-white rounded-lg shadow dark:bg-midnight-40 dark:text-gray-30 animate-pop transition" role="alert">
                <div class="flex items-center mb-3">
                    <span class="mb-1 text-sm font-semibold text-gray-900 dark:text-white">New notification</span>
                    <button type="button" class="ml-auto -mx-1.5 -my-1.5 bg-white text-gray-400 hover:text-gray-900 rounded-lg focus:ring-2 focus:ring-gray-300 p-1.5 hover:bg-gray-100 inline-flex h-8 w-8 dark:text-gray-500 dark:hover:text-white dark:bg-midnight-40 dark:hover:bg-midnight-90" data-collapse-toggle="toast-notification" aria-label="Close"
                          @click="$wire.toastNotifyPostLiked = null; $refs.notifyPostLiked.remove()"
                    >
                        <span class="sr-only">Close</span>
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
                    </button>
                </div>
                <div class="flex items-center">
                    <div class="inline-block relative shrink-0">
                        <a href="/{{ $toastNotifyPostCommented['trigger_user']['username'] }}">
                            <img class="w-12 h-12 rounded-full" src="{{ asset($toastNotifyPostCommented['trigger_user']['profile_photo_url']) }}" alt="{{ $toastNotifyPostCommented['trigger_user']['name'] }}" loading="lazy"/>
                        </a>
                        <span class="inline-flex absolute right-0 bottom-0 justify-center items-center w-6 h-6 bg-blue-600 rounded-full">
                            <svg class="w-4 h-4 text-white" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M18 13V5a2 2 0 00-2-2H4a2 2 0 00-2 2v8a2 2 0 002 2h3l3 3 3-3h3a2 2 0 002-2zM5 7a1 1 0 011-1h8a1 1 0 110 2H6a1 1 0 01-1-1zm1 3a1 1 0 100 2h3a1 1 0 100-2H6z" clip-rule="evenodd"></path></svg>
                        </span>
                    </div>
                    <div class="ml-3 text-sm font-normal">
                        <h4 class="text-sm font-semibold text-gray-900 dark:text-white"><a class="hover:bg-blue-500" href="/{{ $toastNotifyPostCommented['trigger_user']['username'] }}">{{ $toastNotifyPostCommented['trigger_user']['name'] }}</a></h4>
                        <div class="text-sm font-normal text-gray-700 dark:text-gray-300">
                            Berkomentar {{ mb_strimwidth(str_replace('.', '', strtolower($toastNotifyPostCommented['comment']['content'])), 0, 70, '...') }} pada postingan {{ mb_strimwidth(str_replace('.', '', strtolower($toastNotifyPostCommented['post']['title'])), 0, 70, '...') }} yang anda miliki
                        </div> 
                        <a href="/posts/{{ $toastNotifyPostCommented['post']['slug'] }}" class="text-xs font-medium text-blue-600 dark:text-blue-400">Lihat post yang dikomentari</a>
                    </div>
                </div>
            </div>
        </div>
    @endif
    
    
    
    <div class="hidden fixed top-2 right-2 z-50 flex items-center w-full max-w-xs p-4 mb-4 text-gray-500 bg-white rounded-lg shadow dark:text-slate-400 dark:bg-midnight-100 transition" role="alert"
         x-ref="toastStatus"
        x-data="{
            status  : null,
            message : 'null'
        }"
        x-init="window.addEventListener('toastStatus', event => {
            status = event.detail.status;
            message = event.detail.message;
            
            $refs.toastStatus.classList.replace('hidden', 'animate-pop');
            
            if (event.detail.status === 'toastSuccess') {
                $refs.toastSuccess.classList.remove('hidden');
            } else if (event.detail.status === 'toastWarning') {
                $refs.toastWarning.classList.remove('hidden');
            } else if (event.detail.status === 'toastDanger') {
                $refs.toastDanger.classList.remove('hidden');
            }
            
            setTimeout(() => {
                $refs.toastStatus.classList.replace('animate-pop', 'hidden');
            }, 8000);
            
            
        });"
    >
        <div class="hidden inline-flex items-center justify-center flex-shrink-0 w-8 h-8 text-green-500 bg-green-100 rounded-lg dark:bg-green-800 dark:text-green-200"
             x-ref="toastSuccess"
        >
            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path></svg>
        </div>
        <div class="hidden inline-flex items-center justify-center flex-shrink-0 w-8 h-8 text-orange-500 bg-orange-100 rounded-lg dark:bg-orange-700 dark:text-orange-200"
             x-ref="toastWarning"
        >
            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z" clip-rule="evenodd"></path></svg>
        </div>
        <div class="hidden inline-flex items-center justify-center flex-shrink-0 w-8 h-8 text-red-500 bg-red-100 rounded-lg dark:bg-red-800 dark:text-red-200"
             x-ref="toastDanger"
        >
            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
        </div>
        <div x-text="message" class="ml-3 text-sm font-normal"></div>
        <button type="button" class="ml-auto -mx-1.5 -my-1.5 bg-white text-gray-400 hover:text-gray-900 rounded-lg focus:ring-2 focus:ring-gray-300 p-1.5 hover:bg-gray-100 inline-flex h-8 w-8 dark:text-gray-500 dark:hover:text-white dark:focus:ring-midnight-200 dark:bg-midnight-100 dark:hover:bg-midnight-90" aria-label="Close"
            @click="$refs.toastStatus.classList.replace('animate-pop', 'hidden');"
        >
            <span class="sr-only">Close</span>
            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
        </button>
    </div>
</div>