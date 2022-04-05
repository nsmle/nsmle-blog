<div>
    <div class="w-screen h-screen flex max-w-3xl mx-auto"
        x-data="{
            typing: false,
            info: '',
            getInfo() {
                if (this.typing) {
                    return 'Mengetik';
                }
                
                if ({{ now()->parse($user->last_seen)->timestamp }} > {{ now()->addMinutes(-1)->timestamp }}) {
                    return `{{ '@'.$user->username }}`;
                } else {
                    if ({{ now()->parse($user->last_seen)->timestamp }} > {{ now()->subDays(1)->timestamp }}) {
                        return `Terakhir dilihat {{ now()->parse($user->last_seen)->format('H:i') }}`;
                    } else {
                        return `Dilihat pada {{ now()->parse($user->last_seen)->format('d/m/y H:i') }}`;
                    }
                }
            },
            isTyping() {
                @if (!empty($this->room))
                Echo.private('chat-event.{{ $this->room->id }}').whisper('typing', {
                    userId: '{{ Auth::id() }}',
                    typing: true
                });
                @endif
            },
            isNotTyping() {
                @if (!empty($this->room))
                Echo.private('chat-event.{{ $this->room->id }}').whisper('typing', {
                    userId: '{{ Auth::id() }}',
                    typing: false
                });
                @endif
            },
            listenForWhisper() {
                @if (!empty($this->room))
                Echo.private('chat-event.{{ $this->room->id }}').listenForWhisper('typing', (e) => {
                    this.typing = e.typing;
                });
                @endif
            },
            scrollToBottomMessage() {
                $refs.chatMessages.scrollTop =  $refs.chatMessages.scrollHeight;
            }
        }"
        @scroll-to-bottom-message.window="scrollToBottomMessage()"
        x-init="listenForWhisper();
           scrollToBottomMessage();
        "
    >
        <div class="flex-1 bg-slate-100 dark:bg-midnight-500 justify-between flex flex-col">
           
           <div class="flex fixed z-50 w-screen top-0 max-w-xl bg-white dark:bg-midnight-300 rounded px-2 items-center justify-between py-3">
              <div class="relative flex items-center space-x-4">
                <a href="{{ route('dashboard.chat.index') }}" class="relative rounded-full flex items-center hover:bg-slate-200/80 dark:hover:bg-slate-600/20">
                    <div class="mr-2 text-slate-600 dark:text-slate-500">
                        <svg xmlns="http://www.w3.org/2000/svg" stroke="none" viewBox="0 0 448 512" fill="currentColor" class="h-5 w-5">
                            <path d="M447.1 256C447.1 273.7 433.7 288 416 288H109.3l105.4 105.4c12.5 12.5 12.5 32.75 0 45.25C208.4 444.9 200.2 448 192 448s-16.38-3.125-22.62-9.375l-160-160c-12.5-12.5-12.5-32.75 0-45.25l160-160c12.5-12.5 32.75-12.5 45.25 0s12.5 32.75 0 45.25L109.3 224H416C433.7 224 447.1 238.3 447.1 256z"/>
                        </svg>
                    </div>
                  
                     <div class="relative -mr-1">
                        @if (now()->parse($user->last_seen)->timestamp > now()->addMinutes(-1)->timestamp)
                        <span class="absolute rounded-full text-green-500 -right-1 top-0">
                           <svg width="18" height="18" class="border-2 border-white dark:border-midnight-300 rounded-full">
                              <circle cx="7" cy="7" r="10" fill="currentColor"></circle>
                           </svg>
                        </span>
                        @endif
                        <img class="w-11 h-11 object-cover rounded-full" src="{{ $user->profile_photo_url }}" alt="{{ $user->name.'(@'.$user->username.')' }}" loading="lazy">
                    </div>
                </a>
                 <div class="flex flex-col leading-tight max-w-[68%] md:max-w-[70%]">
                    <div class="text-lg inline-flex font-semibold truncate flex">
                       <a href="/{{ $user->username }}" class="text-slate-700 dark:text-slate-200 mr-3">{{ $user->name }}</a>
                    </div>
                    <div class="hidden" :class="{ 'hidden' : !typing, 'block' : typing }">
                        <span class="text-sm text-green-600 -mt-1">
                            Mengetik...
                        </span>
                    </div>
                    <div class="hidden" :class="{ 'hidden' : typing, 'block' : !typing }">
                        @if (now()->parse($user->last_seen)->timestamp > now()->addMinutes(-1)->timestamp)
                            <a href="/{{ $user->username }}" class="text-sm text-slate-600 dark:text-slate-300/80 -mt-1">
                                {{ '@'.$user->username }}
                            </a>
                        @else 
                            <span class="text-sm text-slate-600 dark:text-slate-300/80 -mt-1">
                                @if (now()->parse($user->last_seen)->timestamp > now()->subDays(1)->timestamp )
                                    Terakhir dilihat {{ now()->parse($user->last_seen)->format('H:i') }}
                                @else
                                    Dilihat pada {{ now()->parse($user->last_seen)->format('d/m/y H:i') }}
                                @endif
                            </span>
                        @endif
                    </div>
                 </div>
              </div>
              
              <div class="flex items-center">
                 <button type="button" class="inline-flex items-center justify-center rounded-lg h-10 w-10 transition duration-500 ease-in-out text-gray-500 hover:bg-slate-100 dark:hover:bg-slate-600/20 focus:outline-none">
                    <svg xmlns="http://www.w3.org/2000/svg" stroke="none" viewBox="0 0 128 512" fill="currentColor" class="h-6 w-6">
                        <path d="M64 360C94.93 360 120 385.1 120 416C120 446.9 94.93 472 64 472C33.07 472 8 446.9 8 416C8 385.1 33.07 360 64 360zM64 200C94.93 200 120 225.1 120 256C120 286.9 94.93 312 64 312C33.07 312 8 286.9 8 256C8 225.1 33.07 200 64 200zM64 152C33.07 152 8 126.9 8 96C8 65.07 33.07 40 64 40C94.93 40 120 65.07 120 96C120 126.9 94.93 152 64 152z"/>
                    </svg>
                 </button>
              </div>
           </div>
           
           <div x-ref="chatMessages" id="chat-messages" class="flex flex-col max-w-xl bg-slate-100 dark:bg-midnight-500 space-y-2 p-3 overflow-y-auto dark:scrollbar-none dark:no-scrollbar scrollbar-thumb-blue scrollbar-thumb-rounded scrollbar-track-blue-lighter scrollbar-w-2 scrolling-touch pt-24 pb-36">
                @if (!empty($chats))
                    @foreach ($chats as $chat)
                      @php $next = $chats->get(++$loop->index); @endphp
                      @if ($chat->user_id === Auth::id())
                      <div class="chat-message-me relative">
                         <div class="flex items-end justify-end">
                            <div class="flex max-w-[85%] flex-col space-y-2 text-sm mx-2 order-1 items-end">
                               <div class="px-[12px] py-[4px] rounded-lg inline-block bg-blue-600 text-white">
                                   <span class="text-sm">{{ $chat->message }}</span>
                                   <div class="ml-1 float-right text-slate-300">
                                       <span class="text-[9px] mt-[1px]">{{ $chat->created_at->format('H:i') }}</span>
                                       @if ($chat->read)
                                       <svg class="fill-slate-300/90 inline-flex h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><g data-name="Layer 2"><g data-name="done-all"><rect width="24" height="24" opacity="0"/><path d="M16.62 6.21a1 1 0 0 0-1.41.17l-7 9-3.43-4.18a1 1 0 1 0-1.56 1.25l4.17 5.18a1 1 0 0 0 .78.37 1 1 0 0 0 .83-.38l7.83-10a1 1 0 0 0-.21-1.41zM21.62 6.21a1 1 0 0 0-1.41.17l-7 9-.61-.75-1.26 1.62 1.1 1.37a1 1 0 0 0 .78.37 1 1 0 0 0 .78-.38l7.83-10a1 1 0 0 0-.21-1.4z"/><path d="M8.71 13.06L10 11.44l-.2-.24a1 1 0 0 0-1.43-.2 1 1 0 0 0-.15 1.41z"/></g></g></svg>
                                       @else
                                       <svg class="fill-slate-300/80 inline-flex h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><g data-name="Layer 2"><g data-name="checkmark"><rect width="24" height="24" opacity="0"/><path d="M9.86 18a1 1 0 0 1-.73-.32l-4.86-5.17a1 1 0 1 1 1.46-1.37l4.12 4.39 8.41-9.2a1 1 0 1 1 1.48 1.34l-9.14 10a1 1 0 0 1-.73.33z"/></g></g></svg>
                                       @endif
                                   </div>
                               </div>
                            </div>
                         </div>
                         @if ($loop->last)
                             <svg class="absolute fill-blue-600 bottom-0 -mb-[1px] right-0 h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512" transform="rotate(-90)"><path d="M424.4 214.7L72.4 6.6C43.8-10.3 0 6.1 0 47.9V464c0 37.5 40.7 60.1 72.4 41.3l352-208c31.4-18.5 31.5-64.1 0-82.6z"/></svg>
                         @else
                            @if(!empty($next) && $next->user_id !== $chat->user_id)
                            <svg class="absolute bottom-0 -mb-[1px] right-0 fill-blue-600 h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512" transform="rotate(-90)"><path d="M424.4 214.7L72.4 6.6C43.8-10.3 0 6.1 0 47.9V464c0 37.5 40.7 60.1 72.4 41.3l352-208c31.4-18.5 31.5-64.1 0-82.6z"/></svg>
                            @endif
                         @endif
                      </div>
                      @else
                      <div class="chat-message-to relative">
                         <div class="flex items-end">
                            <div class="flex max-w-[85%] flex-col space-y-2 text-sm mx-2 order-2 items-start">
                               <div class="px-[12px] py-[4px] rounded-lg inline-block bg-gray-300 text-slate-800">
                                   <span class="text-sm">{{ $chat->message }}</span>
                                   <span class="text-[9px] ml-1 mt-[1px] float-right text-slate-600/80">{{ $chat->created_at->format('H:i') }}</span>
                               </div>
                            </div>
                         </div>
                        @if ($loop->last)
                            <svg class="absolute fill-gray-300 bottom-0 -mb-[1px] left-0 h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512" transform="rotate(-90)"><path d="M424.4 214.7L72.4 6.6C43.8-10.3 0 6.1 0 47.9V464c0 37.5 40.7 60.1 72.4 41.3l352-208c31.4-18.5 31.5-64.1 0-82.6z"/></svg>
                        @else
                            @if(!empty($next) && $next->user_id !== $chat->user_id)
                            <svg class="absolute fill-gray-300 bottom-0 -mb-[1px] left-0 h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512" transform="rotate(-90)"><path d="M424.4 214.7L72.4 6.6C43.8-10.3 0 6.1 0 47.9V464c0 37.5 40.7 60.1 72.4 41.3l352-208c31.4-18.5 31.5-64.1 0-82.6z"/></svg>
                            @endif
                        @endif
                      </div>
                      @endif
                    @endforeach
                @else
                    <div class="inline h-screen justify-center text-center opacity-60">
                        <x-illustrations.illustration-easter-egg-hunt class="inline"/>
                        <div class="-mt-8 md:-mt-20 mb-20 font-medium text-slate-700 dark:text-slate-300 items-center">
                            <span class="block text-md md:text-xl font-semibold">Belum ada chat</span>
                            <span class="block text-sm md:text-lg font-medium">Sapalah {{ $user->name }} untuk memulai obrolan.</span>
                        </div>
                    </div>
                @endif
           </div>
           
           <div class="bg-white dark:bg-midnight-300 fixed z-50 w-screen bottom-0 max-w-xl rounded px-4 py-4">
              <div class="flex items-center justify-between w-full"
                  x-data="{ resizeTextAreaMessageContent: () => { if (Number($refs.messageContent.style.height.replace('px', '')) < 160) { $refs.messageContent.style.height = $refs.messageContent.scrollHeight + 'px'; } } }"
              >
              
                  <button @click="console.log($refs.halohai)">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 text-gray-500" fill="none" viewBox="0 0 24 24"
                      stroke="currentColor">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M15.172 7l-6.586 6.586a2 2 0 102.828 2.828l6.414-6.586a4 4 0 00-5.656-5.656l-6.415 6.585a6 6 0 108.486 8.486L20.5 13" />
                    </svg>
                  </button>
                  
                  <textarea x-ref="messageContent"
                           x-init="resizeTextAreaMessageContent()"
                           @keyup="isTyping(); resizeTextAreaMessageContent()"
                           @blur="isNotTyping()"
                            class="block w-full py-2 pl-4 mx-3 bg-gray-100 dark:bg-midnight-40/30 rounded-lg resize-none outline-none text-gray-800 dark:text-gray-100 dark:focus:text-gray-200 focus:text-gray-700"
                            style="height:4px;"
                          @chat-message.window="$el.value = null;"
                          wire:ignore
                  ></textarea>
                  
                  <button @click="$wire.emit('sendMessage', $refs.messageContent.value); $refs.messageContent.value = null;">
                    <svg class="w-7 h-7 text-gray-500 origin-center transform rotate-90 active:scale-90" xmlns="http://www.w3.org/2000/svg"
                      viewBox="0 0 20 20" fill="currentColor">
                      <path
                        d="M10.894 2.553a1 1 0 00-1.788 0l-7 14a1 1 0 001.169 1.409l5-1.429A1 1 0 009 15.571V11a1 1 0 112 0v4.571a1 1 0 00.725.962l5 1.428a1 1 0 001.17-1.408l-7-14z" />
                    </svg>
                  </button>
              </div>
           </div>
        </div>
    </div>
    
</div>


@push('style')
<style>
.scrollbar-w-2::-webkit-scrollbar {
  width: 0.25rem;
  height: 0.25rem;
}

.scrollbar-track-blue-lighter::-webkit-scrollbar-track {
  --bg-opacity: 1;
  background-color: red;
  background-color: rgba(247, 250, 252, var(--bg-opacity));
}

.scrollbar-thumb-blue::-webkit-scrollbar-thumb {
  --bg-opacity: 1;
  background-color: #edf2f7;
  background-color: rgba(237, 242, 247, var(--bg-opacity));
}

.scrollbar-thumb-rounded::-webkit-scrollbar-thumb {
  border-radius: 0.25rem;
}
</style>
@endpush

@push('scripts')
<script>
	//const el = document.getElementById('chat-messages')
	//el.scrollTop = el.scrollHeight
	
/*
window.addEventListener("load",function() {
    
    if (!document.fullscreenElement) {
    	let fullScreen = document.documentElement.requestFullscreen();
    	console.log(fullScreen)
	}
})
	
document.querySelector('#chat').addEventListener('click', () => {
    
    if (!document.fullscreenElement) {
    	let fullScreen = document.documentElement.requestFullscreen();
    	console.log(fullScreen)
	}
});*/

</script>
@endpush