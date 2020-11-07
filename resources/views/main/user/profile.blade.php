@extends('layouts.app')

@section('content')
 
    <div x-data="{ sidebarOpen: false }" class="flex h-screen bg-gray-200">
        <div :class="sidebarOpen ? 'block' : 'hidden'" @click="sidebarOpen = false" class="fixed z-20 inset-0 bg-black opacity-50 transition-opacity lg:hidden"></div>
    
        <div :class="sidebarOpen ? 'translate-x-0 ease-out' : '-translate-x-full ease-in'" class="fixed z-30 inset-y-0 left-0 w-64 transition duration-300 transform bg-white overflow-y-auto lg:translate-x-0 lg:static lg:inset-0">
            
            @include('layouts.cloud.sidebar')

        </div>
        <div class="flex-1 flex flex-col overflow-hidden">
            
            @include('layouts.cloud.header')

            <div class="bg-white overflow-y-auto">
                <main class="flex-1 overflow-x-hidden bg-gray-200 rounded-tl-3xl">
                    <div class="mx-auto px-8 py-8">
                        <h4 class="text-gray-700 text-2xl leading-3 font-medium inline-flex items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-user inline-block w-8 mr-3" viewBox="0 0 24 24" stroke-width="1.5" stroke="#2c3e50" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                <circle cx="12" cy="7" r="4" />
                                <path d="M6 21v-2a4 4 0 0 1 4 -4h4a4 4 0 0 1 4 4v2" />
                            </svg>
                            Profile
                        </h4>
                        <span class="flex leading-3 text-gray-500 text-xs">hey {{ Auth::user()->fname }}, you can manage your profile here.</span>

                        <div class="mt-8">
                            <div class="lg:flex w-full gap-8">
                                <div class="w-full lg:w-1/3">
                                    <div class="rounded-3xl overflow-hidden bg-white">
                                        <div class="h-40 bg-cover bg-center" style="background-image: url(https://s2.best-wallpaper.net/wallpaper/2560x1600/1601/Turboprop-jet-engine-aircraft-3D_2560x1600.jpg);"></div>
                                        <div class="flex justify-left ml-6 -mt-8">
                                            <img src="{{ Auth::user()->avatar }}" class="w-24 rounded-3xl border-solid border-white border-2 -mt-4">		
                                        </div>
                                        <div class="p-8">
                                            <h3 class="flex items-center text-black font-semibold leading-5">
                                                {{ Auth::user()->fname . ' ' . Auth::user()->lname }} 
                                                @if (Auth::user()->rwp == 1)
                                                    <div class="tooltip">
                                                        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-circle-check inline-block w-5 ml-3" viewBox="0 0 24 24" stroke-width="1.5" stroke="#667eea" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                                            <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                                            <circle cx="12" cy="12" r="9" />
                                                            <path d="M9 12l2 2l4 -4" />
                                                        </svg>
                                                        <span class="tooltip-text text-xs font-light px-2 text-white bg-black opacity-75 ml-3 rounded-full">Real World Pilot</span>
                                                    </div>
                                                @endif
                                            </h3>
                                            <span class="text-xs font-semibold">[ {{ Auth::user()->username }} ]</span>

                                            <p class="mt-8 text-xs">{{ Auth::user()->bio == null ? '👋🏻 Hey there! I am a member of this virtual airline.' : '👋🏻 ' . Auth::user()->bio }}</p>
                                        </div>
                                    </div>
                                    <div class="rounded-3xl bg-white mt-8 p-6">
                                        <h5 class="text-gray-700 leading-3 font-medium inline-flex items-center">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-circle-check inline-block w-5 mr-3" viewBox="0 0 24 24" stroke-width="1.5" stroke="#667eea" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                                <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                                <circle cx="12" cy="12" r="9" />
                                                <path d="M9 12l2 2l4 -4" />
                                            </svg>
                                            about verified badge
                                        </h5>
                                        <span class="flex text-gray-500 text-xs">verification badge for real world pilots</span>

                                        <p class="mt-6 text-xs">
                                            these badges are only given to real world pilots holding a valid license. if you're a valid license holder, 
                                            contact your virtual airline staff with an image of your license and ask them to verify you.
                                        </p>
                                    </div>
                                </div>
                                <div class="w-full lg:w-2/3">
                                    <div class="bg-white rounded-3xl p-6 mt-8 lg:mt-0">
                                        <h5 class="text-gray-700 leading-3 font-medium inline-flex items-center">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-rotate-clockwise inline-block w-5 mr-3" viewBox="0 0 24 24" stroke-width="1.5" stroke="#2c3e50" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                                <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                                <path d="M4.05 11a8 8 0 1 1 .5 4m-.5 5v-5h5" />
                                            </svg>
                                            Edit / Update Profile
                                        </h5>
                                        <span class="flex text-gray-500 text-xs">please fill out the fields that need to be updated</span>
                                        <div class="lg:flex mt-6 gap-2">
                                            <div class="lg:w-1/3 mb-2 md:mb-0">
                                                <span class="text-xs lg:flex items-center">
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-arrow-down-right inline-block w-4 mr-3" viewBox="0 0 24 24" stroke-width="1.5" stroke="#2c3e50" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                                        <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                                        <line x1="7" y1="7" x2="17" y2="17" />
                                                        <polyline points="17 8 17 17 8 17" />
                                                    </svg>
                                                    pilot code / username
                                                </span>
                                                <input class="w-full lg:w-full mt-2 outline-none px-4 py-2 rounded-full focus:shadow-outline bg-gray-200 transition duration-500 cursor-not-allowed opacity-75" value="{{ Auth::user()->username }}" disabled />
                                            </div>
                                            <div class="lg:w-1/3 mb-2">
                                                <span class="text-xs lg:flex items-center">
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-arrow-down-right inline-block w-4 mr-3" viewBox="0 0 24 24" stroke-width="1.5" stroke="#2c3e50" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                                        <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                                        <line x1="7" y1="7" x2="17" y2="17" />
                                                        <polyline points="17 8 17 17 8 17" />
                                                    </svg>
                                                    first name
                                                </span>
                                                <input class="w-full lg:w-full mt-2 outline-none px-4 py-2 rounded-full focus:shadow-outline bg-gray-200 transition duration-500 cursor-not-allowed opacity-75" value="{{ Auth::user()->fname }}" disabled />
                                            </div>
                                            <div class="lg:w-1/3">
                                                <span class="text-xs lg:flex items-center">
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-arrow-down-right inline-block w-4 mr-3" viewBox="0 0 24 24" stroke-width="1.5" stroke="#2c3e50" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                                        <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                                        <line x1="7" y1="7" x2="17" y2="17" />
                                                        <polyline points="17 8 17 17 8 17" />
                                                    </svg>
                                                    last name
                                                </span>
                                                <input class="w-full lg:w-full mt-2 outline-none px-4 py-2 rounded-full focus:shadow-outline bg-gray-200 transition duration-500 cursor-not-allowed opacity-75" value="{{ Auth::user()->lname }}" disabled />
                                            </div>
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
