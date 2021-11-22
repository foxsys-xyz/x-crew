
<!-- Application Sidebar -->

    <div :class="sidebarOpen ? 'block' : 'hidden'" @click="sidebarOpen = false" class="fixed z-20 inset-0 bg-black opacity-50 transition-opacity lg:hidden"></div>
        
    <div :class="sidebarOpen ? 'translate-x-0 ease-out' : '-translate-x-full ease-in'" class="fixed z-30 inset-y-0 left-0 w-24 transition duration-300 transform bg-gray-900 bg-opacity-40 backdrop-filter backdrop-blur-sm rounded-tr-3xl lg:rounded-none lg:backdrop-filter-none overflow-visible lg:translate-x-0 lg:static lg:inset-0">
        
        <div class="flex items-center justify-center mx-4 mt-5">
            <img class="w-5" src="{{ asset('img/Logo [Dark Background].svg') }}" />
        </div>

        <nav class="mt-10 grid gap-2">

            <div x-data="{ tooltip: false }" class="relative z-30 flex items-center justify-center">
                <a href="{{ route('dashboard') }}" x-on:mouseover="tooltip = true" x-on:mouseleave="tooltip = false" class="transition duration-500 flex items-center justify-center p-4 rounded-2xl text-sm hover:bg-gray-800 hover:bg-opacity-60">
                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-smart-home inline-block w-6" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                        <path d="M19 8.71l-5.333 -4.148a2.666 2.666 0 0 0 -3.274 0l-5.334 4.148a2.665 2.665 0 0 0 -1.029 2.105v7.2a2 2 0 0 0 2 2h12a2 2 0 0 0 2 -2v-7.2c0 -.823 -.38 -1.6 -1.03 -2.105"></path>
                        <path d="M16 15c-2.21 1.333 -5.792 1.333 -8 0"></path>
                    </svg>
                </a>

                <div class="relative flex items-center" x-cloak x-show.transition.origin.right="tooltip">
                    <div class="whitespace-nowrap ml-8 bg-gray-900 bg-opacity-40 backdrop-filter backdrop-blur-sm rounded-xl absolute z-50 px-4 py-2 text-sm text-white">
                        Dashboard
                    </div>
                </div>
            </div>

            <div x-data="{ tooltip: false }" class="relative z-30 flex items-center justify-center">
                <a href="{{ route('cfcdc') }}" x-on:mouseover="tooltip = true" x-on:mouseleave="tooltip = false" class="transition duration-500 flex items-center justify-center p-4 rounded-2xl text-sm hover:bg-gray-800 hover:bg-opacity-60">
                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-plane inline-block w-6" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                        <path d="M16 10h4a2 2 0 0 1 0 4h-4l-4 7h-3l2 -7h-4l-2 2h-3l2 -4l-2 -4h3l2 2h4l-2 -7h3z"></path>
                    </svg>
                </a>

                <div class="relative flex items-center" x-cloak x-show.transition.origin.right="tooltip">
                    <div class="whitespace-nowrap ml-8 bg-gray-900 bg-opacity-40 backdrop-filter backdrop-blur-sm rounded-xl absolute z-50 px-4 py-2 text-sm text-white">
                        CFCDC
                    </div>
                </div>
            </div>

            <div x-data="{ tooltip: false }" class="relative z-30 flex items-center justify-center">
                <a href="#" x-on:mouseover="tooltip = true" x-on:mouseleave="tooltip = false" class="transition duration-500 flex items-center justify-center p-4 rounded-2xl text-sm hover:bg-gray-800 hover:bg-opacity-60">
                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-calendar inline-block w-6" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                        <rect x="4" y="5" width="16" height="16" rx="2"></rect>
                        <line x1="16" y1="3" x2="16" y2="7"></line>
                        <line x1="8" y1="3" x2="8" y2="7"></line>
                        <line x1="4" y1="11" x2="20" y2="11"></line>
                        <line x1="11" y1="15" x2="12" y2="15"></line>
                        <line x1="12" y1="15" x2="12" y2="18"></line>
                    </svg>
                </a>

                <div class="relative flex items-center" x-cloak x-show.transition.origin.right="tooltip">
                    <div class="whitespace-nowrap ml-8 bg-gray-900 bg-opacity-40 backdrop-filter backdrop-blur-sm rounded-xl absolute z-50 px-4 py-2 text-sm text-white">
                        Schedule
                    </div>
                </div>
            </div>

            <div x-data="{ tooltip: false }" class="relative z-30 flex items-center justify-center">
                <a href="#" x-on:mouseover="tooltip = true" x-on:mouseleave="tooltip = false" class="transition duration-500 flex items-center justify-center p-4 rounded-2xl text-sm hover:bg-gray-800 hover:bg-opacity-60">
                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-server inline-block w-6" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                        <rect x="3" y="4" width="18" height="8" rx="3"></rect>
                        <rect x="3" y="12" width="18" height="8" rx="3"></rect>
                        <line x1="7" y1="8" x2="7" y2="8.01"></line>
                        <line x1="7" y1="16" x2="7" y2="16.01"></line>
                    </svg>
                </a>

                <div class="relative flex items-center" x-cloak x-show.transition.origin.right="tooltip">
                    <div class="whitespace-nowrap ml-8 bg-gray-900 bg-opacity-40 backdrop-filter backdrop-blur-sm rounded-xl absolute z-50 px-4 py-2 text-sm text-white">
                        Resources
                    </div>
                </div>
            </div>

            <div x-data="{ tooltip: false }" class="relative z-30 flex items-center justify-center">
                <a href="#" x-on:mouseover="tooltip = true" x-on:mouseleave="tooltip = false" class="transition duration-500 flex items-center justify-center p-4 rounded-2xl text-sm hover:bg-gray-800 hover:bg-opacity-60">
                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-lifebuoy inline-block w-6" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                        <circle cx="12" cy="12" r="4"></circle>
                        <circle cx="12" cy="12" r="9"></circle>
                        <line x1="15" y1="15" x2="18.35" y2="18.35"></line>
                        <line x1="9" y1="15" x2="5.65" y2="18.35"></line>
                        <line x1="5.65" y1="5.65" x2="9" y2="9"></line>
                        <line x1="18.35" y1="5.65" x2="15" y2="9"></line>
                    </svg>
                </a>

                <div class="relative flex items-center" x-cloak x-show.transition.origin.right="tooltip">
                    <div class="whitespace-nowrap ml-8 bg-gray-900 bg-opacity-40 backdrop-filter backdrop-blur-sm rounded-xl absolute z-50 px-4 py-2 text-sm text-white">
                        Support
                    </div>
                </div>
            </div>

            @if (Auth::user()->staff == true)

                <div x-data="{ tooltip: false }" class="relative z-30 flex items-center justify-center">
                    <a href="{{ route('staff.dashboard') }}" x-on:mouseover="tooltip = true" x-on:mouseleave="tooltip = false" class="transition duration-500 flex items-center justify-center p-4 rounded-2xl text-sm hover:bg-gray-800 hover:bg-opacity-60">
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-drone inline-block w-6" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                            <path d="M10 10h4v4h-4z"></path>
                            <line x1="10" y1="10" x2="6.5" y2="6.5"></line>
                            <path d="M9.96 6a3.5 3.5 0 1 0 -3.96 3.96"></path>
                            <path d="M14 10l3.5 -3.5"></path>
                            <path d="M18 9.96a3.5 3.5 0 1 0 -3.96 -3.96"></path>
                            <line x1="14" y1="14" x2="17.5" y2="17.5"></line>
                            <path d="M14.04 18a3.5 3.5 0 1 0 3.96 -3.96"></path>
                            <line x1="10" y1="14" x2="6.5" y2="17.5"></line>
                            <path d="M6 14.04a3.5 3.5 0 1 0 3.96 3.96"></path>
                        </svg>
                    </a>

                    <div class="relative flex items-center" x-cloak x-show.transition.origin.right="tooltip">
                        <div class="whitespace-nowrap ml-8 bg-gray-900 bg-opacity-40 backdrop-filter backdrop-blur-sm rounded-xl absolute z-50 px-4 py-2 text-sm text-white">
                            Staff Center
                        </div>
                    </div>
                </div>

            @endif
        </nav>
    </div>

<!-- Application Sidebar End -->
