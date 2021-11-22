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

        <div class="mt-8">
            <div class="lg:flex w-full gap-8">
                <div class="w-full lg:w-3/5">
                    <x-card class="overflow-y-auto">
                        <table id="search" class="w-full">
                            <thead>
                                <tr>
                                    <th class="pb-6 text-left" data-priority="1">Airline</th>
                                    <th class="pb-6 text-left" data-priority="2">Flight #</th>
                                    <th class="pb-6 text-left" data-priority="3">Departure</th>
                                    <th class="pb-6 text-left" data-priority="4">Arrival</th>
                                    <th class="pb-6 text-left" data-priority="5">Type</th>
                                    <th class="pb-6 text-left" data-priority="6">Aircraft</th>
                                    <th class="pb-6 text-left" data-priority="7">Fly</th>
                                </tr>
                            </thead>
                            <tbody>
                            @foreach ($schedules as $schedule)

                                <tr>
                                    <td class="py-2 flex items-center"><img class="mr-3" src="https://flightaware.com/images/airline_logos/90p/{{ $schedule->airline_icao }}.png" width="24px">{{ $schedule->airline_icao }}</td>
                                    <td class="py-2">{{ $schedule->flightnum }}</td>
                                    <td class="py-2">{{ $schedule->departure }}</td>
                                    <td class="py-2">{{ $schedule->arrival }}</td>
                                    <td class="py-2">{{ $schedule->type }}</td>
                                    <td class="py-2">{{ $schedule->aircraft_icao }}</td>
                                    <td class="py-2">
                                        <a href="{{ route('cfcdc.flight', ['id' => $schedule->id]) }}" target="_blank">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-plane inline-block w-6 transform -rotate-45 hover:rotate-0 duration-500" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
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
