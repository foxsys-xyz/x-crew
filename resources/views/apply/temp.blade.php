@extends('layouts.app')

@section('content')

    <div class="h-screen bg-black text-white">

        <div class="hidden lg:flex items-center absolute bottom-0 left-0 px-10 py-5 text-xs">
            <img class="w-4 mr-3" src="{{ asset('img/foxsys-xyz [Icon] [Dark Back].png') }}" />
            <span class="text-xs">foxsys-xyz, {{ date('Y') }}. all rights reserved.</span>
        </div>

        <div class="hidden lg:flex items-center absolute bottom-0 right-0 px-10 py-5 text-xs">
            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-folder inline-block w-4 mr-3" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                <path d="M5 4h4l3 3h7a2 2 0 0 1 2 2v8a2 2 0 0 1 -2 2h-14a2 2 0 0 1 -2 -2v-11a2 2 0 0 1 2 -2"></path>
            </svg>
            {{ $uuid }} [ Temporary ]
        </div>

        <div class="lg:flex justify-center absolute right-0 left-0 lg:top-0 text-center px-10 py-5 text-xs bg-gray-900 bg-opacity-80">
            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-box inline-block w-4 mr-3" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                <polyline points="12 3 20 7.5 20 16.5 12 21 4 16.5 4 7.5 12 3"></polyline>
                <line x1="12" y1="12" x2="20" y2="7.5"></line>
                <line x1="12" y1="12" x2="12" y2="21"></line>
                <line x1="12" y1="12" x2="4" y2="7.5"></line>
            </svg>
            temporary application generated.
        </div>
        
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
                
                @include('layouts.sso.application.header')

                <div class="mt-4 lg:flex w-full lg:gap-2">
                    <div class="w-full lg:w-full mt-1 lg:mt-0">
                        <form id="apply-manual" action="{{ route('apply.manual') }}" method="post">

                            @csrf

                            <input type="hidden" name="uuid" value="{{ $uuid }}" />

                            <span class="text-xs lg:flex items-center {{ $errors->has('email') ? 'text-red-500' : '' }}">
                                <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-arrow-down-right inline-block w-4 mr-3" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                    <line x1="7" y1="7" x2="17" y2="17"></line>
                                    <polyline points="17 8 17 17 8 17"></polyline>
                                </svg>
                                email
                            </span>
                            <input type="email" name="email" class="w-full mt-2 outline-none border-none px-4 py-2 rounded-full {{ $errors->has('email') ? 'focus:ring focus:ring-red-500' : 'focus:ring focus:ring-blue-500' }} bg-gray-800 bg-opacity-60 transition duration-500" placeholder="john@doe.com" />
                        </form>
                    </div>
                </div>
                <div class="mt-4 lg:flex lg:float-right lg:gap-2">
                    <div x-data class="w-full lg:w-auto">
                        <form id="connect-with-vatsim" action="{{ route('connect.with.vatsim') }}" method="post">

                            @csrf

                            <input type="hidden" name="uuid" value="{{ $uuid }}" />

                        </form>
                        <button x-on:click="document.getElementById('connect-with-vatsim').submit();" class="text-sm justify-center lg:text-base w-full lg:w-auto flex items-center focus:outline-none px-4 py-2 rounded-full focus:shadow-outline bg-green-600 hover:bg-green-700 text-white transition duration-500" placeholder="username">
                            vatsim sso
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-arrow-up-right inline-block w-6 ml-3" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                <line x1="17" y1="7" x2="7" y2="17"></line>
                                <polyline points="8 7 17 7 17 16"></polyline>
                            </svg>
                        </button>
                    </div>
                    <div x-data class="lg:mt-0 mt-3 w-full lg:w-auto">
                        <button x-on:click="document.getElementById('apply-manual').submit();" class="text-sm justify-center lg:text-base w-full lg:w-auto flex items-center focus:outline-none px-4 py-2 rounded-full focus:shadow-outline bg-blue-600 hover:bg-blue-700 text-white transition duration-500" placeholder="username">
                            verify
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-fingerprint inline-block w-6 ml-3" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                <path d="M18.9 7a8 8 0 0 1 1.1 5v1a6 6 0 0 0 .8 3"></path>
                                <path d="M8 11a4 4 0 0 1 8 0v1a10 10 0 0 0 2 6"></path>
                                <path d="M12 11v2a14 14 0 0 0 2.5 8"></path>
                                <path d="M8 15a18 18 0 0 0 1.8 6"></path>
                                <path d="M4.9 19a22 22 0 0 1 -.9 -7v-1a8 8 0 0 1 12 -6.95"></path>
                            </svg>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
