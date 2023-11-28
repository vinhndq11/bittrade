<script src="js/jquery.min.js"></script>
<script>
	$.ajaxSetup({
		headers: {
			'X-CSRF-TOKEN': '{{csrf_token()}}'
		}
	});
</script>
<script src="{{ assetVersion('plugins/jquery-confirm/jquery-confirm.min.js') }}"></script>
@if(session()->has('flash'))
<script type="text/javascript">
	jQuery(function(){
		$.confirm({
			icon: 'fa fa-warning',
			title: '{{ trans('frontend.notification') }}',
			content: '{!! session('flash')  !!}',
			type: 'blue',
			theme: 'light',
			columnClass: 'small',
			typeAnimated: true,
			buttons: {
				close: {
					text: '{{ trans('frontend.close') }}'
				}
			}
		});
	});
</script>
@endif
<script>
    window.GET_DISTRICT_API = '{{ route('api.location.get_district', ['city_id' => 'CITY_ID']) }}';
    window.GET_WARD_API = '{{ route('api.location.get_ward', ['district_id' => 'DISTRICT_ID']) }}';
</script>
<script src="plugins/bootstrap-notify/notify.min.js"></script>
