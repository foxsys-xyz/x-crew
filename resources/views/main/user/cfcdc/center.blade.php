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
                    <x-card class="mt-8">
                        <h5 class="leading-3 font-medium inline-flex items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-license inline-block w-5 mr-3" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                <path d="M15 21h-9a3 3 0 0 1 -3 -3v-1h10v2a2 2 0 0 0 4 0v-14a2 2 0 1 1 2 2h-2m2 -4h-11a3 3 0 0 0 -3 3v11"></path>
                                <line x1="9" y1="7" x2="13" y2="7"></line>
                                <line x1="9" y1="11" x2="13" y2="11"></line>
                            </svg>
                            Upcoming Flight [Booking]
                        </h5>
                        <span class="text-gray-400 flex text-xs">details of the airframe & last booked flight</span>

                        <p class="text-xs mt-6">
                            <span class="font-bold">{{ $schedule->airline_icao . $schedule->flightnum }}</span><br />
                            {{ $schedule->departure }} >> {{ $schedule->arrival }}<br /><br />

                            {{ $aircraft }}
                        </p>
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
                </div>
            </div>
        </div>
    </div>

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
