@extends('layouts.app')

@section('content')

    <div class="h-screen">
        <div class="container h-full mx-auto flex justify-center items-center">
            <div class="p-12 lg:p-0">
                <img class="h-5" src="{{ asset('img/va_logo.png') }}?id={{ Str::random(32) }}" />
                <div class="border border-gray-200 border-t-1 w-1/3 mt-4"></div>
                <div class="flex items-center mt-4">
                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-plane inline-block w-6 mr-3" viewBox="0 0 24 24" stroke-width="1.5" stroke="#2c3e50" fill="none" stroke-linecap="round" stroke-linejoin="round">
                        <path stroke="none" d="M0 0h24v24H0z"/>
                        <path d="M16 10h4a2 2 0 0 1 0 4h-4l-4 7h-3l2 -7h-4l-2 2h-3l2-4l-2 -4h3l2 2h4l-2 -7h3z" />
                    </svg>
                    howdy, sign in
                </div>
                <div class="mt-4">
                    <input class="w-full lg:w-auto outline-none px-4 py-2 rounded-full focus:shadow-outline bg-gray-200 transition duration-500" placeholder="username" />
                    <input type="password" class="w-full lg:w-auto mt-3 lg:mt-0 outline-none px-4 py-2 rounded-full focus:shadow-outline bg-gray-200 transition duration-500" placeholder="password" />
                </div>
                <div class="mt-4 lg:flex lg:float-right">
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
                    <div class="lg:ml-2 lg:mt-0 mt-3 w-full lg:w-auto">
                        <button class="text-sm justify-center lg:text-base w-full lg:w-auto flex items-center focus:outline-none px-4 py-2 rounded-full focus:shadow-outline bg-indigo-500 hover:bg-indigo-600 text-white transition duration-500" placeholder="username">
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
