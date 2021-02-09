
<!-- Application Header -->

    <header class="flex justify-between items-center py-4 px-8 lg:pl-0 bg-white">
        <div class="flex items-center">
            <button @click="sidebarOpen = true" class="text-gray-500 focus:outline-none lg:hidden">
                <svg class="h-6 w-6" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M4 6H20M4 12H20M4 18H11" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                        stroke-linejoin="round"></path>
                </svg>
            </button>

            <span class="lg:block pull-left hidden text-sm"><img src="{{ asset('img/va_logo.png') }}" class="h-5" /></span>
        </div>

        <div class="flex items-center">
            
            <div x-data="{ notificationOpen: false }" class="relative">
                <button @click="notificationOpen = ! notificationOpen"
                    class="flex mx-4 text-gray-600 focus:outline-none">
                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-notification inline-block w-6" viewBox="0 0 24 24" stroke-width="1.5" stroke="#2c3e50" fill="none" stroke-linecap="round" stroke-linejoin="round">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                        <path d="M10 6h-3a2 2 0 0 0 -2 2v9a2 2 0 0 0 2 2h9a2 2 0 0 0 2 -2v-3" />
                        <circle cx="17" cy="7" r="3" />
                    </svg>
                </button>

                <div x-show="notificationOpen" @click="notificationOpen = false"
                class="fixed inset-0 h-full w-full z-10" style="display: none;"></div>

                <div x-show="notificationOpen"
                    x-transition:enter="transition ease-out duration-100"
                    x-transition:enter-start="transform opacity-0 scale-95"
                    x-transition:enter-end="transform opacity-100 scale-100"
                    x-transition:leave="transition ease-in duration-75"
                    x-transition:leave-start="transform opacity-100 scale-100"
                    x-transition:leave-end="transform opacity-0 scale-95"
                    class="absolute z-30 right-0 mt-8 w-80 bg-white rounded-lg shadow-xl overflow-hidden"
                    style="width: 20rem; display: none;">
                    <a href="#"
                        class="flex items-center px-4 py-3 text-gray-600 hover:text-white hover:bg-indigo-600 -mx-2">
                        <img class="h-8 w-8 rounded-full object-cover mx-1"
                            src="https://images.unsplash.com/photo-1531427186611-ecfd6d936c79?ixlib=rb-1.2.1&amp;ixid=eyJhcHBfaWQiOjEyMDd9&amp;auto=format&amp;fit=crop&amp;w=634&amp;q=80"
                            alt="avatar">
                        <p class="text-sm mx-2">
                            <span class="font-bold" href="#">Sara Salah</span> replied on the <span
                                class="font-bold text-indigo-400" href="#">Upload Image</span> artical . 2m
                        </p>
                    </a>
                    <a href="#"
                        class="flex items-center px-4 py-3 text-gray-600 hover:text-white hover:bg-indigo-600 -mx-2">
                        <img class="h-8 w-8 rounded-full object-cover mx-1"
                            src="https://images.unsplash.com/photo-1531427186611-ecfd6d936c79?ixlib=rb-1.2.1&amp;ixid=eyJhcHBfaWQiOjEyMDd9&amp;auto=format&amp;fit=crop&amp;w=634&amp;q=80"
                            alt="avatar">
                        <p class="text-sm mx-2">
                            <span class="font-bold" href="#">Slick Net</span> start following you . 45m
                        </p>
                    </a>
                    <a href="#"
                        class="flex items-center px-4 py-3 text-gray-600 hover:text-white hover:bg-indigo-600 -mx-2">
                        <img class="h-8 w-8 rounded-full object-cover mx-1"
                            src="https://images.unsplash.com/photo-1450297350677-623de575f31c?ixlib=rb-1.2.1&amp;ixid=eyJhcHBfaWQiOjEyMDd9&amp;auto=format&amp;fit=crop&amp;w=334&amp;q=80"
                            alt="avatar">
                        <p class="text-sm mx-2">
                            <span class="font-bold" href="#">Jane Doe</span> Like Your reply on <span
                                class="font-bold text-indigo-400" href="#">Test with TDD</span> artical . 1h
                        </p>
                    </a>
                    <a href="#"
                        class="flex items-center px-4 py-3 text-gray-600 hover:text-white hover:bg-indigo-600 -mx-2">
                        <img class="h-8 w-8 rounded-full object-cover mx-1"
                            src="https://images.unsplash.com/photo-1580489944761-15a19d654956?ixlib=rb-1.2.1&amp;ixid=eyJhcHBfaWQiOjEyMDd9&amp;auto=format&amp;fit=crop&amp;w=398&amp;q=80"
                            alt="avatar">
                        <p class="text-sm mx-2">
                            <span class="font-bold" href="#">Abigail Bennett</span> start following you . 3h
                        </p>
                    </a>
                </div>
            </div>

            <div x-data="{ dropdownOpen: false }" class="relative">
                <button @click="dropdownOpen = ! dropdownOpen"
                    class="relative block w-8 rounded-full overflow-hidden focus:outline-none">
                    <img class="h-full w-full object-cover"
                        src="{{ Auth::user()->avatar }}"
                        alt="Your avatar">
                </button>

                <div x-show="dropdownOpen" @click="dropdownOpen = false" class="fixed inset-0 h-full w-full z-10"
                style="display: none;"></div>

                <div x-show="dropdownOpen" 
                    x-transition:enter="transition ease-out duration-100"
                    x-transition:enter-start="transform opacity-0 scale-95"
                    x-transition:enter-end="transform opacity-100 scale-100"
                    x-transition:leave="transition ease-in duration-75"
                    x-transition:leave-start="transform opacity-100 scale-100"
                    x-transition:leave-end="transform opacity-0 scale-95"
                    class="absolute z-30 right-0 mt-8 w-64 bg-white rounded-3xl overflow-hidden shadow-lg p-3"
                    style="display: none;">

                    <h5 class="font-semibold px-4 pt-2 flex items-center">
                        {{ Auth::user()->fname . ' ' . Auth::user()->lname }}

                        @if (Auth::user()->rwp == true)
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-circle-check inline-block w-5 ml-3" viewBox="0 0 24 24" stroke-width="1.5" stroke="#6366f1" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                <circle cx="12" cy="12" r="9" />
                                <path d="M9 12l2 2l4 -4" />
                            </svg>
                        @endif

                        @if (Auth::user()->staff == true)
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-drone inline-block w-5 {{ Auth::user()->rwp != true ? 'ml-3' : 'ml-1' }}" viewBox="0 0 24 24" stroke-width="1.5" stroke="#22c55e" fill="none" stroke-linecap="round" stroke-linejoin="round">
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
                        @endif
                    </h5>

                    <div class="p-4 leading-4">
                        <span class="text-xs text-gray-500">[ {{ Auth::user()->username }} ]</span> <br />
                        <span class="text-xs text-gray-500">Senior Training Captain</span>
                    </div>

                    <a href="{{ route('profile') }}"
                        class="transition duration-500 flex items-center px-4 py-2 rounded-full text-sm text-gray-700 hover:bg-gray-300 hover:bg-opacity-25">
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-user inline-block w-5 mr-3" viewBox="0 0 24 24" stroke-width="1.5" stroke="#2c3e50" fill="none" stroke-linecap="round" stroke-linejoin="round">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                            <circle cx="12" cy="7" r="4" />
                            <path d="M6 21v-2a4 4 0 0 1 4 -4h4a4 4 0 0 1 4 4v2" />
                        </svg>
                        Profile
                    </a>

                    <a href="{{ route('cfcdc') }}"
                        class="transition duration-500 flex items-center px-4 py-2 rounded-full text-sm text-gray-700 hover:bg-gray-300 hover:bg-opacity-25">
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-plane inline-block w-5 mr-3" viewBox="0 0 24 24" stroke-width="1.5" stroke="#2c3e50" fill="none" stroke-linecap="round" stroke-linejoin="round">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                            <path d="M16 10h4a2 2 0 0 1 0 4h-4l-4 7h-3l2 -7h-4l-2 2h-3l2-4l-2 -4h3l2 2h4l-2 -7h3z" />
                        </svg>
                        CFCDC
                    </a>

                    <form id="logout" action="{{ route('logout') }}" method="post">

                        @csrf

                    </form>
                    
                    <a x-on:click="document.getElementById('logout').submit();"
                        class="transition duration-500 cursor-pointer flex items-center px-4 py-2 rounded-full text-sm text-gray-700 hover:bg-gray-300 hover:bg-opacity-25">
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-logout inline-block w-5 mr-3" viewBox="0 0 24 24" stroke-width="1.5" stroke="#2c3e50" fill="none" stroke-linecap="round" stroke-linejoin="round">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                            <path d="M14 8v-2a2 2 0 0 0 -2 -2h-7a2 2 0 0 0 -2 2v12a2 2 0 0 0 2 2h7a2 2 0 0 0 2 -2v-2" />
                            <path d="M7 12h14l-3 -3m0 6l3 -3" />
                        </svg>
                        Logout
                    </a>
                </div>
            </div>
        </div>
    </header>

<!-- Application Header End -->
