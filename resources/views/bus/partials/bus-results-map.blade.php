<!-- Map Container -->
<div class="map-container">
    <div class="map-header mb-3">
        <div class="d-flex justify-content-between align-items-center">
            <div>
                <h6 class="mb-0 fw-bold">Route Map</h6>
                <p class="text-muted small mb-0">View your journey on the map</p>
            </div>
            <div class="map-controls">
                <button class="btn btn-sm btn-light" id="zoomIn">
                    <i class="bi bi-plus-lg"></i>
                </button>
                <button class="btn btn-sm btn-light" id="zoomOut">
                    <i class="bi bi-dash-lg"></i>
                </button>
                <button class="btn btn-sm btn-light" id="centerMap">
                    <i class="bi bi-geo-alt"></i>
                </button>
            </div>
        </div>
    </div>
    <div id="map" class="results-map"></div>
    <div class="map-info mt-3">
        <div class="route-info">
            <div class="route-point">
                <div class="point-icon start">
                    <i class="bi bi-circle-fill"></i>
                </div>
                <div class="point-details">
                    <span class="point-label">From</span>
                    <span class="point-name">{{ request('origin') }}</span>
                </div>
            </div>
            <div class="route-line"></div>
            <div class="route-point">
                <div class="point-icon end">
                    <i class="bi bi-circle-fill"></i>
                </div>
                <div class="point-details">
                    <span class="point-label">To</span>
                    <span class="point-name">{{ request('destination') }}</span>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://maps.google.com/maps/api/js?key=AIzaSyA9auUDXrbwFvKP5UIpRmSoH7c5GEqAauc" type="text/javascript"></script>

<style>
.map-container {
    background: #fff;
    border-radius: 12px;
    box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05);
    overflow: hidden;
}

.map-header {
    padding: 1.25rem;
    border-bottom: 1px solid #e9ecef;
}

.map-controls {
    display: flex;
    gap: 0.5rem;
}

.map-controls .btn {
    width: 32px;
    height: 32px;
    padding: 0;
    display: flex;
    align-items: center;
    justify-content: center;
    border-radius: 8px;
    background: #f8f9fa;
    border: 1px solid #e9ecef;
    transition: all 0.3s ease;
}

.map-controls .btn:hover {
    background: #e9ecef;
    transform: translateY(-1px);
}

.results-map {
    height: calc(100vh - 350px);
    border-radius: 8px;
    overflow: hidden;
}

.map-info {
    padding: 1.25rem;
    border-top: 1px solid #e9ecef;
}

.route-info {
    display: flex;
    align-items: center;
    gap: 1rem;
}

.route-point {
    display: flex;
    align-items: center;
    gap: 0.75rem;
    flex: 1;
}

.point-icon {
    width: 24px;
    height: 24px;
    display: flex;
    align-items: center;
    justify-content: center;
}

.point-icon.start {
    color: #198754;
}

.point-icon.end {
    color: #dc3545;
}

.point-details {
    display: flex;
    flex-direction: column;
}

.point-label {
    font-size: 0.75rem;
    color: #6c757d;
}

.point-name {
    font-size: 0.875rem;
    font-weight: 500;
    color: #212529;
}

.route-line {
    flex: 1;
    height: 2px;
    background: linear-gradient(90deg, #198754, #dc3545);
    position: relative;
}

.route-line::before {
    content: '';
    position: absolute;
    top: 50%;
    left: 0;
    width: 8px;
    height: 8px;
    background: #198754;
    border-radius: 50%;
    transform: translate(-50%, -50%);
}

.route-line::after {
    content: '';
    position: absolute;
    top: 50%;
    right: 0;
    width: 8px;
    height: 8px;
    background: #dc3545;
    border-radius: 50%;
    transform: translate(50%, -50%);
}
</style>

    <script>
        // Define the custom map style
        const mapStyle = [
            {
        "featureType": "all",
                "elementType": "geometry",
                "stylers": [{ "color": "#f5f5f5" }]
            },
    {
        "featureType": "water",
        "elementType": "geometry",
        "stylers": [{ "color": "#e9e9e9" }]
    },
    {
        "featureType": "water",
        "elementType": "labels.text.fill",
        "stylers": [{ "color": "#9e9e9e" }]
    },
            {
                "featureType": "road",
                "elementType": "geometry",
                "stylers": [{ "color": "#ffffff" }]
            },
            {
        "featureType": "road.arterial",
        "elementType": "labels.text.fill",
        "stylers": [{ "color": "#757575" }]
    },
    {
        "featureType": "road.highway",
                "elementType": "geometry",
        "stylers": [{ "color": "#dadada" }]
    },
    {
        "featureType": "road.highway",
        "elementType": "labels.text.fill",
        "stylers": [{ "color": "#616161" }]
            },
            {
                "featureType": "poi",
                "elementType": "geometry",
                "stylers": [{ "color": "#eeeeee" }]
            },
            {
        "featureType": "poi",
        "elementType": "labels.text.fill",
        "stylers": [{ "color": "#757575" }]
            },
            {
        "featureType": "transit.line",
                "elementType": "geometry",
        "stylers": [{ "color": "#e5e5e5" }]
            },
            {
        "featureType": "transit.station",
                "elementType": "geometry",
        "stylers": [{ "color": "#eeeeee" }]
            }
        ];

        // Extract latitude and longitude from Blade variables
        const originLat = @json($originLat);
        const originLng = @json($originLng);
        const destinationLat = @json($destinationLat);
        const destinationLng = @json($destinationLng);

// Initialize the map
const map = new google.maps.Map(document.getElementById("map"), {
    styles: mapStyle,
    zoom: 5,
    mapTypeControl: false,
    streetViewControl: false,
    fullscreenControl: false
});

// Define locations
        const origin = { lat: parseFloat(originLat), lng: parseFloat(originLng) };
        const destination = { lat: parseFloat(destinationLat), lng: parseFloat(destinationLng) };

// Custom marker icons
const startIcon = {
    path: google.maps.SymbolPath.CIRCLE,
    fillColor: '#198754',
    fillOpacity: 1,
    scale: 8,
    strokeColor: '#ffffff',
    strokeWeight: 2
};

const endIcon = {
            path: google.maps.SymbolPath.CIRCLE,
    fillColor: '#dc3545',
            fillOpacity: 1,
    scale: 8,
    strokeColor: '#ffffff',
    strokeWeight: 2
        };

// Create markers
        const markerOrigin = new google.maps.Marker({
            position: origin,
            map: map,
            title: "Origin",
    icon: startIcon,
    animation: google.maps.Animation.DROP
        });

        const markerDestination = new google.maps.Marker({
            position: destination,
            map: map,
            title: "Destination",
    icon: endIcon,
    animation: google.maps.Animation.DROP
        });

// Create the polyline
        const polyline = new google.maps.Polyline({
    path: [origin, destination],
            geodesic: true,
    strokeColor: '#0d6efd',
    strokeOpacity: 0.8,
    strokeWeight: 3,
    icons: [{
        icon: {
            path: google.maps.SymbolPath.FORWARD_CLOSED_ARROW,
            scale: 3,
            strokeColor: '#0d6efd'
        },
        offset: '50%'
    }]
});

        polyline.setMap(map);

// Fit bounds
        const bounds = new google.maps.LatLngBounds();
        bounds.extend(origin);
        bounds.extend(destination);
map.fitBounds(bounds);

// Add padding to bounds
const padding = 50;
const ne = bounds.getNorthEast();
const sw = bounds.getSouthWest();
const neLat = ne.lat() + (ne.lat() - sw.lat()) * padding / 100;
const neLng = ne.lng() + (ne.lng() - sw.lng()) * padding / 100;
const swLat = sw.lat() - (ne.lat() - sw.lat()) * padding / 100;
const swLng = sw.lng() - (ne.lng() - sw.lng()) * padding / 100;
bounds.extend(new google.maps.LatLng(neLat, neLng));
bounds.extend(new google.maps.LatLng(swLat, swLng));
map.fitBounds(bounds);

// Map controls
document.getElementById('zoomIn').addEventListener('click', () => {
    map.setZoom(map.getZoom() + 1);
});

document.getElementById('zoomOut').addEventListener('click', () => {
    map.setZoom(map.getZoom() - 1);
});

document.getElementById('centerMap').addEventListener('click', () => {
        map.fitBounds(bounds);
});

// Add info windows
const originInfo = new google.maps.InfoWindow({
    content: `<div class="p-2">
        <strong>${@json(request('origin'))}</strong>
        <div class="text-muted small">Starting Point</div>
    </div>`
});

const destinationInfo = new google.maps.InfoWindow({
    content: `<div class="p-2">
        <strong>${@json(request('destination'))}</strong>
        <div class="text-muted small">Destination</div>
    </div>`
});

markerOrigin.addListener('click', () => {
    originInfo.open(map, markerOrigin);
});

markerDestination.addListener('click', () => {
    destinationInfo.open(map, markerDestination);
});
    </script>

