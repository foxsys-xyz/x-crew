@extends('layouts.staff')

@section('content')

    <div class="mx-auto px-8 py-8">
        <h4 class="text-2xl leading-3 inline-flex items-center">
            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-database-import inline-block w-8 mr-3" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                <ellipse cx="12" cy="6" rx="8" ry="3"></ellipse>
                <path d="M4 6v8m5.009 .783c.924 .14 1.933 .217 2.991 .217c4.418 0 8 -1.343 8 -3v-6"></path>
                <path d="M11.252 20.987c.246 .009 .496 .013 .748 .013c4.418 0 8 -1.343 8 -3v-6m-18 7h7m-3 -3l3 3l-3 3"></path>
            </svg>
            CFCDC // Airports
        </h4>
        <span class="flex leading-3 text-gray-400 text-xs">here you can organise your airline's airport data.</span>

        @if (session()->has('success'))

            <div class="lg:flex justify-center text-center px-10 py-5 text-xs bg-blue-600 mt-8 rounded-3xl shadow-2xl">
                <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-check inline-block w-4 mr-3" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                    <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                    <path d="M5 12l5 5l10 -10"></path>
                </svg>
                {{ session()->get('success') }}
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
                                <th class="pb-2 text-left px-4" data-priority="1">Country</th>
                                    <th class="pb-2 text-left" data-priority="2">ICAO</th>
                                    <th class="pb-2 text-left" data-priority="3">Airport Name</th>
                                    <th class="pb-2 text-left" data-priority="4">City Name</th>
                                    <th class="pb-2 text-left px-4" data-priority="5">Manage</th>
                                </tr>
                            </thead>
                            <tbody>
                            @foreach ($airports as $airport)

                                <tr class="hover:bg-gray-800 hover:bg-opacity-60 transition duration-150">
                                    <td class="text-sm truncate py-2 px-4 rounded-l-xl">
                                        <p class="flex items-center">
                                            <img class="mr-3 h-5 rounded-md" src="{{ asset('img/flags/' . strtolower($airport->country) . '.svg') }}" />
                                            {{ $airport->country }}
                                        </p>
                                    </td>
                                    <td class="text-sm truncate py-2">{{ $airport->icao }}</td>
                                    <td class="text-sm truncate py-2">{{ $airport->airport_name }}</td>
                                    <td class="text-sm truncate py-2">{{ $airport->city_name }}</td>
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
                    <x-card class="mt-8 lg:mt-0">
                        <h5 class="leading-3 font-medium inline-flex items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-rotate-clockwise inline-block w-5 mr-3" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                <path d="M4.05 11a8 8 0 1 1 .5 4m-.5 5v-5h5"></path>
                            </svg>
                            Import Data
                        </h5>
                        <span class="text-gray-400 flex text-xs">please upload the csv files with complete data</span>

                        <form action="{{ route('staff.airports.import') }}" method="post" enctype="multipart/form-data">

                            @csrf

                            <div class="lg:flex mt-6 gap-2">
                                <div class="lg:w-full mb-2 lg:mb-0">
                                    <x-forms.label :for="__('airports (csv)')">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-arrow-down-right inline-block w-4 mr-2" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                            <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                            <line x1="7" y1="7" x2="17" y2="17"></line>
                                            <polyline points="17 8 17 17 8 17"></polyline>
                                        </svg>
                                    </x-forms.label>
                                    <label class="mt-2 w-full flex flex-col items-center px-4 py-4 bg-gray-800 bg-opacity-60 rounded-xl cursor-pointer text-sm">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-cloud w-8" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                            <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                            <path d="M7 18a4.6 4.4 0 0 1 0 -9a5 4.5 0 0 1 11 2h1a3.5 3.5 0 0 1 0 7h-12"></path>
                                        </svg>
                                        <span class="mt-1 leading-normal">upload csv</span>
                                        <span id="file-chosen-airports">no file is chosen currently</span>
                                        <input type="file" name="airports" id="airports" class="hidden" />
                                    </label>
                                </div>
                            </div>
                            <div class="lg:flex mt-2 gap-2">
                                <div class="lg:w-full mb-2 lg:mb-0">
                                    <x-forms.label :for="__('runways (csv)')">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-arrow-down-right inline-block w-4 mr-2" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                            <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                            <line x1="7" y1="7" x2="17" y2="17"></line>
                                            <polyline points="17 8 17 17 8 17"></polyline>
                                        </svg>
                                    </x-forms.label>
                                    <label class="mt-2 w-full flex flex-col items-center px-4 py-4 bg-gray-800 bg-opacity-60 rounded-xl cursor-pointer text-sm">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-cloud w-8" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                            <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                            <path d="M7 18a4.6 4.4 0 0 1 0 -9a5 4.5 0 0 1 11 2h1a3.5 3.5 0 0 1 0 7h-12"></path>
                                        </svg>
                                        <span class="mt-1 leading-normal">upload csv</span>
                                        <span id="file-chosen-runways">no file is chosen currently</span>
                                        <input type="file" name="runways" id="runways" class="hidden" />
                                    </label>
                                </div>
                            </div>
                            <div class="lg:flex mt-2 gap-2">
                                <div class="lg:w-full mb-2 lg:mb-0">
                                    <x-forms.label :for="__('frequencies (csv)')">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-arrow-down-right inline-block w-4 mr-2" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                            <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                            <line x1="7" y1="7" x2="17" y2="17"></line>
                                            <polyline points="17 8 17 17 8 17"></polyline>
                                        </svg>
                                    </x-forms.label>
                                    <label class="mt-2 w-full flex flex-col items-center px-4 py-4 bg-gray-800 bg-opacity-60 rounded-xl cursor-pointer text-sm">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-cloud w-8" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                            <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                            <path d="M7 18a4.6 4.4 0 0 1 0 -9a5 4.5 0 0 1 11 2h1a3.5 3.5 0 0 1 0 7h-12"></path>
                                        </svg>
                                        <span class="mt-1 leading-normal">upload csv</span>
                                        <span id="file-chosen-frequencies">no file is chosen currently</span>
                                        <input type="file" name="frequencies" id="frequencies" class="hidden" />
                                    </label>
                                </div>
                            </div>
                            <div class="mt-6 flex justify-end">
                                <div class="lg:mt-0 mt-3 w-full lg:w-auto">
                                    <x-buttons.primary type="submit">
                                        import data
                                        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-rotate-clockwise inline-block w-5 ml-2" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                            <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                            <path d="M4.05 11a8 8 0 1 1 .5 4m-.5 5v-5h5"></path>
                                        </svg>
                                    </x-buttons.primary>
                                </div>
                            </div>
                        </form>
                    </x-card>
                </div>
            </div>
        </div>
    </div>

    <script>
        const airports = document.getElementById('airports');
        const fileChosenAirports = document.getElementById('file-chosen-airports');

        airports.addEventListener('change', function() {
            fileChosenAirports.textContent = this.files[0].name
        });

        const runways = document.getElementById('runways');
        const fileChosenRunways = document.getElementById('file-chosen-runways');

        runways.addEventListener('change', function() {
            fileChosenRunways.textContent = this.files[0].name
        });

        const frequencies = document.getElementById('frequencies');
        const fileChosenFrequencies = document.getElementById('file-chosen-frequencies');

        frequencies.addEventListener('change', function() {
            fileChosenFrequencies.textContent = this.files[0].name
        });
    </script>

@endsection
