<x-guest-layout>
    <div class="mb-5 bg-neutral-100 dark:bg-midnight-600">
        <div class="min-h-screen flex flex-col items-center pt-6 sm:pt-0">
            <div>
                <x-jet-authentication-card-logo />
            </div>

            <div class="w-full xs:w-11/12 sm:max-w-2xl mt-6 p-6 bg-white dark:bg-midnight-500 shadow-md overflow-hidden rounded-lg prose dark:prose-invert prose-a:text-blue-500 prose-a:no-underline">
                {!! $terms !!}
            </div>
            
            @if (!Auth::check())
            <div class="w-full xs:w-11/12 sm:max-w-2xl rounded-lg mt-6 px-6 py-6 overflow-hidden border border-slate-300 dark:border-slate-700 bg-transparent">
                <div class="flex px-4 grid grid-cols-2 gap-6 justify-between">
                    <a href="{{ route('login') }}" class="w-full items-center text-center px-4 py-1 border border-blue-600 dark:border-blue-500 hover:border-blue-800 dark:hover:border-blue-600 rounded-md font-semibold text-sm text-blue-600 dark:text-blue-500 hover:text-blue-800 dark:hover:text-blue-600 font-bold tracking-wide focus:outline-none focus:ring focus:ring-blue-600/20 disabled:opacity-25 transition">
                        {{ __('Masuk') }}
                    </a>
                    <a href="{{ route('register') }}" class="w-full items-center text-center px-4 py-1 border border-blue-600 dark:border-blue-500 hover:border-blue-800 dark:hover:border-blue-600 rounded-md font-semibold text-sm text-blue-600 dark:text-blue-500 hover:text-blue-800 dark:hover:text-blue-600 font-bold tracking-wide focus:outline-none focus:ring focus:ring-blue-600/20 disabled:opacity-25 transition">
                        {{ __('Daftar') }}
                    </a>
                </div>
            </div>
            @else
            <div class="w-full xs:w-11/12 sm:max-w-2xl rounded-lg mt-6 px-6 py-6 overflow-hidden border border-slate-300 dark:border-slate-700 bg-transparent">
                <div class="flex px-4 grid grid-cols-2 gap-6 justify-between">
                    <a href="{{ route('home') }}" class="w-full items-center text-center px-4 py-1 border border-blue-600 dark:border-blue-500 hover:border-blue-800 dark:hover:border-blue-600 rounded-md font-semibold text-sm text-blue-600 dark:text-blue-500 hover:text-blue-800 dark:hover:text-blue-600 font-bold tracking-wide focus:outline-none focus:ring focus:ring-blue-600/20 disabled:opacity-25 transition">
                        {{ __('Home') }}
                    </a>
                    <a href="{{ route('dashboard') }}" class="w-full items-center text-center px-4 py-1 border border-blue-600 dark:border-blue-500 hover:border-blue-800 dark:hover:border-blue-600 rounded-md font-semibold text-sm text-blue-600 dark:text-blue-500 hover:text-blue-800 dark:hover:text-blue-600 font-bold tracking-wide focus:outline-none focus:ring focus:ring-blue-600/20 disabled:opacity-25 transition">
                        {{ __('Dashboard') }}
                    </a>
                </div>
            </div>
            @endif
            
            <div class="w-full xs:w-11/12 sm:max-w-2xl outline-none rounded-lg sm:max-w-md mt-12 px-4 md:px-8 py-4 bg-transparent">
                <div class="flex -mt-3 text-center md:mx-8 justify-between">
                    <a class="text-xs md:text-md font-semibold whitespace-nowrap text-blue-600 dark:text-blue-500 hover:text-blue-700 dark:hover:text-blue-400" href="{{ route('terms.show') }}">
                        {{ __('Terms of Service') }}
                    </a>
                    <a class="text-xs md:text-md font-semibold whitespace-nowrap text-blue-600 dark:text-blue-500 hover:text-blue-700 dark:hover:text-blue-400" href="{{ route('policy.show') }}">
                        {{ __('Privacy Policy') }}
                    </a>
                    <a class="text-xs md:text-md font-semibold whitespace-nowrap text-blue-600 dark:text-blue-500 hover:text-blue-700 dark:hover:text-blue-400" href="{{ route('about.show') }}">
                        {{ __('About') }}
                    </a>
                </div>
            </div>
            
            
        </div>
    </div>
    
    @push('scripts')
    <script>
        let pageOfContent = document.createElement('div');
        let h = document.createElement("h2");
        h.innerHTML = "Page of Content"
        pageOfContent.appendChild(h)
        document.querySelectorAll("h2, h3, h4, h5, h6").forEach((heading) => {
            let content = heading.outerText
            heading.setAttribute('id', content.trim().replace(/([^\d\w])/g, '-'));
            let navigationContent = document.createElement("a");
            navigationContent.setAttribute('href', "#" + content.trim().replace(/([^\d\w])/g, '-'));
            navigationContent.innerHTML = content;
            let ul = document.createElement("ul");
            let li = document.createElement("li");
            li.appendChild(navigationContent)
            ul.appendChild(li)
            pageOfContent.appendChild(ul)
        });
        
        document.querySelectorAll("code").forEach((code) => {
            if (code.outerText === '{table-of-contents}') {
                code.parentNode.insertBefore(pageOfContent, code)
                code.remove()
            }
        });
    </script>
    @endpush
    
</x-guest-layout>
