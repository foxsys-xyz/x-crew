@extends('layouts.app')

@section('content')
 
    <div x-data="{ sidebarOpen: false }" class="flex h-screen bg-gray-100">
    
        @include('layouts.cloud.sidebar')

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

                        <!-- Laravel's Validation Errors -->

                        @if ($errors->any())

                            <div class="lg:flex justify-center text-center px-10 py-5 text-xs text-white bg-red-500 mt-8 rounded-3xl">
                                <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-ban inline-block w-4 mr-3" viewBox="0 0 24 24" stroke-width="1.5" stroke="#ffffff" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                    <circle cx="12" cy="12" r="9" />
                                    <line x1="5.7" y1="5.7" x2="18.3" y2="18.3" />
                                </svg>
                                strange, an error. maybe retry entering the details correctly?
                            </div>

                        @endif

                        <div class="mt-8">
                            <div class="lg:flex w-full gap-8">
                                <div class="w-full lg:w-3/5">
                                    <div class="rounded-3xl overflow-hidden bg-white shadow-lg">
                                        <div class="h-80 overflow-hidden">
                                            <div class="h-full bg-cover bg-center flex items-center" style="background-image: url('{{ asset('/img/bg/cfcdc [1].png') }}');">
                                                <div class="text-white p-8">
                                                    <h1 class="text-3xl flex items-center">
                                                        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-access-point inline-block w-10 mr-3" viewBox="0 0 24 24" stroke-width="1.5" stroke="#ffffff" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                                            <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                                            <line x1="12" y1="12" x2="12" y2="12.01" />
                                                            <path d="M14.828 9.172a4 4 0 0 1 0 5.656" />
                                                            <path d="M17.657 6.343a8 8 0 0 1 0 11.314" />
                                                            <path d="M9.168 14.828a4 4 0 0 1 0 -5.656" />
                                                            <path d="M6.337 17.657a8 8 0 0 1 0 -11.314" />
                                                        </svg>
                                                        {{ $weather->station_id }} <span class="text-sm ml-3 -mb-2">[{{ $currentloc->iata }}]</span>
                                                    </h1>
                                                    <p class="text-sm">{{ $currentloc->airport_name }}, {{ $currentloc->city_name }}.</p>
                                                    <p class="my-4 max-w-md">{{ $weather->raw_text }}</p>
                                                    <p class="text-xs">weather by aviationweather.gov</p>
                                                </div>                                            
                                            </div>
                                        </div>
                                        <div class="p-8">
                                            <form action="{{ route('cfcdc.search') }}" method="post">

                                                @csrf

                                                <div class="w-full mb-2 lg:mb-0">
                                                    <span class="text-xs lg:flex items-center {{ $errors->has('icao') ? 'text-red-500' : '' }}">
                                                        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-arrow-down-right inline-block w-4 mr-3" viewBox="0 0 24 24" stroke-width="1.5" stroke="{{ $errors->has('icao') ? '#f56565' : '#2c3e50' }}" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                                            <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                                            <line x1="7" y1="7" x2="17" y2="17" />
                                                            <polyline points="17 8 17 17 8 17" />
                                                        </svg>
                                                        destination
                                                    </span>
                                                    <input name="icao" class="w-full mt-2 outline-none px-4 py-2 rounded-full {{ $errors->has('icao') ? 'focus:ring focus:ring-red-500' : 'focus:ring focus:ring-indigo-500' }} bg-gray-100 transition duration-500" placeholder="EGKK or Gatwick? What about Dubai?" />
                                                </div>
                                                <div class="mt-6 flex justify-end">
                                                    <div class="lg:mt-0 mt-3 w-full lg:w-auto">
                                                        <button type="submit" class="text-sm justify-center lg:text-base w-full lg:w-auto flex items-center focus:outline-none px-4 py-2 rounded-full focus:shadow-outline bg-indigo-500 hover:bg-indigo-600 text-white transition duration-500">
                                                            search aerodomes
                                                            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-search inline-block w-6 ml-3" viewBox="0 0 24 24" stroke-width="1.5" stroke="#ffffff" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                                                <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                                                <circle cx="10" cy="10" r="7" />
                                                                <line x1="21" y1="21" x2="15" y2="15" />
                                                            </svg>
                                                        </button>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                <div class="w-full lg:w-2/5 mt-8 lg:mt-0">
                                    <div class="rounded-3xl bg-white shadow-lg p-6">
                                        <canvas id="myChart"></canvas>
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
        chartOptionsConfiguration =  {
            maintainAspectRatio: false,
            legend: {
                display: false
            },
            tooltips: {
                backgroundColor: '#FFFFFF',
                titleFontColor: '#333',
                bodyFontColor: '#666',
                bodySpacing: 4,
                xPadding: 12,
                mode: "nearest",
                intersect: 0,
                position: "nearest"
            },
            responsive: true,
            scales: {
                yAxes: [{
                barPercentage: 1.6,
                    gridLines: {
                        drawBorder: false,
                        color: '#FFFFFF',
                        zeroLineColor: "transparent"
                    },
                    ticks: {
                        beginAtZero: true,
                        display: false
                    }
                }],

                xAxes: [{
                    barPercentage: 1.6,
                    gridLines: {
                        drawBorder: false,
                        color: '#FFFFFF',
                        zeroLineColor: "transparent"
                    },
                    ticks: {
                        padding: 20,
                        fontColor: "#9A9A9A"
                    }
                }]
            }
        };

        var ctx = document.getElementById("myChart").getContext("2d");

        var data = {
            labels: ['JAN','FEB','MAR','APR','MAY','JUN','JUL','AUG','SEP','OCT','NOV','DEC'],
            datasets: [{
                label: "Flights",
                fill: true,
                backgroundColor: '#FFFFFF',
                borderColor: '#FF0000',
                borderWidth: 2,
                borderDash: [],
                borderDashOffset: 0.0,
                pointBackgroundColor: '#FF0000',
                pointBorderColor: '#FFFFFF',
                pointHoverBackgroundColor: '#FF0000',
                pointBorderWidth: 20,
                pointHoverRadius: 4,
                pointHoverBorderWidth: 15,
                pointRadius: 4,
                data: [5, 6, 13, 2, 5, 5, 12, 8, 9, 10, 11, 12],
            }]
        };

        var myChart = new Chart(ctx, {
            type: 'line',
            data: data,
            options: chartOptionsConfiguration
        });
    </script>

@endsection
