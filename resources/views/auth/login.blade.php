@extends('layouts.guest')

@section('content')

    <div class="h-screen bg-black text-white">

        <div class="hidden lg:flex items-center absolute bottom-0 left-0 px-10 py-5">
            <img class="w-4 mr-3" src="{{ asset('img/Logo [Dark Background].svg') }}" />
            <span class="text-xs">foxsys-xyz, {{ date('Y') }}. all rights reserved.</span>
        </div>

        @if (session()->has('error'))

            <div class="w-full lg:flex justify-center absolute right-0 left-0 lg:top-0 text-center px-10 py-5 text-sm bg-red-600">
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

            <div class="w-full lg:flex justify-center absolute right-0 left-0 lg:top-0 text-center px-10 py-5 text-sm bg-red-600">
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
                
                @include('layouts.sso.auth.header')

                <form id="login-manual" action="{{ route('login.check') }}" method="post">

                    @csrf

                    <div class="mt-8 lg:flex w-full grid gap-2">
                        <div class="w-full {{ $errors->has('username') ? 'text-red-500' : '' }}">
                            <x-forms.label :for="__('username')">
                                <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-arrow-down-right inline-block w-4 mr-2" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                    <line x1="7" y1="7" x2="17" y2="17"></line>
                                    <polyline points="17 8 17 17 8 17"></polyline>
                                </svg>
                            </x-forms.label>
                            <x-forms.input name="username" class="mt-2 {{ $errors->has('username') ? 'focus:ring-red-500' : 'focus:ring-blue-500' }}" placeholder="{{ config('app.va_icao') }}1234" :value="old('username')" />
                        </div>
                        
                        <div class="w-full {{ $errors->has('password') ? 'text-red-500' : '' }}">
                            <x-forms.label :for="__('password')">
                                <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-arrow-down-right inline-block w-4 mr-2" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                    <line x1="7" y1="7" x2="17" y2="17"></line>
                                    <polyline points="17 8 17 17 8 17"></polyline>
                                </svg>
                            </x-forms.label>
                            <x-forms.input name="password" type="password" class="mt-2 {{ $errors->has('password') ? 'focus:ring-red-500' : 'focus:ring-blue-500' }}" placeholder="••••••••••" />
                        </div>
                    </div>

                    <div class="mt-8 flex items-center">
                        <input id="remember_me" type="checkbox" class="rounded-full border-none text-blue-500 focus:ring focus:ring-blue-500 transition duration-150 bg-gray-800 bg-opacity-60" name="remember" checked>
                        <span class="ml-3 text-sm">remember my credentials</span>
                    </div>
                </form>

                <div class="mt-4 lg:flex lg:items-center grid gap-2">
                    <div x-data class="w-full lg:w-auto">
                        <x-buttons.primary x-on:click="document.getElementById('login-manual').submit();">
                            sign in
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-lock-open inline-block w-5 ml-2" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                <rect x="5" y="11" width="14" height="10" rx="2"></rect>
                                <circle cx="12" cy="16" r="1"></circle>
                                <path d="M8 11v-5a4 4 0 0 1 8 0"></path>
                            </svg>
                        </x-buttons.primary>
                    </div>
                    <div x-data class="w-full lg:w-auto">
                        <form id="connect-with-vatsim" action="{{ route('connect.with.vatsim') }}" method="post">

                            @csrf

                        </form>
                        <x-buttons.secondary x-on:click="document.getElementById('connect-with-vatsim').submit();">
                            vatsim sso
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
