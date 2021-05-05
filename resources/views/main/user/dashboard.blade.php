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
                    <div class="flex items-center p-6 bg-gray-900 bg-opacity-80 rounded-3xl shadow-2xl">
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
                    </div>
                </div>

                <div class="w-full mt-6 px-3 sm:w-1/2 lg:w-1/3 sm:mt-0">
                    <div class="flex items-center p-6 bg-gray-900 bg-opacity-80 rounded-3xl shadow-2xl">
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
                    </div>
                </div>

                <div class="w-full mt-6 px-3 sm:w-1/2 lg:w-1/3 lg:mt-0">
                    <div class="flex items-center p-6 bg-gray-900 bg-opacity-80 rounded-3xl shadow-2xl">
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
                    </div>
                </div>
            </div>

            <div class="lg:flex mt-8 gap-8">
                <div class="w-full lg:w-3/5 p-6 bg-gray-900 bg-opacity-80 rounded-3xl shadow-2xl">
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

                    <div class="mt-6 rounded-xl rounded-br-none z-10 shadow-xl" id="mapid" style="height: 520px;"></div>
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
        var map = L.map('mapid').setView([51.505, -0.2], 5);

        L.tileLayer('https://{s}.basemaps.cartocdn.com/light_nolabels/{z}/{x}/{y}{r}.png', {
            attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> Contributors &copy; <a href="https://carto.com/attributions">CARTO</a>'
        }).addTo(map);

        L.marker([51.5, -0.09]).addTo(map)
        .bindPopup('A pretty CSS3 popup.<br> Easily customizable.');
    </script>

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
