<div>
    
    <div class="flex justify-center mt-4">
        <h1 class="text-2xl text-bold text-center text-slate-800 dark:text-slate-100">Semua Post</h1>
    </div>
    
    <div class="flex justify-center mt-4">
        <div class="inline-flex md:items-center md:gap-8 w-11/12"
            x-data="{ searching: false }"
        >
            <x-buttons.button-primary wire:loading.attr="disabled" wire:click="createNewPost" class="mt-1 hidden md:block md:w-4/12 disabled:opacity-40">
                <i class="fa-solid fa-plus mr-2"></i>Buat Post Baru
            </x-buttons.button-primary>
            <div class="mt-1 w-full md:w-8/12 relative rounded-md shadow-sm">
                <div class="absolute inset-y-0 left-0 pl-2 flex items-center pointer-events-none">
                    <span class="text-gray-500 dark:text-gray-400 sm:text-sm">
                        <i class="fa-solid fa-search"></i>
                    </span>
                </div>
                <input type="text" name="search" id="search" class="focus:ring-indigo-500 focus:border-indigo-500 dark:focus:ring-indigo-700/80 dark:focus:bg-midnight-600 dark:focus:border-indigo-700/80 text-slate-700 dark:text-slate-200 placeholder:text-slate-500 dark:placeholder:text-slate-400 block w-full pl-7 pr-12 sm:text-sm border-gray-300 dark:border-midnight-500 dark:bg-midnight-500 dark:focus:bg-midnight-800 rounded-md" placeholder="Cari" x-on:keyup="searching = true" wire:keyup="search($event.target.value)">
                <div class="absolute inset-y-0 right-0 flex items-center" x-show="searching === false">
                    <label for="searchBy" class="sr-only">Search By</label>
                    <select wire:model="searchBy" x-data="{ filter: false }" id="searchBy" name="searchBy" class="font-ubuntu focus:ring-indigo-500 focus:border-indigo-500 h-full py-0 pl-2 pr-4 border-transparent bg-transparent text-gray-500 dark:text-gray-400 dark:focus:ring-indigo-700/80 dark:focus:bg-midnight-600 dark:focus:border-indigo-700/80 sm:text-sm rounded-md"
                            @click="filter = true"
                    >
                        <option value="title">JUDUL</option>
                        <option value="slug">SLUG</option>
                        <option value="content">KONTEN</option>
                    </select>
                </div>
                <div class="absolute inset-y-0 right-0 flex items-center"
                    x-show="searching === true">
                    <div class="text-gray-500 dark:text-gray-400 hover:text-blue-500" 
                        wire:click="resetSearch"
                        x-on:click="searching = false; search.value = '';">
                        <i class="fa-solid fa-close mr-4"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <div class="flex mt-4 justify-center md:hidden">
        <div class="w-11/12">
            <x-buttons.button-primary wire:click="createNewPost">
                <i class="fa-solid fa-plus mr-2"></i>Buat Post Baru
            </x-buttons.button-primary>
        </div>
    </div>
    
    
    <div class="flex justify-center">
        <!-- Table All Post -->
        <div class="flex w-11/12 mb-8 mt-4 content-center justify-center">
            <div class="flex flex-col mx-auto overflow-y-hidden overflow-x-scroll pb-6 scrollbar scrollbar-thumb-slate-400 scrollbar-track-slate-200 dark:scrollbar-thumb-midnight-100 dark:scrollbar-track-midnight-500 rounded-md">
              <div class="-my-2 sm:-mx-6 lg:-mx-8">
                <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
                  <div class="shadow overflow-hidden border-b border-gray-200 dark:border-gray-600 sm:rounded-lg">
                    <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-600">
                      <thead class="bg-gray-50 dark:bg-midnight-500">
                        <tr>
                          <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                            #
                          </th>
                          <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                            Sampul
                          </th>
                          <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                            Judul
                          </th>
                          <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                            Slug
                          </th>
                          <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                            Kategori
                          </th>
                          <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                            Tags
                          </th>
                          </th>
                          <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                            Dibaca
                          </th>
                          <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                            Status
                          </th>
                          <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                            Dipublish Pada
                          </th>
                          <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                            Dibuat Pada
                          </th>
                          <th scope="col" class="relative px-6 py-3">
                            <span class="sr-only">Preview</span>
                          </th>
                          <th scope="col" class="relative px-6 py-3">
                            <span class="sr-only">Edit</span>
                          </th>
                          <th scope="col" class="relative px-6 py-3">
                            <span class="sr-only">Delete</span>
                          </th>
                        </tr>
                      </thead>
                      <tbody class="bg-white dark:bg-midnight-400 divide-y dark:divide-y-2 divide-gray-200 dark:divide-midnight-600">
                        @foreach ($posts as $post)
                        <tr>
                          <td class="px-6 py-4 whitespace-nowrap">
                            <div class="flex items-center">
                                <div class="text-sm font-medium text-gray-900 dark:text-gray-200">
                                  @if($posts instanceof \Illuminate\Pagination\AbstractPaginator)
                                    {{  $loop->iteration + $posts->firstItem() - 1 }}
                                  @else
                                    {{ $loop->iteration }}
                                  @endif
                                </div>
                            </div>
                          </td>
                          <td class="px-6 py-4 whitespace-nowrap">
                            <div class="flex-shrink-0 h-10 w-10">
                              <img class="h-10 w-10 object-cover rounded-md cursor-zoom-in" src="{{ $post->cover ?asset($post->cover) : 'https://source.unsplash.com/700x400?' . urlencode($post->title) }}" alt="{{ $post->title }}" wire:click='$emit("openModal", "components.modals-profile-photos", {{ json_encode([ $post->cover ? asset($post->cover) : "https://source.unsplash.com/700x400?" . urlencode($post->title)]) }})'>
                            </div>
                          </td>
                          <td class="px-6 py-4 whitespace-nowrap">
                            <div class="flex items-center">
                                <div class="text-sm font-medium text-gray-900 dark:text-gray-200">
                                  {{ $post->title }}
                                </div>
                              </div>
                            </div>
                          </td>
                          <td class="px-6 py-4 whitespace-nowrap">
                            <div class="flex items-center">
                                <div class="text-sm font-medium text-gray-900 dark:text-gray-200">
                                  {{ $post->slug }}
                                </div>
                              </div>
                            </div>
                          </td>
                          <td class="px-6 py-4 whitespace-nowrap">
                            <div class="flex items-center">
                                <div class="text-sm font-medium text-gray-900 dark:text-gray-200">
                                  {{ $post->category->name }}
                                </div>
                              </div>
                            </div>
                          </td>
                          <td class="px-6 py-4 whitespace-nowrap">
                            <div class="flex items-center overflow-y-auto">
                                <div class="text-sm font-medium text-gray-900 dark:text-gray-200 overflow-x-auto">
                                  @foreach ($post->tags as $tag)
                                      #{{ $tag->name }} 
                                  @endforeach
                                </div>
                              </div>
                            </div>
                          </td>
                          <td class="px-6 py-4 whitespace-nowrap">
                            <div class="flex items-center">
                                <div class="text-sm font-medium text-gray-900 dark:text-gray-200 overflow-x-auto">
                                  {{ $post->read->count() }}
                                </div>
                              </div>
                            </div>
                          </td>
                          <td class="px-6 py-4 whitespace-nowrap">
                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full {{ $post->published ? 'bg-green-100 dark:bg-green-200 text-green-800 dark:text-green-900' : 'bg-yellow-100 dark:bg-yellow-200 text-yellow-800 dark:text-yellow-900' }}">
                              {{ $post->published ? 'Publish' : 'Draft' }}
                            </span>
                          </td>
                          <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-300">
                            {{ $post->published_at ? now()->parse($post->published_at)->format('d M Y, H:i') : '-' }}
                          </td>
                          <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-300">
                            {{ now()->parse($post->created_at)->format('d M Y, H:i') }}
                          </td>
                          <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                            <a href="/posts/{{ $post->slug }}" class="text-blue-500 hover:text-blue-900 dark:text-blue-500 text-bold dark:hover:text-blue-900 cursor-pointer">{{ __('Preview') }}</a>
                          </td>
                          <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                            <a href="/posts/{{ $post->slug }}/edit" class="text-indigo-600 hover:text-indigo-900 dark:text-indigo-500 text-bold dark:hover:text-blue-600 cursor-pointer">{{ __('Edit') }}</a>
                          </td>
                          <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium" x-data>
                            <button @click="deletePost('{{ $post->id }}', '{{ $post->slug }}', '{{ $post->title }}')" class="text-red-600 hover:text-red-900 text-bold dark:text-red-500 dark:hover:text-red-600 cursor-pointer">{{ __('Hapus') }}</button>
                          </td>
                        </tr>
                        @endforeach
                        <!-- More people... -->
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
            </div>
        </div>
    </div>
    
    
    @if($posts instanceof \Illuminate\Pagination\AbstractPaginator)
    <div class="flex mt-4 mb-12 justify-center">
        <div class="w-11/12 text-center justify-center">
        {{ $posts->links('livewire.layouts.pagination') }}
        </div>
    </div>
    @endif
    
@push('scripts')
<script type="text/javascript">
//document.addEventListener('livewire:load', function () {

    function deletePost(id, slug, title) {
        Swal.fire({
            title: '<h5 class="text-midnight-800 dark:text-slate-100">Apakah kamu yakin?</h5>',
            html: `<p class="text-midnight-800/70 dark:text-slate-400">Kamu ingin menghapus post dengan judul <a class="text-blue-500" href="/post/${slug}">${title}</a>!<br><span class="opacity-70">Postingan yang telah dihapus tidak dapat dipulihkan kembali.</span></p>`,
            type: 'warning',
            background: (localStorage.theme === 'light') ? '#f3f6fe' : '#20315a', 
            color: 'red',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#64748b',
            confirmButtonText: 'Hapus!',
            focusConfirm: false,
            cancelButtonText: 'Batal'
        }).then((result) => {
            if (result.value) {
                window.Livewire.emit('deletePost', id, slug, title);
            }
        })
    }
    
    window.addEventListener('postDeleted', event => {
        Swal.fire({
            title: '<h5 class="text-midnight-800 dark:text-slate-100">Dihapus!</h5>',
            html: `<p class="text-midnight-800/70 dark:text-slate-400">Post dengan judul "${event.detail.title}" berhasil dihapus.</p>`,
            type: 'success',
            confirmButtonText: 'OK',
            focusConfirm: false,
            background: (localStorage.theme === 'light') ? '#f3f6fe' : '#20315a', 
        });
        
    });
    
    
//});
</script>
@endpush

</div>

