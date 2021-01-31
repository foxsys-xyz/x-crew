@extends('layouts.app')

@section('content')
 
    <div x-data="{ sidebarOpen: false }" class="flex h-screen bg-gray-100">
        <div :class="sidebarOpen ? 'block' : 'hidden'" @click="sidebarOpen = false" class="fixed z-20 inset-0 bg-black opacity-50 transition-opacity lg:hidden"></div>
    
        <div :class="sidebarOpen ? 'translate-x-0 ease-out' : '-translate-x-full ease-in'" class="fixed z-30 inset-y-0 left-0 w-64 transition duration-300 transform bg-white overflow-y-auto lg:translate-x-0 lg:static lg:inset-0">
            
            @include('layouts.cloud.sidebar')

        </div>
        <div class="flex-1 flex flex-col overflow-hidden">
            <div class="bg-white overflow-y-auto">

                @include('layouts.cloud.header')

                <main class="flex-1 overflow-x-hidden bg-gray-100 rounded-tl-3xl rounded-bl-3xl min-h-screen">
                    <div class="mx-auto px-8 py-8">
                        <h4 class="text-gray-700 text-2xl leading-3 font-medium inline-flex items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-plane inline-block w-8 mr-3" viewBox="0 0 24 24" stroke-width="1.5" stroke="#2c3e50" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                <path d="M16 10h4a2 2 0 0 1 0 4h-4l-4 7h-3l2 -7h-4l-2 2h-3l2 -4l-2 -4h3l2 2h4l-2 -7h3z" />
                            </svg>
                            CFCDC
                        </h4>
                        <span class="flex leading-3 text-gray-500 text-xs">the central flight crew data center, for all.</span>

                        <div class="mt-8">
                            <div class="lg:flex w-full gap-8">
                                <div class="w-full lg:w-3/5">
                                    <div class="rounded-3xl bg-white shadow-lg p-6 h-96">

                                    </div>
                                </div>
                                <div class="w-full lg:w-2/5 mt-8 lg:mt-0">
                                    <div class="rounded-3xl bg-white shadow-lg p-6 h-96">
                                        
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </main>
                
                @include('layouts.cloud.footer')

            </div>
        </div>
    </div>

    <script>
        $(document).ready( function () {
            $('#search').DataTable();
        } );
    </script>

@endsection
