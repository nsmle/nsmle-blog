<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-midnight-800 dark:text-neutral-100 leading-tight">
            {{ __('Post') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="overflow-hidden shadow-xl sm:rounded-lg">
                <div class="p-6 sm:px-20 bg-neutral-100 dark:text-white dark:bg-midnight-800 border sm:rounded-lg border-gray-300 dark:border-gray-800">
                    <div>
                        <x-jet-application-logo class="block h-12 w-auto" />
                    </div>
                
                    <div class="mt-8 text-2xl">
                        Welcome back {{ Auth::user()->name }}
                    </div>
                
                    <div class="mt-6 text-gray-600 dark:text-gray-400 font-nunito">
                        Laravel Jetstream menyediakan titik awal yang indah dan kuat untuk aplikasi Laravel Anda berikutnya. Laravel dirancang untuk membantu Anda membangun aplikasi menggunakan lingkungan pengembangan yang sederhana, kuat, dan menyenangkan. Kami percaya Anda harus senang mengekspresikan kreativitas Anda melalui pemrograman, jadi kami telah menghabiskan waktu dengan hati-hati untuk membuat ekosistem Laravel menjadi angin segar. Kami harap Anda menyukainya.
                    </div>
                    <div class="mt-6 text-gray-600 dark:text-gray-400 font-poppins">
                        Laravel Jetstream menyediakan titik awal yang indah dan kuat untuk aplikasi Laravel Anda berikutnya. Laravel dirancang untuk membantu Anda membangun aplikasi menggunakan lingkungan pengembangan yang sederhana, kuat, dan menyenangkan. Kami percaya Anda harus senang mengekspresikan kreativitas Anda melalui pemrograman, jadi kami telah menghabiskan waktu dengan hati-hati untuk membuat ekosistem Laravel menjadi angin segar. Kami harap Anda menyukainya.
                    </div>
                    <div class="mt-6 text-gray-600 dark:text-gray-400 font-ubuntu">
                        Laravel Jetstream menyediakan titik awal yang indah dan kuat untuk aplikasi Laravel Anda berikutnya. Laravel dirancang untuk membantu Anda membangun aplikasi menggunakan lingkungan pengembangan yang sederhana, kuat, dan menyenangkan. Kami percaya Anda harus senang mengekspresikan kreativitas Anda melalui pemrograman, jadi kami telah menghabiskan waktu dengan hati-hati untuk membuat ekosistem Laravel menjadi angin segar. Kami harap Anda menyukainya.
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
