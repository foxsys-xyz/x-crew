
<!-- Application Sidebar -->

    <div :class="sidebarOpen ? 'block' : 'hidden'" @click="sidebarOpen = false" class="fixed z-20 inset-0 bg-black opacity-50 transition-opacity lg:hidden"></div>
        
    <div :class="sidebarOpen ? 'translate-x-0 ease-out' : '-translate-x-full ease-in'" class="fixed z-30 inset-y-0 left-0 w-24 transition duration-300 transform bg-gray-900 bg-opacity-40 backdrop-filter backdrop-blur-sm rounded-tr-3xl lg:rounded-none lg:backdrop-filter-none overflow-visible lg:translate-x-0 lg:static lg:inset-0">
        
        <div class="flex items-center justify-center mx-4 mt-5">
            <img class="w-5" src="{{ asset('img/Logo [Dark Background].svg') }}" />
        </div>

        <nav class="mt-10 grid gap-2">

            <div x-data="{ tooltip: false }" class="relative z-30 flex items-center justify-center">
                <a href="{{ route('staff.dashboard') }}" x-on:mouseover="tooltip = true" x-on:mouseleave="tooltip = false" class="transition duration-150 flex items-center justify-center p-4 rounded-2xl hover:bg-gray-800 hover:bg-opacity-60">
                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-smart-home inline-block w-6" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                        <path d="M19 8.71l-5.333 -4.148a2.666 2.666 0 0 0 -3.274 0l-5.334 4.148a2.665 2.665 0 0 0 -1.029 2.105v7.2a2 2 0 0 0 2 2h12a2 2 0 0 0 2 -2v-7.2c0 -.823 -.38 -1.6 -1.03 -2.105"></path>
                        <path d="M16 15c-2.21 1.333 -5.792 1.333 -8 0"></path>
                    </svg>
                </a>

                <div class="relative flex items-center" x-cloak x-show="tooltip" x-transition.origin.right>
                    <div class="whitespace-nowrap ml-8 bg-gray-900 bg-opacity-40 backdrop-filter backdrop-blur-sm rounded-xl absolute z-50 px-4 py-2 text-xs text-white">
                        Dashboard
                    </div>
                </div>
            </div>

            <div x-data="{ tooltip: false }" class="relative z-30 flex items-center justify-center">
                <a href="{{ route('staff.cfcdc') }}" x-on:mouseover="tooltip = true" x-on:mouseleave="tooltip = false" class="transition duration-150 flex items-center justify-center p-4 rounded-2xl hover:bg-gray-800 hover:bg-opacity-60">
                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-database-import inline-block w-6" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                        <ellipse cx="12" cy="6" rx="8" ry="3"></ellipse>
                        <path d="M4 6v8m5.009 .783c.924 .14 1.933 .217 2.991 .217c4.418 0 8 -1.343 8 -3v-6"></path>
                        <path d="M11.252 20.987c.246 .009 .496 .013 .748 .013c4.418 0 8 -1.343 8 -3v-6m-18 7h7m-3 -3l3 3l-3 3"></path>
                    </svg>
                </a>

                <div class="relative flex items-center" x-cloak x-show="tooltip" x-transition.origin.right>
                    <div class="whitespace-nowrap ml-8 bg-gray-900 bg-opacity-40 backdrop-filter backdrop-blur-sm rounded-xl absolute z-50 px-4 py-2 text-xs text-white">
                        CFCDC
                    </div>
                </div>
            </div>

            <div x-data="{ tooltip: false }" class="relative z-30 flex items-center justify-center">
                <a href="#" x-on:mouseover="tooltip = true" x-on:mouseleave="tooltip = false" class="transition duration-150 flex items-center justify-center p-4 rounded-2xl hover:bg-gray-800 hover:bg-opacity-60">
                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-hierarchy inline-block w-6" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                        <circle cx="12" cy="5" r="2"></circle>
                        <circle cx="5" cy="19" r="2"></circle>
                        <circle cx="19" cy="19" r="2"></circle>
                        <path d="M6.5 17.5l5.5 -4.5l5.5 4.5"></path>
                        <line x1="12" y1="7" x2="12" y2="13"></line>
                    </svg>
                </a>

                <div class="relative flex items-center" x-cloak x-show="tooltip" x-transition.origin.right>
                    <div class="whitespace-nowrap ml-8 bg-gray-900 bg-opacity-40 backdrop-filter backdrop-blur-sm rounded-xl absolute z-50 px-4 py-2 text-xs text-white">
                        PIREPs
                    </div>
                </div>
            </div>

            <div x-data="{ tooltip: false }" class="relative z-30 flex items-center justify-center">
                <a href="#" x-on:mouseover="tooltip = true" x-on:mouseleave="tooltip = false" class="transition duration-150 flex items-center justify-center p-4 rounded-2xl hover:bg-gray-800 hover:bg-opacity-60">
                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-file-import inline-block w-6" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                        <path d="M14 3v4a1 1 0 0 0 1 1h4"></path>
                        <path d="M5 13v-8a2 2 0 0 1 2 -2h7l5 5v11a2 2 0 0 1 -2 2h-5.5m-9.5 -2h7m-3 -3l3 3l-3 3"></path>
                    </svg>
                </a>

                <div class="relative flex items-center" x-cloak x-show="tooltip" x-transition.origin.right>
                    <div class="whitespace-nowrap ml-8 bg-gray-900 bg-opacity-40 backdrop-filter backdrop-blur-sm rounded-xl absolute z-50 px-4 py-2 text-xs text-white">
                        Applications
                    </div>
                </div>
            </div>

            <div x-data="{ tooltip: false }" class="relative z-30 flex items-center justify-center">
                <a href="#" x-on:mouseover="tooltip = true" x-on:mouseleave="tooltip = false" class="transition duration-150 flex items-center justify-center p-4 rounded-2xl hover:bg-gray-800 hover:bg-opacity-60">
                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-users inline-block w-6" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                        <circle cx="9" cy="7" r="4"></circle>
                        <path d="M3 21v-2a4 4 0 0 1 4 -4h4a4 4 0 0 1 4 4v2"></path>
                        <path d="M16 3.13a4 4 0 0 1 0 7.75"></path>
                        <path d="M21 21v-2a4 4 0 0 0 -3 -3.85"></path>
                    </svg>
                </a>

                <div class="relative flex items-center" x-cloak x-show="tooltip" x-transition.origin.right>
                    <div class="whitespace-nowrap ml-8 bg-gray-900 bg-opacity-40 backdrop-filter backdrop-blur-sm rounded-xl absolute z-50 px-4 py-2 text-xs text-white">
                        Pilot Roster
                    </div>
                </div>
            </div>

            <div x-data="{ tooltip: false }" class="relative z-30 flex items-center justify-center">
                <a href="#" x-on:mouseover="tooltip = true" x-on:mouseleave="tooltip = false" class="transition duration-150 flex items-center justify-center p-4 rounded-2xl hover:bg-gray-800 hover:bg-opacity-60">
                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-settings inline-block w-6" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                        <path d="M10.325 4.317c.426 -1.756 2.924 -1.756 3.35 0a1.724 1.724 0 0 0 2.573 1.066c1.543 -.94 3.31 .826 2.37 2.37a1.724 1.724 0 0 0 1.065 2.572c1.756 .426 1.756 2.924 0 3.35a1.724 1.724 0 0 0 -1.066 2.573c.94 1.543 -.826 3.31 -2.37 2.37a1.724 1.724 0 0 0 -2.572 1.065c-.426 1.756 -2.924 1.756 -3.35 0a1.724 1.724 0 0 0 -2.573 -1.066c-1.543 .94 -3.31 -.826 -2.37 -2.37a1.724 1.724 0 0 0 -1.065 -2.572c-1.756 -.426 -1.756 -2.924 0 -3.35a1.724 1.724 0 0 0 1.066 -2.573c-.94 -1.543 .826 -3.31 2.37 -2.37c1 .608 2.296 .07 2.572 -1.065z"></path>
                        <circle cx="12" cy="12" r="3"></circle>
                    </svg>
                </a>

                <div class="relative flex items-center" x-cloak x-show="tooltip" x-transition.origin.right>
                    <div class="whitespace-nowrap ml-8 bg-gray-900 bg-opacity-40 backdrop-filter backdrop-blur-sm rounded-xl absolute z-50 px-4 py-2 text-xs text-white">
                        Settings
                    </div>
                </div>
            </div>

            <div x-data="{ tooltip: false }" class="relative z-30 flex items-center justify-center">
                <a href="#" x-on:mouseover="tooltip = true" x-on:mouseleave="tooltip = false" class="transition duration-150 flex items-center justify-center p-4 rounded-2xl hover:bg-gray-800 hover:bg-opacity-60">
                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-cloud inline-block w-6" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                        <path d="M7 18a4.6 4.4 0 0 1 0 -9a5 4.5 0 0 1 11 2h1a3.5 3.5 0 0 1 0 7h-12"></path>
                    </svg>
                </a>

                <div class="relative flex items-center" x-cloak x-show="tooltip" x-transition.origin.right>
                    <div class="whitespace-nowrap ml-8 bg-gray-900 bg-opacity-40 backdrop-filter backdrop-blur-sm rounded-xl absolute z-50 px-4 py-2 text-xs text-white">
                        Pilot Center
                    </div>
                </div>
            </div>
        </nav>
    </div>

<!-- Application Sidebar End -->
