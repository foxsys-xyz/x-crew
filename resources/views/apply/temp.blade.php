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
            {{ $uuid }} [ Temporary ]
        </div>

        <div class="lg:flex justify-center absolute right-0 left-0 lg:top-0 text-center px-10 py-5 text-xs bg-gray-900 bg-opacity-40">
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

            <div class="w-full lg:flex justify-center absolute right-0 left-0 lg:top-0 text-center px-10 py-5 text-xs bg-red-600">
                <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-circle-minus inline-block w-4 mr-3" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                    <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                    <circle cx="12" cy="12" r="9"></circle>
                    <line x1="9" y1="12" x2="15" y2="12"></line>
                </svg>
                strange, an error. maybe retry entering the details correctly?
            </div>

        @endif

        <div class="container h-full mx-auto flex justify-center items-center">
            <x-card class="m-4 lg:m-0 w-full lg:w-2/3">
                
                @include('layouts.sso.application.header')

                <form id="apply-manual" action="{{ route('apply.manual') }}" method="post">
                    
                    @csrf

                    <input type="hidden" name="uuid" value="{{ $uuid }}" />

                    <div class="mt-8 w-full">
                        <div class="w-full mt-1 lg:mt-0">
                            <div class="{{ $errors->has('email') ? 'text-red-500' : '' }}">
                                <x-forms.label :for="__('email')">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-arrow-down-right inline-block w-4 mr-2" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                        <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                        <line x1="7" y1="7" x2="17" y2="17"></line>
                                        <polyline points="17 8 17 17 8 17"></polyline>
                                    </svg>
                                </x-forms.label>
                            </div>
                            <x-forms.input name="email" type="email" class="mt-2 {{ $errors->has('email') ? 'focus:ring-red-500' : 'focus:ring-blue-500' }}" placeholder="john@doe.com" />
                        </div>
                    </div>
                </form>

                <div class="mt-8 flex items-center text-sm">
                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-urgent inline-block w-4 mr-2" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                        <path d="M8 16v-4a4 4 0 0 1 8 0v4"></path>
                        <path d="M3 12h1m8 -9v1m8 8h1m-15.4 -6.4l.7 .7m12.1 -.7l-.7 .7"></path>
                        <rect x="6" y="16" width="12" height="4" rx="1"></rect>
                    </svg>
                    by continuing you agree to our
                    <a class="text-blue-500 ml-2" href="{{ route('apply.privacy') }}" target="_blank">privacy policy</a>.
                </div>

                <div class="mt-4 lg:flex gap-2">
                     <div x-data class="lg:mt-0 mt-3 w-full lg:w-auto">
                        <x-buttons.primary x-on:click="document.getElementById('apply-manual').submit();">
                            verify mail
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-fingerprint inline-block w-5 ml-2" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                <path d="M18.9 7a8 8 0 0 1 1.1 5v1a6 6 0 0 0 .8 3"></path>
                                <path d="M8 11a4 4 0 0 1 8 0v1a10 10 0 0 0 2 6"></path>
                                <path d="M12 11v2a14 14 0 0 0 2.5 8"></path>
                                <path d="M8 15a18 18 0 0 0 1.8 6"></path>
                                <path d="M4.9 19a22 22 0 0 1 -.9 -7v-1a8 8 0 0 1 12 -6.95"></path>
                            </svg>
                        </x-buttons.primary>
                    </div>
                    <div x-data class="w-full lg:w-auto">
                        <form id="connect-with-vatsim" action="{{ route('connect.with.vatsim') }}" method="post">

                            @csrf

                            <input type="hidden" name="uuid" value="{{ $uuid }}" />

                        </form>
                        <x-buttons.secondary x-on:click="document.getElementById('connect-with-vatsim').submit();">
                            apply with vatsim
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-arrow-up-right inline-block w-5 ml-2" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                <line x1="17" y1="7" x2="7" y2="17"></line>
                                <polyline points="8 7 17 7 17 16"></polyline>
                            </svg>
                        </x-buttons.secondary>
                    </div>
                </div>
            </x-card>
        </div>
    </div>

@endsection
