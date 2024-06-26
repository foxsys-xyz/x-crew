@extends('layouts.staff')

@section('content')

    <div class="mx-auto px-8 py-8">
        <h4 class="text-xl leading-3 inline-flex items-center">
            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-database-import inline-block w-6 mr-3" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                <ellipse cx="12" cy="6" rx="8" ry="3"></ellipse>
                <path d="M4 6v8m5.009 .783c.924 .14 1.933 .217 2.991 .217c4.418 0 8 -1.343 8 -3v-6"></path>
                <path d="M11.252 20.987c.246 .009 .496 .013 .748 .013c4.418 0 8 -1.343 8 -3v-6m-18 7h7m-3 -3l3 3l-3 3"></path>
            </svg>
            CFCDC // Aircraft
        </h4>
        <span class="flex leading-3 text-gray-400 text-xs">here you can edit specific aircraft data.</span>

        @if (session()->has('success'))

            <div class="lg:flex justify-center text-center px-10 py-5 text-xs bg-blue-600 mt-8 rounded-3xl shadow-2xl">
                <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-check inline-block w-4 mr-3" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                    <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                    <path d="M5 12l5 5l10 -10"></path>
                </svg>
                {{ session()->get('success') }}
            </div>

        @endif

        <!-- Laravel's Validation Errors -->

        @if ($errors->any())

            <div class="lg:flex justify-center text-center px-10 py-5 text-xs text-white bg-red-500 mt-8 rounded-3xl shadow-2xl">
                <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-circle-minus inline-block w-4 mr-3" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                    <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                    <circle cx="12" cy="12" r="9"></circle>
                    <line x1="9" y1="12" x2="15" y2="12"></line>
                </svg>
                strange, an error. maybe retry entering the details correctly?
            </div>

        @endif

        <div class="mt-8">
            <div class="lg:flex w-full gap-8">
                <div class="w-full lg:w-3/5">
                    <x-card class="overflow-y-auto">
                        <h5 class="leading-3 inline-flex items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-plane-departure inline-block w-5 mr-3" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                <path d="M15 12h5a2 2 0 0 1 0 4h-15l-3 -6h3l2 2h3l-2 -7h3z" transform="rotate(-15 12 12) translate(0 -1)"></path>
                                <line x1="3" y1="21" x2="21" y2="21"></line>
                            </svg>
                            {{ $aircraft->model }} // {{ $aircraft->icao }}
                        </h5>
                        <span class="text-gray-400 flex text-xs">as required, you can omit or edit airport data</span>   
                        
                        <form action="{{ route('staff.aircraft.update', ['id' => $aircraft->id]) }}" method="post">

                            @csrf

                            @method('patch')

                            <div class="lg:flex mt-6 gap-2">
                                <div class="lg:w-1/3 mb-2 lg:mb-0">
                                    <x-forms.label :for="__('icao')">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-check inline-block w-4 mr-2" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                            <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                            <path d="M5 12l5 5l10 -10"></path>
                                        </svg>
                                    </x-forms.label>
                                    <x-forms.input class="mt-2 cursor-not-allowed" value="{{ $aircraft->icao }}" disabled />
                                </div>
                                <div class="lg:w-1/3 mb-2 lg:mb-0">
                                    <x-forms.label :for="__('manufacturer & model')">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-check inline-block w-4 mr-2" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                            <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                            <path d="M5 12l5 5l10 -10"></path>
                                        </svg>
                                    </x-forms.label>
                                    <x-forms.input class="mt-2 cursor-not-allowed" value="{{ $aircraft->manufacturer }} {{ $aircraft->model }}" disabled />
                                </div>
                                <div class="lg:w-1/3">
                                    <x-forms.label :for="__('airline')">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-check inline-block w-4 mr-2" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                            <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                            <path d="M5 12l5 5l10 -10"></path>
                                        </svg>
                                    </x-forms.label>
                                    <x-forms.input class="mt-2 cursor-not-allowed" value="{{ $aircraft->airline_icao }}" disabled />
                                </div>
                            </div>
                            <div class="lg:flex mt-2 gap-2">
                                <div class="lg:w-3/5 mb-2 lg:mb-0">
                                    <x-forms.label class="{{ $errors->has('airport_name') ? 'text-red-500' : '' }}" :for="__('airport name')">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-arrow-down-right inline-block w-4 mr-2" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                            <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                            <line x1="7" y1="7" x2="17" y2="17"></line>
                                            <polyline points="17 8 17 17 8 17"></polyline>
                                        </svg>
                                    </x-forms.label>
                                    <x-forms.input  name="airport_name" class="mt-2 {{ $errors->has('airport_name') ? 'focus:ring-red-500' : 'focus:ring-blue-500' }}" value="" />
                                </div>
                                <div class="lg:w-1/5 mb-2 lg:mb-0">
                                    <x-forms.label :for="__('country')">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-check inline-block w-4 mr-2" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                            <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                            <path d="M5 12l5 5l10 -10"></path>
                                        </svg>
                                    </x-forms.label>
                                    <x-forms.input class="mt-2 cursor-not-allowed" value="" disabled />
                                </div>
                                <div class="lg:w-1/5 mb-2 lg:mb-0">
                                    <x-forms.label :for="__('continent')">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-check inline-block w-4 mr-2" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                            <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                            <path d="M5 12l5 5l10 -10"></path>
                                        </svg>
                                    </x-forms.label>
                                    <x-forms.input class="mt-2 cursor-not-allowed" value="" disabled />
                                </div>
                            </div>
                            <div class="lg:flex mt-2 gap-2">
                                <div class="lg:w-1/3 mb-2 lg:mb-0">
                                    <x-forms.label class="{{ $errors->has('lat') ? 'text-red-500' : '' }}" :for="__('latitude')">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-arrow-down-right inline-block w-4 mr-2" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                            <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                            <line x1="7" y1="7" x2="17" y2="17"></line>
                                            <polyline points="17 8 17 17 8 17"></polyline>
                                        </svg>
                                    </x-forms.label>
                                    <x-forms.input name="lat" class="mt-2 {{ $errors->has('lat') ? 'focus:ring-red-500' : 'focus:ring-blue-500' }}" placeholder="59.2826004" value="" />
                                </div>
                                <div class="lg:w-1/3 mb-2 lg:mb-0">
                                    <x-forms.label class="{{ $errors->has('lng') ? 'text-red-500' : '' }}" :for="__('longitude')">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-arrow-down-right inline-block w-4 mr-2" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                            <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                            <line x1="7" y1="7" x2="17" y2="17"></line>
                                            <polyline points="17 8 17 17 8 17"></polyline>
                                        </svg>
                                    </x-forms.label>
                                    <x-forms.input name="lng" class="mt-2 {{ $errors->has('lng') ? 'focus:ring-red-500' : 'focus:ring-blue-500' }}" placeholder="-142.8796558" value="" />
                                </div>
                                <div class="lg:w-1/3 mb-2 lg:mb-0">
                                    <x-forms.label class="{{ $errors->has('elevation') ? 'text-red-500' : '' }}" :for="__('elevation (ft)')">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-arrow-down-right inline-block w-4 mr-2" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                            <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                            <line x1="7" y1="7" x2="17" y2="17"></line>
                                            <polyline points="17 8 17 17 8 17"></polyline>
                                        </svg>
                                    </x-forms.label>
                                    <x-forms.input name="elevation" class="mt-2 {{ $errors->has('elevation') ? 'focus:ring-red-500' : 'focus:ring-blue-500' }}" placeholder="546" value="" />
                                </div>
                            </div>

                            <div class="mt-6 flex justify-end">
                                <div class="lg:mt-0 mt-3 w-full lg:w-auto">
                                    <x-buttons.primary type="submit">
                                        update data
                                        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-rotate-clockwise inline-block w-5 ml-2" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                            <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                            <path d="M4.05 11a8 8 0 1 1 .5 4m-.5 5v-5h5"></path>
                                        </svg>
                                    </x-buttons.primary>
                                </div>
                            </div>
                        </form>
                    </x-card>

                    <x-card class="mt-8">
                        <h5 class="leading-3 inline-flex items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-info-circle inline-block w-5 mr-3" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                <circle cx="12" cy="12" r="9"></circle>
                                <line x1="12" y1="8" x2="12.01" y2="8"></line>
                                <polyline points="11 12 12 12 12 16 13 16"></polyline>
                            </svg>
                            Sub Data Updation
                        </h5>
                        <span class="text-gray-400 flex text-xs">information regarding omission of sub data</span>

                        <p class="mt-6 text-xs">
                            sub data includes runway & frequency data of an airport. these cannot be edited by the staff through a form due to database limitations.
                            a workaround would be to edit these in the csv file provided by your relationship manager and importing the edited file into the database.
                            we are working to make your experience better and will be bringing this feature to x-crew soon through OTA updates. <br />

                            <br />for any further queries, please contact us at hi@foxsys.xyz thank you for your understanding.
                        </p>
                    </x-card>
                </div>

                <div class="w-full lg:w-2/5 mt-8 lg:mt-0">
                    <x-card class="mt-8 lg:mt-0">
                        <h5 class="leading-3 inline-flex items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-plane-departure inline-block w-5 mr-3" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                <path d="M15 12h5a2 2 0 0 1 0 4h-15l-3 -6h3l2 2h3l-2 -7h3z" transform="rotate(-15 12 12) translate(0 -1)"></path>
                                <line x1="3" y1="21" x2="21" y2="21"></line>
                            </svg>
                            {{ $aircraft->icao }} [{{ $aircraft->registration }}] // Location
                        </h5>
                        <span class="text-gray-400 flex text-xs">map displays visual location of the airport</span>
                        
                        <div class="mt-6 rounded-xl z-10 shadow-xl" id="map" style="height: 256px;"></div>
                    </x-card>
                </div>
            </div>
        </div>
    </div>

    <script>
        mapboxgl.accessToken = `{{ config('services.mapbox.access_token') }}`;
        const map = new mapboxgl.Map({
            container: 'map', // container ID
            style: 'mapbox://styles/hiaaryan/ckwatwod05wdw14mvtj34e8nk', // style URL
            center: [`{{ $airport->lng }}`, `{{ $airport->lat }}`], // starting position [lng, lat]
            zoom: 11.5, // starting zoom
            attributionControl: false
        });
    </script>

@endsection
