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
                    <x-card>
                        <h5 class="leading-3 font-medium inline-flex items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-clipboard inline-block w-5 mr-3" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                <path d="M9 5h-2a2 2 0 0 0 -2 2v12a2 2 0 0 0 2 2h10a2 2 0 0 0 2 -2v-12a2 2 0 0 0 -2 -2h-2"></path>
                                <rect x="9" y="3" width="6" height="4" rx="2"></rect>
                            </svg>
                            Pre Book
                        </h5>
                        <span class="text-gray-400 flex text-xs">select your aircraft, know about the route & fly!</span>

                        <h6 class="mt-6 flex items-center">
                            {{ $schedule->airline_icao . $schedule->flightnum }}
                            
                            //
                            
                            {{ $schedule->departure }} >
                            {{ $schedule->arrival }}
                        </h6>
                        <p class="text-xs mt-2 text-gray-400">
                            Please book this flight only if you intend to fly it within the next 2 hours. If you book this flight other pilots won't be able to see
                            this particular schedule in their search. You're only allowed to book 'one' flight at a time. If you do not fly this route within 2 hours
                            of booking this flight, it will be automatically deleted from your bookings.
                        </p>
                        <p class="text-xs mt-2 text-gray-400">
                            Now, here below are the listed aircraft which are available at the airport and suits for this route. The aircraft assigned to this route is
                            <span class="text-white">{{ $schedule->aircraft_icao }}</span>. Please select any one. During <span class="text-white">Real Operations</span>, try to fly the aircraft back to avoid disruption.
                        </p>
                    </x-card>
                </div>
                <div class="w-full lg:w-2/5 mt-8 lg:mt-0">
                    <x-card>
                        <h5 class="leading-3 font-medium inline-flex items-center">

                            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-map inline-block w-5 mr-3" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                <polyline points="3 7 9 4 15 7 21 4 21 17 15 20 9 17 3 20 3 7"></polyline>
                                <line x1="9" y1="4" x2="9" y2="17"></line>
                                <line x1="15" y1="7" x2="15" y2="20"></line>
                            </svg>

                            {{ $schedule->airline_icao . $schedule->flightnum }}
                            
                            //
                            
                            {{ $schedule->departure }} >

                            {{ $schedule->arrival }}
                        </h5>
                        <span class="text-gray-400 flex text-xs">raw flight route which is to be flown, as shown below</span>

                        <div class="mt-6 rounded-xl rounded-br-none z-10 shadow-xl" id="mapid" style="height: 520px;"></div>
                    </x-card>
                </div>
            </div>
        </div>
    </div>

    <script>
        var map = L.map('mapid');

        L.tileLayer('https://{s}.basemaps.cartocdn.com/dark_nolabels/{z}/{x}/{y}.png', {
            attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> Contributors &copy; <a href="https://carto.com/attributions">CARTO</a>'
        }).addTo(map);

        var latlngs = [
            [{{ $departure->lat }}, {{ $departure->lng }}],
            [{{ $arrival->lat }}, {{ $arrival->lng }}]
        ];

        var polyline = L.polyline(latlngs, {color: 'white', weight: 1.5}).addTo(map);
        map.fitBounds(polyline.getBounds(), {maxZoom: 4});

        L.marker([{{ $departure->lat }}, {{ $departure->lng }}]).addTo(map).bindPopup('{{ $departure->airport_name }}');
        L.marker([{{ $arrival->lat }}, {{ $arrival->lng }}]).addTo(map).bindPopup('{{ $arrival->airport_name }}');
    </script>

@endsection
