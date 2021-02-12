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

                        <div class="mt-8">
                            <div class="lg:flex w-full gap-8">
                                <div class="w-full lg:w-3/5">
                                    <div class="rounded-3xl bg-white shadow-lg p-6 overflow-y-auto">
                                        <table id="search" class="pb-6">
                                            <thead>
                                                <tr>
                                                    <th class="text-left" data-priority="1">Airline</th>
                                                    <th class="text-left" data-priority="2">Flight #</th>
                                                    <th class="text-left" data-priority="3">Departure</th>
                                                    <th class="text-left" data-priority="4">Arrival</th>
                                                    <th class="text-left" data-priority="5">Type</th>
                                                    <th class="text-left" data-priority="6">Aircraft</th>
                                                    <th class="text-left" data-priority="7">Fly</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                            @foreach ($schedules as $schedule)

                                                <tr>
                                                    <td class="flex items-center"><img class="mr-3" src="https://flightaware.com/images/airline_logos/90p/{{ $schedule->airline_icao }}.png" width="24px">{{ $schedule->airline_icao }}</td>
                                                    <td>{{ $schedule->flightnum }}</td>
                                                    <td>{{ $schedule->departure }}</td>
                                                    <td>{{ $schedule->arrival }}</td>
                                                    <td>{{ $schedule->type }}</td>
                                                    <td>{{ $schedule->aircraft_icao }}</td>
                                                    <td>
                                                        <a href="{{ route('cfcdc.flight', ['id' => $schedule->id]) }}" target="_blank">
                                                            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-plane inline-block w-6 transform -rotate-45 hover:rotate-0 duration-500" viewBox="0 0 24 24" stroke-width="1.5" stroke="#2c3e50" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                                                <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                                                <path d="M16 10h4a2 2 0 0 1 0 4h-4l-4 7h-3l2 -7h-4l-2 2h-3l2 -4l-2 -4h3l2 2h4l-2 -7h3z" />
                                                            </svg>
                                                        </a>
                                                    </td>
                                                </tr>

                                            @endforeach
                                            </tbody>
                                        </table>
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
