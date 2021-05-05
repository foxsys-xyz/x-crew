@extends('layouts.app')

@section('content')

    <div class="h-screen bg-black text-white">

        <div class="hidden lg:flex items-center absolute bottom-0 left-0 px-10 py-5 text-xs">
            <img class="w-4 mr-3" src="{{ asset('img/foxsys-xyz [Icon] [Dark Back].png') }}" />
            <span class="text-xs">foxsys-xyz, {{ date('Y') }}. all rights reserved.</span>
        </div>

        @if (session()->has('error'))

            <div class="lg:flex justify-center absolute right-0 left-0 lg:top-0 text-center px-10 py-5 text-xs bg-red-500">
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

            <div class="lg:flex justify-center absolute right-0 left-0 lg:top-0 text-center px-10 py-5 text-xs bg-red-500">
                <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-circle-minus inline-block w-4 mr-3" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                    <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                    <circle cx="12" cy="12" r="9"></circle>
                    <line x1="9" y1="12" x2="15" y2="12"></line>
                </svg>
                strange, an error. maybe retry entering the details correctly?
            </div>

        @endif

        <div class="container h-full mx-auto flex justify-center items-center">
            <div class="m-4 p-8 w-full lg:w-1/2 bg-gray-900 bg-opacity-80 rounded-3xl shadow-2xl">
                
                @include('layouts.sso.auth.header')

                <form id="login-manual" action="{{ route('login.check') }}" method="post">

                    @csrf

                    <div class="mt-4 lg:flex w-full gap-2">
                        <div class="w-full lg:w-full mt-1 lg:mt-0">
                            <span class="text-xs lg:flex items-center {{ $errors->has('username') ? 'text-red-500' : '' }}">
                                <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-arrow-down-right inline-block w-4 mr-3" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                    <line x1="7" y1="7" x2="17" y2="17"></line>
                                    <polyline points="17 8 17 17 8 17"></polyline>
                                </svg>
                                username
                            </span>
                            <input name="username" class="w-full mt-2 outline-none border-none px-4 py-2 rounded-full {{ $errors->has('username') ? 'focus:ring focus:ring-red-500' : 'focus:ring focus:ring-blue-500' }} bg-gray-800 bg-opacity-60 transition duration-500" placeholder="{{ config(app.va_icao) }}1234" value="{{ old('username') }}" />
                        </div>
                        <div class="w-full lg:w-full mt-1 lg:mt-0">
                            <span class="text-xs lg:flex items-center {{ $errors->has('password') ? 'text-red-500' : '' }}">
                                <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-arrow-down-right inline-block w-4 mr-3" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                    <line x1="7" y1="7" x2="17" y2="17"></line>
                                    <polyline points="17 8 17 17 8 17"></polyline>
                                </svg>
                                password
                            </span>
                            <input name="password" type="password" class="w-full mt-2 outline-none border-none px-4 py-2 rounded-full {{ $errors->has('password') ? 'focus:ring focus:ring-red-500' : 'focus:ring focus:ring-blue-500' }} bg-gray-800 bg-opacity-60 transition duration-500" placeholder="••••••••••" />
                        </div>
                    </div>

                    <div class="mt-4 flex items-center">
                        <input id="remember_me" type="checkbox" class="rounded-full border-none text-blue-500 focus:ring focus:ring-blue-500 transition duration-300 bg-gray-800 bg-opacity-60" name="remember">
                        <span class="ml-3 text-xs">Remember Me?</span>
                    </div>
                </form>
                <div class="mt-4 lg:flex lg:float-right lg:gap-2">
                    <div x-data class="w-full lg:w-auto">
                        <form id="connect-with-vatsim" action="{{ route('connect.with.vatsim') }}" method="post">

                            @csrf

                        </form>
                        <button x-on:click="document.getElementById('connect-with-vatsim').submit();" class="text-sm justify-center lg:text-base w-full lg:w-auto flex items-center focus:outline-none px-4 py-2 rounded-full focus:shadow-outline bg-green-600 hover:bg-green-700 text-white transition duration-500" placeholder="username">
                            vatsim sso
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-rotate-clockwise-2 inline-block w-6 ml-3" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                <path d="M9 4.55a8 8 0 0 1 6 14.9m0 -4.45v5h5"></path>
                                <line x1="5.63" y1="7.16" x2="5.63" y2="7.17"></line>
                                <line x1="4.06" y1="11" x2="4.06" y2="11.01"></line>
                                <line x1="4.63" y1="15.1" x2="4.63" y2="15.11"></line>
                                <line x1="7.16" y1="18.37" x2="7.16" y2="18.38"></line>
                                <line x1="11" y1="19.94" x2="11" y2="19.95"></line>
                            </svg>
                        </button>
                    </div>
                    <div x-data class="lg:mt-0 mt-3 w-full lg:w-auto">
                        <button x-on:click="document.getElementById('login-manual').submit();" class="text-sm justify-center lg:text-base w-full lg:w-auto flex items-center focus:outline-none px-4 py-2 rounded-full focus:shadow-outline bg-blue-600 hover:bg-blue-700 text-white transition duration-500" placeholder="username">
                            sign in
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-lock-open inline-block w-6 ml-3" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                <rect x="5" y="11" width="14" height="10" rx="2"></rect>
                                <circle cx="12" cy="16" r="1"></circle>
                                <path d="M8 11v-5a4 4 0 0 1 8 0"></path>
                            </svg>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
