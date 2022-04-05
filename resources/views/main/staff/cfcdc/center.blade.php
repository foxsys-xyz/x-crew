@extends('layouts.staff')

@section('content')

    <div class="mx-auto px-8 py-8">
        <h4 class="text-2xl leading-3 font-medium inline-flex items-center">
            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-database-import inline-block w-8 mr-3" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                <ellipse cx="12" cy="6" rx="8" ry="3"></ellipse>
                <path d="M4 6v8m5.009 .783c.924 .14 1.933 .217 2.991 .217c4.418 0 8 -1.343 8 -3v-6"></path>
                <path d="M11.252 20.987c.246 .009 .496 .013 .748 .013c4.418 0 8 -1.343 8 -3v-6m-18 7h7m-3 -3l3 3l-3 3"></path>
            </svg>
            CFCDC
        </h4>
        <span class="flex leading-3 text-gray-400 text-xs">here you can organise your airline's operational data.</span>

        <div class="mt-8">
            <div class="lg:flex w-full gap-8">
                <div class="w-full lg:w-2/5">
                    <x-card>
                        <h5 class="leading-3 font-medium inline-flex items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-plane-departure inline-block w-5 mr-3" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                <path d="M15 12h5a2 2 0 0 1 0 4h-15l-3 -6h3l2 2h3l-2 -7h3z" transform="rotate(-15 12 12) translate(0 -1)"></path>
                                <line x1="3" y1="21" x2="21" y2="21"></line>
                            </svg>
                            Airport Data
                        </h5>
                        <span class="text-gray-400 flex text-xs">manage airports, runways and frequencies</span>

                        <p class="mt-6 text-xs">airfields: {{ $airports }}</p>
                        <p class="flex items-center text-xs">
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-corner-down-right inline-block w-4 mr-2" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                <path d="M6 6v6a3 3 0 0 0 3 3h10l-4 -4m0 8l4 -4"></path>
                            </svg>
                            runways: {{ $runways }}
                        </p>
                        <p class="flex items-center text-xs">
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-corner-down-right inline-block w-4 mr-2" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                <path d="M6 6v6a3 3 0 0 0 3 3h10l-4 -4m0 8l4 -4"></path>
                            </svg>
                            frequencies: {{ $frequencies }}
                        </p>

                        <div class="mt-6">
                            <div x-data class="lg:mt-0 mt-3 w-full lg:w-auto">
                                <x-buttons.primary x-on:click="window.location.href='{{ route('staff.airports') }}'">
                                    manage data
                                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-arrow-up-right inline-block w-5 ml-2" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                        <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                        <line x1="17" y1="7" x2="7" y2="17"></line>
                                        <polyline points="8 7 17 7 17 16"></polyline>
                                    </svg>
                                </x-buttons.primary>
                            </div>
                        </div>
                    </x-card>

                    <x-card class="mt-8">
                        <h5 class="leading-3 font-medium inline-flex items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-plane inline-block w-5 mr-3" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                <path d="M16 10h4a2 2 0 0 1 0 4h-4l-4 7h-3l2 -7h-4l-2 2h-3l2 -4l-2 -4h3l2 2h4l-2 -7h3z"></path>
                            </svg>
                            Aircraft / Fleet Data
                        </h5>
                        <span class="text-gray-400 flex text-xs">profile badges for real world pilots & management</span>

                        <p class="mt-6 text-xs">aircraft: {{ $aircraft }}</p>

                        <div class="mt-6">
                            <div x-data class="lg:mt-0 mt-3 w-full lg:w-auto">
                                <x-buttons.primary x-on:click="window.location.href='{{ route('staff.aircraft') }}'">
                                    manage data
                                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-arrow-up-right inline-block w-5 ml-2" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                        <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                        <line x1="17" y1="7" x2="7" y2="17"></line>
                                        <polyline points="8 7 17 7 17 16"></polyline>
                                    </svg>
                                </x-buttons.primary>
                            </div>
                        </div>
                    </x-card>

                    <x-card class="mt-8">
                        <h5 class="leading-3 font-medium inline-flex items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-plane inline-block w-5 mr-3" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                <path d="M16 10h4a2 2 0 0 1 0 4h-4l-4 7h-3l2 -7h-4l-2 2h-3l2 -4l-2 -4h3l2 2h4l-2 -7h3z"></path>
                            </svg>
                            Airline Schedules
                        </h5>
                        <span class="text-gray-400 flex text-xs">profile badges for real world pilots & management</span>

                        <p class="mt-6 text-xs">schedules: {{ $schedules }}</p>

                        <div class="mt-6">
                            <div class="lg:mt-0 mt-3 w-full lg:w-auto">
                                <x-buttons.primary>
                                    manage data
                                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-arrow-up-right inline-block w-5 ml-2" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                        <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                        <line x1="17" y1="7" x2="7" y2="17"></line>
                                        <polyline points="8 7 17 7 17 16"></polyline>
                                    </svg>
                                </x-buttons.primary>
                            </div>
                        </div>
                    </x-card>
                </div>
                <div class="w-full lg:w-3/5 mt-8 lg:mt-0">
                    <x-card class="h-96">
                        
                    </x-card>
                </div>
            </div>
        </div>
    </div>

@endsection
