
<!-- Application Sidebar -->

    <div :class="sidebarOpen ? 'block' : 'hidden'" @click="sidebarOpen = false" class="fixed z-20 inset-0 bg-black opacity-50 transition-opacity lg:hidden"></div>
        
    <div :class="sidebarOpen ? 'translate-x-0 ease-out' : '-translate-x-full ease-in'" class="fixed z-30 inset-y-0 left-0 w-64 transition duration-300 transform bg-gray-900 bg-opacity-80 backdrop-filter backdrop-blur-lg lg:backdrop-filter-none overflow-y-auto lg:translate-x-0 lg:static lg:inset-0">
        <div class="mx-12 mt-12">
            <img class="w-24 rounded-3xl" src="{{ Auth::user()->avatar }}" />
            <div class="leading-5 mt-8">
                <span class="text-lg inline-flex items-center">
                    {{ Auth::user()->username }}

                    @if (Auth::user()->rwp == true)
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-circle-check text-blue-500 inline-block w-5 ml-3" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                            <circle cx="12" cy="12" r="9"></circle>
                            <path d="M9 12l2 2l4 -4"></path>
                        </svg>
                    @endif

                    @if (Auth::user()->staff == true)
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-crown text-yellow-400 inline-block w-5 {{ Auth::user()->rwp != true ? 'ml-3' : 'ml-2' }}" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                            <path d="M12 6l4 6l5 -4l-2 10h-14l-2 -10l5 4z"></path>
                        </svg>
                    @endif
                </span> <br />
                <span class="text-gray-400 text-xs">Senior Training Captain</span>
            </div>
        </div>

        <nav class="mt-6 mx-8">    
            <a class="transition duration-500 flex items-center py-3 px-4 rounded-full text-sm hover:bg-gray-800 hover:bg-opacity-60"
                href="{{ route('dashboard') }}">
                <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-smart-home inline-block w-6" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                    <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                    <path d="M19 8.71l-5.333 -4.148a2.666 2.666 0 0 0 -3.274 0l-5.334 4.148a2.665 2.665 0 0 0 -1.029 2.105v7.2a2 2 0 0 0 2 2h12a2 2 0 0 0 2 -2v-7.2c0 -.823 -.38 -1.6 -1.03 -2.105"></path>
                    <path d="M16 15c-2.21 1.333 -5.792 1.333 -8 0"></path>
                </svg>

                <span class="mx-3">Dashboard</span>
            </a>

            <a class="transition duration-500 flex items-center py-3 px-4 rounded-full text-sm hover:bg-gray-800 hover:bg-opacity-60"
                href="{{ route('cfcdc') }}">
                <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-plane inline-block w-6" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                    <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                    <path d="M16 10h4a2 2 0 0 1 0 4h-4l-4 7h-3l2 -7h-4l-2 2h-3l2 -4l-2 -4h3l2 2h4l-2 -7h3z"></path>
                </svg>

                <span class="mx-3">CFCDC</span>
            </a>

            <a class="transition duration-500 flex items-center py-3 px-4 rounded-full text-sm hover:bg-gray-800 hover:bg-opacity-60"
                href="#">
                <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-calendar inline-block w-6" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                    <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                    <rect x="4" y="5" width="16" height="16" rx="2"></rect>
                    <line x1="16" y1="3" x2="16" y2="7"></line>
                    <line x1="8" y1="3" x2="8" y2="7"></line>
                    <line x1="4" y1="11" x2="20" y2="11"></line>
                    <line x1="11" y1="15" x2="12" y2="15"></line>
                    <line x1="12" y1="15" x2="12" y2="18"></line>
                </svg>

                <span class="mx-3">Schedule</span>
            </a>

            <a class="transition duration-500 flex items-center py-3 px-4 rounded-full text-sm hover:bg-gray-800 hover:bg-opacity-60"
                href="#">
                <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-server inline-block w-6" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                    <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                    <rect x="3" y="4" width="18" height="8" rx="3"></rect>
                    <rect x="3" y="12" width="18" height="8" rx="3"></rect>
                    <line x1="7" y1="8" x2="7" y2="8.01"></line>
                    <line x1="7" y1="16" x2="7" y2="16.01"></line>
                </svg>

                <span class="mx-3">Resources</span>
            </a>

            <a class="transition duration-500 flex items-center py-3 px-4 rounded-full text-sm hover:bg-gray-800 hover:bg-opacity-60"
                href="#">
                <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-lifebuoy inline-block w-6" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                    <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                    <circle cx="12" cy="12" r="4"></circle>
                    <circle cx="12" cy="12" r="9"></circle>
                    <line x1="15" y1="15" x2="18.35" y2="18.35"></line>
                    <line x1="9" y1="15" x2="5.65" y2="18.35"></line>
                    <line x1="5.65" y1="5.65" x2="9" y2="9"></line>
                    <line x1="18.35" y1="5.65" x2="15" y2="9"></line>
                </svg>

                <span class="mx-3">Help</span>
            </a>

            @if (Auth::user()->staff == true)

                <a class="transition duration-500 flex items-center py-3 px-4 rounded-full text-sm hover:bg-gray-800 hover:bg-opacity-60"
                    href="{{ route('staff.dashboard') }}" target="_blank">
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

                    <span class="mx-3">Staff Access</span>
                </a>

                <a class="transition duration-500 flex items-center py-3 px-4 rounded-full text-sm hover:bg-gray-800 hover:bg-opacity-60"
                    href="#">
                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-inbox inline-block w-6" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                        <rect x="4" y="4" width="16" height="16" rx="2"></rect>
                        <path d="M4 13h3l3 3h4l3 -3h3"></path>
                    </svg>

                    <span class="mx-3">xMail</span>
                </a>

            @endif
        </nav>
    </div>

<!-- Application Sidebar End -->
