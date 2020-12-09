@extends('layouts.app')

@section('content')

    <div class="h-screen">
        <div class="container h-full mx-auto flex justify-center items-center">
            <div class="p-12 lg:p-0">
                <div class="flex items-center mt-4">
                    <div class="text-center">
                        <div class="p-2 bg-indigo-500 items-center text-white leading-none lg:rounded-full rounded-lg flex lg:inline-flex" role="alert">
                            <span class="flex bg-indigo-600 lg:rounded-full rounded-lg uppercase px-2 py-1 text-xs font-bold mr-3">ECAM</span>
                            <span class="font-semibold mr-2 text-left flex-auto">{{ $status }}</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection