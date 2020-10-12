@extends('layouts.app')

@section('content')

    <div class="h-screen">
        <div class="lg:flex justify-center absolute right-0 left-0 lg:top-0 text-center px-10 py-5 text-xs text-white bg-indigo-500">
            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-inbox inline-block w-4 mr-3" viewBox="0 0 24 24" stroke-width="1.5" stroke="#ffffff" fill="none" stroke-linecap="round" stroke-linejoin="round">
                <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                <rect x="4" y="4" width="16" height="16" rx="2" />
                <path d="M4 13h3l3 3h4l3 -3h3" />
            </svg>
            we've sent a verification email.
        </div>
        <div class="hidden lg:flex items-center absolute bottom-0 right-0 px-10 py-5 text-xs">
            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-bolt inline-block w-4 mr-3" viewBox="0 0 24 24" stroke-width="1.5" stroke="#667eea" fill="none" stroke-linecap="round" stroke-linejoin="round">
                <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                <polyline points="13 3 13 10 19 10 11 21 11 14 5 14 13 3" />
            </svg>
            {{ $applicant->uuid }} {{ $applicant->vatsim != null ? '[ VATSIM Verified ]' : '[ Manual ]' }}
        </div>
        <div class="container h-full mx-auto flex justify-center items-center">
            <div class="p-12 lg:p-0 w-full lg:w-2/5">
                <img class="h-5" src="{{ asset('img/va_logo.png') }}?id={{ Str::random(32) }}" />
                <div class="lg:flex items-center mt-4">
                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-plane inline-block w-6 mr-3" viewBox="0 0 24 24" stroke-width="1.5" stroke="#2c3e50" fill="none" stroke-linecap="round" stroke-linejoin="round">
                        <path stroke="none" d="M0 0h24v24H0z"/>
                        <path d="M16 10h4a2 2 0 0 1 0 4h-4l-4 7h-3l2 -7h-4l-2 2h-3l2-4l-2 -4h3l2 2h4l-2 -7h3z" />
                    </svg>howdy, get started
                </div>
                <div class="border border-gray-200 border-t-1 w-1/3 mt-4"></div>
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
                            <input type="email" class="w-full lg:w-full mt-2 outline-none px-4 py-2 rounded-full focus:shadow-outline bg-gray-200 transition duration-500 cursor-not-allowed opacity-75" value="{{ $applicant->email }}" disabled />
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
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-fingerprint inline-block w-6 ml-3" viewBox="0 0 24 24" stroke-width="1.5" stroke="#ffffff" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z"/>
                                <path d="M18.9 7a8 8 0 0 1 1.1 5v1a6 6 0 0 0 .8 3" />
                                <path d="M8 11a4 4 0 0 1 8 0v1a10 10 0 0 0 2 6" />
                                <path d="M12 11v2a14 14 0 0 0 2.5 8" />
                                <path d="M8 15a18 18 0 0 0 1.8 6" />
                                <path d="M4.9 19a22 22 0 0 1 -.9 -7v-1a8 8 0 0 1 12 -6.95" />
                            </svg>
                        </button>
                    </div>
                    <script>
                        window.onload = function() {
                            verifyEmailPage();
                        };
                    </script>
                </div>
            </div>
        </div>
    </div>

@endsection
