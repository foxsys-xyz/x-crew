@extends('layouts.app')

@section('content')
 
    <div class="mx-auto px-8 py-8" x-data="{ 'showModal': false }" @keydown.escape="showModal = false">
        <h4 class="text-2xl leading-3 font-medium inline-flex items-center">
            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-user inline-block w-8 mr-3" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                <circle cx="12" cy="7" r="4"></circle>
                <path d="M6 21v-2a4 4 0 0 1 4 -4h4a4 4 0 0 1 4 4v2"></path>
            </svg>
            Profile
        </h4>
        <span class="text-gray-400 flex leading-3 text-xs">hey {{ Auth::user()->fname }}, you can manage your profile here.</span>

        @if (session()->has('success'))

            <div class="lg:flex justify-center text-center px-10 py-5 text-xs bg-blue-600 mt-8 rounded-3xl shadow-2xl">
                <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-check inline-block w-4 mr-3" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                    <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                    <path d="M5 12l5 5l10 -10"></path>
                </svg>
                {{ session()->get('success') }}
            </div>

        @endif

        @if (session()->has('error'))

            <div class="lg:flex justify-center text-center px-10 py-5 text-xs bg-red-500 mt-8 rounded-3xl shadow-2xl">
                <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-circle-minus inline-block w-4 mr-3" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                    <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                    <circle cx="12" cy="12" r="9"></circle>
                    <line x1="9" y1="12" x2="15" y2="12"></line>
                </svg>
                {{ session()->get('error') }}
            </div>

        @endif

        <!-- Laravel's Validation Errors -->

        @if ($errors->any())

            <div class="lg:flex justify-center text-center px-10 py-5 text-xs text-white bg-red-500 mt-8 rounded-3xl shadow-2xl">
                <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-circle-minus inline-block w-4 mr-3" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                    <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                    <circle cx="12" cy="12" r="9"></circle>
                    <line x1="9" y1="12" x2="15" y2="12"></line>
                </svg>
                strange, an error. maybe retry entering the details correctly?
            </div>

        @endif

        <div class="mt-8">
            <div class="lg:flex w-full gap-8">
                <div class="w-full lg:w-1/3">
                    <x-card class="overflow-hidden">
                        <div class="h-40 bg-cover bg-center" style="background-image: url('https://wallpapercave.com/wp/wp2471512.jpg');"></div>
                        <div class="flex justify-left ml-5 -mt-8">
                            <img src="{{ Auth::user()->avatar }}" class="w-24 rounded-3xl -mt-4">		
                        </div>
                        <div class="p-6 pt-6">
                            <h3 class="flex items-center font-semibold leading-6">
                                {{ Auth::user()->fname . ' ' . Auth::user()->lname }} 

                                @if (Auth::user()->rwp == true)
                                    <div class="tooltip">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-circle-check text-blue-500 inline-block w-5 ml-3 cursor-pointer" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                            <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                            <circle cx="12" cy="12" r="9"></circle>
                                            <path d="M9 12l2 2l4 -4"></path>
                                        </svg>
                                        <span class="absolute tooltip-text text-xs font-light px-2 py-1 text-white bg-black bg-opacity-80 -mt-6 pb-1 -ml-5 rounded-full">Real World Pilot</span>
                                    </div>
                                @endif

                                @if (Auth::user()->staff == true)
                                    <div class="tooltip">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-crown text-yellow-400 inline-block w-5 {{ Auth::user()->rwp != true ? 'ml-3' : 'ml-2' }} cursor-pointer" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                            <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                            <path d="M12 6l4 6l5 -4l-2 10h-14l-2 -10l5 4z"></path>
                                        </svg>
                                        <span class="absolute tooltip-text text-xs font-light px-2 py-1 text-white bg-black bg-opacity-80 -mt-6 pb-1 -ml-5 rounded-full">Staff Member</span>
                                    </div>
                                @endif
                            </h3>

                            <span class="text-xs font-semibold">[ {{ Auth::user()->username }} ]</span>
                            <span class="text-xs">{{ Carbon\Carbon::parse(Auth::user()->dob)->diff(\Carbon\Carbon::now())->format('%y') }} years old.</span>

                            <p class="mt-1 text-xs">{{ Auth::user()->bio == null ? '🚀 Hey there! I am a member of this virtual airline.' : '🚀 ' . Auth::user()->bio }}</p>

                            @if (!!Auth::user()->vatsim)
                                <p class="flex items-center mt-6 text-xs text-gray-400">
                                    connected through <img class="h-5 ml-3" src="{{ asset('img/vatsim.png') }}" />
                                </p>
                            @endif
                        </div>
                    </x-card>
                    <x-card class="mt-8">
                        <h5 class="leading-3 font-medium inline-flex items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-info-circle inline-block w-5 mr-3" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                <circle cx="12" cy="12" r="9"></circle>
                                <line x1="12" y1="8" x2="12.01" y2="8"></line>
                                <polyline points="11 12 12 12 12 16 13 16"></polyline>
                            </svg>
                            about profile badges
                        </h5>
                        <span class="text-gray-400 flex text-xs">profile badges for real world pilots & management</span>

                        <p class="mt-6 text-xs">
                            these badges are only given to real world pilots holding a valid license or the virtual airline managment. if you're a valid license holder, 
                            contact your virtual airline management with an image of your license and ask them to verify you. else, if you want to become a part of the management,
                            please email to the appropriate contact.
                        </p>
                    </x-card>
                    <x-card class="mt-8">
                        <h5 class="leading-3 font-medium inline-flex items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-info-circle inline-block w-5 mr-3" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                <circle cx="12" cy="12" r="9"></circle>
                                <line x1="12" y1="8" x2="12.01" y2="8"></line>
                                <polyline points="11 12 12 12 12 16 13 16"></polyline>
                            </svg>
                            about uneditable fields
                        </h5>
                        <span class="text-gray-400 flex text-xs">fields which cannot be edited / updated without staff authorization</span>

                        <p class="mt-6 text-xs max-w-4xl">
                            some fields such as pilot code, first name & last name, hub & nationality cannot be edited without staff's authorization.
                            if you have changes and want to update the details, please contact the staff via respective communication channels.
                        </p>
                    </x-card>
                </div>
                <div class="w-full lg:w-2/3">
                    <x-card class="mt-8 lg:mt-0">
                        <h5 class="leading-3 font-medium inline-flex items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-rotate-clockwise inline-block w-5 mr-3" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                <path d="M4.05 11a8 8 0 1 1 .5 4m-.5 5v-5h5"></path>
                            </svg>
                            Edit / Update Profile
                        </h5>
                        <span class="text-gray-400 flex text-xs">please fill out the fields that need to be updated</span>

                        <form action="{{ route('profile.update') }}" method="post" enctype="multipart/form-data">

                            @csrf

                            @method('patch')

                            <div class="lg:flex mt-6 gap-2">
                                <div class="lg:w-1/3 mb-2 lg:mb-0">
                                    <span class="text-xs lg:flex items-center">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-check inline-block w-4 mr-3" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                            <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                            <path d="M5 12l5 5l10 -10"></path>
                                        </svg>
                                        pilot code / username
                                    </span>
                                    <x-forms.input class="mt-2 cursor-not-allowed" value="{{ Auth::user()->username }}" disabled />
                                </div>
                                <div class="lg:w-1/3 mb-2 lg:mb-0">
                                    <span class="text-xs lg:flex items-center">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-check inline-block w-4 mr-3" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                            <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                            <path d="M5 12l5 5l10 -10"></path>
                                        </svg>
                                        first name
                                    </span>
                                    <x-forms.input class="mt-2 cursor-not-allowed" value="{{ Auth::user()->fname }}" disabled />
                                </div>
                                <div class="lg:w-1/3">
                                    <span class="text-xs lg:flex items-center">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-check inline-block w-4 mr-3" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                            <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                            <path d="M5 12l5 5l10 -10"></path>
                                        </svg>
                                        last name
                                    </span>
                                    <x-forms.input class="mt-2 cursor-not-allowed" value="{{ Auth::user()->lname }}" disabled />
                                </div>
                            </div>
                            <div class="lg:flex mt-2 gap-2">
                                <div class="lg:w-3/5 mb-2 lg:mb-0">
                                    <span class="text-xs lg:flex items-center {{ $errors->has('email') ? 'text-red-500' : '' }}">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-arrow-down-right inline-block w-4 mr-3" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                            <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                            <line x1="7" y1="7" x2="17" y2="17"></line>
                                            <polyline points="17 8 17 17 8 17"></polyline>
                                        </svg>
                                        email
                                    </span>
                                    <x-forms.input  name="email" type="email" class="mt-2 {{ $errors->has('email') ? 'focus:ring-red-500' : 'focus:ring-blue-500' }}" value="{{ Auth::user()->email }}" />
                                </div>
                                <div class="lg:w-1/5 mb-2 lg:mb-0">
                                    <span class="text-xs lg:flex items-center">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-check inline-block w-4 mr-3" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                            <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                            <path d="M5 12l5 5l10 -10"></path>
                                        </svg>
                                        hub
                                    </span>
                                    <x-forms.input class="mt-2 cursor-not-allowed" value="{{ Auth::user()->hub }}" disabled />
                                </div>
                                <div class="lg:w-1/5 mb-2 lg:mb-0">
                                    <span class="text-xs lg:flex items-center">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-check inline-block w-4 mr-3" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                            <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                            <path d="M5 12l5 5l10 -10"></path>
                                        </svg>
                                        nationality
                                    </span>
                                    <x-forms.input class="mt-2 cursor-not-allowed" value="{{ Auth::user()->country }}" disabled />
                                </div>
                            </div>
                            <div class="lg:flex mt-2 gap-2">
                                <div class="lg:w-full mb-2 lg:mb-0">
                                    <span class="text-xs lg:flex items-center">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-arrow-down-right inline-block w-4 mr-3" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                            <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                            <line x1="7" y1="7" x2="17" y2="17"></line>
                                            <polyline points="17 8 17 17 8 17"></polyline>
                                        </svg>
                                        bio / about
                                    </span>
                                    <x-forms.input name="bio" class="mt-2 focus:ring-blue-500" placeholder="👋🏻 hey! i am Joe, a flight sim enthusiast." value="{{ Auth::user()->bio }}" />
                                </div>
                            </div>
                            <div class="lg:flex mt-2 gap-2">
                                <div class="lg:w-full mb-2 lg:mb-0">
                                    <span class="text-xs lg:flex items-center">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-arrow-down-right inline-block w-4 mr-3" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                            <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                            <line x1="7" y1="7" x2="17" y2="17"></line>
                                            <polyline points="17 8 17 17 8 17"></polyline>
                                        </svg>
                                        avatar
                                    </span>
                                    <label class="mt-2 w-full flex flex-col items-center px-4 py-4 bg-gray-800 bg-opacity-60 rounded-xl border-2 border-dashed cursor-pointer text-sm">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-cloud w-8" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                            <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                            <path d="M7 18a4.6 4.4 0 0 1 0 -9a5 4.5 0 0 1 11 2h1a3.5 3.5 0 0 1 0 7h-12"></path>
                                        </svg>
                                        <span class="mt-1 leading-normal">upload avatar</span>
                                        <span id="file-chosen">no file is chosen currently</span>
                                        <input type="file" name="avatar" id="actual-btn" class="hidden" />
                                    </label>
                                </div>
                            </div>
                            <div class="mt-6 flex justify-end">
                                <div class="lg:mt-0 mt-3 w-full lg:w-auto">
                                    <button type="submit" class="text-sm justify-center lg:text-base w-full lg:w-auto flex items-center focus:outline-none px-4 py-2 rounded-full focus:shadow-outline bg-blue-600 hover:bg-blue-700 transition duration-500" placeholder="username">
                                        update data
                                        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-rotate-clockwise inline-block w-6 ml-3" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                            <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                            <path d="M4.05 11a8 8 0 1 1 .5 4m-.5 5v-5h5"></path>
                                        </svg>
                                    </button>
                                </div>
                            </div>
                        </form>
                    </x-card>
                    <x-card class="mt-8">
                        <h5 class="leading-3 font-medium inline-flex items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-lock inline-block w-5 mr-3" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                <rect x="5" y="11" width="14" height="10" rx="2"></rect>
                                <circle cx="12" cy="16" r="1"></circle>
                                <path d="M8 11v-4a4 4 0 0 1 8 0v4"></path>
                            </svg>
                            Edit / Update Password
                        </h5>
                        <span class="text-gray-400 flex text-xs">please confirm old, and enter new password</span>

                        <form action="{{ route('profile.password.update') }}" method="post">

                            @csrf

                            @method('patch')

                            <div class="lg:flex mt-6 gap-2">
                                <div class="lg:w-1/3 mb-2 lg:mb-0">
                                    <span class="text-xs lg:flex items-center {{ $errors->has('oldpass') ? 'text-red-500' : '' }}">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-arrow-down-right inline-block w-4 mr-3" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                            <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                            <line x1="7" y1="7" x2="17" y2="17"></line>
                                            <polyline points="17 8 17 17 8 17"></polyline>
                                        </svg>
                                        old password
                                    </span>
                                    <x-forms.input name="oldpass" type="password" class="mt-2 {{ $errors->has('oldpass') ? 'focus:ring-red-500' : 'focus:ring-blue-500' }}" placeholder="••••••••••" />
                                </div>
                                <div class="lg:w-1/3 mb-2 lg:mb-0">
                                    <span class="text-xs lg:flex items-center {{ $errors->has('newpass') ? 'text-red-500' : '' }}">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-arrow-down-right inline-block w-4 mr-3" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                            <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                            <line x1="7" y1="7" x2="17" y2="17"></line>
                                            <polyline points="17 8 17 17 8 17"></polyline>
                                        </svg>
                                        new password
                                    </span>
                                    <x-forms.input name="newpass" type="password" class="mt-2 {{ $errors->has('newpass') ? 'focus:ring-red-500' : 'focus:ring-blue-500' }}" placeholder="••••••••••" />
                                </div>
                                <div class="lg:w-1/3 mb-2 lg:mb-0">
                                    <span class="text-xs lg:flex items-center {{ $errors->has('newpass_confirmation') ? 'text-red-500' : '' }}">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-arrow-down-right inline-block w-4 mr-3" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                            <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                            <line x1="7" y1="7" x2="17" y2="17"></line>
                                            <polyline points="17 8 17 17 8 17"></polyline>
                                        </svg>
                                        confirm new password
                                    </span>
                                    <x-forms.input name="newpass_confirmation" type="password" class="mt-2 {{ $errors->has('newpass_confirmation') ? 'focus:ring-red-500' : 'focus:ring-blue-500' }}" placeholder="••••••••••" />
                                </div>
                            </div>
                            <div class="mt-6 flex justify-end">
                                <div class="lg:mt-0 mt-3 w-full lg:w-auto">
                                    <button type="submit" class="text-sm justify-center lg:text-base w-full lg:w-auto flex items-center focus:outline-none px-4 py-2 rounded-full focus:shadow-outline bg-blue-600 hover:bg-blue-700 transition duration-500" placeholder="username">
                                        update password
                                        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-rotate-clockwise inline-block w-6 ml-3" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                            <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                            <path d="M4.05 11a8 8 0 1 1 .5 4m-.5 5v-5h5"></path>
                                        </svg>
                                    </button>
                                </div>
                            </div>
                        </form>
                    </x-card>
                </div>
            </div>
        </div>

        <!-- Modal -->
        <div class="fixed z-10 inset-0 overflow-y-auto" aria-labelledby="modal-title" role="dialog" aria-modal="true" x-show="showModal">
            <div class="flex items-center justify-center h-full pt-4 px-4 pb-20 text-center sm:block sm:p-0">

                <div class="fixed inset-0" aria-hidden="true"></div>

                <!-- This element is to trick the browser into centering the modal contents. -->
                <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>

                <div class="inline-block align-bottom bg-gray-900 bg-opacity-80 rounded-3xl shadow-2xl p-6 backdrop-filter backdrop-blur-sm text-left overflow-hidden transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full"
                    x-transition:enter="transition ease-out duration-100"
                    x-transition:enter-start="transform opacity-0 scale-95"
                    x-transition:enter-end="transform opacity-100 scale-100"
                    x-transition:leave="transition ease-in duration-75"
                    x-transition:leave-start="transform opacity-100 scale-100"
                    x-transition:leave-end="transform opacity-0 scale-95"
                    x-show="showModal"
                >
                    <div class="px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                        <div class="sm:flex sm:items-start">
                        <div class="mx-auto flex-shrink-0 flex items-center justify-center h-12 w-12 rounded-full sm:mx-0 sm:h-10 sm:w-10">
                            <!-- Heroicon name: outline/exclamation -->
                            <svg class="h-6 w-6 text-red-600" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                            </svg>
                        </div>
                        <div class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left">
                            <h3 class="text-lg leading-6 font-medium" id="modal-title">
                            Deactivate account
                            </h3>
                            <div class="mt-2">
                            <p class="text-sm text-gray-400">
                                Are you sure you want to deactivate your account? All of your data will be permanently removed. This action cannot be undone.
                            </p>
                            </div>
                        </div>
                        </div>
                    </div>
                    <div class="px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
                        <button @click="showModal = false" type="button" class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-red-600 text-base font-medium text-white hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500 sm:ml-3 sm:w-auto sm:text-sm">
                        Deactivate
                        </button>
                        <button type="button" class="mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm">
                        Cancel
                        </button>
                    </div>
                </div>
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
