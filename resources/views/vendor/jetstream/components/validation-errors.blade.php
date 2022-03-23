@if ($errors->any())
    <div {{ $attributes }}>
            <div class="validation-error w-full bg-red-100/50 dark:bg-red-100 border border-red-200 dark:border-red-300 text-red-900 px-4 py-3 rounded-lg relative" role="alert">
                <strong class="font-bold text-sm">Whoops!</strong>
                @if (count($errors->all()) > 1)
                    <ul class="px-4 list-disc text-sm">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                @else 
                    @foreach ($errors->all() as $error)
                        <span class="block sm:inline text-sm">{{ $error }}</span>
                    @endforeach
                @endif
                <span class="absolute close-error top-0 bottom-0 right-0 px-4 py-3">
                    <svg class="fill-current h-5 w-5 text-red-500" role="button" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><title>Close</title><path d="M14.348 14.849a1.2 1.2 0 0 1-1.697 0L10 11.819l-2.651 3.029a1.2 1.2 0 1 1-1.697-1.697l2.758-3.15-2.759-3.152a1.2 1.2 0 1 1 1.697-1.697L10 8.183l2.651-3.031a1.2 1.2 0 1 1 1.697 1.697l-2.758 3.152 2.758 3.15a1.2 1.2 0 0 1 0 1.698z"/></svg>
                </span>
            </div>
    </div>
@endif
