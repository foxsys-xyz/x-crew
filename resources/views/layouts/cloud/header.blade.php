
<!-- Application Header -->

    <header class="flex shadow-2xl justify-between items-center py-4 px-8 lg:pl-0 bg-white">
        <div class="flex items-center">
            <button @click="sidebarOpen = true" class="text-gray-500 focus:outline-none lg:hidden">
                <svg class="h-6 w-6" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M4 6H20M4 12H20M4 18H11" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                        stroke-linejoin="round"></path>
                </svg>
            </button>
            <span class="lg:block pull-left hidden text-sm"><img src="{{ asset('img/va_logo.png') }}?id={{ Str::random(32) }}" class="h-5" /></span>
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
                    class="absolute right-0 mt-8 w-80 bg-white rounded-lg shadow-xl overflow-hidden z-10"
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
                    class="relative block h-8 w-8 rounded-full overflow-hidden shadow focus:outline-none">
                    <img class="h-full w-full object-cover"
                        src="{{ Auth::user()->avatar }}"
                        alt="Your avatar">
                </button>

                <div x-show="dropdownOpen" @click="dropdownOpen = false" class="fixed inset-0 h-full w-full z-10"
                    style="display: none;"></div>

                <div x-show="dropdownOpen"
                    class="absolute right-0 mt-8 w-48 bg-white rounded-md overflow-hidden shadow-xl z-10"
                    style="display: none;">
                    <a href="#"
                        class="block px-4 py-2 text-sm text-gray-700 hover:bg-indigo-600 hover:text-white">Profile</a>
                    <a href="#"
                        class="block px-4 py-2 text-sm text-gray-700 hover:bg-indigo-600 hover:text-white">Products</a>
                    <a href="/login"
                        class="block px-4 py-2 text-sm text-gray-700 hover:bg-indigo-600 hover:text-white">Logout</a>
                </div>
            </div>
        </div>
    </header>

<!-- Application Header End -->
