@extends('layouts.guest')

@section('content')

    <div class="h-screen bg-black text-white">

        <div class="hidden lg:flex items-center absolute bottom-0 left-0 pl-10 pb-5">
            <img class="w-4 mr-3" src="{{ asset('img/Logo [Dark Background].svg') }}" />
            <span class="text-xs">foxsys-xyz, {{ date('Y') }}. all rights reserved.</span>
        </div>

        <div class="hidden lg:flex items-center absolute bottom-0 right-0 pr-10 pb-5 text-xs">
            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-folder inline-block w-4 mr-3" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                <path d="M5 4h4l3 3h7a2 2 0 0 1 2 2v8a2 2 0 0 1 -2 2h-14a2 2 0 0 1 -2 -2v-11a2 2 0 0 1 2 -2"></path>
            </svg>
            {{ $uuid }} [ Complete ]
        </div>

        <div class="lg:flex justify-center absolute right-0 left-0 lg:top-0 text-center px-10 py-5 text-xs bg-gray-900 bg-opacity-40">
            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-box inline-block w-4 mr-3" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                <polyline points="12 3 20 7.5 20 16.5 12 21 4 16.5 4 7.5 12 3"></polyline>
                <line x1="12" y1="12" x2="20" y2="7.5"></line>
                <line x1="12" y1="12" x2="12" y2="21"></line>
                <line x1="12" y1="12" x2="4" y2="7.5"></line>
            </svg>
            database: application is now marked complete.
        </div>

        <div class="container h-full mx-auto flex justify-center items-center">
            <x-card class="m-4 lg:m-0 w-full lg:w-2/3 text-white">
                
                @include('layouts.sso.application.header')

                <div class="mt-8 w-full">
                    <div class="w-full lg:w-full mt-1 lg:mt-0">
                        <x-forms.label :for="__('uuid')">
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-check inline-block w-4 mr-2" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                <path d="M5 12l5 5l10 -10"></path>
                            </svg>
                        </x-forms.label>
                        <x-forms.input class="mt-2 cursor-not-allowed" value="{{ $uuid }}" disabled />
                    </div>
                </div>

                <div class="mt-8 flex items-center text-sm">
                    <div class="lg:flex items-center " id="time">
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-loader animate-spin inline-block w-4 mr-2" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                            <line x1="12" y1="6" x2="12" y2="3"></line>
                            <line x1="16.25" y1="7.75" x2="18.4" y2="5.6"></line>
                            <line x1="18" y1="12" x2="21" y2="12"></line>
                            <line x1="16.25" y1="16.25" x2="18.4" y2="18.4"></line>
                            <line x1="12" y1="18" x2="12" y2="21"></line>
                            <line x1="7.75" y1="16.25" x2="5.6" y2="18.4"></line>
                            <line x1="6" y1="12" x2="3" y2="12"></line>
                            <line x1="7.75" y1="7.75" x2="5.6" y2="5.6"></line>
                        </svg>
                        veriying token status...
                    </div>
                </div>

                <div class="mt-4 lg:flex items-center">
                    <div x-data class="lg:mt-0 mt-3 w-full lg:w-auto">
                        <x-buttons.primary name="manual" x-on:click="window.location.replace('{{ route('login') }}');">
                            manual
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-arrow-up-right inline-block w-5 ml-2" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                <line x1="17" y1="7" x2="7" y2="17"></line>
                                <polyline points="8 7 17 7 17 16"></polyline>
                            </svg>
                        </x-buttons.primary>
                    </div>
                </div>
            </x-card>
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
                    window.location.replace(`{{ route('login') }}`);
                    completeBtn.disabled = false;
                    completeBtn.classList.remove('cursor-not-allowed');
                    completeBtn.classList.remove('opacity-75');
                    completeBtn.classList.add('hover:bg-indigo-600');
                } else {
                    completeElem.innerHTML = '<svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-loader animate-spin inline-block w-4 mr-2" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"></path><line x1="12" y1="6" x2="12" y2="3"></line><line x1="16.25" y1="7.75" x2="18.4" y2="5.6"></line><line x1="18" y1="12" x2="21" y2="12"></line><line x1="16.25" y1="16.25" x2="18.4" y2="18.4"></line><line x1="12" y1="18" x2="12" y2="21"></line><line x1="7.75" y1="16.25" x2="5.6" y2="18.4"></line><line x1="6" y1="12" x2="3" y2="12"></line><line x1="7.75" y1="7.75" x2="5.6" y2="5.6"></line></svg> all done, redirecting in ' + completeTimeLeft + 's...';
                    completeTimeLeft--;
                }
            }
        };
    </script>

@endsection
