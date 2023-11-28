var markerList = {};
const center = { lat: 10.773578, lng: 106.700961 };
var map = null, bounds = null;
const iconNormal = 'common/images/ping.png';
const iconSelected = 'common/images/ping2.png';

function setMarkers() {
	bounds = new google.maps.LatLngBounds();
	Object.values(markerList).forEach(function (value) {
		value.setMap(null);
	})
	markerList = {};
	$('.list_store>li').each(function (index) {
		let lat = parseFloat($(this).find('.lat').text());
		let lng = parseFloat($(this).find('.lng').text());
		let id = 'marker_' + $(this).find('.id').text();
		let myLatLng = new google.maps.LatLng(lat, lng);
		bounds.extend(myLatLng);
		markerList[id] = new google.maps.Marker({
			record_id: index,
			position: myLatLng,
			map: map,
			animation: google.maps.Animation.DROP,
			icon: iconNormal,
			title: $(this).find('.store-name').text()
		});
	});
	map.fitBounds(bounds);
}

$('.list_store').on('click', 'li', function () {
	let lat = parseFloat($(this).find('.lat').text());
	let lng = parseFloat($(this).find('.lng').text());
	Object.values(markerList).forEach(function (value) {
		value.setIcon(iconNormal);
	})
	let id = 'marker_' + $(this).find('.id').text();
	markerList[id].setIcon(iconSelected);
	map.panTo({ lat, lng });
});

function initialize() {
	map = new google.maps.Map(document.getElementById('map'), {
		zoom: 6,
		center: new google.maps.LatLng(10.7, 106.7),
		mapTypeId: google.maps.MapTypeId.ROADMAP
	});
	setMarkers();
}
google.maps.event.addDomListener(window, 'load', initialize);
