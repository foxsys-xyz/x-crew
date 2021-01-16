@extends('layouts.app')

@section('content')

    <div class="lg:flex justify-center absolute right-0 left-0 lg:top-0 text-center px-10 py-5 text-xs text-white bg-gray-500">
        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-router inline-block w-4 mr-3" viewBox="0 0 24 24" stroke-width="1.5" stroke="#ffffff" fill="none" stroke-linecap="round" stroke-linejoin="round">
            <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
            <rect x="3" y="13" width="18" height="8" rx="2" />
            <line x1="17" y1="17" x2="17" y2="17.01" />
            <line x1="13" y1="17" x2="13" y2="17.01" />
            <line x1="15" y1="13" x2="15" y2="11" />
            <path d="M11.75 8.75a4 4 0 0 1 6.5 0" />
            <path d="M8.5 6.5a8 8 0 0 1 13 0" />
        </svg>
        {{ $status }}
    </div>

    <div class="h-screen flex justify-center items-center">
        <div class="w-64">
            <img class="select-none" src="{{ asset('img/foxsys-xyz [Text] [Light Back].png') }}" />
        </div>
    </div>

@endsection
