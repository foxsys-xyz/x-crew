@extends('layouts.app')

@section('content')
 
    <div class="mx-auto px-8 py-8">
        <h4 class="text-2xl leading-3 font-medium inline-flex items-center">
            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-smart-home inline-block w-8 mr-3" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                <path d="M19 8.71l-5.333 -4.148a2.666 2.666 0 0 0 -3.274 0l-5.334 4.148a2.665 2.665 0 0 0 -1.029 2.105v7.2a2 2 0 0 0 2 2h12a2 2 0 0 0 2 -2v-7.2c0 -.823 -.38 -1.6 -1.03 -2.105"></path>
                <path d="M16 15c-2.21 1.333 -5.792 1.333 -8 0"></path>
            </svg>
            Dashboard
        </h4>
        <span class="text-gray-400 flex leading-3 text-xs">welcome back, here is your airline dashboard.</span>

        <div class="mt-8">
            <div class="flex flex-wrap -mx-3">
                <div class="w-full px-3 sm:w-1/2 lg:w-1/3">
                    <x-card class="flex items-center">
                        <div class="p-3 rounded-xl bg-indigo-600 shadow-xl">
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-license inline-block w-6" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                <path d="M15 21h-9a3 3 0 0 1 -3 -3v-1h10v2a2 2 0 0 0 4 0v-14a2 2 0 1 1 2 2h-2m2 -4h-11a3 3 0 0 0 -3 3v11"></path>
                                <line x1="9" y1="7" x2="13" y2="7"></line>
                                <line x1="9" y1="11" x2="13" y2="11"></line>
                            </svg>
                        </div>

                        <div class="mx-5">
                            <h4 class="text-2xl">2</h4>
                            <div class="text-gray-400">PIREPs</div>
                        </div>
                    </x-card>
                </div>

                <div class="w-full mt-6 px-3 sm:w-1/2 lg:w-1/3 sm:mt-0">
                    <x-card class="flex items-center">
                        <div class="p-3 rounded-xl bg-gray-600 shadow-xl">
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-clock inline-block w-6" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                <circle cx="12" cy="12" r="9"></circle>
                                <polyline points="12 7 12 12 15 15"></polyline>
                            </svg>
                        </div>

                        <div class="mx-5">
                            <h4 class="text-2xl">03:21</h4>
                            <div class="text-gray-400">Chrono</div>
                        </div>
                    </x-card>
                </div>

                <div class="w-full mt-6 px-3 sm:w-1/2 lg:w-1/3 lg:mt-0">
                    <x-card class="flex items-center">
                        <div class="p-3 rounded-xl bg-yellow-600 shadow-xl">
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-plane-arrival inline-block w-6" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                <path d="M15 12h5a2 2 0 0 1 0 4h-15l-3 -6h3l2 2h3l-2 -7h3z" transform="rotate(15 12 12) translate(0 -1)"></path>
                                <line x1="3" y1="21" x2="21" y2="21"></line>
                            </svg>
                        </div>

                        <div class="mx-5">
                            <h4 class="text-2xl">-221</h4>
                            <div class="text-gray-400">Average</div>
                        </div>
                    </x-card>
                </div>
            </div>

            <div class="lg:flex mt-8 gap-8">
                <div class="w-full lg:w-3/5 mt-8 lg:mt-0">
                    <x-card>
                        <h5 class="leading-3 font-medium inline-flex items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-chart-arcs inline-block w-5 mr-3" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                <circle cx="12" cy="12" r="1"></circle>
                                <path d="M16.924 11.132a5 5 0 1 0 -4.056 5.792"></path>
                                <path d="M3 12a9 9 0 1 0 9 -9"></path>
                            </svg>
                            Company [ ACARS ] Uplink
                        </h5>
                        <span class="text-gray-400 flex text-xs">11 aircraft stations online</span>

                        <div class="mt-6 rounded-xl z-10 shadow-xl" id="map" style="height: 520px;"></div>
                    </x-card>
                </div>
                
                <div class="w-full lg:w-2/5 mt-8 lg:mt-0">
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

                    <x-card class="mt-8 bg-gradient-to-br from-indigo-500 via-purple-600 to-pink-600">
                        <p class="text-xs">
                            we're glad you're here. unfortunately the system was unable to find any flights that you've booked.
                            we recommend you to check CFCDC and come back afterwards.
                        </p>
                        <div x-data class="mt-6">
                            <x-buttons.primary x-on:click="window.location.href='{{ route('cfcdc') }}'" class="lg:w-full bg-blue-50 hover:bg-blue-100 bg-opacity-30 hover:bg-opacity-40">
                                open CFCDC
                                <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-arrow-up-right inline-block w-5 ml-2" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                    <line x1="17" y1="7" x2="7" y2="17"></line>
                                    <polyline points="8 7 17 7 17 16"></polyline>
                                </svg>
                            </x-buttons.primary>
                        </div>
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
            center: [40.52, 32.34], // starting position [lng, lat]
            zoom: 1.5, // starting zoom
            attributionControl: false
        });
        const marker = new mapboxgl.Marker()
            .setLngLat([30.5, 50.5])
            .addTo(map);
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
