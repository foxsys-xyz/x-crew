
<!-- Application Sidebar -->

    <div :class="sidebarOpen ? 'block' : 'hidden'" @click="sidebarOpen = false" class="fixed z-20 inset-0 bg-black opacity-50 transition-opacity lg:hidden"></div>
        
    <div :class="sidebarOpen ? 'translate-x-0 ease-out' : '-translate-x-full ease-in'" class="lg:m-6 lg:rounded-3xl fixed z-30 inset-y-0 left-0 w-64 transition duration-300 transform bg-gray-900 bg-opacity-80 overflow-y-auto lg:translate-x-0 lg:static lg:inset-0">
        <div class="mx-12 mt-12">
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
                <span class="text-xs text-gray-400">Human Resources Manager</span>
                <div class="mt-8">
                    <p class="text-xs">
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-activity inline-block w-5 mr-1" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                            <path d="M3 12h4l3 8l4 -16l3 8h4"></path>
                        </svg>
                        All Sytems Online
                    </p>
                    <p class="text-xs">
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-activity inline-block w-5 mr-1" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                            <path d="M3 12h4l3 8l4 -16l3 8h4"></path>
                        </svg>
                        CFCDC Connected
                    </p>
                    <p class="text-xs">
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-activity inline-block w-5 mr-1" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                            <path d="M3 12h4l3 8l4 -16l3 8h4"></path>
                        </svg>
                        ACARS Online
                    </p>

                    <p class="mt-8 text-xs">
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-shield-check inline-block w-5 mr-1" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                            <path d="M9 12l2 2l4 -4"></path>
                            <path d="M12 3a12 12 0 0 0 8.5 3a12 12 0 0 1 -8.5 15a12 12 0 0 1 -8.5 -15a12 12 0 0 0 8.5 -3"></path>
                        </svg>
                        License Active
                    </p>
                </div>
            </div>
        </div>

        <nav class="mt-6 mx-8">    
            <a class="transition duration-500 flex items-center py-3 px-4 rounded-full text-sm hover:bg-gray-800 hover:bg-opacity-60"
                href="{{ route('dashboard') }}">
                <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-smart-home inline-block w-6 stroke-current" viewBox="0 0 24 24" stroke-width="1.5" fill="none" stroke-linecap="round" stroke-linejoin="round">
                    <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                    <path d="M19 8.71l-5.333 -4.148a2.666 2.666 0 0 0 -3.274 0l-5.334 4.148a2.665 2.665 0 0 0 -1.029 2.105v7.2a2 2 0 0 0 2 2h12a2 2 0 0 0 2 -2v-7.2c0 -.823 -.38 -1.6 -1.03 -2.105" />
                    <path d="M16 15c-2.21 1.333-5.792 1.333-8 0" />
                </svg>

                <span class="mx-3">Dashboard</span>
            </a>

            <a class="transition duration-500 flex items-center py-3 px-4 rounded-full text-sm hover:bg-gray-800 hover:bg-opacity-60"
                href="{{ route('cfcdc') }}">
                <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-plane inline-block w-6 stroke-current" viewBox="0 0 24 24" stroke-width="1.5" fill="none" stroke-linecap="round" stroke-linejoin="round">
                    <path stroke="none" d="M0 0h24v24H0z"/>
                    <path d="M16 10h4a2 2 0 0 1 0 4h-4l-4 7h-3l2 -7h-4l-2 2h-3l2-4l-2 -4h3l2 2h4l-2 -7h3z" />
                </svg>

                <span class="mx-3">Data Center</span>
            </a>

            <a class="transition duration-500 flex items-center py-3 px-4 rounded-full text-sm hover:bg-gray-800 hover:bg-opacity-60"
                href="#">
                <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-lifebuoy inline-block w-6 stroke-current" viewBox="0 0 24 24" stroke-width="1.5" fill="none" stroke-linecap="round" stroke-linejoin="round">
                    <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                    <circle cx="12" cy="12" r="4" />
                    <circle cx="12" cy="12" r="9" />
                    <line x1="15" y1="15" x2="18.35" y2="18.35" />
                    <line x1="9" y1="15" x2="5.65" y2="18.35" />
                    <line x1="5.65" y1="5.65" x2="9" y2="9" />
                    <line x1="18.35" y1="5.65" x2="15" y2="9" />
                </svg>

                <span class="mx-3">PIREPs</span>
            </a>

            <div class="ml-4 w-28 border border-gray-400 my-6"></div>

            <a class="transition duration-500 flex items-center py-3 px-4 rounded-full text-sm hover:bg-gray-800 hover:bg-opacity-60"
                href="#">
                <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-users inline-block w-6 stroke-current" viewBox="0 0 24 24" stroke-width="1.5" fill="none" stroke-linecap="round" stroke-linejoin="round">
                    <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                    <circle cx="9" cy="7" r="4"></circle>
                    <path d="M3 21v-2a4 4 0 0 1 4 -4h4a4 4 0 0 1 4 4v2"></path>
                    <path d="M16 3.13a4 4 0 0 1 0 7.75"></path>
                    <path d="M21 21v-2a4 4 0 0 0 -3 -3.85"></path>
                </svg>

                <span class="mx-3">Pilots</span>
            </a>

            <a class="transition duration-500 flex items-center py-3 px-4 rounded-full text-sm hover:bg-gray-800 hover:bg-opacity-60"
                href="#">
                <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-clipboard-list inline-block w-6 stroke-current" viewBox="0 0 24 24" stroke-width="1.5" fill="none" stroke-linecap="round" stroke-linejoin="round">
                    <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                    <path d="M9 5h-2a2 2 0 0 0 -2 2v12a2 2 0 0 0 2 2h10a2 2 0 0 0 2 -2v-12a2 2 0 0 0 -2 -2h-2"></path>
                    <rect x="9" y="3" width="6" height="4" rx="2"></rect>
                    <line x1="9" y1="12" x2="9.01" y2="12"></line>
                    <line x1="13" y1="12" x2="15" y2="12"></line>
                    <line x1="9" y1="16" x2="9.01" y2="16"></line>
                    <line x1="13" y1="16" x2="15" y2="16"></line>
                </svg>

                <span class="mx-3">Applications</span>
            </a>

            <div class="ml-4 w-28 border border-gray-400 my-6"></div>

            <a class="transition duration-500 flex items-center py-3 px-4 rounded-full text-sm hover:bg-gray-800 hover:bg-opacity-60"
                href="{{ route('dashboard') }}" target="_blank">
                <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-drone inline-block w-6 stroke-current" viewBox="0 0 24 24" stroke-width="1.5" fill="none" stroke-linecap="round" stroke-linejoin="round">
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

                <span class="mx-3">Pilot Access</span>
            </a>

            <a class="transition duration-500 flex items-center py-3 px-4 rounded-full text-sm hover:bg-gray-800 hover:bg-opacity-60"
                href="#">
                <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-inbox inline-block w-6 stroke-current" viewBox="0 0 24 24" stroke-width="1.5" fill="none" stroke-linecap="round" stroke-linejoin="round">
                    <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                    <rect x="4" y="4" width="16" height="16" rx="2"></rect>
                    <path d="M4 13h3l3 3h4l3 -3h3"></path>
                </svg>

                <span class="mx-3">xMail</span>
            </a>
        </nav>
    </div>

<!-- Application Sidebar End -->
