@extends('layouts.app')

@section('content')
 
    <div x-data="{ sidebarOpen: false }" class="flex h-screen bg-gray-200">
        <div :class="sidebarOpen ? 'block' : 'hidden'" @click="sidebarOpen = false" class="fixed z-20 inset-0 bg-black opacity-50 transition-opacity lg:hidden"></div>
    
        <div :class="sidebarOpen ? 'translate-x-0 ease-out' : '-translate-x-full ease-in'" class="fixed z-30 inset-y-0 left-0 w-64 transition duration-300 transform bg-white overflow-y-auto lg:translate-x-0 lg:static lg:inset-0">
            <div class="mx-12 mt-10">
                <img class="w-24 rounded-3xl" src="{{ Auth::user()->avatar }}" />
                <div class="leading-5 mt-8">
                    <span class="text-black text-lg">howdy, {{ Auth::user()->username }}</span> <br />
                    <span class="text-xs font-semibold text-gray-500">{{ env('VA_NAME') }}</span>
                </div>
            </div>

            <nav class="mt-6 mx-8">    
                <a class="transition duration-500 flex items-center py-3 px-3 rounded-full text-sm text-gray-600 hover:bg-gray-400 hover:bg-opacity-25"
                    href="/ui-elements">
                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-smart-home inline-block w-6" viewBox="0 0 24 24" stroke-width="1.5" stroke="#2c3e50" fill="none" stroke-linecap="round" stroke-linejoin="round">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                        <path d="M19 8.71l-5.333 -4.148a2.666 2.666 0 0 0 -3.274 0l-5.334 4.148a2.665 2.665 0 0 0 -1.029 2.105v7.2a2 2 0 0 0 2 2h12a2 2 0 0 0 2 -2v-7.2c0 -.823 -.38 -1.6 -1.03 -2.105" />
                        <path d="M16 15c-2.21 1.333-5.792 1.333-8 0" />
                    </svg>
    
                    <span class="mx-3">Dashboard</span>
                </a>

                <a class="transition duration-500 flex items-center mt-2 py-3 px-3 rounded-full text-sm text-gray-600 hover:bg-gray-400 hover:bg-opacity-25"
                    href="/ui-elements">
                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-plane inline-block w-6" viewBox="0 0 24 24" stroke-width="1.5" stroke="#2c3e50" fill="none" stroke-linecap="round" stroke-linejoin="round">
                        <path stroke="none" d="M0 0h24v24H0z"/>
                        <path d="M16 10h4a2 2 0 0 1 0 4h-4l-4 7h-3l2 -7h-4l-2 2h-3l2-4l-2 -4h3l2 2h4l-2 -7h3z" />
                    </svg>
    
                    <span class="mx-3">CFCDC</span>
                </a>

                <a class="transition duration-500 flex items-center mt-2 py-3 px-3 rounded-full text-sm text-gray-600 hover:bg-gray-400 hover:bg-opacity-25"
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
        </div>
        <div class="flex-1 flex flex-col overflow-hidden">
            <header class="flex shadow-2xl justify-between items-center py-4 px-8 bg-white">
                <div class="flex items-center">
                    <button @click="sidebarOpen = true" class="text-gray-500 focus:outline-none lg:hidden">
                        <svg class="h-6 w-6" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M4 6H20M4 12H20M4 18H11" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round"></path>
                        </svg>
                    </button>
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
            <div class="bg-white overflow-y-auto">
                <main class="flex-1 overflow-x-hidden bg-gray-200 rounded-tl-3xl">
                    <div class="mx-auto px-12 py-8">
                        <h4 class="text-gray-700 text-2xl font-medium inline-flex items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-smart-home inline-block w-8 mr-3" viewBox="0 0 24 24" stroke-width="1.5" stroke="#2c3e50" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                <path d="M19 8.71l-5.333 -4.148a2.666 2.666 0 0 0 -3.274 0l-5.334 4.148a2.665 2.665 0 0 0 -1.029 2.105v7.2a2 2 0 0 0 2 2h12a2 2 0 0 0 2 -2v-7.2c0 -.823 -.38 -1.6 -1.03 -2.105" />
                                <path d="M16 15c-2.21 1.333-5.792 1.333-8 0" />
                            </svg>
                            Dashboard
                        </h4>
        
                        <div class="mt-4">
                            <div class="flex flex-wrap -mx-3">
                                <div class="w-full px-3 sm:w-1/2 lg:w-1/3">
                                    <div class="flex items-center p-6 rounded-3xl bg-white">
                                        <div class="p-3 rounded-xl bg-indigo-600">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-license inline-block w-6" viewBox="0 0 24 24" stroke-width="1.5" stroke="#ffffff" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                                <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                                <path d="M15 21h-9a3 3 0 0 1 -3 -3v-1h10v2a2 2 0 0 0 4 0v-14a2 2 0 1 1 2 2h-2m2 -4h-11a3 3 0 0 0 -3 3v11" />
                                                <line x1="9" y1="7" x2="13" y2="7" />
                                                <line x1="9" y1="11" x2="13" y2="11" />
                                            </svg>
                                        </div>
        
                                        <div class="mx-5">
                                            <h4 class="text-2xl font-semibold text-gray-700">2</h4>
                                            <div class="text-gray-500">PIREPs</div>
                                        </div>
                                    </div>
                                </div>
        
                                <div class="w-full mt-6 px-3 sm:w-1/2 lg:w-1/3 lg:mt-0">
                                    <div class="flex items-center p-6 rounded-3xl bg-white">
                                        <div class="p-3 rounded-xl bg-gray-600">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-clock inline-block w-6" viewBox="0 0 24 24" stroke-width="1.5" stroke="#ffffff" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                                <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                                <circle cx="12" cy="12" r="9" />
                                                <polyline points="12 7 12 12 15 15" />
                                            </svg>
                                        </div>
        
                                        <div class="mx-5">
                                            <h4 class="text-2xl font-semibold text-gray-700">03:21</h4>
                                            <div class="text-gray-500">Chrono</div>
                                        </div>
                                    </div>
                                </div>
        
                                <div class="w-full mt-6 px-3 sm:w-1/2 lg:w-1/3 lg:mt-0">
                                    <div class="flex items-center p-6 rounded-3xl bg-white">
                                        <div class="p-3 rounded-xl bg-orange-600">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-plane-arrival inline-block w-6" viewBox="0 0 24 24" stroke-width="1.5" stroke="#ffffff" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                                <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                                <path d="M15 12h5a2 2 0 0 1 0 4h-15l-3 -6h3l2 2h3l-2 -7h3z" transform="rotate(15 12 12) translate(0 -1)" />
                                                <line x1="3" y1="21" x2="21" y2="21" />
                                            </svg>
                                        </div>
        
                                        <div class="mx-5">
                                            <h4 class="text-2xl font-semibold text-gray-700">-221</h4>
                                            <div class="text-gray-500">Landing Average</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </main>
            </div>
        </div>
    </div>

@endsection
