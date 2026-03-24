<script src="https://maps.google.com/maps/api/js?key=AIzaSyA9auUDXrbwFvKP5UIpRmSoH7c5GEqAauc" type="text/javascript"></script>
                    <script>
                        const origin = {
                            latitude: {{ $flightOffers['data']['offers'][0]['slices'][0]['segments'][0]['origin']['latitude'] ?? '51.0504' }},
                            longitude: {{ $flightOffers['data']['offers'][0]['slices'][0]['segments'][0]['origin']['longitude'] ?? '13.7373' }},
                            name: "{{ $flightOffers['data']['offers'][0]['slices'][0]['segments'][0]['origin']['city_name'] ?? 'Origin City' }}"
                        };

                        const destination = {
                            latitude: {{ $flightOffers['data']['offers'][0]['slices'][0]['segments'][0]['destination']['latitude'] ?? '52.5200' }},
                            longitude: {{ $flightOffers['data']['offers'][0]['slices'][0]['segments'][0]['destination']['longitude'] ?? '13.4050' }},
                            name: "{{ $flightOffers['data']['offers'][0]['slices'][0]['segments'][0]['destination']['city_name'] ?? 'Destination City' }}"
                        };

                        const mapOptions = {
                            center: { lat: (origin.latitude + destination.latitude) / 2, lng: (origin.longitude + destination.longitude) / 2 },
                            zoom: 6,
                            styles: [
                                {
                                    "featureType": "water",
                                    "elementType": "geometry",
                                    "stylers": [{ "color": "#e0f7fa" }]
                                },
                                {
                                    "featureType": "landscape",
                                    "elementType": "geometry",
                                    "stylers": [{ "color": "#f5f5f5" }]
                                },
                                {
                                    "featureType": "road",
                                    "elementType": "geometry",
                                    "stylers": [{ "color": "#ffffff" }]
                                },
                                {
                                    "featureType": "administrative",
                                    "elementType": "geometry",
                                    "stylers": [{ "color": "#b0bec5" }]
                                },
                                {
                                    "featureType": "poi",
                                    "elementType": "geometry",
                                    "stylers": [{ "color": "#eeeeee" }]
                                },
                                {
                                    "featureType": "transit",
                                    "elementType": "geometry",
                                    "stylers": [{ "color": "#eeeeee" }]
                                },
                                {
                                    "featureType": "administrative.country",
                                    "elementType": "geometry",
                                    "stylers": [
                                        { "visibility": "on" },
                                        { "weight": 1.5 }
                                    ]
                                },
                                {
                                    "featureType": "administrative.province",
                                    "elementType": "geometry",
                                    "stylers": [{ "visibility": "on" }]
                                },
                                {
                                    "featureType": "administrative.locality",
                                    "elementType": "geometry",
                                    "stylers": [{ "visibility": "on" }]
                                }
                            ]
                        };

                        const map = new google.maps.Map(document.getElementById("map"), mapOptions);

                        // Create markers
                        const originLatLng = new google.maps.LatLng(origin.latitude, origin.longitude);
                        const destinationLatLng = new google.maps.LatLng(destination.latitude, destination.longitude);

                        const originMarker = new google.maps.Marker({
                            position: originLatLng,
                            map: map,
                            title: origin.name,
                            icon: {
                                path: google.maps.SymbolPath.CIRCLE,
                                fillColor: '#faa102',
                                fillOpacity: 1,
                                scale: 10,
                                strokeColor: '#faa102',
                                strokeWeight: 1
                            }
                        });

                        const destinationMarker = new google.maps.Marker({
                            position: destinationLatLng,
                            map: map,
                            title: destination.name,
                            icon: {
                                path: google.maps.SymbolPath.CIRCLE,
                                fillColor: '#6587e3',
                                fillOpacity: 1,
                                scale: 6,
                                strokeColor: '#6587e3',
                                strokeWeight: 1
                            }
                        });

                        // Add info windows for markers
                        const originInfoWindow = new google.maps.InfoWindow({
                            content: `<div><strong>${origin.name}</strong><br>Coordinates: ${origin.latitude}, ${origin.longitude}</div>`
                        });

                        const destinationInfoWindow = new google.maps.InfoWindow({
                            content: `<div><strong>${destination.name}</strong><br>Coordinates: ${destination.latitude}, ${destination.longitude}</div>`
                        });

                        originMarker.addListener('click', function() {
                            originInfoWindow.open(map, originMarker);
                        });

                        destinationMarker.addListener('click', function() {
                            destinationInfoWindow.open(map, destinationMarker);
                        });

                        // Draw polyline between origin and destination
                        const pathCoordinates = [originLatLng, destinationLatLng];
                        const flightPath = new google.maps.Polyline({
                            path: pathCoordinates,
                            geodesic: true,
                            strokeColor: "#faa102",
                            strokeOpacity: 1.0,
                            strokeWeight: 4
                        });

                        flightPath.setMap(map);

                        // Fit map to markers
                        const bounds = new google.maps.LatLngBounds();
                        bounds.extend(originLatLng);
                        bounds.extend(destinationLatLng);
                        map.fitBounds(bounds);
                    </script>
