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
                                    <div class="rounded-3xl bg-white shadow-lg p-6">
                                        <h5 class="text-gray-700 leading-3 font-medium inline-flex items-center">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-clipboard inline-block w-5 mr-3" viewBox="0 0 24 24" stroke-width="1.5" stroke="#2c3e50" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                                <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                                <path d="M9 5h-2a2 2 0 0 0 -2 2v12a2 2 0 0 0 2 2h10a2 2 0 0 0 2 -2v-12a2 2 0 0 0 -2 -2h-2"></path>
                                                <rect x="9" y="3" width="6" height="4" rx="2"></rect>
                                            </svg>
                                            Pre Book
                                        </h5>
                                        <span class="flex text-gray-500 text-xs">select your aircraft, know about the route & fly!</span>

                                        <h6 class="mt-6 flex items-center">
                                            {{ $schedule->airline_icao . $schedule->flightnum }} 
                                            
                                            // 
                                            
                                            {{ $schedule->departure }} 

                                            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-plane w-5 mx-2" viewBox="0 0 24 24" stroke-width="1.5" stroke="#2c3e50" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                                <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                                <path d="M16 10h4a2 2 0 0 1 0 4h-4l-4 7h-3l2 -7h-4l-2 2h-3l2 -4l-2 -4h3l2 2h4l-2 -7h3z"></path>
                                            </svg>
                                        
                                            {{ $schedule->arrival }}
                                        </h6>
                                        <p class="text-xs mt-2 text-gray-500">
                                            Please book this flight only if you intend to fly it within the next 2 hours. If you book this flight other pilots won't be able to see
                                            this particular schedule in their search. You're only allowed to book 'one' flight at a time. If you do not fly this route within 2 hours
                                            of booking this flight, it will be automatically deleted from your bookings.
                                        </p>
                                        <p class="text-xs mt-2 text-gray-500">
                                            Now, here below are the listed aircraft which are available at the airport and suits for this route. The aircraft assigned to this route is
                                            <span class="text-black">{{ $schedule->aircraft_icao }}</span>. Please select any one. During <span class="text-black">Real Operations</span>, try to fly the aircraft back to avoid disruption.
                                        </p>
                                    </div>
                                </div>
                                <div class="w-full lg:w-2/5 mt-8 lg:mt-0">
                                    <div class="rounded-3xl bg-white shadow-lg p-6">
                                        <h5 class="text-gray-700 leading-3 font-medium inline-flex items-center">

                                            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-plane inline-block w-5 mr-3" viewBox="0 0 24 24" stroke-width="1.5" stroke="#2c3e50" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                                <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                                <path d="M16 10h4a2 2 0 0 1 0 4h-4l-4 7h-3l2 -7h-4l-2 2h-3l2 -4l-2 -4h3l2 2h4l-2 -7h3z"></path>
                                            </svg>

                                            {{ $schedule->airline_icao . $schedule->flightnum }} 
                                            
                                            // 
                                            
                                            {{ $schedule->departure }} >

                                            {{ $schedule->arrival }}
                                        </h5>
                                        <span class="flex text-gray-500 text-xs">raw flight route which is to be flown, as shown below</span>

                                        <div class="mt-6 rounded-xl rounded-br-none z-10" id="mapid" style="height: 520px;"></div>
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
        var map = L.map('mapid');

        L.tileLayer('https://{s}.basemaps.cartocdn.com/light_nolabels/{z}/{x}/{y}{r}.png', {
            attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> Contributors &copy; <a href="https://carto.com/attributions">CARTO</a>'
        }).addTo(map);

        var latlngs = [
            [{{ $departure->lat }}, {{ $departure->lng }}],
            [{{ $arrival->lat }}, {{ $arrival->lng }}]
        ];

        var polyline = L.polyline(latlngs, {color: 'gray', weight: 1}).addTo(map);
        map.fitBounds(polyline.getBounds(), {maxZoom: 4});

        L.marker([{{ $departure->lat }}, {{ $departure->lng }}]).addTo(map).bindPopup('{{ $departure->airport_name }}');
        L.marker([{{ $arrival->lat }}, {{ $arrival->lng }}]).addTo(map).bindPopup('{{ $arrival->airport_name }}');
    </script>

@endsection
