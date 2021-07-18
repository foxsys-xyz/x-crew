@extends('layouts.guest')

@section('content')

    <div class="h-screen bg-black text-white">

        <div class="hidden lg:flex items-center absolute bottom-0 left-0 px-10 py-5 text-xs">
            <img class="w-4 mr-3" src="{{ asset('img/Logo [Dark Background].svg') }}" />
            <span class="text-xs">foxsys-xyz, {{ date('Y') }}. all rights reserved.</span>
        </div>

        <div class="hidden lg:flex items-center absolute bottom-0 right-0 px-10 py-5 text-xs">
            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-folder inline-block w-4 mr-3" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                <path d="M5 4h4l3 3h7a2 2 0 0 1 2 2v8a2 2 0 0 1 -2 2h-14a2 2 0 0 1 -2 -2v-11a2 2 0 0 1 2 -2"></path>
            </svg>
            {{ $applicant->uuid }} {{ $applicant->vatsim != null ? '[ VATSIM Verified ]' : '[ Manual ]' }}
        </div>

        <div class="lg:flex justify-center absolute right-0 left-0 lg:top-0 text-center px-10 py-5 text-xs bg-gray-900 bg-opacity-80">
            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-inbox inline-block w-4 mr-3" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                <rect x="4" y="4" width="16" height="16" rx="2"></rect>
                <path d="M4 13h3l3 3h4l3 -3h3"></path>
            </svg>
            we've sent a verification email.
        </div>
        
        <div class="container h-full mx-auto flex justify-center items-center">
            <div class="m-4 p-8 w-full lg:w-1/2 bg-gray-900 bg-opacity-80 rounded-3xl shadow-2xl">
                
                @include('layouts.sso.application.header')

                <div class="mt-4 lg:flex w-full lg:gap-2">
                    <div class="w-full lg:w-full mt-1 lg:mt-0">
                        <form id="resend-email" action="{{ route('apply.verify.resend.manual') }}" method="post">

                            @csrf

                            <input type="hidden" name="uuid" value="{{ $applicant->uuid }}" />

                            <span class="text-xs lg:flex items-center">
                                <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-check inline-block w-4 mr-3" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                    <path d="M5 12l5 5l10 -10"></path>
                                </svg>
                                email
                            </span>
                            <input type="email" class="w-full mt-2 outline-none border-none px-4 py-2 rounded-full bg-gray-800 opacity-60 cursor-not-allowed" value="{{ $applicant->email }}" disabled />
                        </form>
                    </div>
                </div>
                <div class="mt-4 lg:flex items-center lg:float-right lg:gap-2">
                    <div class="lg:mt-0 mt-3 w-full lg:w-auto text-xs">
                        <div class="lg:flex items-center " id="verifyTime"></div>
                    </div>
                    <div x-data class="lg:mt-0 mt-3 w-full lg:w-auto">
                        <button name="resend" x-on:click="document.getElementById('resend-email').submit();" class="text-sm justify-center lg:text-base w-full lg:w-auto flex items-center focus:outline-none px-4 py-2 rounded-full focus:shadow-outline bg-blue-600 transition duration-500 " placeholder="username">
                            resend
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-rotate inline-block w-6 ml-3" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                <path d="M19.95 11a8 8 0 1 0 -.5 4m.5 5v-5h-5"></path>
                            </svg>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        window.onload = function() {
            var verifyTimeLeft = 60;
            var verifyElem = document.getElementById('verifyTime');
            var verifyTimerId = setInterval(verifyCountdown, 1000);

            var verifyBtn = document.getElementsByName('resend')[0];
            verifyBtn.classList.add('cursor-not-allowed');
            verifyBtn.classList.add('opacity-75');
            verifyBtn.disabled = true;
                
            function verifyCountdown() {
                if (verifyTimeLeft == -1) {
                    clearTimeout(verifyTimerId);
                    verifyBtn.disabled = false;
                    verifyBtn.classList.remove('cursor-not-allowed');
                    verifyBtn.classList.remove('opacity-75');
                    verifyBtn.classList.add('hover:bg-indigo-600');
                    verifyElem.classList.remove('lg:flex');
                    verifyElem.classList.add('hidden');
                } else {
                    verifyElem.innerHTML = '<svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-loader animate-spin inline-block w-4 mr-3" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"></path><line x1="12" y1="6" x2="12" y2="3"></line><line x1="16.25" y1="7.75" x2="18.4" y2="5.6"></line><line x1="18" y1="12" x2="21" y2="12"></line><line x1="16.25" y1="16.25" x2="18.4" y2="18.4"></line><line x1="12" y1="18" x2="12" y2="21"></line><line x1="7.75" y1="16.25" x2="5.6" y2="18.4"></line><line x1="6" y1="12" x2="3" y2="12"></line><line x1="7.75" y1="7.75" x2="5.6" y2="5.6"></line></svg> please wait ' + verifyTimeLeft + 's';
                    verifyTimeLeft--;
                }
            }
        };
    </script>

@endsection
