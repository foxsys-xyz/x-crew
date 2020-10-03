@extends('layouts.app')

@section('content')

    <div class="font-mono">
        <div class="h-screen flex justify-center items-center">
            <div class="w-64">
                <img class="select-none" src="{{ asset('img/foxsys-xyz [Text] [Light Back].png') }}?id={{ Str::random(32) }}" />
            </div>
        </div>
    </div>

@endsection
