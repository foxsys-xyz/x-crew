@extends('layouts.app')

@section('content')

    <div class="h-screen">
        <div class="container h-full mx-auto flex justify-center items-center">
            <div class="p-12 lg:p-0 w-full lg:w-2/5">
                <img class="h-5" src="{{ asset('img/va_logo.png') }}?id={{ Str::random(32) }}" />
                <div class="lg:flex items-center mt-4">
                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-plane inline-block w-6 mr-3" viewBox="0 0 24 24" stroke-width="1.5" stroke="#2c3e50" fill="none" stroke-linecap="round" stroke-linejoin="round">
                        <path stroke="none" d="M0 0h24v24H0z"/>
                        <path d="M16 10h4a2 2 0 0 1 0 4h-4l-4 7h-3l2 -7h-4l-2 2h-3l2-4l-2 -4h3l2 2h4l-2 -7h3z" />
                    </svg>howdy, sign in
                </div>
                <div class="border border-gray-200 border-t-1 w-1/3 mt-4"></div>
                <form id="login-manual" action="{{ route('login.check') }}" method="post">

                    @csrf

                    <div class="mt-4 lg:flex w-full gap-2">
                        <div class="w-full lg:w-full mt-1 lg:mt-0">
                            <span class="text-xs lg:flex items-center {{ $errors->has('username') ? 'text-red-500' : '' }}">
                                <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-arrow-down-right inline-block w-4 mr-3" viewBox="0 0 24 24" stroke-width="1.5" stroke="{{ $errors->has('username') ? '#f56565' : '#2c3e50' }}" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                    <line x1="7" y1="7" x2="17" y2="17" />
                                    <polyline points="17 8 17 17 8 17" />
                                </svg>
                                username
                            </span>
                            <input name="username" class="w-full lg:w-full mt-2 outline-none px-4 py-2 rounded-full focus:shadow-outline bg-gray-200 transition duration-500" placeholder="{{ env('PCS') }}1234" />
                        </div>
                        <div class="w-full lg:w-full mt-1 lg:mt-0">
                            <span class="text-xs lg:flex items-center {{ $errors->has('password') ? 'text-red-500' : '' }}">
                                <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-arrow-down-right inline-block w-4 mr-3" viewBox="0 0 24 24" stroke-width="1.5" stroke="{{ $errors->has('password') ? '#f56565' : '#2c3e50' }}" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                    <line x1="7" y1="7" x2="17" y2="17" />
                                    <polyline points="17 8 17 17 8 17" />
                                </svg>
                                password
                            </span>
                            <input name="password" type="password" class="w-full lg:w-full mt-2 outline-none px-4 py-2 rounded-full focus:shadow-outline bg-gray-200 transition duration-500" placeholder="••••••••••" />
                        </div>
                    </div>
                </form>
                <div class="mt-4 lg:flex lg:float-right lg:gap-2">
                    <div class="w-full lg:w-auto">
                        <button class="text-sm justify-center lg:text-base w-full lg:w-auto flex items-center focus:outline-none px-4 py-2 rounded-full focus:shadow-outline bg-green-500 hover:bg-green-600 text-white transition duration-500" placeholder="username">
                            vatsim sso
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-arrow-up-right inline-block w-6 ml-3" viewBox="0 0 24 24" stroke-width="1.5" stroke="#ffffff" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z"/>
                                <line x1="17" y1="7" x2="7" y2="17" />
                                <polyline points="8 7 17 7 17 16" />
                            </svg>
                        </button>
                    </div>
                    <div x-data class="lg:mt-0 mt-3 w-full lg:w-auto">
                        <button x-on:click="document.getElementById('login-manual').submit();" class="text-sm justify-center lg:text-base w-full lg:w-auto flex items-center focus:outline-none px-4 py-2 rounded-full focus:shadow-outline bg-indigo-500 hover:bg-indigo-600 text-white transition duration-500" placeholder="username">
                            sign in
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-arrow-forward inline-block w-6 ml-3" viewBox="0 0 24 24" stroke-width="1.5" stroke="#ffffff" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z"/>
                                <path d="M15 11l4 4l-4 4m4 -4h-11a4 4 0 0 1 0 -8h1" />
                            </svg>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
