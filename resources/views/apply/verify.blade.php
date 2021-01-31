@extends('layouts.app')

@section('content')

    <div class="h-screen">

        <div class="hidden lg:flex items-center absolute bottom-0 left-0 px-10 py-5 text-xs">
            <img class="w-4 mr-3" src="{{ asset('img/foxsys-xyz [Icon] [Light Back].png') }}" />
            <span class="text-xs text-gray-500">foxsys-xyz, {{ date('Y') }}. all rights reserved.</span>
        </div>

        <div class="hidden lg:flex items-center absolute bottom-0 right-0 px-10 py-5 text-xs">
            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-bolt inline-block w-4 mr-3" viewBox="0 0 24 24" stroke-width="1.5" stroke="#667eea" fill="none" stroke-linecap="round" stroke-linejoin="round">
                <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                <polyline points="13 3 13 10 19 10 11 21 11 14 5 14 13 3" />
            </svg>
            {{ $applicant->uuid }} {{ $applicant->vatsim != null ? '[ VATSIM Verified ]' : '[ Manual ]' }}
        </div>

        <div class="lg:flex justify-center absolute right-0 left-0 lg:top-0 text-center px-10 py-5 text-xs text-white bg-indigo-500">
            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-inbox inline-block w-4 mr-3" viewBox="0 0 24 24" stroke-width="1.5" stroke="#ffffff" fill="none" stroke-linecap="round" stroke-linejoin="round">
                <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                <rect x="4" y="4" width="16" height="16" rx="2" />
                <path d="M4 13h3l3 3h4l3 -3h3" />
            </svg>
            we've sent a verification email.
        </div>
        
        <div class="container h-full mx-auto flex justify-center items-center">
            <div class="p-12 lg:p-0 w-full lg:w-2/5">
                
                @include('layouts.sso.application.header')

                <div class="mt-4 lg:flex w-full lg:gap-2">
                    <div class="w-full lg:w-full mt-1 lg:mt-0">
                        <form id="resend-email" action="{{ route('apply.verify.resend.manual') }}" method="post">

                            @csrf

                            <input type="hidden" name="uuid" value="{{ $applicant->uuid }}" />

                            <span class="text-xs lg:flex items-center">
                                <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-arrow-down-right inline-block w-4 mr-3" viewBox="0 0 24 24" stroke-width="1.5" stroke="#2c3e50" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                    <line x1="7" y1="7" x2="17" y2="17" />
                                    <polyline points="17 8 17 17 8 17" />
                                </svg>
                                email
                            </span>
                            <input type="email" class="w-full mt-2 outline-none px-4 py-2 rounded-full focus:ring focus:ring-indigo-500 bg-gray-100 transition duration-500 cursor-not-allowed" value="{{ $applicant->email }}" disabled />
                        </form>
                    </div>
                </div>
                <div class="mt-4 lg:flex items-center lg:float-right lg:gap-2">
                    <div class="lg:mt-0 mt-3 w-full lg:w-auto text-xs">
                        <div class="lg:flex items-center " id="verifyTime"></div>
                    </div>
                    <div x-data class="lg:mt-0 mt-3 w-full lg:w-auto">
                        <button name="resend" x-on:click="document.getElementById('resend-email').submit();" class="text-sm justify-center lg:text-base w-full lg:w-auto flex items-center focus:outline-none px-4 py-2 rounded-full focus:shadow-outline bg-indigo-500 text-white transition duration-500 " placeholder="username">
                            resend
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-refresh inline-block w-6 ml-3" viewBox="0 0 24 24" stroke-width="1.5" stroke="#ffffff" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                <path d="M20 11a8.1 8.1 0 0 0 -15.5 -2m-.5 -4v4h4" />
                                <path d="M4 13a8.1 8.1 0 0 0 15.5 2m.5 4v-4h-4" />
                            </svg>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        window.onload = function() {
            verifyEmailPage();
        };
    </script>

@endsection
