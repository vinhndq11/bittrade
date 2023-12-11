<script type="application/javascript" src="js/jquery.min.js"></script>
<script src="vendor/jquery-ui/jquery-ui.min.js"></script>
<script src="{{ assetVersion('js/jquery.extend.js') }}"></script>
<script>
    $.widget.bridge('uibutton', $.ui.button);
</script>
<script src="vendor/bootstrap/dist/js/bootstrap.min.js"></script>
<script src="vendor/raphael/raphael.min.js"></script>
<script src="vendor/morris.js/morris.min.js"></script>
<script src="vendor/jquery-knob/dist/jquery.knob.min.js"></script>
<!-- daterangepicker -->
<script src="vendor/moment/min/moment.min.js"></script>

<script src="vendor/bootstrap-colorpicker/dist/js/bootstrap-colorpicker.min.js"></script>

<!-- ckfinder -->
<script src="plugins/ckfinder/ckfinder.js?v=1521165460"></script>
<script type="text/javascript" src="vendor/ckeditor/ckeditor.js?v=1.0"></script>

<script src="vendor/bootstrap-datetimepicker/js/bootstrap-datetimepicker.min.js"></script>

<script src="vendor/bootstrap-daterangepicker/daterangepicker.js"></script>
<!-- datepicker -->
<script src="vendor/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script>
<!-- Slimscroll -->
<script src="vendor/jquery-slimscroll/jquery.slimscroll.min.js"></script>
<!-- FastClick -->
<script src="vendor/fastclick/lib/fastclick.js"></script>
<!-- AdminLTE App -->
<script src="dist/js/adminlte.min.js"></script>
<script src="plugins/mymenu/menu.js"></script>

<script src="plugins/datatables/jquery.dataTables.min.js"></script>
<script src="plugins/datatables/dataTables.bootstrap.min.js"></script>
<script src="plugins/iCheck/icheck.min.js"></script>

<script src="js/autoNumeric-1.8.3.js"></script>

<script type="application/javascript" src="plugins/price-format/jquery.priceformat.min.js"></script>

<!-- Bootstrap notify -->
<script src="plugins/bootstrap-notify/notify.min.js"></script>
<script>
    function Notify(title, message, className) {
		$.notify(message, {
			allow_dismiss: true,
			type: 'success'
		});
	}
</script>

<script src="vendor/bootstrap-timepicker/js/bootstrap-timepicker.js"></script>
<script src="vendor/select2/dist/js/select2.full.min.js"></script>
<script>
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': '{{csrf_token()}}'
        }
    });
</script>
<script src="{{ setting('socket_link') . '/socket.io/socket.io.js' }}"></script>
<script>
    window.socket_link = '{{ setting('socket_link') }}';
    window.session_id = '{{ getCurrentSessionId() }}';
    window.icon = '{{ assetResource('images/favicon.png') }}';
</script>
<script src="{{assetVersion('js/helpers.js')}}"></script>
<script src="{{assetVersion('dist/js/style.js')}}"></script>
<script src="{{assetVersion('js/style_function.js')}}"></script>
<script src="{{assetVersion('js/socket-notify.js')}}"></script>
<script>
    const language = 'vi';
    var defaultPath = '{{asset('img/default.png')}}';
    var config_switchery = {
        color: 'rgb(247, 228, 201)',
        secondaryColor: 'rgb(247, 228, 201)',
        size: 'small',
        jackColor: 'green',
        jackSecondaryColor: 'red'
    };
	window['LOCATION_DISTRICT'] = '{{ route('api.location.get_district', 'PROVINCE_ID') }}';
</script>

<script src="plugins/loading/loadingoverlay.min.js"></script>

<script src="plugins/jquery-confirm/jquery-confirm.min.js"></script>
<script type="text/javascript">
    @if(session()->has('flash'))
    jQuery(function(){
        $.confirm({
            icon: 'fa fa-warning',
            title: 'Thông báo',
            content: '{!! session('flash')  !!}',
            type: 'blue',
            theme: 'light',
            typeAnimated: true,
            buttons: {
                close: {
                    text: 'Đóng'
                }
            }
        });
    });
    @endif
</script>
