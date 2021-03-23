@extends('layouts.app')

@section('content')

    <div class="h-screen">

        <div class="hidden lg:flex items-center absolute bottom-0 left-0 px-10 py-5 text-xs">
            <img class="w-4 mr-3" src="{{ asset('img/foxsys-xyz [Icon] [Light Back].png') }}" />
            <span class="text-xs text-gray-500">foxsys-xyz, {{ date('Y') }}. all rights reserved.</span>
        </div>

        <div class="hidden lg:flex items-center absolute bottom-0 right-0 px-10 py-5 text-xs">
            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-bolt inline-block w-4 mr-3 stroke-current" viewBox="0 0 24 24" stroke-width="1.5" fill="none" stroke-linecap="round" stroke-linejoin="round">
                <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                <polyline points="13 3 13 10 19 10 11 21 11 14 5 14 13 3" />
            </svg>
            {{ $uuid }} [ Complete ]
        </div>

        <div class="lg:flex justify-center absolute right-0 left-0 lg:top-0 text-center px-10 py-5 text-xs text-white bg-indigo-500">
            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-paperclip inline-block w-4 mr-3 stroke-current" viewBox="0 0 24 24" stroke-width="1.5" fill="none" stroke-linecap="round" stroke-linejoin="round">
                <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                <path d="M15 7l-6.5 6.5a1.5 1.5 0 0 0 3 3l6.5 -6.5a3 3 0 0 0 -6 -6l-6.5 6.5a4.5 4.5 0 0 0 9 9l6.5 -6.5" />
            </svg>
            database: application is now marked complete.
        </div>

        <div class="container h-full mx-auto flex justify-center items-center">
            <div class="p-12 lg:p-0 w-full lg:w-2/5">
                
                @include('layouts.sso.application.header')

                <div class="mt-4 lg:flex w-full lg:gap-2">
                    <div class="w-full lg:w-full mt-1 lg:mt-0">
                        <span class="text-xs lg:flex items-center {{ $errors->has('email') ? 'text-red-500' : '' }}">
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-arrow-down-right inline-block w-4 mr-3 stroke-current" viewBox="0 0 24 24" stroke-width="1.5" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                <line x1="7" y1="7" x2="17" y2="17" />
                                <polyline points="17 8 17 17 8 17" />
                            </svg>
                            uuid
                        </span>
                        <input class="w-full mt-2 outline-none px-4 py-2 rounded-full bg-gray-100 cursor-not-allowed" value="{{ $uuid }}" disabled />
                    </div>
                </div>
                <div class="mt-4 lg:flex items-center lg:float-right lg:gap-2">
                    <div class="lg:mt-0 mt-3 w-full lg:w-auto text-xs">
                        <div class="lg:flex items-center" id="time"></div>
                    </div>
                    <div x-data class="lg:mt-0 mt-3 w-full lg:w-auto">
                        <button name="manual" x-on:click="window.location.replace('{{ env('APP_URL') }}');" class="text-sm justify-center lg:text-base w-full lg:w-auto flex items-center focus:outline-none px-4 py-2 rounded-full focus:shadow-outline bg-indigo-500 text-white transition duration-500 " placeholder="username">
                            manual
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-activity inline-block w-6 ml-3 stroke-current" viewBox="0 0 24 24" stroke-width="1.5" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                <path d="M3 12h4l3 8l4 -16l3 8h4" />
                            </svg>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        window.onload = function() {
            var completeTimeLeft = 5;
            var completeElem = document.getElementById('time');
            var completeTimerId = setInterval(completeCountdown, 1000);

            var completeBtn = document.getElementsByName('manual')[0];
            completeBtn.classList.add('cursor-not-allowed');
            completeBtn.classList.add('opacity-75');
            completeBtn.disabled = true;
                
            function completeCountdown() {
                if (completeTimeLeft == -1) {
                    clearTimeout(completeTimerId);
                    window.location.replace('/');
                    completeBtn.disabled = false;
                    completeBtn.classList.remove('cursor-not-allowed');
                    completeBtn.classList.remove('opacity-75');
                    completeBtn.classList.add('hover:bg-indigo-600');
                } else {
                    completeElem.innerHTML = '<svg xmlns="http://www.w3.org/2000/svg" class="animate-spin icon icon-tabler icon-tabler-loader inline-block w-4 mr-3 stroke-current" viewBox="0 0 24 24" stroke-width="1.5" fill="none" stroke-linecap="round" stroke-linejoin="round"> <path stroke="none" d="M0 0h24v24H0z" fill="none"/> <line x1="12" y1="6" x2="12" y2="3" /> <line x1="16.25" y1="7.75" x2="18.4" y2="5.6" /> <line x1="18" y1="12" x2="21" y2="12" /> <line x1="16.25" y1="16.25" x2="18.4" y2="18.4" /> <line x1="12" y1="18" x2="12" y2="21" /> <line x1="7.75" y1="16.25" x2="5.6" y2="18.4" /> <line x1="6" y1="12" x2="3" y2="12" /> <line x1="7.75" y1="7.75" x2="5.6" y2="5.6" /></svg> all done, redirecting in ' + completeTimeLeft + 's';
                    completeTimeLeft--;
                }
            }
        };
    </script>

@endsection
