
    @section('title', ($state['username']) ? "{$state['name']} (@{$state['username']}) • Edit Profile" : "Pengguna (@{request()->username}) Tidak Ditemukan")
    
   <div class="max-w-3xl mx-auto sm:px-6 lg:px-8 scroll-smooth">
       
       <div class="bg-neutral-200 dark:bg-midnight-500/60 dark:text-neutral-100/80 border border-slate-300 dark:border-midnight-500 rounded-t-3xl md:rounded-3xl py-8 px-6 md:my-8">
           
            <!-- Header Profile Mobile -->
            <div class="flex justify-center">
                <div class="w-full md:w-11/12 md:my-9">
                    <div class="block md:flex md:items-start md:justify-center">
                        
                        <div class="w-full float-center md:w-1/2 md:mt-8 flex justify-center">
                            
                            
                            <form wire:submit.prevent="savedPhoto">
                                <div x-data="{photoName: null, photoPreview: null}" class="col-span-6 sm:col-span-4">
                                    <!-- Profile Photo File Input -->
                                    <input type="file" class="hidden"
                                                wire:model="photo"
                                                x-ref="photo"
                                                x-on:change="
                                                        photoName = $refs.photo.files[0].name;
                                                        const reader = new FileReader();
                                                        reader.onload = (e) => {
                                                            photoPreview = e.target.result;
                                                        };
                                                        reader.readAsDataURL($refs.photo.files[0]);
                                                " />
                        
                                    <!-- Current Profile Photo -->
                                    <div class="mb-0 flex justify-center"  x-show="! photoPreview">
                                        <div class="w-40 h-auto flex justify-center">
                                            <img src="{{ Auth::user()->profile_photo_url }}" 
                                                alt="{{ Auth::user()->username }}"
                                                class="my-5 md:my-8 w-40 h-40 object-cover cursor-zoom-in rounded-full shadow-xl" 
                                                wire:click='$emit("openModal", "components.modals-profile-photos", {{ json_encode([$state["profile_photo_url"]]) }})'
                                            >
                                        </div>
                                    </div>
                                    
                                     <!-- New Profile Photo Preview -->
                                    <div class="mb-12 mt-0 flex justify-center" x-show="photoPreview" style="display: none;">
                                        <div class="w-40 h-40 flex justify-center items-start">
                                            <span class="block rounded-full w-40 h-40 my-5 md:my-8 shadow-lg bg-cover bg-no-repeat bg-center cursor-zoom-in"
                                                  x-bind:style="'background-image: url(\'' + photoPreview + '\');'"
                                                  wire:click='$emit("openModal", "components.modals-profile-photos", {{ $photo ? json_encode([$photo->temporaryUrl()]) : json_encode([Auth::user()->profile_photo_url]) }})'>
                                            </span>
                                        </div>
                                    </div>
                                    
                                    <div class="w-full">
                                        <x-jet-action-message class="text-center text-blue-500 mb-2" on="photo-profile-saved">
                                            {{ __('Foto Profil Berhasil Di Perbarui.') }}
                                        </x-jet-action-message>
                                        <x-jet-action-message class="text-center text-blue-500 mb-2" on="photo-profile-deleted">
                                            {{ __('Foto Profil Berhasil Di Hapus.') }}
                                        </x-jet-action-message>
                                    </div>
                                    
                                    <div class="w-full flex justify-center">
                                        <x-buttons.button-secondary class="mx-2 uppercase" type="button" x-on:click.prevent="$refs.photo.click()"  x-show="! photoPreview">
                                            {{ __('Ubah') }}
                                        </x-buttons.button-secondary>
                                        <x-buttons.button-danger class="mx-2 uppercase" type="button" wire:click="deleteProfilePhoto"  x-show="! photoPreview">
                                            {{ __('Hapus') }}
                                        </x-buttons.button-danger>
                                    </div>
                                    
                                    
                                    @error('photo')
                                        <div class="flex grid grid-cols items-center text-center">
                                            <span class="error text-red-500 text-center text-xs">{{ $message }}</span>
                                            <x-buttons.button-bunglon class="mt-2 uppercase" type="button" x-on:click.prevent="$refs.photo.click()"  x-show="photoPreview">
                                                {{ __('Pilih Foto Yang lain') }}
                                            </x-buttons.button-bunglon>
                                        </div>
                                    @else
                                        <x-buttons.button-primary class="uppercase hidden" x-data="" x-ref="saveAsPhotoProfileBtn" x-init="$refs.saveAsPhotoProfileBtn.classList.remove('hidden')" type="submit" x-show="photoPreview" @click="setTimeout(() => { photoPreview = null }, 250);">
                                            {{ __('Simpan Sebagai Foto Profile') }}
                                        </x-buttons.button-primary>
                                    @enderror
                                    
                                </div>
                            </form>
                            
                        </div>
                        
                        
                        
                        <div class="w-full md:w-4/6">
                            <form wire:submit.prevent="save" >
                                <div class="mt-6">
                                    <x-jet-label for="name" value="{{ __('Nama') }}" />
                                    <x-jet-input id="name" class="block mt-1 w-full" type="text" name="name" required autofocus wire:model.defer="state.name"/>
                                    <x-jet-input-error for="name" class="mt-2" />
                                </div>
                                <div class="mt-6">
                                    <x-jet-label for="username" value="{{ __('Username') }}" />
                                    <x-jet-input id="username" class="block mt-1 w-full" type="text" name="username" :value="old('username', Auth::user()->username)" required wire:model.defer="state.username"/>
                                    <x-jet-input-error for="username" class="mt-2" />
                                </div>
                                
                                <div class="mt-6">
                                    <x-jet-label for="biography" value="{{ __('Bio') }}" />
                                    <textarea class="block w-full resize-y border-gray-300 dark:text-midnight-800 dark:bg-neutral-400 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm"
                                   wire:model.defer="state.biography" 
                                                 id="biography" 
                                               name="biography"
                                             x-data="{ resize: () => { $el.style.height = '20px'; $el.style.height = ($el.scrollHeight + 20) + 'px';} }"
                                             x-init="resize"
                                             x-on:input="resize"
                                    >
                                        {{ old('biography', Auth::user()->biography) }}
                                    </textarea>
                                    <x-jet-input-error for="biography" class="mt-2" />
                                </div>
                                
                                <div class="mt-12">
                                        <x-jet-action-message class="float-right text-blue-500 mb-3" on="profile-saved">
                                        {{ __('Perubahan Berhasil Di Simpan.') }}
                                        </x-jet-action-message>
                                    <div class="flex justify-between w-full">
                                        <x-buttons.button-bunglon class="float-left uppercase" type="button" onclick="window.location='/{{ $state['username'] }}'">
                                            <i class="fa-solid fa-arrow-left mr-2"></i>Kembali
                                        </x-buttons.button-bunglon>
                                        <x-buttons.button-primary type="submit" class="float-right uppercase">
                                            <i class="fa-solid fa-save mr-2"></i>Simpan
                                        </x-buttons.button-primary>
                                    </div>
                                </div>
                                
                            </form>
                        </div>
                    
                    </div>
                </div>
            </div>
            
            
            
       </div>
   </div>
    
    <!-- <div class="relative bg-transparent">
        <img class="rounded-t-xl cursor-pointer" src="https://www.dwinawan.com/blog/thumb_article19.jpg" alt="">
    </div>
    <div class="absolute top-41 -z-50 t-5 left-0 ...">
        <img  class="w-16 rounded-full shadow-xl" src="http://localhost:8000/img/logo.png" alt="">
    </div> -->
    
   