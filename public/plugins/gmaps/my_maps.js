var marker;
var map;
var infowindow;
var directionsDisplay = new google.maps.DirectionsRenderer;
var current_location = {lat: 10.7798583, lng: 106.6682017};
function initMap() {
    map = new google.maps.Map(document.getElementById('map'), {
        zoom: 16,
        center: current_location
    });
    marker = new google.maps.Marker({
        map: map,
        position: current_location,
        title: 'C6903',
        draggable: false,
        icon: 'img/marker_green.png',
        details: {
            database_id: 42,
            author: 'Hadesker',
        }
    });
    infowindow = new google.maps.InfoWindow({
        content: '<b style="text-align:center">C6903</b>'
    });
    directionsDisplay.setMap(map);

    marker.addListener('click', function() {
        infowindow.open(map, marker);
    });
    marker.addListener('dblclick', function() {
        animateToMap();
    });
    marker.addListener('rightclick', function() {
        alert(1);
    });
}

function animateToMap() {
    let latlng = new google.maps.LatLng(current_location.lat,current_location.lng);
    marker.animateTo(latlng,{  easing: "linear",
        duration: 1000,
        complete: function() {
            map.panTo(latlng);
        }
    });
}

function changeMarkerPosition(lat,lng) {
    current_location.lat = lat;
    current_location.lng = lng;
    animateToMap();
    infowindow.open(map, marker);
}
$(function() {
    initMap();
});