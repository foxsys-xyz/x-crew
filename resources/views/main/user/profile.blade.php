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
                                    <div class="rounded-3xl overflow-hidden bg-white shadow-lg">
                                        <div class="h-40 bg-cover bg-center" style="background-image: url(https://images.unsplash.com/photo-1587408811730-1a978e6c407d?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&w=1000&q=80);"></div>
                                        <div class="flex justify-left ml-6 -mt-8">
                                            <img src="{{ Auth::user()->avatar }}" class="w-24 rounded-3xl border-solid border-white border-2 -mt-4">		
                                        </div>
                                        <div class="p-8 pt-6">
                                            <h3 class="flex items-center text-black font-semibold leading-6">
                                                {{ Auth::user()->fname . ' ' . Auth::user()->lname }} 
                                                @if (Auth::user()->rwp == 1)
                                                    <div class="tooltip">
                                                        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-circle-check inline-block w-5 ml-3" viewBox="0 0 24 24" stroke-width="1.5" stroke="#667eea" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                                            <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                                            <circle cx="12" cy="12" r="9" />
                                                            <path d="M9 12l2 2l4 -4" />
                                                        </svg>
                                                        <span class="tooltip-text text-xs font-light px-2 py-1 text-white bg-black opacity-75 ml-3 rounded-full">Real World Pilot</span>
                                                    </div>
                                                @endif
                                            </h3>

                                            <span class="text-xs font-semibold">[ {{ Auth::user()->username }} ]</span>
                                            <span class="text-xs">{{ Carbon\Carbon::parse(Auth::user()->dob)->diff(\Carbon\Carbon::now())->format('%y') }} years old</span>

                                            <p class="mt-1 text-xs">{{ Auth::user()->bio == null ? '👋🏻 Hey there! I am a member of this virtual airline.' : '👋🏻 ' . Auth::user()->bio }}</p>

                                            @if (!!Auth::user()->vatsim)
                                                <p class="flex items-center mt-6 text-xs text-gray-500">
                                                    connected through <img class="h-5 ml-3" src="{{ asset('img/vatsim.png') }}" />
                                                </p>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="rounded-3xl bg-white mt-8 p-6 shadow-lg">
                                        <h5 class="text-gray-700 leading-3 font-medium inline-flex items-center">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-info-circle inline-block w-5 mr-3" viewBox="0 0 24 24" stroke-width="1.5" stroke="#2c3e50" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                                <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                                <circle cx="12" cy="12" r="9" />
                                                <line x1="12" y1="8" x2="12.01" y2="8" />
                                                <polyline points="11 12 12 12 12 16 13 16" />
                                            </svg>
                                            about verified badges
                                        </h5>
                                        <span class="flex text-gray-500 text-xs">verification badge for real world pilots</span>

                                        <p class="mt-6 text-xs">
                                            these badges are only given to real world pilots holding a valid license. if you're a valid license holder, 
                                            contact your virtual airline staff with an image of your license and ask them to verify you.
                                        </p>
                                    </div>
                                    <div class="rounded-3xl bg-white mt-8 p-6 shadow-lg">
                                        <h5 class="text-gray-700 leading-3 font-medium inline-flex items-center">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-info-circle inline-block w-5 mr-3" viewBox="0 0 24 24" stroke-width="1.5" stroke="#2c3e50" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                                <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                                <circle cx="12" cy="12" r="9" />
                                                <line x1="12" y1="8" x2="12.01" y2="8" />
                                                <polyline points="11 12 12 12 12 16 13 16" />
                                            </svg>
                                            about uneditable fields
                                        </h5>
                                        <span class="flex text-gray-500 text-xs">fields which cannot be edited / updated without staff authorization</span>

                                        <p class="mt-6 text-xs max-w-4xl">
                                            some fields such as pilot code, first name & last name, hub & nationality cannot be edited without staff's authorization.
                                            if you have changes and want to update the details, please contact the staff via respective communication channels.
                                        </p>
                                    </div>
                                </div>
                                <div class="w-full lg:w-2/3">
                                    <div class="bg-white rounded-3xl p-6 mt-8 lg:mt-0 shadow-lg">
                                        <h5 class="text-gray-700 leading-3 font-medium inline-flex items-center">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-rotate-clockwise inline-block w-5 mr-3" viewBox="0 0 24 24" stroke-width="1.5" stroke="#2c3e50" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                                <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                                <path d="M4.05 11a8 8 0 1 1 .5 4m-.5 5v-5h5" />
                                            </svg>
                                            Edit / Update Profile
                                        </h5>
                                        <span class="flex text-gray-500 text-xs">please fill out the fields that need to be updated</span>

                                        <form action="{{ route('profile.update') }}" method="post" enctype="multipart/form-data">

                                            @csrf

                                            @method('patch')

                                            <div class="lg:flex mt-6 gap-2">
                                                <div class="lg:w-1/3 mb-2 lg:mb-0">
                                                    <span class="text-xs lg:flex items-center">
                                                        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-arrow-down-right inline-block w-4 mr-3" viewBox="0 0 24 24" stroke-width="1.5" stroke="#2c3e50" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                                            <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                                            <line x1="7" y1="7" x2="17" y2="17" />
                                                            <polyline points="17 8 17 17 8 17" />
                                                        </svg>
                                                        pilot code / username
                                                    </span>
                                                    <input class="w-full lg:w-full mt-2 outline-none px-4 py-2 rounded-full focus:ring focus:ring-indigo-500 bg-gray-100 transition duration-500 cursor-not-allowed" value="{{ Auth::user()->username }}" disabled />
                                                </div>
                                                <div class="lg:w-1/3 mb-2 lg:mb-0">
                                                    <span class="text-xs lg:flex items-center">
                                                        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-arrow-down-right inline-block w-4 mr-3" viewBox="0 0 24 24" stroke-width="1.5" stroke="#2c3e50" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                                            <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                                            <line x1="7" y1="7" x2="17" y2="17" />
                                                            <polyline points="17 8 17 17 8 17" />
                                                        </svg>
                                                        first name
                                                    </span>
                                                    <input class="w-full lg:w-full mt-2 outline-none px-4 py-2 rounded-full focus:ring focus:ring-indigo-500 bg-gray-100 transition duration-500 cursor-not-allowed" value="{{ Auth::user()->fname }}" disabled />
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
                                                    <input class="w-full lg:w-full mt-2 outline-none px-4 py-2 rounded-full focus:ring focus:ring-indigo-500 bg-gray-100 transition duration-500 cursor-not-allowed" value="{{ Auth::user()->lname }}" disabled />
                                                </div>
                                            </div>
                                            <div class="lg:flex mt-2 gap-2">
                                                <div class="lg:w-3/5 mb-2 lg:mb-0">
                                                    <span class="text-xs lg:flex items-center">
                                                        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-arrow-down-right inline-block w-4 mr-3" viewBox="0 0 24 24" stroke-width="1.5" stroke="#2c3e50" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                                            <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                                            <line x1="7" y1="7" x2="17" y2="17" />
                                                            <polyline points="17 8 17 17 8 17" />
                                                        </svg>
                                                        email
                                                    </span>
                                                    <input type="email" name="email" class="w-full lg:w-full mt-2 outline-none px-4 py-2 rounded-full {{ $errors->has('email') ? 'focus:ring focus:ring-red-500' : 'focus:ring focus:ring-indigo-500' }} bg-gray-100 transition duration-500" value="{{ Auth::user()->email }}" />
                                                </div>
                                                <div class="lg:w-1/5 mb-2 lg:mb-0">
                                                    <span class="text-xs lg:flex items-center">
                                                        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-arrow-down-right inline-block w-4 mr-3" viewBox="0 0 24 24" stroke-width="1.5" stroke="#2c3e50" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                                            <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                                            <line x1="7" y1="7" x2="17" y2="17" />
                                                            <polyline points="17 8 17 17 8 17" />
                                                        </svg>
                                                        hub
                                                    </span>
                                                    <input class="w-full lg:w-full mt-2 outline-none px-4 py-2 rounded-full focus:ring focus:ring-indigo-500 bg-gray-100 transition duration-500 cursor-not-allowed" value="{{ Auth::user()->hub }}" disabled />
                                                </div>
                                                <div class="lg:w-1/5 mb-2 lg:mb-0">
                                                    <span class="text-xs lg:flex items-center">
                                                        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-arrow-down-right inline-block w-4 mr-3" viewBox="0 0 24 24" stroke-width="1.5" stroke="#2c3e50" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                                            <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                                            <line x1="7" y1="7" x2="17" y2="17" />
                                                            <polyline points="17 8 17 17 8 17" />
                                                        </svg>
                                                        nationality
                                                    </span>
                                                    <input class="w-full lg:w-full mt-2 outline-none px-4 py-2 rounded-full focus:ring focus:ring-indigo-500 bg-gray-100 transition duration-500 cursor-not-allowed" value="{{ Auth::user()->country }}" disabled />
                                                </div>
                                            </div>
                                            <div class="lg:flex mt-2 gap-2">
                                                <div class="lg:w-full mb-2 lg:mb-0">
                                                    <span class="text-xs lg:flex items-center">
                                                        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-arrow-down-right inline-block w-4 mr-3" viewBox="0 0 24 24" stroke-width="1.5" stroke="#2c3e50" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                                            <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                                            <line x1="7" y1="7" x2="17" y2="17" />
                                                            <polyline points="17 8 17 17 8 17" />
                                                        </svg>
                                                        bio / about
                                                    </span>
                                                    <input name="bio" class="w-full lg:w-full mt-2 outline-none px-4 py-2 rounded-full focus:ring focus:ring-indigo-500 bg-gray-100 transition duration-500" placeholder="👋🏻 hey! i am Joe, a flight sim enthusiast." value="{{ Auth::user()->bio }}" />
                                                </div>
                                            </div>
                                            <div class="lg:flex mt-2 gap-2">
                                                <div class="lg:w-full mb-2 lg:mb-0">
                                                    <span class="text-xs lg:flex items-center">
                                                        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-arrow-down-right inline-block w-4 mr-3" viewBox="0 0 24 24" stroke-width="1.5" stroke="#2c3e50" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                                            <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                                            <line x1="7" y1="7" x2="17" y2="17" />
                                                            <polyline points="17 8 17 17 8 17" />
                                                        </svg>
                                                        avatar
                                                    </span>
                                                    <label class="mt-2 w-full flex flex-col items-center px-4 py-4 bg-white rounded-xl border border-dashed cursor-pointer text-sm">
                                                        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-cloud w-8" viewBox="0 0 24 24" stroke-width="1.5" stroke="#2c3e50" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                                            <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                                            <path d="M7 18a4.6 4.4 0 0 1 0 -9a5 4.5 0 0 1 11 2h1a3.5 3.5 0 0 1 0 7h-12" />
                                                        </svg>
                                                        <span class="mt-1 leading-normal">upload avatar</span>
                                                        <span id="file-chosen">no file is chosen currently</span>
                                                        <input type="file" name="avatar" id="actual-btn" class="hidden" />
                                                    </label>
                                                </div>
                                            </div>
                                            <div class="mt-6 flex justify-end">
                                                <div class="lg:mt-0 mt-3 w-full lg:w-auto">
                                                    <button type="submit" class="text-sm justify-center lg:text-base w-full lg:w-auto flex items-center focus:outline-none px-4 py-2 rounded-full focus:shadow-outline bg-indigo-500 hover:bg-indigo-600 text-white transition duration-500" placeholder="username">
                                                        update data
                                                        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-rotate-clockwise inline-block w-6 ml-3" viewBox="0 0 24 24" stroke-width="1.5" stroke="#ffffff" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                                            <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                                            <path d="M4.05 11a8 8 0 1 1 .5 4m-.5 5v-5h5" />
                                                        </svg>
                                                    </button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </main>
            </div>
        </div>
    </div>

    <script>
        const actualBtn = document.getElementById('actual-btn');
        const fileChosen = document.getElementById('file-chosen');

        actualBtn.addEventListener('change', function() {
            fileChosen.textContent = this.files[0].name
        });
    </script>

@endsection
