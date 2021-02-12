
<!-- Application Header -->

    <header class="flex justify-between items-center py-6 px-8 bg-white mx-6 mt-6 lg:ml-0 rounded-3xl">
        <div class="flex items-center">
            <button @click="sidebarOpen = true" class="text-gray-500 focus:outline-none lg:hidden">
                <svg class="h-6 w-6" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M4 6H20M4 12H20M4 18H11" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                        stroke-linejoin="round"></path>
                </svg>
            </button>

            <span class="lg:block pull-left hidden text-sm"><img src="{{ asset('img/va_logo.png') }}" class="h-5" /></span>
        </div>
        
        <p class="flex items-center text-xs">
            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-satellite inline-block w-5 mr-3" viewBox="0 0 24 24" stroke-width="1.5" stroke="#6366f1" fill="none" stroke-linecap="round" stroke-linejoin="round">
                <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                <path d="M3.707 6.293l2.586 -2.586a1 1 0 0 1 1.414 0l5.586 5.586a1 1 0 0 1 0 1.414l-2.586 2.586a1 1 0 0 1 -1.414 0l-5.586 -5.586a1 1 0 0 1 0 -1.414z"></path>
                <path d="M6 10l-3 3l3 3l3 -3"></path>
                <path d="M10 6l3 -3l3 3l-3 3"></path>
                <line x1="12" y1="12" x2="13.5" y2="13.5"></line>
                <path d="M14.5 17a2.5 2.5 0 0 0 2.5 -2.5"></path>
                <path d="M15 21a6 6 0 0 0 6 -6"></path>
            </svg>
            11 Stations Active
        </p>
    </header>

<!-- Application Header End -->
