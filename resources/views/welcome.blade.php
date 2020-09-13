@extends('layouts.app')

@section('content')

    <div class="font-mono">
        <div class="h-screen flex justify-center items-center">
            <div class="w-64">
                <img src="{{ asset('img/FOXSYS [XYZ] Logo [Black].png') }}?id={{ Str::random(32) }}" />
            </div>
        </div>
    </div>

@endsection
