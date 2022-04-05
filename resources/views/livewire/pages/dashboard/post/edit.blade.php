<div class="max-w-3xl mx-auto px-4 md:px-6 lg:px-8">
    
    @if (!empty($this->replyToPost))
        <div class="flex w-full justify-center mb-4" x-data="" x-ref="replyPost">
            <div class="flex w-11/12 px-4 py-3 text-slate-600 dark:text-slate-400  bg-neutral-200 dark:bg-midnight-400 rounded">
                <div class="block w-full">
                    <div class="flex w-full relative">
                        <span class="absolute close-error top-0 bottom-0 right-0 -mr-4" @click="cancelReplyPost($refs.replyPost)">
                            <svg class="fill-current h-5 w-5 text-red-500" role="button" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><title>Cancel Reply Post</title><path d="M14.348 14.849a1.2 1.2 0 0 1-1.697 0L10 11.819l-2.651 3.029a1.2 1.2 0 1 1-1.697-1.697l2.758-3.15-2.759-3.152a1.2 1.2 0 1 1 1.697-1.697L10 8.183l2.651-3.031a1.2 1.2 0 1 1 1.697 1.697l-2.758 3.152 2.758 3.15a1.2 1.2 0 0 1 0 1.698z"/></svg>
                        </span>
                        <p class="text-xs">Membalas Postingan <a class="text-blue-500" target="_blank" href="/{{ $this->replyToPost->user->username }}">{{ $this->replyToPost->user->name }}</a></p>
                    </div>
                    <ul role="list" class="divide-y divide-slate-200 dark:divide-slate-700">
                        <li class="py-3 sm:py-4">
                            <div class="flex items-center space-x-4">
                                <div class="flex-shrink-0">
                                    <img class="w-8 h-8 object-cover rounded-lg" src="{{ asset($this->replyToPost->cover) }}" alt="{{ $this->replyToPost->title }}">
                                </div>
                                <div class="flex-1 min-w-0">
                                    <p class="text-sm font-medium text-gray-900 truncate dark:text-white">
                                        {{ $this->replyToPost->title }}
                                    </p>
                                    <p class="text-sm text-gray-500 truncate dark:text-gray-400">
                                        {{ $this->replyToPost->user->name.'(@'.$this->replyToPost->user->username.')' }}
                                    </p>
                                </div>
                                <div class="inline-flex items-center text-base font-semibold text-gray-900 dark:text-white">
                                    <x-buttons.button-primary type="button" onclick="window.open('/posts/{{ $this->replyToPost->slug }}', '_blank')">
                                        Lihat
                                    </x-buttons.button-primary>
                                </div>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    @endif
    
    <div class="flex justify-center">
        <h1 class="text-2xl @if (empty($post->parent)) mt-4 @endif mb-8 font-bold text-slate-800 dark:text-slate-200">Edit Post</h1>
    </div>
    
    <form wire:submit.prevent="store(Object.fromEntries(new FormData($event.target)))">
        <div class="flex justify-center">
            
            <div class="block w-11/12 md:flex md:gap-4 mb-8">
    
                <div class="block md:flex md:w-1/2">
                    <div class="w-full block">
                    
                        <div class="mb-4">
                            <label class="block mb-2 font-ubuntu text-slate-600 dark:text-slate-400 text-md font-medium mb-2" 
                                     for="title"
                            >
                                Judul
                            </label>
                            <input class="focus:ring-indigo-500 focus:border-indigo-500 bg-neutral-400 dark:focus:ring-indigo-700/80 dark:focus:bg-slate-900 dark:focus:border-indigo-700/80 text-slate-700 dark:text-slate-200 placeholder:text-slate-500 dark:placeholder:text-slate-400 block w-full px-4 sm:text-sm border-neutral-400 dark:border-midnight-500 dark:bg-midnight-500 dark:focus:bg-midnight-700 rounded-md @error('judul') border-red-500 dark:border-red-500 @enderror"
                                      id="title"
                                    name="judul"
                                    type="text"
                             placeholder="Judul"
                              wire:keyup="createSlug($event.target.value)"
                              wire:model="judul"
                            >
                            @error('judul') <span class="text-xs text-red-500">{{ $message }}</span> @enderror
                        </div>
                    
                        <div class="mb-4">
                            <label class="block mb-2 font-ubuntu text-slate-600 dark:text-slate-400 text-md font-medium mb-2" 
                                     for="slug"
                            >
                                Slug
                            </label>
                            <input class="focus:ring-indigo-500 focus:border-indigo-500 bg-neutral-400 dark:focus:ring-indigo-700/80 dark:focus:bg-slate-900 dark:focus:border-indigo-700/80 text-slate-700 dark:text-slate-200 placeholder:text-slate-500 dark:placeholder:text-slate-400 block w-full px-4 sm:text-sm border-neutral-400 dark:border-midnight-500 dark:bg-midnight-500 dark:focus:bg-midnight-700 rounded-md @error('slug') border-red-500 dark:border-red-500 @enderror"
                                      id="slug"
                                    name="slug"
                                    type="text"
                             placeholder="Slug"
                              wire:model="slug"
                            >
                            @error('slug') <span class="text-xs text-red-500">{{ $message }}</span> @enderror
                        </div>
                    
                        <div class="mb-4">
                            <label class="block mb-2 font-ubuntu text-slate-600 dark:text-slate-400 text-md font-medium mb-2" 
                                     for="category"
                            >
                                Kategory
                            </label>
                            <select class="focus:ring-indigo-500 focus:border-indigo-500 bg-neutral-400 dark:focus:ring-indigo-700/80 dark:focus:bg-slate-900 dark:focus:border-indigo-700/80 text-slate-700 dark:text-slate-200 placeholder:text-slate-500 dark:placeholder:text-slate-400 block w-full px-4 sm:text-sm border-neutral-400 dark:border-midnight-500 dark:bg-midnight-500 dark:focus:bg-midnight-700 rounded-md"
                                      id="category"
                                    name="category_id"
                              wire:model="category_id"
                            >
                                @foreach ($allCategories as $category)
                                    
                                        <option @if ($category->id === $category_id) selected="" @endif value="{{ $category->id }}">{{ $category->name }}</option>
                                    
                                @endforeach
                            </select>
                        </div>
                    
                        <div class="mb-4">
                            <div>
                                <label class="block mb-2 font-ubuntu text-slate-600 dark:text-slate-400 text-md font-medium mb-2" 
                                         for="tag"
                                >
                                    Tags
                                </label>
                                <div class="bg-neutral-200 dark:bg-midnight-400 rounded" id="tags">
                                    <div class="flex bg-neutral-400 dark:bg-midnight-500 rounded-t">
                                        <select x-cloak class="w-full py-3" id="select">
                                        @foreach ($allTags as $tag)
                                            <option value="{{ $tag->id }}">#{{ $tag->name }}</option>
                                        @endforeach
                                        </select>
                                        <div x-data="dropdown()" x-init="loadOptions()" class="w-full flex flex-col items-center h-auto mx-auto">
                                          <input name="tags" type="hidden" x-bind:value="selectedValues()">
                                          <div class="inline-block relative w-full">
                                            <div class="flex flex-col items-center relative">
                                              <div x-on:click="open" class="w-full">
                                                <div class="flex border border-neutral-200 bg-neutral-400 dark:bg-midnight-500 dark:border-midnight-400 rounded">
                                                  <div class="flex flex-auto flex-wrap">
                                                    <template x-for="(option,index) in selected" :key="options[option].value">
                                                      <div class="flex justify-center items-center m-1 font-medium py-1 px-1 rounded bg-white dark:bg-neutral-400 border dark:border-slate-300">
                                                        <div class="text-xs font-normal leading-none max-w-full flex-initial x-model=" options[option] x-text="options[option].text"></div>
                                                        <div class="flex flex-auto flex-row-reverse">
                                                          <div x-on:click.stop="remove(index,option)">
                                                            <svg class="fill-current h-4 w-4 " role="button" viewBox="0 0 20 20">
                                                              <path d="M14.348,14.849c-0.469,0.469-1.229,0.469-1.697,0L10,11.819l-2.651,3.029c-0.469,0.469-1.229,0.469-1.697,0
                                                                                   c-0.469-0.469-0.469-1.229,0-1.697l2.758-3.15L5.651,6.849c-0.469-0.469-0.469-1.228,0-1.697s1.228-0.469,1.697,0L10,8.183
                                                                                   l2.651-3.031c0.469-0.469,1.228-0.469,1.697,0s0.469,1.229,0,1.697l-2.758,3.152l2.758,3.15
                                                                                   C14.817,13.62,14.817,14.38,14.348,14.849z" />
                                                            </svg>
                                        
                                                          </div>
                                                        </div>
                                                      </div>
                                                    </template>
                                                    <div x-show="selected.length == 0" class="flex-1">
                                                      <input placeholder="Pilih tags" class="bg-transparent appearance-none px-3 py-3 outline-none h-full w-full text-gray-800 dark:placeholder:text-slate-400" x-bind:value="selectedValues()">
                                                    </div>
                                                  </div>
                                                  <div class="text-gray-300 dark:text-gray-700/50 w-8 py-1 pl-2 pr-1 border-l flex items-center border-gray-200 dark:border-gray-600/20 svelte-1l8159u">
                                        
                                                    <button type="button" x-show="isOpen() === true" x-on:click="open" class="cursor-pointer w-6 h-6 text-gray-600 outline-none focus:outline-none">
                                                      <svg version="1.1" class="fill-current h-4 w-4" viewBox="0 0 20 20">
                                                        <path d="M17.418,6.109c0.272-0.268,0.709-0.268,0.979,0s0.271,0.701,0,0.969l-7.908,7.83
                                                    	c-0.27,0.268-0.707,0.268-0.979,0l-7.908-7.83c-0.27-0.268-0.27-0.701,0-0.969c0.271-0.268,0.709-0.268,0.979,0L10,13.25
                                                    	L17.418,6.109z" />
                                                      </svg>
                                        
                                                    </button>
                                                    <button type="button" x-show="isOpen() === false" @click="close" class="cursor-pointer w-6 h-6 text-gray-600 outline-none focus:outline-none">
                                                      <svg class="fill-current h-4 w-4" viewBox="0 0 20 20">
                                                        <path d="M2.582,13.891c-0.272,0.268-0.709,0.268-0.979,0s-0.271-0.701,0-0.969l7.908-7.83
                                                    	c0.27-0.268,0.707-0.268,0.979,0l7.908,7.83c0.27,0.268,0.27,0.701,0,0.969c-0.271,0.268-0.709,0.268-0.978,0L10,6.75L2.582,13.891z
                                                    	" />
                                                      </svg>
                                        
                                                    </button>
                                                  </div>
                                                </div>
                                              </div>
                                              <div class="w-full px-4">
                                                <div x-show.transition.origin.top="isOpen()" class="absolute shadow-lg top-100 bg-neutral-200 dark:bg-midnight-400 my-2 z-40 w-full left-0 rounded max-h-select" x-on:click.away="close">
                                                  <div class="flex flex-col w-full overflow-y-auto h-64">
                                                    <template x-for="(option,index) in options" :key="index" class="overflow-auto">
                                                      <div class="cursor-pointer w-full border-slate-300 dark:border-slate-700 rounded-t border-b hover:bg-slate-200 dark:hover:bg-midnight-200"
                                                          @click="select(index,$event)"
                                                      >
                                                        <!-- xxxxxxxx -->
                                                        <div class="flex w-full items-center p-2 pl-2 border-transparent border-l-2 relative">
                                                          <div class="w-full items-center flex justify-between">
                                                            <div class="mx-2 leading-6 text-gray-700 dark:text-slate-200" x-model="option" x-text="option.text"></div>
                                                            <div x-show="option.selected">
                                                              <svg class="svg-icon dark:svg-icon" viewBox="0 0 20 20">
                                                                <path fill="none" d="M7.197,16.963H7.195c-0.204,0-0.399-0.083-0.544-0.227l-6.039-6.082c-0.3-0.302-0.297-0.788,0.003-1.087
                                        							C0.919,9.266,1.404,9.269,1.702,9.57l5.495,5.536L18.221,4.083c0.301-0.301,0.787-0.301,1.087,0c0.301,0.3,0.301,0.787,0,1.087
                                        							L7.741,16.738C7.596,16.882,7.401,16.963,7.197,16.963z"></path>
                                                              </svg>
                                                            </div>
                                                          </div>
                                                        </div>
                                                      </div>
                                                    </template>
                                                  </div>
                                                </div>
                                              </div>
                                            </div>
                                          </div>
                                        </div>
                                    </div>
                                    <div class="flex mx-3 items-center justify-between py-4"
                                        x-data="{ createTag: false, tagCreated: false }"
                                    >
                                        <div x-show="! createTag" class="block w-full">
                                            <div class="flex w-full" x-show="tagCreated">
                                                <x-jet-action-message class="text-center text-blue-500 mb-2" on="tag-created">
                                                    {{ __('Tag berhasil dibuat, silahkan refresh untuk menggunakan tag yang baru saja dibuat.') }}
                                                </x-jet-action-message>
                                            </div>
                                            
                                            <div class="flex w-full" x-show="!tagCreated">
                                                <p class="text-slate-600 dark:text-slate-300/80">Tag yang kamu inginkan tidak ada?</p>
                                                <button @tag-created.window="createTag = false, tagCreated = true" @click="createTag = true" type="button" class="inline-flex h-8 items-center cursor-pointer px-2 py-2 text-sm md:text-md px-3 py-2 leading-4 bg-slate-500 dark:bg-slate-600 border border-transparent rounded-md font-semibold text-white hover:bg-slate-700 dark:hover:bg-slate-700 active:bg-slate-400 dark:active:bg-slate-500 focus:outline-none focus:ring focus:ring-slate-300/50 dark:focus:ring-slate-600/20 disabled:opacity-85 transition disabled:cursor-not-allowed disabled:opacity-70 disabled:hover:bg-slate-500 dark:disabled:bg-slate-600 ml-auto">
                                                    {{ __('Buat') }}
                                                </button>
                                            </div>
                                        </div>
                                        
                                        <div class="block w-full" x-show="createTag">
                                            <div class="flex w-full">
                                                
                                                <input class="inline-flex mr-4 focus:ring-indigo-500 focus:border-indigo-500 bg-neutral-400 dark:focus:ring-indigo-700/80 dark:focus:bg-slate-900 dark:focus:border-indigo-700/80 text-slate-700 dark:text-slate-200 placeholder:text-slate-500 dark:placeholder:text-slate-400 block w-full px-4 sm:text-sm border-neutral-400 dark:border-midnight-500 dark:bg-midnight-500 dark:focus:bg-midnight-700 rounded-md @error('name') border-red-500 dark:border-red-500 @enderror"
                                                          id="createTag"
                                                        name="createTag"
                                                        type="text"
                                                 placeholder="Buat Tag"
                                                  wire:keyup="createSlugTag($event.target.value)"
                                                  wire:model="createTag"
                                                >
                                                <input type="hidden" 
                                                         id="createTagSlug"
                                                       name="createTagSlug"
                                                 wire:model="createTagSlug"
                                                >
                                                <button wire:loading.attr="disabled" wire:click="saveTag" type="button" class="inline-flex h-8 my-auto items-center cursor-pointer px-2 py-2 text-sm md:text-md px-3 py-2 leading-4 bg-slate-500 dark:bg-slate-600 border border-transparent rounded-md font-semibold text-white hover:bg-slate-700 dark:hover:bg-slate-700 active:bg-slate-400 dark:active:bg-slate-500 focus:outline-none focus:ring focus:ring-slate-300/50 dark:focus:ring-slate-600/20 disabled:opacity-85 transition disabled:cursor-not-allowed disabled:hover:bg-slate-500 dark:disabled:bg-slate-600 disabled:opacity-30">
                                                    {{ __('Buat') }}
                                                </button>
                                            </div>
                                            <div class="flex w-full">
                                                @error('name') <span class="text-xs mt-2 text-red-500">{{ $message }}</span> @enderror
                                            </div>
                                        </div>
                                        
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="mb-4 md:mb-0">
                            <label class="block mb-2 font-ubuntu text-slate-600 dark:text-slate-400 text-md font-medium mb-2" 
                                     for="published"
                            >
                                Status
                            </label>
                            <select class="focus:ring-indigo-500 focus:border-indigo-500 bg-neutral-400 dark:focus:ring-indigo-700/80 dark:focus:bg-slate-900 dark:focus:border-indigo-700/80 text-slate-700 dark:text-slate-200 placeholder:text-slate-500 dark:placeholder:text-slate-400 block w-full px-4 sm:text-sm border-neutral-400 dark:border-midnight-500 dark:bg-midnight-500 dark:focus:bg-midnight-700 rounded-md"
                                      id="published"
                                    name="published"
                              wire:model="published"
                              wire:ignore
                            >
                                
                                <option @if ($published) 'selected="selected"' @endif value="0">Draft</option>
                                <option @if ($published) 'selected="selected"' @endif value="1">Publish</option>
                            </select>
                        </div>
                        
                    </div>
                </div>
                
                <div class="block md:flex md:w-1/2">
                    <div class="w-full h-full block">
                    
                        <div class="h-full mb-4 pb-8">
                            <label class="block mb-2 font-ubuntu text-slate-600 dark:text-slate-400 text-md font-medium mb-2" 
                                     for="cover"
                            >
                                Cover
                            </label>
                            @error('cover') <span class="text-xs text-red-500">{{ $message }}</span> @enderror
                            <div class="flex py-5 bg-neutral-400 text-slate-700 dark:text-slate-200 block w-full h-full px-4 sm:text-sm border-neutral-400 dark:border-midnight-500 dark:bg-midnight-500 rounded-md @error('cover') border border-red-500 dark:border-red-500 @enderror" id="cover">
                                
                                <div class="block w-full text-center justify-center"
                                    x-data="{coverName: null, coverPreview: null}"
                                >
                                    
                                    
                                    
                                    <!-- Cover Post File Input -->
                                    <input type="file" class="hidden"
                                           name="cover"
                                     wire:model="cover"
                                          x-ref="cover"
                                        x-on:change="
                                                coverName = $refs.cover.files[0].name;
                                                const reader = new FileReader();
                                                reader.onload = (e) => {
                                                    coverPreview = e.target.result;
                                                };
                                                reader.readAsDataURL($refs.cover.files[0]);"
                                    />
                                    
                                    
                                    
                                    <div class="w-full block text-center justify-center">
                                        @if (!$cover)
                                        <div class="@error('cover') border-red-400 @enderror bg-neutral-200 dark:bg-midnight-500 py-20 rounded-md text-center justify-center border border-slate-500 dark:border-slate-400 border-dashed" x-show="! coverPreview">
                                            <p class="mb-3 mx-4">Pilih foto untuk dijadikan sampul dari postinganmu</p>
                                            <button class="inline-flex items-center text-sm md:text-md text-center uppercase tracking-widest px-3 py-2 border border-grenteel-200/10 leading-4 font-medium rounded text-gray-800 dark:text-slate-100 bg-slate-300 hover:shadow-grenteel-300 hover:text-white focus:outline-none dark:bg-slate-600 active:bg-slate-700/60 active:text-gray-300 focus:ring focus:ring-slate-500/10 cursor-pointer disabled:opacity-85 transition disabled:cursor-not-allowed disabled:opacity-70"
                                                     type="button" x-on:click.prevent="$refs.cover.click()"  
                                            >
                                                {{ __('Pilih Foto') }}
                                            </button>
                                        </div>
                                        @else
                                        <button class="inline-flex items-center text-sm md:text-md text-center uppercase tracking-widest px-3 py-2 border border-grenteel-200/10 leading-4 font-medium rounded text-gray-800 dark:text-slate-100 bg-slate-300 hover:shadow-grenteel-300 hover:text-white focus:outline-none dark:bg-slate-600 active:bg-slate-700/60 active:text-gray-300 focus:ring focus:ring-slate-500/10 cursor-pointer disabled:opacity-85 transition disabled:cursor-not-allowed disabled:opacity-70"
                                                 type="button" x-on:click.prevent="$refs.cover.click()" 
                                        >
                                            {{ __('Ganti') }}
                                        </button>
                                        @endif
                                    </div>
                                    
                                    <!-- New Profile Photo Preview -->
                                    <div class="w-full justify-center mt-0 block justify-center" x-show="coverPreview" style="display: none;">
                                        <div class="w-full h-full flex justify-center items-start">
                                            <span class="block w-full h-52 my-5 md:my-8 shadow-lg object-cover bg-cover bg-no-repeat bg-center cursor-zoom-in @error('cover') border border-red-400 @enderror"
                                                  x-bind:style="'background-image: url(\'' + coverPreview + '\');'"
                                            </span>
                                        </div>
                                    </div>
                                    
                                    <!-- Current Cover Post -->
                                    @if ($cover)
                                    <div class="w-full justify-center mt-0 block justify-center"  x-show="! coverPreview">
                                        <div class="w-full h-full flex justify-center items-start">
                                            <img src="{{ asset($cover) }}" 
                                                alt="{{ $judul }}"
                                                class="w-full h-52 object-cover cursor-zoom-in my-5 md:my-8 shadow-lg" 
                                                wire:click='$emit("openModal", "components.modals-profile-photos", {{ json_encode([asset($cover)]) }})'
                                            >
                                        </div>
                                    </div>
                                    @endif
                                </div>
                            </div>
                            
                        </div>
                    </div>
                </div>
                
            </div>
        </div>
        
        <div class="flex justify-center">
            <div class="block md:flex w-11/12">
                <div class="w-full block">
                    <div class="mb-4">
                        <label class="block mb-2 font-ubuntu text-slate-600 dark:text-slate-400 text-md font-medium mb-2" 
                                 for="content"
                        >
                            Konten 
                        </label>
                        @error('konten') <span class="text-xs text-red-500">{{ $message }}</span> @enderror
                        <input type="hidden" 
                                 id="content"
                               name="konten"
                               wire:model="konten"
                        >
                        <div class="block rounded-md w-full bg-neutral-400 text-slate-800 border border-[#dadde6] dark:border-slate-600"
                                id="editor"
                              wire:ignore
                        >
                        </div>
                        <!-- <div class="block w-full focus:ring-indigo-500 h-full py-4 focus:border-indigo-500 bg-neutral-400 dark:focus:ring-indigo-700/80 dark:focus:bg-slate-900 dark:focus:border-indigo-700/80 text-slate-700 dark:text-slate-200 placeholder:text-slate-500 dark:placeholder:text-slate-400 block w-full px-4 sm:text-sm border-neutral-400 dark:border-midnight-500 dark:bg-midnight-500 dark:focus:bg-midnight-700 rounded-md"
                        >
                            <input type="hidden" name="content" id="content">
                            
                        </div> -->
                    </div>
                    <div>
                        <div>
                            @if ($errors->any())
                                <x-buttons.button-primary type="button" class="my-8 float-right" wire:loading.remove disabled wire:target="store">
                                    Save <i class="fa-solid fa-save ml-2"></i>
                                </x-buttons.button-primary>
                            @else
                                <x-buttons.button-primary type="submit" class="my-8 float-right" wire:loading.remove wire:target="store">
                                    Save <i class="fa-solid fa-save ml-2"></i>
                                </x-buttons.button-primary>
                            @enderror
                            <x-buttons.button-primary type="button" class="my-8 float-right" disabled wire:loading wire:target="store">
                                <div class="flex px-2 justify-center">
                                    <div style="border-top-color:transparent"
                                        class="w-4 h-4 border-2 border-blue-200 border-solid rounded-full animate-spin"></div>
                                </div>
                            </x-buttons.button-primary>
                            
                        </div>
                        </div>
                            <x-buttons.button-bunglon wire:click="redirectToDashboardPost" type="button" class="my-8 float-left" wire:loading.remove wire:target="redirectToDashboardPost">
                                <i class="fa-solid fa-arrow-left mr-2"></i> Kembali
                            </x-buttons.button-bunglon>
                            <x-buttons.button-bunglon type="button" class="my-8 float-left whitespace-nowrap" disabled wire:loading wire:target="redirectToDashboardPost">
                                <i class="fa-solid fa-circle-notch fa-spin"></i> Kembali
                            </x-buttons.button-bunglon>
                        <div>
                    </div>
                    
                </div>
            </div>
        </div>
    </form>
</div>


<!-- Push Style -->
@push('style')
<link rel="stylesheet" href="{{ asset('vendor/toastui/editor/toastui-editor.css') }}" />
<link rel="stylesheet" href="{{ asset('vendor/toastui/editor/toastui-editor-dark.css') }}"/>
<link rel="stylesheet" href="{{ asset('vendor/toastui/plugins/toastui-editor-plugin-code-syntax-highlight.min.css') }}"/>
<link rel="stylesheet" href="{{ asset('vendor/katex/katex.min.css') }}">
<link rel="stylesheet" href="{{ asset('vendor/katex/contrib/copy-tex.css') }}">
@endpush

<!-- Push Script -->
@push('scripts')
<!-- Editor -->
<script src="{{ asset('vendor/toastui/editor/toastui-editor-all.min.js') }}"></script>
<!-- Prism.js -->
<script src="{{ asset('vendor/prism/prism.js') }}"></script>
<!-- Editor's Plugin -->
<script src="{{ asset('vendor/toastui/plugins/toastui-editor-plugin-code-syntax-highlight-all.min.js') }}"></script>
<script src="{{ asset('vendor/toastui/plugins/toastui-editor-plugin-uml.min.js') }}"></script>
<!-- Katex.js -->
<script src="{{ asset('vendor/katex/katex.min.js') }}"></script>
<script src="{{ asset('vendor/katex/contrib/copy-tex.js') }}"></script>

<script type="text/javascript">

function cancelReplyPost(componentReplyPost) {
    Swal.fire({
        title: '<h5 class="text-midnight-800 dark:text-slate-100">Apakah kamu yakin?</h5>',
        html: `<div><p class="text-midnight-800/70 dark:text-slate-400">Kamu ingin membatalkan membalas postingan ini?</p><p class="mt-4 text-xs text-midnight-800/50 dark:text-slate-400/80">Tindakan ini akan membuat postinganmu berdiri sendiri tanpa membalas postingan lain.</p></div>`,
        showCloseButton: true,
        showConfirmButton: true,
        confirmButtonText: 'Batalkan Balas',
        showCancelButton: false,
        //cancelButtonText: 'Batal',
        focusConfirm: false,
        background: (localStorage.theme === 'light') ? '#f3f6fe' : '#20315a', 
    }).then((result) => {
        if (result.value === true) {
            Livewire.emit('cancelReplyPost');
        }
    })
}

function dropdown() {
    return {
        defaultValue: @js($post->tags),
        options: [],
        selected: [],
        show: false,
        open() { this.show = true },
        close() { this.show = false },
        isOpen() { return this.show === true },
        select(index, event) {

            if (!this.options[index].selected) {
                this.options[index].selected = true;
                this.options[index].element = event.target;
                this.selected.push(index);

            } else {
                this.selected.splice(this.selected.lastIndexOf(index), 1);
                this.options[index].selected = false
            }
            
        },
        remove(index, option) {
            this.options[option].selected = false;
            this.selected.splice(index, 1);


        },
        loadOptions() {
            // console.log(this.defaultValue)
            const options = document.getElementById('select').options;
            
            for (let i = 0; i < options.length; i++) {
                
                this.options.push({
                    value: options[i].value,
                    text: options[i].innerText,
                    selected: options[i].getAttribute('selected') != null ? options[i].getAttribute('selected') : false
                });
                
                
                if (this.defaultValue !== undefined || this.defaultValue.length != 0) {
                    for (let j = 0; j < this.defaultValue.length; j++) {
                        if (options[i].value == this.defaultValue[j].id) {
                            this.options[i].selected = true;
                            this.selected.push(i);
                            // console.log(option[i].value, this.defaultValue[j].id);
                        }
                    }
                }
                
            }
            

        },
        selectedValues(){
            return this.selected.map((option)=>{
                return this.options[option].value;
            })
        }
    }
}

Prism.manual = false;

const Editor = toastui.Editor;
const { codeSyntaxHighlight, uml, chart } = Editor.plugin;

let renderer = {
    codeBlock(node, { origin }) {
        
        let result = origin()
        result.unshift({ type: 'openTag', tagName: 'div', classNames: ["wrapper-pre-editor"] })
        result.push({ type: 'closeTag', tagName: 'div' })
        
        //console.log(result)
        return result;
    },
    latex(node) {
        let latex =  katex.renderToString(node.literal, {
            throwOnError: false
        });
      
      return [
        { type: 'openTag', tagName: 'div', outerNewLine: true },
        { type: 'html', content: latex },
        { type: 'closeTag', tagName: 'div', outerNewLine: true }
      ];
    }
};

let post = {!! $post !!};
let content = post.content;
//content = content.replaceAll(/=-=/g, '\u0060');
//content = content.replaceAll(/\u0060\u0060\u0060}/g, '\u0060\u0060\u0060');


const editor = new Editor({
    el: document.querySelector('#editor'),
    previewStyle: 'tab',
    toolbarItems: [
        ['heading', 'bold', 'italic', 'strike'],
        ['hr', 'quote'],
        ['ul', 'ol', 'task', 'indent', 'outdent'],
        ['table', 'image', 'link'],
        ['code', 'codeblock'],
    ],
    height: '650px',
    placeholder: 'Tuliskan cerita maupun ide kreatif mu disini!',
    initialValue: content,
    customHTMLRenderer: renderer,
    plugins: [uml, [codeSyntaxHighlight, { highlighter: Prism }]],
    theme: localStorage.theme,
});

document.addEventListener('livewire:load', function () {
    document.querySelector('#editor').addEventListener('keyup', () => {
        
        let markdown = editor.getMarkdown();
        //markdown = markdown.replaceAll(/\u0060/g, "=-=");
        //let containerContent = document.querySelector('#content')
        //containerContent.value = markdown;
        
        @this.set('konten', markdown);
    });
    
    window.addEventListener('create-tag', (event) => {
       if (event.detail.status == 'success') {
           console.log(event.detail)
       }
    });
    
    
});

window.addEventListener('cancel-reply-post', event => {
    const Toast = Swal.mixin({
        toast: true,
        position: 'top-end',
        showConfirmButton: false,
        timer: 10000,
        timerProgressBar: true,
        didOpen: (toast) => {
            toast.addEventListener('mouseenter', Swal.stopTimer)
            toast.addEventListener('mouseleave', Swal.resumeTimer)
        }
    });
    
    if (event.detail.status === 'canceled') {
        Toast.fire({
            icon: 'success',
            title: "Balas postingan berhasil dibatalkan"
        })
    }
});
</script>
@endpush










