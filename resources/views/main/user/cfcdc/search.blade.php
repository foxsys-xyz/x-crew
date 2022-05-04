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

        <div class="mt-8">
            <div class="lg:flex w-full gap-8">
                <div class="w-full lg:w-3/5">
                    <x-card class="overflow-y-auto">
                        <h5 class="leading-3 font-medium inline-flex items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-plane inline-block w-5 mr-3" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                <path d="M16 10h4a2 2 0 0 1 0 4h-4l-4 7h-3l2 -7h-4l-2 2h-3l2 -4l-2 -4h3l2 2h4l-2 -7h3z"></path>
                            </svg>
                            Aircraft / Fleet Data
                        </h5>
                        <span class="text-gray-400 flex text-xs">manage aircraft or fleet of one or more airlines</span>

                        <table id="search" class="mt-6 w-full">
                            <thead>
                                <tr>
                                    <th class="pb-2 text-left px-4" data-priority="1">Airline</th>
                                    <th class="pb-2 text-left" data-priority="2">Flight #</th>
                                    <th class="pb-2 text-left" data-priority="3">Departure</th>
                                    <th class="pb-2 text-left" data-priority="4">Arrival</th>
                                    <th class="pb-2 text-left" data-priority="5">Type</th>
                                    <th class="pb-2 text-left" data-priority="6">Aircraft</th>
                                    <th class="pb-2 text-left px-4" data-priority="7">Fly</th>
                                </tr>
                            </thead>
                            <tbody>
                            @foreach ($schedules as $schedule)

                                <tr class="hover:bg-gray-800 hover:bg-opacity-60 transition duration-150">
                                    <td class="text-sm truncate py-2 px-4 rounded-l-xl">
                                        <p class="flex items-center">
                                            <img class="mr-3 h-5 rounded-md" src="https://flightaware.com/images/airline_logos/90p/{{ $schedule->airline_icao }}.png">
                                            {{ $schedule->airline_icao }}
                                        </p>
                                    </td>
                                    <td class="py-2 truncate text-sm">{{ $schedule->flightnum }}</td>
                                    <td class="py-2 truncate text-sm">{{ $schedule->departure }}</td>
                                    <td class="py-2 truncate text-sm">{{ $schedule->arrival }}</td>
                                    <td class="py-2 truncate text-sm">{{ $schedule->type }}</td>
                                    <td class="py-2 truncate text-sm">{{ $schedule->aircraft_icao }}</td>
                                    <td class="py-2 truncate text-sm px-4 rounded-r-xl">
                                        <a class="hover:text-gray-400 trasition duration-150"  href="{{ route('cfcdc.flight', ['id' => $schedule->id]) }}" target="_blank">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-plane transform -rotate-45 hover:rotate-0 transition duration-150 inline-block w-5" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                                <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                                <path d="M16 10h4a2 2 0 0 1 0 4h-4l-4 7h-3l2 -7h-4l-2 2h-3l2 -4l-2 -4h3l2 2h4l-2 -7h3z"></path>
                                            </svg>
                                        </a>
                                    </td>
                                </tr>

                            @endforeach
                            </tbody>
                        </table>
                    </x-card>
                </div>
                <div class="w-full lg:w-2/5 mt-8 lg:mt-0">
                    <x-card class="h-96">
                        
                    </x-card>
                </div>
            </div>
        </div>
    </div>

@endsection
