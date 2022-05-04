
<!-- Application Header -->

    <header class="flex justify-between items-center py-4 px-8 lg:pl-0">
        <div class="flex items-center">
            <button @click="sidebarOpen = true" class="focus:outline-none lg:hidden">
                <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-align-left w-6" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                    <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                    <line x1="4" y1="6" x2="20" y2="6"></line>
                    <line x1="4" y1="12" x2="14" y2="12"></line>
                    <line x1="4" y1="18" x2="18" y2="18"></line>
                </svg>
            </button>

            <span class="lg:block pull-left hidden text-sm"><img src="{{ asset('img/va_logo.png') }}" class="h-5" /></span>
        </div>

        <div class="flex items-center">
            <p class="text-sm" id="zuluClock"></p>
        </div>

        <div class="flex items-center">
            <div x-data="{ notificationOpen: false }" class="relative">
                <button @click="notificationOpen = ! notificationOpen"
                    class="flex mx-4 focus:outline-none">
                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-access-point inline-block w-6" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                        <line x1="12" y1="12" x2="12" y2="12.01"></line>
                        <path d="M14.828 9.172a4 4 0 0 1 0 5.656"></path>
                        <path d="M17.657 6.343a8 8 0 0 1 0 11.314"></path>
                        <path d="M9.168 14.828a4 4 0 0 1 0 -5.656"></path>
                        <path d="M6.337 17.657a8 8 0 0 1 0 -11.314"></path>
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
                    class="absolute z-30 right-0 mt-8 w-80 p-3 bg-gray-900 bg-opacity-40 rounded-3xl shadow-2xl backdrop-filter backdrop-blur-sm"
                    style="width: 20rem; display: none;">
                    <a href="#"
                        class="transition duration-500 flex items-center px-4 py-2 rounded-xl text-sm hover:bg-gray-800 hover:bg-opacity-60">
                        <p class="text-sm mx-2">
                            <span class="font-bold" href="#">Sara Salah</span> replied on the
                        </p>
                    </a>
                    <a href="#"
                        class="transition duration-500 flex items-center px-4 py-2 rounded-xl text-sm hover:bg-gray-800 hover:bg-opacity-60">
                        <p class="text-sm mx-2">
                            <span class="font-bold" href="#">Slick Net</span> start
                        </p>
                    </a>
                    <a href="#"
                        class="transition duration-500 flex items-center px-4 py-2 rounded-xl text-sm hover:bg-gray-800 hover:bg-opacity-60">
                        <p class="text-sm mx-2">
                            <span class="font-bold" href="#">Jane Doe</span> Like Your reply on
                        </p>
                    </a>
                    <a href="#"
                        class="transition duration-500 flex items-center px-4 py-2 rounded-xl text-sm hover:bg-gray-800 hover:bg-opacity-60">
                        <p class="text-sm mx-2">
                            <span class="font-bold" href="#">Abigail Bennett</span> start
                        </p>
                    </a>
                </div>
            </div>

            <div x-data="{ dropdownOpen: false }" class="relative">
                <button @click="dropdownOpen = ! dropdownOpen"
                    class="relative block w-8 rounded-xl overflow-hidden focus:outline-none">
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
                    class="absolute z-30 right-0 mt-8 w-64 p-3 bg-gray-900 bg-opacity-40 rounded-3xl shadow-2xl backdrop-filter backdrop-blur-sm"
                    style="display: none;">

                    <h5 class="font-semibold px-4 pt-2 flex items-center">
                        {{ Auth::user()->fname . ' ' . Auth::user()->lname }}

                        @if (Auth::user()->rwp == true)
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-circle-check text-white inline-block w-5 ml-3" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
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
                    </h5>

                    <div class="text-gray-400 p-4 leading-4">
                        <span class="text-xs">[ {{ Auth::user()->username }} ]</span> <br />
                        <span class="text-xs">Senior Training Captain</span>
                    </div>

                    <a href="{{ route('profile') }}"
                        class="transition duration-500 flex items-center px-4 py-2 rounded-xl text-sm hover:bg-gray-800 hover:bg-opacity-60">
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-user inline-block w-5 mr-3" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                            <circle cx="12" cy="7" r="4"></circle>
                            <path d="M6 21v-2a4 4 0 0 1 4 -4h4a4 4 0 0 1 4 4v2"></path>
                        </svg>
                        Profile
                    </a>

                    <a href="{{ route('cfcdc') }}"
                        class="transition duration-500 flex items-center px-4 py-2 rounded-xl text-sm hover:bg-gray-800 hover:bg-opacity-60">
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-plane inline-block w-5 mr-3" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                            <path d="M16 10h4a2 2 0 0 1 0 4h-4l-4 7h-3l2 -7h-4l-2 2h-3l2 -4l-2 -4h3l2 2h4l-2 -7h3z"></path>
                        </svg>
                        CFCDC
                    </a>

                    <form id="logout" action="{{ route('logout') }}" method="post">

                        @csrf

                    </form>
                    
                    <a x-on:click="document.getElementById('logout').submit();"
                        class="transition duration-500 cursor-pointer flex items-center px-4 py-2 rounded-xl text-sm hover:bg-gray-800 hover:bg-opacity-60">
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-logout inline-block w-5 mr-3" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                            <path d="M14 8v-2a2 2 0 0 0 -2 -2h-7a2 2 0 0 0 -2 2v12a2 2 0 0 0 2 2h7a2 2 0 0 0 2 -2v-2"></path>
                            <path d="M7 12h14l-3 -3m0 6l3 -3"></path>
                        </svg>
                        Logout
                    </a>
                </div>
            </div>
        </div>
    </header>

    <script>
        var span = document.getElementById('zuluClock');

        function time() {
        var d = new Date();
        var s = d.getUTCSeconds();
        var m = d.getUTCMinutes();
        var h = d.getUTCHours();
        span.textContent = 
            ("0" + h).substr(-2) + ":" + ("0" + m).substr(-2) + ":" + ("0" + s).substr(-2) + 'z';
        }

        setInterval(time, 1000);
    </script>

<!-- Application Header End -->
