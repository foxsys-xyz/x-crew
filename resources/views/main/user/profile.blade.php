@extends('layouts.app')

@section('content')
 
    <div x-data="{ sidebarOpen: false }" class="flex h-screen bg-gray-100">

        @include('layouts.cloud.sidebar')

        <div class="flex-1 flex flex-col overflow-hidden">
            <div class="bg-white overflow-y-auto">

                @include('layouts.cloud.header')

                <main class="flex-1 overflow-x-hidden bg-gray-100 rounded-tl-3xl rounded-bl-3xl min-h-screen">
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

                        @if (session()->has('success'))

                            <div class="lg:flex justify-center text-center px-10 py-5 text-xs text-white bg-indigo-500 mt-8 rounded-3xl">
                                <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-ban inline-block w-4 mr-3" viewBox="0 0 24 24" stroke-width="1.5" stroke="#ffffff" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                    <circle cx="12" cy="12" r="9" />
                                    <line x1="5.7" y1="5.7" x2="18.3" y2="18.3" />
                                </svg>
                                {{ session()->get('success') }}
                            </div>

                        @endif

                        @if (session()->has('error'))

                            <div class="lg:flex justify-center text-center px-10 py-5 text-xs text-white bg-red-500 mt-8 rounded-3xl">
                                <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-ban inline-block w-4 mr-3" viewBox="0 0 24 24" stroke-width="1.5" stroke="#ffffff" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                    <circle cx="12" cy="12" r="9" />
                                    <line x1="5.7" y1="5.7" x2="18.3" y2="18.3" />
                                </svg>
                                {{ session()->get('error') }}
                            </div>

                        @endif

                        <!-- Laravel's Validation Errors -->

                        @if ($errors->any())

                            <div class="lg:flex justify-center text-center px-10 py-5 text-xs text-white bg-red-500 mt-8 rounded-3xl">
                                <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-ban inline-block w-4 mr-3" viewBox="0 0 24 24" stroke-width="1.5" stroke="#ffffff" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                    <circle cx="12" cy="12" r="9" />
                                    <line x1="5.7" y1="5.7" x2="18.3" y2="18.3" />
                                </svg>
                                strange, an error. maybe retry entering the details correctly?
                            </div>

                        @endif

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

                                                @if (Auth::user()->rwp == true)
                                                    <div class="tooltip">
                                                        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-circle-check inline-block w-5 ml-3 cursor-pointer" viewBox="0 0 24 24" stroke-width="1.5" stroke="#6366f1" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                                            <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                                            <circle cx="12" cy="12" r="9" />
                                                            <path d="M9 12l2 2l4 -4" />
                                                        </svg>
                                                        <span class="absolute tooltip-text text-xs font-light px-2 py-1 text-white bg-black opacity-75 ml-3 rounded-full">Real World Pilot</span>
                                                    </div>
                                                @endif

                                                @if (Auth::user()->staff == true)
                                                    <div class="tooltip">
                                                        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-drone inline-block w-5 {{ Auth::user()->rwp != true ? 'ml-3' : 'ml-1' }} cursor-pointer" viewBox="0 0 24 24" stroke-width="1.5" stroke="#22c55e" fill="none" stroke-linecap="round" stroke-linejoin="round">
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
                                                        <span class="absolute tooltip-text text-xs font-light px-2 py-1 text-white bg-black opacity-75 ml-3 rounded-full">Staff Member</span>
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
                                            about profile badges
                                        </h5>
                                        <span class="flex text-gray-500 text-xs">profile badges for real world pilots & management</span>

                                        <p class="mt-6 text-xs">
                                            these badges are only given to real world pilots holding a valid license or the virtual airline managment. if you're a valid license holder, 
                                            contact your virtual airline management with an image of your license and ask them to verify you. else, if you want to become a part of the management,
                                            please email to the appropriate contact.
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
                                                    <span class="text-xs lg:flex items-center {{ $errors->has('email') ? 'text-red-500' : '' }}">
                                                        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-arrow-down-right inline-block w-4 mr-3" viewBox="0 0 24 24" stroke-width="1.5" stroke="{{ $errors->has('email') ? '#f56565' : '#2c3e50' }}" fill="none" stroke-linecap="round" stroke-linejoin="round">
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
                                    <div class="bg-white rounded-3xl p-6 mt-8 shadow-lg">
                                        <h5 class="text-gray-700 leading-3 font-medium inline-flex items-center">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-lock inline-block w-5 mr-3" viewBox="0 0 24 24" stroke-width="1.5" stroke="#2c3e50" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                                <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                                <rect x="5" y="11" width="14" height="10" rx="2" />
                                                <circle cx="12" cy="16" r="1" />
                                                <path d="M8 11v-4a4 4 0 0 1 8 0v4" />
                                            </svg>
                                            Edit / Update Password
                                        </h5>
                                        <span class="flex text-gray-500 text-xs">please confirm old, and enter new password</span>

                                        <form action="{{ route('profile.password.update') }}" method="post">

                                            @csrf

                                            @method('patch')

                                            <div class="lg:flex mt-6 gap-2">
                                                <div class="lg:w-1/3 mb-2 lg:mb-0">
                                                    <span class="text-xs lg:flex items-center {{ $errors->has('oldpass') ? 'text-red-500' : '' }}">
                                                        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-arrow-down-right inline-block w-4 mr-3" viewBox="0 0 24 24" stroke-width="1.5" stroke="{{ $errors->has('oldpass') ? '#f56565' : '#2c3e50' }}" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                                            <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                                            <line x1="7" y1="7" x2="17" y2="17" />
                                                            <polyline points="17 8 17 17 8 17" />
                                                        </svg>
                                                        old password
                                                    </span>
                                                    <input name="oldpass" type="password" class="w-full lg:w-full mt-2 outline-none px-4 py-2 rounded-full {{ $errors->has('oldpass') ? 'focus:ring focus:ring-red-500' : 'focus:ring focus:ring-indigo-500' }} bg-gray-100 transition duration-500" placeholder="••••••••••" />
                                                </div>
                                                <div class="lg:w-1/3 mb-2 lg:mb-0">
                                                    <span class="text-xs lg:flex items-center {{ $errors->has('newpass') ? 'text-red-500' : '' }}">
                                                        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-arrow-down-right inline-block w-4 mr-3" viewBox="0 0 24 24" stroke-width="1.5" stroke="{{ $errors->has('newpass') ? '#f56565' : '#2c3e50' }}" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                                            <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                                            <line x1="7" y1="7" x2="17" y2="17" />
                                                            <polyline points="17 8 17 17 8 17" />
                                                        </svg>
                                                        new password
                                                    </span>
                                                    <input name="newpass" type="password" class="w-full lg:w-full mt-2 outline-none px-4 py-2 rounded-full {{ $errors->has('newpass') ? 'focus:ring focus:ring-red-500' : 'focus:ring focus:ring-indigo-500' }} bg-gray-100 transition duration-500" placeholder="••••••••••" />
                                                </div>
                                                <div class="lg:w-1/3 mb-2 lg:mb-0">
                                                    <span class="text-xs lg:flex items-center {{ $errors->has('newpass_confirmation') ? 'text-red-500' : '' }}">
                                                        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-arrow-down-right inline-block w-4 mr-3" viewBox="0 0 24 24" stroke-width="1.5" stroke="{{ $errors->has('newpass_confirmation') ? '#f56565' : '#2c3e50' }}" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                                            <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                                            <line x1="7" y1="7" x2="17" y2="17" />
                                                            <polyline points="17 8 17 17 8 17" />
                                                        </svg>
                                                        confirm new password
                                                    </span>
                                                    <input name="newpass_confirmation" type="password" class="w-full lg:w-full mt-2 outline-none px-4 py-2 rounded-full {{ $errors->has('newpass_confirmation') ? 'focus:ring focus:ring-red-500' : 'focus:ring focus:ring-indigo-500' }} bg-gray-100 transition duration-500" placeholder="••••••••••" />
                                                </div>
                                            </div>
                                            <div class="mt-6 flex justify-end">
                                                <div class="lg:mt-0 mt-3 w-full lg:w-auto">
                                                    <button type="submit" class="text-sm justify-center lg:text-base w-full lg:w-auto flex items-center focus:outline-none px-4 py-2 rounded-full focus:shadow-outline bg-indigo-500 hover:bg-indigo-600 text-white transition duration-500" placeholder="username">
                                                        update password
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
                
                @include('layouts.cloud.footer')

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
