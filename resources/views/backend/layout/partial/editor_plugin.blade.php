<div class="hd-button-group">
    <a href="javascript:window.open('','_self').close();" class="hd-btn hd-button-cancel">{{ trans('backend.cancel') }}</a>
    <button class="hd-btn hd-button-save">{{ trans('backend.save') }}</button>
</div>

<link rel="stylesheet" href="{{ assetVersion('css/editor.css') }}">
<link rel="stylesheet" href="plugins/jquery-confirm/jquery-confirm.min.css">

<script type="application/javascript" src="js/jquery.min.js"></script>
<script src="plugins/jquery-confirm/jquery-confirm.min.js"></script>
<script>
	$.ajaxSetup({ headers: { 'X-CSRF-TOKEN': '{{csrf_token()}}' } });
</script>
<script src="plugins/loading/loadingoverlay.min.js"></script>
<script src="plugins/ckfinder/ckfinder.js?"></script>
<script src="{{ assetVersion('js/editor.js') }}"></script>
