@extends('layouts.app')

@section('content')

    <div class="mx-auto px-8 py-8">
        <h4 class="text-2xl leading-3 inline-flex items-center">
            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-plane inline-block w-8 mr-3" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                <path d="M16 10h4a2 2 0 0 1 0 4h-4l-4 7h-3l2 -7h-4l-2 2h-3l2 -4l-2 -4h3l2 2h4l-2 -7h3z"></path>
            </svg>
            CFCDC
        </h4>
        <span class="text-gray-400 flex leading-3 text-xs">the central flight crew data center, for all.</span>

        @if (session()->has('error'))

            <div class="lg:flex justify-center text-center px-10 py-5 text-xs bg-red-500 mt-8 rounded-3xl shadow-2xl">
                <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-circle-minus inline-block w-4 mr-3" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                    <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                    <circle cx="12" cy="12" r="9"></circle>
                    <line x1="9" y1="12" x2="15" y2="12"></line>
                </svg>
                {{ session()->get('error') }}
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
                    <x-card class="overflow-hidden">
                        <h5 class="leading-3 font-medium inline-flex items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-brand-safari inline-block w-5 mr-3" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                <polyline points="8 16 10 10 16 8 14 14 8 16"></polyline>
                                <circle cx="12" cy="12" r="9"></circle>
                            </svg>
                            {{ $currentloc->icao }} // Flight Search
                        </h5>
                        <span class="text-gray-400 flex text-xs">map displays visual location of the airport</span>
                        
                        <div class="mt-6 rounded-xl z-10 shadow-xl" id="map" style="height: 256px;"></div>

                        <form class="pt-6" action="{{ route('cfcdc.search') }}" method="post">

                            @csrf

                            <div class="w-full mb-2 lg:mb-0">
                                <x-forms.label class="{{ $errors->has('icao') ? 'text-red-500' : '' }}" :for="__('destination')">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-arrow-down-right inline-block w-4 mr-2" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                        <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                        <line x1="7" y1="7" x2="17" y2="17"></line>
                                        <polyline points="17 8 17 17 8 17"></polyline>
                                    </svg>
                                </x-forms.label>
                                <x-forms.input name="icao" class="mt-2 {{ $errors->has('icao') ? 'focus:ring-red-500' : 'focus:ring-indigo-500' }}" placeholder="EGKK or Gatwick? What about Dubai?" />
                            </div>
                            <div class="mt-6 flex justify-end">
                                <div class="lg:mt-0 mt-3 w-full lg:w-auto">
                                    <x-buttons.primary type="submit">
                                        search aerodomes
                                        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-search inline-block w-5 ml-2" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                            <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                            <circle cx="10" cy="10" r="7"></circle>
                                            <line x1="21" y1="21" x2="15" y2="15"></line>
                                        </svg>
                                    </x-buttons.primary>
                                </div>
                            </div>
                        </form>
                    </x-card>
                </div>
                <div class="w-full lg:w-2/5 mt-8 lg:mt-0">
                    @if ($booking != null)
                    <x-card class="mb-8 bg-gradient-to-br from-indigo-500 via-purple-600 to-pink-600">
                        <h5 class="leading-3 font-medium inline-flex items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-server-2 inline-block w-5 mr-3" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                <rect x="3" y="4" width="18" height="8" rx="3"></rect>
                                <rect x="3" y="12" width="18" height="8" rx="3"></rect>
                                <line x1="7" y1="8" x2="7" y2="8.01"></line>
                                <line x1="7" y1="16" x2="7" y2="16.01"></line>
                                <path d="M11 8h6"></path>
                                <path d="M11 16h6"></path>
                            </svg>
                            {{ $schedule->airline_icao . $schedule->flightnum }} // Active Booking
                        </h5>
                        <span class="text-gray-200 flex text-xs">map displays visual location of the airport</span>

                        <p class="mt-6 text-xs">
                            <span class="font-bold">{{ $schedule->airline_icao . $schedule->flightnum }}</span><br /><br />
                            {{ $schedule->departure }} >> {{ $schedule->arrival }}<br />

                            {{ $aircraft->icao }} // {{ $aircraft->manufacturer . ' ' . $aircraft->model }} [{{ $aircraft->registration }}]
                        </p>
                        <div x-data class="mt-6 lg:flex items-center gap-2">
                            <x-buttons.primary x-on:click="window.location.href='{{ route('cfcdc') }}'" class="w-full lg:w-1/3 bg-blue-50 hover:bg-blue-100 bg-opacity-30 hover:bg-opacity-40">
                                cancel
                                <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-x inline-block w-5 ml-2" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                    <desc>Download more icon variants from https://tabler-icons.io/i/x</desc>
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                    <line x1="18" y1="6" x2="6" y2="18"></line>
                                    <line x1="6" y1="6" x2="18" y2="18"></line>
                                </svg>
                            </x-buttons.primary>

                            <x-buttons.primary x-on:click="window.location.href='{{ route('cfcdc') }}'" class="w-full lg:w-2/3 bg-blue-50 hover:bg-blue-100 bg-opacity-30 hover:bg-opacity-40">
                                proceed to briefing
                                <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-arrow-up-right inline-block w-5 ml-2" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                    <line x1="17" y1="7" x2="7" y2="17"></line>
                                    <polyline points="8 7 17 7 17 16"></polyline>
                                </svg>
                            </x-buttons.primary>
                        </div>
                    </x-card>
                    @endif

                    <x-card>
                        <h5 class="leading-3 font-medium inline-flex items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-license inline-block w-5 mr-3" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                <path d="M15 21h-9a3 3 0 0 1 -3 -3v-1h10v2a2 2 0 0 0 4 0v-14a2 2 0 1 1 2 2h-2m2 -4h-11a3 3 0 0 0 -3 3v11"></path>
                                <line x1="9" y1="7" x2="13" y2="7"></line>
                                <line x1="9" y1="11" x2="13" y2="11"></line>
                            </svg>
                            Monthly PIREPs
                        </h5>
                        <span class="text-gray-400 flex text-xs">amount of PIREPs filed per month</span>

                        <canvas class="mt-6" id="myChart"></canvas>
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
            center: [`{{ $currentloc->lng }}`, `{{ $currentloc->lat }}`], // starting position [lng, lat]
            zoom: 11.5, // starting zoom
            attributionControl: false
        });
    </script>

    <script>
        const labels = [
            'January',
            'February',
            'March',
            'April',
            'May',
            'June',
            'July',
            'August',
            'September',
            'October',
            'November',
            'December',
        ];
        
        const data = {
            labels: labels,
            datasets: [{
                label: 'Flights',
                backgroundColor: '#4f46e5',
                borderColor: '#4f46e5',
                data: [0, 10, 5, 2, 20, 30, 45, 25, 20, 10, 5, 12],
                tension: 0.4,
            }]
        };

        const config = {
            type: 'line',
            data: data,
            options: {
                layout: {
                    padding: {
                        bottom: 20,
                    }
                },
                plugins: {
                    legend: {
                        display: false,
                    }
                },
                scales: {
                    xAxes: 
                        {
                            display: false,
                        },
                    yAxes: 
                        {
                            display: false,
                        }
                },
            }
        };

        const myChart = new Chart(
            document.getElementById('myChart'),
            config
        );
    </script>

@endsection
