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
                            Please book this flight only if you intend to depart within the next 2 hours. If you book this flight other pilots won't be able to see
                            this particular schedule in their search. You're only allowed to book 'one' flight at a time. If you do not fly this route within 2 hours
                            of booking this flight, it will be automatically deleted from your bookings.
                        </p>
                        <p class="text-xs mt-2 text-gray-400">
                            Now, here below are the listed aircraft which are available at the airport and suits for this route. The aircraft assigned to this route is
                            <span class="text-white">{{ $schedule->aircraft_icao }}</span>. Please select any one. During <span class="text-white">Real Operations</span>, try to fly the aircraft back to avoid disruption.
                        </p>

                        @if ($aircraft != '[]')
                        <form action="{{ route('cfcdc.flight.confirm', ['id' => $schedule->id]) }}" method="post">

                            @csrf

                            <div class="lg:flex mt-6 gap-2">
                                <div class="lg:w-full mb-2 lg:mb-0">
                                    <x-forms.label :for="__('available aircraft')">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-arrow-down-right inline-block w-4 mr-2" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                            <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                            <line x1="7" y1="7" x2="17" y2="17"></line>
                                            <polyline points="17 8 17 17 8 17"></polyline>
                                        </svg>
                                    </x-forms.label>
                                    <div class="custom-select">
                                        <select name="aircraft" class="transition duration-150 focus:ring-blue-500">
                                            <option hidden>[select aircraft]</option>

                                            @foreach ($aircraft as $aircraft)
                                            <option value="{{ $aircraft->id }}">{{ $aircraft->icao }} [{{ $aircraft->registration }}]</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="mt-6 flex justify-end">
                                <div class="lg:mt-0 mt-3 w-full lg:w-auto">
                                    <x-buttons.primary type="submit">
                                        book flight
                                        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-circle-plus inline-block w-5 ml-2" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                            <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                            <circle cx="12" cy="12" r="9"></circle>
                                            <line x1="9" y1="12" x2="15" y2="12"></line>
                                            <line x1="12" y1="9" x2="12" y2="15"></line>
                                        </svg>
                                    </x-buttons.primary>
                                </div>
                            </div>
                        </form>
                        @endif
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

                        <div class="mt-6 rounded-xl z-10 shadow-xl" id="map" style="height: 520px;"></div>
                    </x-card>
                </div>
            </div>
        </div>
    </div>

    <script src='https://unpkg.com/@turf/turf@6/turf.min.js'></script>

    <script>
        mapboxgl.accessToken = `{{ config('services.mapbox.access_token') }}`;
        const map = new mapboxgl.Map({
            container: 'map',
            style: 'mapbox://styles/hiaaryan/ckwatwod05wdw14mvtj34e8nk',
            center: [40.86, 34.56],
            zoom: 0.5,
            attributionControl: false
        });

        // const popup = new mapboxgl.Popup({ closeOnClick: false, offset: 10, maxWidth: '400px', closeButton: false })
        //     .setLngLat([`{{ $departure->lng }}`, `{{ $departure->lat }}`])
        //     .setHTML(`
        //         <div class="flex items-center">
        //             <h1 class="font-bold mr-1.5">{{ $departure->icao }}</h1>
        //             <p>[{{ $departure->airport_name }}]</p>
        //         </div>
        //     `)
        //     .addTo(map);

        // const popup2 = new mapboxgl.Popup({ closeOnClick: false, offset: 10, maxWidth: '400px', closeButton: false })
        //     .setLngLat([`{{ $arrival->lng }}`, `{{ $arrival->lat }}`])
        //     .setHTML(`
        //         <div class="flex items-center">
        //             <h1 class="font-bold mr-1.5">{{ $arrival->icao }}</h1>
        //             <p>[{{ $arrival->airport_name }}]</p>
        //         </div>
        //     `)
        //     .addTo(map);

        // Departure Airport
        const origin = [`{{ $departure->lng }}`, `{{ $departure->lat }}`];

        // Arrival Airport
        const destination = [`{{ $arrival->lng }}`, `{{ $arrival->lat }}`];

        // A simple line from origin to destination.
        const route = {
            'type': 'FeatureCollection',
            'features': [{
                'type': 'Feature',
                'geometry': {
                    'type': 'LineString',
                    'coordinates': [origin, destination]
                }
            }]
        };

        // A single point that animates along the route.
        // Coordinates are initially set to origin.
        const point = {
            'type': 'FeatureCollection',
            'features': [{
                'type': 'Feature',
                'properties': {},
                'geometry': {
                    'type': 'Point',
                    'coordinates': origin
                }
            }]
        };

        // Calculate the distance in kilometers between route start/end point.
        const lineDistance = turf.length(route.features[0]);

        const arc = [];

        // Number of steps to use in the arc and animation, more steps means
        // a smoother arc and animation, but too many steps will result in a
        // low frame rate
        const steps = 500;

        // Draw an arc between the `origin` & `destination` of the two points
        for (let i = 0; i < lineDistance; i += lineDistance / steps) {
            const segment = turf.along(route.features[0], i);
            arc.push(segment.geometry.coordinates);
        }

        // Update the route with calculated arc coordinates
        route.features[0].geometry.coordinates = arc;

        // Used to increment the value of the point measurement against the route.
        let counter = 0;

        map.on('load', () => {
            // Add a source and layer displaying a point which will be animated in a circle.
            map.addSource('route', {
                'type': 'geojson',
                'data': route
            });

            map.addSource('point', {
                'type': 'geojson',
                'data': point
            });

            map.addLayer({
                'id': 'route',
                'source': 'route',
                'type': 'line',
                'paint': {
                    'line-width': 1.5,
                    'line-color': '#ffffff'
                }
            });

            map.addLayer({
                'id': 'point',
                'source': 'point',
                'type': 'symbol',
                'layout': {
                    // This icon is a part of the Mapbox Streets style.
                    // To view all images available in a Mapbox style, open
                    // the style in Mapbox Studio and click the "Images" tab.
                    // To add a new image to the style at runtime see
                    // https://docs.mapbox.com/mapbox-gl-js/example/add-image/
                    'icon-image': 'airport',
                    'icon-rotate': ['get', 'bearing'],
                    'icon-rotation-alignment': 'map',
                    'icon-allow-overlap': true,
                    'icon-ignore-placement': true
                }
            });

            // Load an image from an external URL.
            map.loadImage(
                `{{ asset('img/mapbox/circle.png') }}`,
                (error, image) => {
                    if (error) throw error;

                    // Add the image to the map style.
                    map.addImage('circle', image);

                    // Add a data source containing one point feature.
                    map.addSource('points', {
                        'type': 'geojson',
                        'data': {
                            'type': 'FeatureCollection',
                            'features': [
                                {
                                    'type': 'Feature',
                                    'properties': {
                                        'description': `
                                            <div class="flex items-center">
                                                <h1 class="font-bold mr-1.5">{{ $departure->icao }}</h1>
                                                <p>[{{ $departure->airport_name }}]</p>
                                            </div>
                                        `,
                                    },
                                    'geometry': {
                                        'type': 'Point',
                                        'coordinates': [`{{ $departure->lng }}`, `{{ $departure->lat }}`]
                                    },
                                },
                                {
                                    'type': 'Feature',
                                    'properties': {
                                        'description': `
                                            <div class="flex items-center">
                                                <h1 class="font-bold mr-1.5">{{ $arrival->icao }}</h1>
                                                <p>[{{ $arrival->airport_name }}]</p>
                                            </div>
                                        `,
                                    },
                                    'geometry': {
                                        'type': 'Point',
                                        'coordinates': [`{{ $arrival->lng }}`, `{{ $arrival->lat }}`]
                                    }
                                }
                            ]
                        }
                    });

                    // Add a layer to use the image to represent the data.
                    map.addLayer({
                        'id': 'points',
                        'type': 'symbol',
                        'source': 'points', // reference the data source
                        'layout': {
                            'icon-image': 'circle', // reference the image
                            'icon-size': 0.3
                        }
                    });
                }
            );

            map.on('click', 'points', (e) => {
                // Copy coordinates array.
                const coordinates = e.features[0].geometry.coordinates.slice();
                const description = e.features[0].properties.description;
                
                // Ensure that if the map is zoomed out such that multiple
                // copies of the feature are visible, the popup appears
                // over the copy being pointed to.
                while (Math.abs(e.lngLat.lng - coordinates[0]) > 180) {
                    coordinates[0] += e.lngLat.lng > coordinates[0] ? 360 : -360;
                }
                
                new mapboxgl.Popup({ closeOnClick: true, offset: 10, maxWidth: '400px', closeButton: false })
                    .setLngLat(coordinates)
                    .setHTML(description)
                    .addTo(map);
            });

            // Geographic coordinates of the LineString
            const coordinates = route.features[0].geometry.coordinates;

            // Create a 'LngLatBounds' with both corners at the first coordinate.
            const bounds = new mapboxgl.LngLatBounds(
                coordinates[0],
                coordinates[0]
            );

            // Extend the 'LngLatBounds' to include every coordinate in the bounds result.
            for (const coord of coordinates) {
                bounds.extend(coord);
            }

            map.fitBounds(bounds, {
                padding: 80
            });

            function animate() {
                const start =
                    route.features[0].geometry.coordinates[
                        counter >= steps ? counter - 1 : counter
                    ];
                const end =
                    route.features[0].geometry.coordinates[
                        counter >= steps ? counter : counter + 1
                    ];

                if (!start || !end) {
                    counter = 0;
                    animate(counter);

                    return;
                };

                // Update point geometry to a new position based on counter denoting
                // the index to access the arc
                point.features[0].geometry.coordinates =
                    route.features[0].geometry.coordinates[counter];

                // Calculate the bearing to ensure the icon is rotated to match the route arc
                // The bearing is calculated between the current point and the next point, except
                // at the end of the arc, which uses the previous point and the current point
                point.features[0].properties.bearing = turf.bearing(
                    turf.point(start),
                    turf.point(end)
                );

                // Update the source with this new data
                map.getSource('point').setData(point);

                // Request the next frame of animation as long as the end has not been reached
                if (counter < steps) {
                    requestAnimationFrame(animate);
                }

                counter = counter + 1;
            }

            animate(counter);
        });
    </script>

    <script>
        var x, i, j, l, ll, selElmnt, a, b, c;
        /*look for any elements with the class "custom-select":*/
        x = document.getElementsByClassName("custom-select");
        l = x.length;
        for (i = 0; i < l; i++) {
            selElmnt = x[i].getElementsByTagName("select")[0];
            ll = selElmnt.length;
            /*for each element, create a new DIV that will act as the selected item:*/
            a = document.createElement("div");
            a.setAttribute("class", "select-selected");
            a.innerHTML = selElmnt.options[selElmnt.selectedIndex].innerHTML;
            x[i].appendChild(a);
            /*for each element, create a new DIV that will contain the option list:*/
            b = document.createElement("div");
            b.setAttribute("class", "select-items select-hide");
            for (j = 1; j < ll; j++) {
                /*for each option in the original select element,
                create a new DIV that will act as an option item:*/
                c = document.createElement("div");
                c.innerHTML = selElmnt.options[j].innerHTML;
                c.addEventListener("click", function(e) {
                    /*when an item is clicked, update the original select box,
                    and the selected item:*/
                    var y, i, k, s, h, sl, yl;
                    s = this.parentNode.parentNode.getElementsByTagName("select")[0];
                    sl = s.length;
                    h = this.parentNode.previousSibling;
                    for (i = 0; i < sl; i++) {
                        if (s.options[i].innerHTML == this.innerHTML) {
                            s.selectedIndex = i;
                            h.innerHTML = this.innerHTML;
                            y = this.parentNode.getElementsByClassName("same-as-selected");
                            yl = y.length;
                            for (k = 0; k < yl; k++) {
                                y[k].removeAttribute("class");
                            }
                            this.setAttribute("class", "same-as-selected");
                            break;
                        }
                    }
                    h.click();
                });
                b.appendChild(c);
            }
            x[i].appendChild(b);
            a.addEventListener("click", function(e) {
                /*when the select box is clicked, close any other select boxes,
                and open/close the current select box:*/
                e.stopPropagation();
                closeAllSelect(this);
                this.nextSibling.classList.toggle("select-hide");
                this.classList.toggle("select-arrow-active");
            });
        }

        function closeAllSelect(elmnt) {
            /*a function that will close all select boxes in the document,
            except the current select box:*/
            var x, y, i, xl, yl, arrNo = [];
            x = document.getElementsByClassName("select-items");
            y = document.getElementsByClassName("select-selected");
            xl = x.length;
            yl = y.length;
            for (i = 0; i < yl; i++) {
                if (elmnt == y[i]) {
                    arrNo.push(i)
                } else {
                    y[i].classList.remove("select-arrow-active");
                }
            }
            for (i = 0; i < xl; i++) {
                if (arrNo.indexOf(i)) {
                    x[i].classList.add("select-hide");
                }
            }
        }
        /*if the user clicks anywhere outside the select box,
        then close all select boxes:*/
        document.addEventListener("click", closeAllSelect);
    </script>

@endsection
