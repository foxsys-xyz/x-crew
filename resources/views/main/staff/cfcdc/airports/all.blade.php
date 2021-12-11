@extends('layouts.staff')

@section('content')

    <div class="mx-auto px-8 py-8">
        <h4 class="text-2xl leading-3 font-medium inline-flex items-center">
            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-database-import inline-block w-8 mr-3" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                <ellipse cx="12" cy="6" rx="8" ry="3"></ellipse>
                <path d="M4 6v8m5.009 .783c.924 .14 1.933 .217 2.991 .217c4.418 0 8 -1.343 8 -3v-6"></path>
                <path d="M11.252 20.987c.246 .009 .496 .013 .748 .013c4.418 0 8 -1.343 8 -3v-6m-18 7h7m-3 -3l3 3l-3 3"></path>
            </svg>
            CFCDC // Airports
        </h4>
        <span class="flex leading-3 text-gray-400 text-xs">here you can organise your airline's airport data.</span>

        <div class="mt-8">
            <div class="lg:flex w-full gap-8">
                <div class="w-full lg:w-3/5">
                    <x-card class="overflow-y-auto">
                        <h5 class="leading-3 font-medium inline-flex items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-plane-departure inline-block w-5 mr-3" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                <path d="M15 12h5a2 2 0 0 1 0 4h-15l-3 -6h3l2 2h3l-2 -7h3z" transform="rotate(-15 12 12) translate(0 -1)"></path>
                                <line x1="3" y1="21" x2="21" y2="21"></line>
                            </svg>
                            Airport Data
                        </h5>
                        <span class="text-gray-400 flex text-xs">manage airports, runways and frequencies</span>

                        <table id="search" class="mt-6 w-full">
                            <thead>
                                <tr>
                                    <th class="pb-2 text-left px-4" data-priority="1">ICAO</th>
                                    <th class="pb-2 text-left" data-priority="2">Airport Name</th>
                                    <th class="pb-2 text-left" data-priority="3">City Name</th>
                                    <th class="pb-2 text-left" data-priority="4">Country</th>
                                    <th class="pb-2 text-left px-4" data-priority="7">Manage</th>
                                </tr>
                            </thead>
                            <tbody>
                            @foreach ($airports as $airport)

                                <tr class="hover:bg-gray-800 hover:bg-opacity-60 transition duration-150">
                                    <td class="text-sm truncate py-2 px-4 rounded-l-xl">{{ $airport->icao }}</td>
                                    <td class="text-sm truncate py-2">{{ $airport->airport_name }}</td>
                                    <td class="text-sm truncate py-2">{{ $airport->city_name }}</td>
                                    <td class="text-sm truncate py-2 flex items-center"><img class="mr-3" src="https://flagcdn.com/16x12/{{ strtolower($airport->country) }}.png">{{ $airport->country }}</td>
                                    <td class="text-sm truncate py-2 px-4 rounded-r-xl">
                                        <a class="hover:text-gray-400 trasition duration-150" href="{{ route('staff.airport.edit', ['id' => $airport->id]) }}" target="_blank">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-arrow-up-right transform hover:rotate-45 transition duration-150 inline-block w-5" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                                <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                                <line x1="17" y1="7" x2="7" y2="17"></line>
                                                <polyline points="8 7 17 7 17 16"></polyline>
                                            </svg>
                                        </a>
                                    </td>
                                </tr>

                            @endforeach
                            </tbody>
                        </table>

                        <div class="mt-4">
                            {{ $airports->onEachSide(2)->links() }}
                        </div>                        
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
