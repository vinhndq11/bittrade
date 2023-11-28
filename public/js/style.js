$(function () {
	const $listCode = $('.list-code');
	$listCode.on('click', '.btn-remove', function (){
		$(this).closest('.input-group').fadeOut().remove();
	}).on('click', '.btn-add', function (){
		const $item = $(this).closest('.input-group').clone();
		$item.find('input').val('');
		$listCode.append($item);
	});

	const $city = $('#city_id');
	const $district = $('#district_id');
	const $ward = $('#ward_id');
	$city.on('change', function () {
		let city_id = $(this).find('option:selected').val();
		$.get(window.GET_DISTRICT_API.replace('CITY_ID', city_id)).then(({ success, data })=>{
			if(success){
				$district.html('');
				data.forEach(item => {
					$district.append($("<option />").val(item.id).text(item['full_name']));
				});
				$district.trigger('change');
			}
		});
	}).trigger('change');
	$district.on('change', function (){
		let district_id = $(this).find('option:selected').val();
		$.get(window.GET_WARD_API.replace('DISTRICT_ID', district_id)).then(({ success, data })=>{
			if(success){
				$ward.html('');
				data.forEach(item => {
					$ward.append($("<option />").val(item.id).text(item['full_name']));
				});
			}
		});
	});
});
