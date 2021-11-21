@extends('layouts.guest')

@section('content')

    <div class="text-white lg:flex justify-center absolute right-0 left-0 lg:top-0 text-center px-10 py-5 text-xs bg-gray-900 bg-opacity-40">
        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-router inline-block w-4 mr-3" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
            <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
            <rect x="3" y="13" width="18" height="8" rx="2"></rect>
            <line x1="17" y1="17" x2="17" y2="17.01"></line>
            <line x1="13" y1="17" x2="13" y2="17.01"></line>
            <line x1="15" y1="13" x2="15" y2="11"></line>
            <path d="M11.75 8.75a4 4 0 0 1 6.5 0"></path>
            <path d="M8.5 6.5a8 8 0 0 1 13 0"></path>
        </svg>
        {{ $status }}
    </div>

    <div class="text-white hidden lg:flex items-center absolute bottom-0 left-0 pl-10 pb-5">
        <img class="w-4 mr-3" src="{{ asset('img/Logo [Dark Background].svg') }}" />
        <span class="text-xs">foxsys-xyz, {{ date('Y') }}. all rights reserved.</span>
    </div>

    <div class="h-screen flex justify-center items-center bg-black">
        <img class="select-none h-48" src="{{ asset('img/Logo [Dark Background].svg') }}" />
    </div>

@endsection
