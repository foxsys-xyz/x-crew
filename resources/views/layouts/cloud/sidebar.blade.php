
<!-- Application Sidebar -->

    <div class="mx-12 mt-12">
        <img class="w-24 rounded-3xl" src="{{ Auth::user()->avatar }}" />
        <div class="leading-4 mt-8">
            <span class="text-black text-lg inline-flex items-center">
                <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-user inline-block w-5 mr-3" viewBox="0 0 24 24" stroke-width="1.5" stroke="#2c3e50" fill="none" stroke-linecap="round" stroke-linejoin="round">
                    <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                    <circle cx="12" cy="7" r="4" />
                    <path d="M6 21v-2a4 4 0 0 1 4 -4h4a4 4 0 0 1 4 4v2" />
                </svg>
                {{ Auth::user()->username }}
            </span> <br />
            <span class="text-xs text-gray-500">Senior Training Captain</span>
        </div>
    </div>

    <nav class="mt-6 mx-8">    
        <a class="transition duration-500 flex items-center py-3 px-3 rounded-full text-sm text-gray-700 hover:bg-gray-400 hover:bg-opacity-25"
            href="{{ route('dashboard') }}">
            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-smart-home inline-block w-6" viewBox="0 0 24 24" stroke-width="1.5" stroke="#2c3e50" fill="none" stroke-linecap="round" stroke-linejoin="round">
                <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                <path d="M19 8.71l-5.333 -4.148a2.666 2.666 0 0 0 -3.274 0l-5.334 4.148a2.665 2.665 0 0 0 -1.029 2.105v7.2a2 2 0 0 0 2 2h12a2 2 0 0 0 2 -2v-7.2c0 -.823 -.38 -1.6 -1.03 -2.105" />
                <path d="M16 15c-2.21 1.333-5.792 1.333-8 0" />
            </svg>

            <span class="mx-3">Dashboard</span>
        </a>

        <a class="transition duration-500 flex items-center py-3 px-3 rounded-full text-sm text-gray-700 hover:bg-gray-400 hover:bg-opacity-25"
            href="/ui-elements">
            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-plane inline-block w-6" viewBox="0 0 24 24" stroke-width="1.5" stroke="#2c3e50" fill="none" stroke-linecap="round" stroke-linejoin="round">
                <path stroke="none" d="M0 0h24v24H0z"/>
                <path d="M16 10h4a2 2 0 0 1 0 4h-4l-4 7h-3l2 -7h-4l-2 2h-3l2-4l-2 -4h3l2 2h4l-2 -7h3z" />
            </svg>

            <span class="mx-3">CFCDC</span>
        </a>

        <a class="transition duration-500 flex items-center py-3 px-3 rounded-full text-sm text-gray-700 hover:bg-gray-400 hover:bg-opacity-25"
            href="/ui-elements">
            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-server inline-block w-6" viewBox="0 0 24 24" stroke-width="1.5" stroke="#2c3e50" fill="none" stroke-linecap="round" stroke-linejoin="round">
                <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                <rect x="3" y="4" width="18" height="8" rx="3" />
                <rect x="3" y="12" width="18" height="8" rx="3" />
                <line x1="7" y1="8" x2="7" y2="8.01" />
                <line x1="7" y1="16" x2="7" y2="16.01" />
            </svg>

            <span class="mx-3">Resources</span>
        </a>

        <a class="transition duration-500 flex items-center py-3 px-3 rounded-full text-sm text-gray-700 hover:bg-gray-400 hover:bg-opacity-25"
            href="/ui-elements">
            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-lifebuoy inline-block w-6" viewBox="0 0 24 24" stroke-width="1.5" stroke="#2c3e50" fill="none" stroke-linecap="round" stroke-linejoin="round">
                <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                <circle cx="12" cy="12" r="4" />
                <circle cx="12" cy="12" r="9" />
                <line x1="15" y1="15" x2="18.35" y2="18.35" />
                <line x1="9" y1="15" x2="5.65" y2="18.35" />
                <line x1="5.65" y1="5.65" x2="9" y2="9" />
                <line x1="18.35" y1="5.65" x2="15" y2="9" />
            </svg>

            <span class="mx-3">Help</span>
        </a>
    </nav>

    <div class="flex items-center m-12 mt-10 bottom-0 absolute">
        <img class="w-4 mr-3" src="{{ asset('img/foxsys-xyz [Icon] [Light Back].png') }}" />
        <span class="text-xs text-gray-500">foxsys-xyz, {{ date('Y') }}.</span>
    </div>

<!-- Application Sidebar End -->
