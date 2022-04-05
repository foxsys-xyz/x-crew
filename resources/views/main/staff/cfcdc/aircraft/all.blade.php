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
            CFCDC // Aircraft / Fleet
        </h4>
        <span class="flex leading-3 text-gray-400 text-xs">here you can organise your airline's aircraft or fleet data.</span>

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
                                    <th class="pb-2 text-left px-4" data-priority="1">Model</th>
                                    <th class="pb-2 text-left" data-priority="2">Range</th>
                                    <th class="pb-2 text-left" data-priority="3">Registration</th>
                                    <th class="pb-2 text-left" data-priority="4">Airline</th>
                                    <th class="pb-2 text-left px-4" data-priority="5">Manage</th>
                                </tr>
                            </thead>
                            <tbody>
                            @foreach ($fleet as $aircraft)

                                <tr class="hover:bg-gray-800 hover:bg-opacity-60 transition duration-150">
                                    <td class="text-sm truncate py-2 px-4 rounded-l-xl">{{ $aircraft->manufacturer }} {{ $aircraft->model }}</td>
                                    <td class="text-sm truncate py-2">{{ $aircraft->range }}nm</td>
                                    <td class="text-sm truncate py-2">{{ $aircraft->registration }} [{{ $aircraft->icao }}]</td>
                                    <td class="text-sm truncate py-2">{{ $aircraft->airline_icao }}</td>
                                    <td class="text-sm truncate py-2 px-4 rounded-r-xl">
                                        <a class="hover:text-gray-400 trasition duration-150" href="{{ route('staff.aircraft.edit', ['id' => $aircraft->id]) }}" target="_blank">
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
                            {{ $fleet->onEachSide(2)->links() }}
                        </div>                        
                    </x-card>
                </div>
                <div class="w-full lg:w-2/5 mt-8 lg:mt-0">
                    <x-card class="mt-8 lg:mt-0">
                        <h5 class="leading-3 font-medium inline-flex items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-info-circle inline-block w-5 mr-3" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                <circle cx="12" cy="12" r="9"></circle>
                                <line x1="12" y1="8" x2="12.01" y2="8"></line>
                                <polyline points="11 12 12 12 12 16 13 16"></polyline>
                            </svg>
                            Aircraft Location
                        </h5>
                        <span class="text-gray-400 flex text-xs">determines the location for the fleet</span>

                        <p class="mt-6 text-xs max-w-4xl">
                            while importing the aircraft / fleet data, the location of all aircraft (starting point) must be defined.
                            this can be done by entering the ICAO code of the airport. if the ICAO code does not exist, the import will fail.
                            alternatively, you can leave the field blank and the default location of the fleet will be set to a a random hub of the airline.
                        </p>
                    </x-card>

                    <x-card class="mt-8">
                        <h5 class="leading-3 font-medium inline-flex items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-rotate-clockwise inline-block w-5 mr-3" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                <path d="M4.05 11a8 8 0 1 1 .5 4m-.5 5v-5h5"></path>
                            </svg>
                            Import Data
                        </h5>
                        <span class="text-gray-400 flex text-xs">please upload the csv files with complete data</span>

                        <form action="{{ route('staff.aircraft.import') }}" method="post" enctype="multipart/form-data">

                            @csrf

                            <div class="lg:flex mt-6 gap-2">
                                <div class="lg:w-full mb-2 lg:mb-0">
                                    <x-forms.label :for="__('aircraft / fleet (csv)')">
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
                                        <span id="file-chosen-aircraft">no file is chosen currently</span>
                                        <input type="file" name="aircraft" id="aircraft" class="hidden" />
                                    </label>
                                    <x-forms.label class="mt-2 {{ $errors->has('location') ? 'text-red-500' : '' }}" :for="__('location [icao only]')">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-arrow-down-right inline-block w-4 mr-2" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                            <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                            <line x1="7" y1="7" x2="17" y2="17"></line>
                                            <polyline points="17 8 17 17 8 17"></polyline>
                                        </svg>
                                    </x-forms.label>
                                    <x-forms.input name="location" class="mt-2 {{ $errors->has('location') ? 'focus:ring-red-500' : 'focus:ring-blue-500' }}" placeholder="OMDB or EGLL?" maxlength="4" />
                                </div>
                            </div>

                            <div class="mt-8 flex items-center text-sm">
                                <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-urgent inline-block w-4 mr-2" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                    <path d="M8 16v-4a4 4 0 0 1 8 0v4"></path>
                                    <path d="M3 12h1m8 -9v1m8 8h1m-15.4 -6.4l.7 .7m12.1 -.7l-.7 .7"></path>
                                    <rect x="6" y="16" width="12" height="4" rx="1"></rect>
                                </svg>
                                please make sure that the airport exists in the db.
                            </div>

                            <div class="mt-4 flex justify-end">
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
        const aircraft = document.getElementById('aircraft');
        const fileChosenAircraft = document.getElementById('file-chosen-aircraft');

        aircraft.addEventListener('change', function() {
            fileChosenAircraft.textContent = this.files[0].name
        });
    </script>

@endsection
