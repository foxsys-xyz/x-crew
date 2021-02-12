@extends('layouts.app')

@section('content')
 
    <div x-data="{ sidebarOpen: false }" class="flex h-screen bg-gray-100">
        
        @include('layouts.staff.sidebar')
        
        <div class="flex-1 flex flex-col overflow-hidden">
            <div class="overflow-y-auto">

                @include('layouts.staff.header')

                <main class="flex-1 overflow-x-hidden bg-gray-100 rounded-tl-3xl rounded-bl-3xl lg:rounded-none min-h-screen">
                    <div class="mx-auto px-8 py-8">
                        <h4 class="text-gray-700 text-2xl leading-3 font-medium inline-flex items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-smart-home inline-block w-8 mr-3" viewBox="0 0 24 24" stroke-width="1.5" stroke="#2c3e50" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                <path d="M19 8.71l-5.333 -4.148a2.666 2.666 0 0 0 -3.274 0l-5.334 4.148a2.665 2.665 0 0 0 -1.029 2.105v7.2a2 2 0 0 0 2 2h12a2 2 0 0 0 2 -2v-7.2c0 -.823 -.38 -1.6 -1.03 -2.105" />
                                <path d="M16 15c-2.21 1.333-5.792 1.333-8 0" />
                            </svg>
                            Dashboard
                        </h4>
                        <span class="flex leading-3 text-gray-500 text-xs">welcome back, here is your airline dashboard.</span>

                        <div class="mt-8">

                        </div>
                    </div>
                </main>

                @include('layouts.staff.footer')

            </div>
        </div>
    </div>

@endsection
