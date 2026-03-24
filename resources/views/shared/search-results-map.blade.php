<script src="https://maps.google.com/maps/api/js?key=AIzaSyA9auUDXrbwFvKP5UIpRmSoH7c5GEqAauc" type="text/javascript"></script>
{{--  <div id="map" class="col-lg-4 col-xl-4">  --}}
    <!-- Responsive offcanvas body START -->
    <div class="offcanvas-lg offcanvas-end" tabindex="-1" id="offcanvasSidebar">
        <!-- Offcanvas header -->
        <div class="offcanvas-header justify-content-end pb-2">
            <button type="button" class="btn-close" data-bs-dismiss="offcanvas" data-bs-target="#offcanvasSidebar"
                aria-label="Close"></button>
        </div>
        <!-- Offcanvas body -->
        <div class="offcanvas-body p-3 p-lg-0">
            <div class="card bg-light w-100">
            </div>
        </div>
    </div>


<script>
    // Define the custom map style
    const mapStyle = [
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
    ];

    // Set up the Google Maps API
    const mapOptions = {
        styles: mapStyle // Apply the custom style
    };
    const map = new google.maps.Map(document.getElementById("map"), mapOptions);

    // Define locations for Lusaka and Kitwe
    const lusaka = { lat: 28.2773, lng: 15.4155 };
    const kitwe = { lat: 12.8232, lng: 28.2176 };

    // Custom blue circle marker icon
    const blueCircleIcon = {
        path: google.maps.SymbolPath.CIRCLE,
        fillColor: '#5e90cc',
        fillOpacity: 1,
        scale: 6,
        strokeColor: '#5e90cc',
        strokeWeight: 1
    };

    // Custom blue dot icon for Kitwe
    const blueIcon = "http://maps.google.com/mapfiles/ms/icons/blue-dot.png";

    // Create markers for Lusaka and Kitwe
    const markerLusaka = new google.maps.Marker({
        position: lusaka,
        map: map,
        title: "Lusaka",
        icon: blueCircleIcon // Blue circle marker for Lusaka
    });

    const markerKitwe = new google.maps.Marker({
        position: kitwe,
        map: map,
        title: "Kitwe",
        icon: blueIcon // Blue dot icon for Kitwe
    });

    // Define the path for the polyline
    const pathCoordinates = [lusaka, kitwe];

    // Create the polyline with light blue color
    const polyline = new google.maps.Polyline({
        path: pathCoordinates,
        geodesic: true,
        strokeColor: "#5e90cc", // Light blue color
        strokeOpacity: 1.0,
        strokeWeight: 4, // Increased thickness
    });

    // Add the polyline to the map
    polyline.setMap(map);

    // Create a LatLngBounds object
    const bounds = new google.maps.LatLngBounds();

    // Extend the bounds to include the locations of Lusaka and Kitwe
    bounds.extend(lusaka);
    bounds.extend(kitwe);

    // Fit the map to the bounds
    map.fitBounds(bounds);
</script>
