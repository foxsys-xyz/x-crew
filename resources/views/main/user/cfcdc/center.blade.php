@extends('layouts.app')

@section('content')

    <div class="mx-auto px-8 py-8">
        <h4 class="text-2xl leading-3 font-medium inline-flex items-center">
            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-plane inline-block w-8 mr-3" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                <path d="M16 10h4a2 2 0 0 1 0 4h-4l-4 7h-3l2 -7h-4l-2 2h-3l2 -4l-2 -4h3l2 2h4l-2 -7h3z"></path>
            </svg>
            CFCDC
        </h4>
        <span class="text-gray-400 flex leading-3 text-xs">the central flight crew data center, for all.</span>

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
                    <div class="bg-gray-900 bg-opacity-80 rounded-3xl shadow-2xl overflow-hidden">
                        <div class="h-80">
                            <div class="h-full bg-cover bg-center flex items-center" style="background-image: url('{{ asset('/img/bg/cfcdc [1].png') }}');">
                                <div class="p-6">
                                    <h1 class="text-3xl flex items-center">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-cloud inline-block w-10 mr-3" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                            <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                            <path d="M7 18a4.6 4.4 0 0 1 0 -9a5 4.5 0 0 1 11 2h1a3.5 3.5 0 0 1 0 7h-12"></path>
                                        </svg>
                                        {{ $weather->station_id }} <span class="text-sm ml-3 -mb-2">[{{ $currentloc->iata }}]</span>
                                    </h1>
                                    <p class="text-sm">{{ $currentloc->airport_name }}, {{ $currentloc->city_name }}.</p>
                                    <p class="my-4 max-w-md">{{ $weather->raw_text }}</p>
                                    <p class="text-xs">weather by aviationweather.gov</p>
                                </div>                                            
                            </div>
                        </div>
                        <div class="p-6">
                            <form action="{{ route('cfcdc.search') }}" method="post">

                                @csrf

                                <div class="w-full mb-2 lg:mb-0">
                                    <span class="text-xs lg:flex items-center {{ $errors->has('icao') ? 'text-red-500' : '' }}">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-arrow-down-right inline-block w-4 mr-3" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                            <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                            <line x1="7" y1="7" x2="17" y2="17"></line>
                                            <polyline points="17 8 17 17 8 17"></polyline>
                                        </svg>
                                        destination
                                    </span>
                                    <input name="icao" class="w-full mt-2 outline-none px-4 py-2 rounded-full {{ $errors->has('icao') ? 'focus:ring focus:ring-red-500' : 'focus:ring focus:ring-indigo-500' }} bg-gray-800 bg-opacity-60 transition duration-500" placeholder="EGKK or Gatwick? What about Dubai?" />
                                </div>
                                <div class="mt-6 flex justify-end">
                                    <div class="lg:mt-0 mt-3 w-full lg:w-auto">
                                        <button type="submit" class="text-sm justify-center lg:text-base w-full lg:w-auto flex items-center focus:outline-none px-4 py-2 rounded-full focus:shadow-outline bg-blue-600 hover:bg-blue-700 transition duration-500">
                                            search aerodomes
                                            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-search inline-block w-6 ml-3" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                                <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                                <circle cx="10" cy="10" r="7"></circle>
                                                <line x1="21" y1="21" x2="15" y2="15"></line>
                                            </svg>
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="w-full lg:w-2/5 mt-8 lg:mt-0">
                    <div class="bg-gray-900 bg-opacity-80 rounded-3xl shadow-2xl p-6">
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
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        const colors = {
            purple: {
                default: "rgba(149, 76, 233, 1)",
                half: "rgba(149, 76, 233, 0.5)",
                quarter: "rgba(149, 76, 233, 0.25)",
                zero: "rgba(149, 76, 233, 0)"
            },
            indigo: {
                default: "rgba(80, 102, 120, 1)",
                quarter: "rgba(80, 102, 120, 0.25)"
            }
            };

            const weight = [2, 6, 4, 3, 5, 3, 6, 6, 9, 4, 5, 7];

            const labels = [
                    "January",
                    "February",
                    "March",
                    "April",
                    "May",
                    "June",
                    "July",
                    "August",
                    "September",
                    "October",
                    "Novemeber",
                    "December"
                ];

                const ctx = document.getElementById("myChart").getContext("2d");
                ctx.canvas.height = 100;

                gradient = ctx.createLinearGradient(0, 25, 0, 300);
                gradient.addColorStop(0, colors.purple.half);
                gradient.addColorStop(0.15, colors.purple.quarter);
                gradient.addColorStop(0.55, colors.purple.zero);

                const options = {
                type: "line",
                data: {
                    labels: labels,
                    datasets: [
                    {
                        fill: true,
                        backgroundColor: gradient,
                        pointBackgroundColor: colors.purple.default,
                        borderColor: colors.purple.default,
                        data: weight,
                        lineTension: 0.4,
                        borderWidth: 2,
                        pointRadius: 3
                    }
                    ]
                },
                options: {
                    layout: {
                    padding: 10
                    },
                    responsive: true,
                    legend: {
                    display: false
                    },

                    scales: {
                    xAxes: [
                        {
                            display: false,
                            gridLines: {
                                display: false
                            },
                            ticks: {
                                padding: 10,
                                autoSkip: false,
                                maxRotation: 15,
                                minRotation: 15
                            }
                        }
                    ],
                    yAxes: [
                        {
                            display: false,
                            gridLines: {
                                display: true,
                                color: colors.indigo.quarter
                            },
                            ticks: {
                                beginAtZero: false,
                                padding: 10
                            }
                        }
                    ]
                    }
                }
            };

            window.onload = function () {
            window.myLine = new Chart(ctx, options);
        };
    </script>

@endsection
