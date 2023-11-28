function initMap(mapId) {
	const $map = $('#' + mapId);
	const $lat = $(`input[name="${$map.attr('data-lat')}"]`);
	const $lng = $(`input[name="${$map.attr('data-lng')}"]`);
	let myLatlng = {lat: 10.795265, lng: 106.709382};
	if($lat.val() && $lng.val()){
		myLatlng = {
			lat: parseFloat($lat.val()),
			lng: parseFloat($lng.val())
		};
	}
	let map = new google.maps.Map(document.getElementById(mapId), {zoom: 10, center: myLatlng});
	let infoWindow = new google.maps.InfoWindow({content: 'Click the map to get Lat/Lng!', position: myLatlng});
	if($lat.val() && $lng.val()){
		infoWindow.setContent(`(${myLatlng.lat}, ${myLatlng.lng})`);
	}
	infoWindow.open(map);

	map.addListener('click', function(mapsMouseEvent) {
		infoWindow.close();
		infoWindow = new google.maps.InfoWindow({position: mapsMouseEvent.latLng});
		infoWindow.setContent(mapsMouseEvent.latLng.toString());
		infoWindow.open(map);
		$lat.val(mapsMouseEvent.latLng.lat());
		$lng.val(mapsMouseEvent.latLng.lng());
	});
}
(function ($) {
	if(window['LOCATION_DISTRICT']){
		const $province = $('#city_id');
		const $district = $('#district_id');
		$province.change(function(){
			let province_id = $(this).val();
			$.get(window['LOCATION_DISTRICT'].replace('PROVINCE_ID', province_id)).then(({data}) => {
				data = data.map(p => ({id: p.id, text: p.full_name}));
				data.unshift({id: 0, text: 'Chọn quận/huyện'});
				$district.select2('destroy');
				$district.empty();
				$district.select2({
					placeholder: 'Chọn quận/huyện',
					allowClear: true,
					data: data
				});
				window['selected_district_id'] && $district.val(window['selected_district_id']);
				$district.trigger('change');
			});
		}).trigger('change');
	}
	$('.gmaps-body').each(function () {
		initMap($(this).attr('id'));
	})
})(jQuery);
