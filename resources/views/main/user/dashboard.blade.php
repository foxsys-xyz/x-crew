@extends('layouts.app')

@section('content')
 
    <div x-data="{ sidebarOpen: false }" class="flex h-screen bg-gray-100">
        <div :class="sidebarOpen ? 'block' : 'hidden'" @click="sidebarOpen = false" class="fixed z-20 inset-0 bg-black opacity-50 transition-opacity lg:hidden"></div>
    
        <div :class="sidebarOpen ? 'translate-x-0 ease-out' : '-translate-x-full ease-in'" class="fixed z-30 inset-y-0 left-0 w-64 transition duration-300 transform bg-white overflow-y-auto lg:translate-x-0 lg:static lg:inset-0">
            
            @include('layouts.cloud.sidebar')

        </div>
        <div class="flex-1 flex flex-col overflow-hidden">
            
            @include('layouts.cloud.header')

            <div class="bg-white overflow-y-auto">
                <main class="flex-1 overflow-x-hidden bg-gray-100 rounded-tl-3xl">
                    <div class="mx-auto px-8 py-8">
                        <h4 class="text-gray-700 text-2xl leading-3 font-medium inline-flex items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-smart-home inline-block w-8 mr-3" viewBox="0 0 24 24" stroke-width="1.5" stroke="#2c3e50" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                <path d="M19 8.71l-5.333 -4.148a2.666 2.666 0 0 0 -3.274 0l-5.334 4.148a2.665 2.665 0 0 0 -1.029 2.105v7.2a2 2 0 0 0 2 2h12a2 2 0 0 0 2 -2v-7.2c0 -.823 -.38 -1.6 -1.03 -2.105" />
                                <path d="M16 15c-2.21 1.333-5.792 1.333-8 0" />
                            </svg>
                            Dashboard
                        </h4>
                        <span class="flex leading-3 text-gray-500 text-xs">welcome back, here is your airline dashboard.</span>

                        <div class="mt-8">
                            <div class="flex flex-wrap -mx-3">
                                <div class="w-full px-3 sm:w-1/2 lg:w-1/3">
                                    <div class="flex items-center p-6 rounded-3xl bg-white shadow-lg">
                                        <div class="p-3 rounded-xl bg-indigo-600">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-license inline-block w-6" viewBox="0 0 24 24" stroke-width="1.5" stroke="#ffffff" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                                <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                                <path d="M15 21h-9a3 3 0 0 1 -3 -3v-1h10v2a2 2 0 0 0 4 0v-14a2 2 0 1 1 2 2h-2m2 -4h-11a3 3 0 0 0 -3 3v11" />
                                                <line x1="9" y1="7" x2="13" y2="7" />
                                                <line x1="9" y1="11" x2="13" y2="11" />
                                            </svg>
                                        </div>
        
                                        <div class="mx-5">
                                            <h4 class="text-2xl text-gray-700">2</h4>
                                            <div class="text-gray-500">PIREPs</div>
                                        </div>
                                    </div>
                                </div>

                                <div class="w-full mt-6 px-3 sm:w-1/2 lg:w-1/3 sm:mt-0">
                                    <div class="flex items-center p-6 rounded-3xl bg-white shadow-lg">
                                        <div class="p-3 rounded-xl bg-gray-600">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-clock inline-block w-6" viewBox="0 0 24 24" stroke-width="1.5" stroke="#ffffff" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                                <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                                <circle cx="12" cy="12" r="9" />
                                                <polyline points="12 7 12 12 15 15" />
                                            </svg>
                                        </div>
        
                                        <div class="mx-5">
                                            <h4 class="text-2xl text-gray-700">03:21</h4>
                                            <div class="text-gray-500">Chrono</div>
                                        </div>
                                    </div>
                                </div>
        
                                <div class="w-full mt-6 px-3 sm:w-1/2 lg:w-1/3 lg:mt-0">
                                    <div class="flex items-center p-6 rounded-3xl bg-white shadow-lg">
                                        <div class="p-3 rounded-xl bg-yellow-600">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-plane-arrival inline-block w-6" viewBox="0 0 24 24" stroke-width="1.5" stroke="#ffffff" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                                <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                                <path d="M15 12h5a2 2 0 0 1 0 4h-15l-3 -6h3l2 2h3l-2 -7h3z" transform="rotate(15 12 12) translate(0 -1)" />
                                                <line x1="3" y1="21" x2="21" y2="21" />
                                            </svg>
                                        </div>
        
                                        <div class="mx-5">
                                            <h4 class="text-2xl text-gray-700">-221</h4>
                                            <div class="text-gray-500">Average</div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="w-full lg:w-3/5 mt-8 bg-white rounded-3xl p-6 shadow-lg">
                                <h5 class="text-gray-700 leading-3 font-medium inline-flex items-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="animate-spin icon icon-tabler icon-tabler-forbid-2 inline-block w-5 mr-3" viewBox="0 0 24 24" stroke-width="1.5" stroke="#2c3e50" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                        <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                        <circle cx="12" cy="12" r="9" />
                                        <line x1="9" y1="15" x2="15" y2="9" />
                                    </svg>
                                    Company [ ACARS ] Uplink
                                </h5>
                                <span class="flex text-gray-500 text-xs">11 aircraft stations online</span>

                                <div class="mt-6 rounded-xl rounded-br-none" id="mapid" style="height: 520px;"></div>
                                <script>
                                    var map = L.map('mapid').setView([51.505, -0.09], 13);

                                    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png').addTo(map);

                                    L.marker([51.5, -0.09]).addTo(map)
                                    .bindPopup('A pretty CSS3 popup.<br> Easily customizable.')
                                    .openPopup();
                                </script>
                            </div>
                        </div>
                    </div>
                </main>
            </div>
        </div>
    </div>

@endsection
