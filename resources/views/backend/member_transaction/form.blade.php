@extends('backend.layout.master')

@section('title', 'Thêm/Cập nhật sub-catalog')

@section('css')
@endsection

@section('js')
    <script>
        const $catalog = $('#catalog_id');
        const $code = $('#code');
		function checkCode(){
			let catalog_id = $catalog.val();
			let code = $code.val();
			$.get(`{{ route('admin.sub_catalog.code') }}?catalog_id=${catalog_id}&code=${code}`).then(({ success, data, message }) => {
				$code.closest('.form-group').find('.error-message').html(message);
				if(!success){
					$code.closest('.form-group').addClass('has-error prevent-submit');
				} else {
					$code.closest('.form-group').removeClass('has-error prevent-submit');
                }
			});
		}
		$catalog.change(checkCode);
		$code.change(function (){
            $(this).val($(this).val().toUpperCase());
			checkCode();
        });
    </script>
@endsection

@component('backend.layout.component.form', compact('viewFolder', 'mainData'))
    <div class="row">
        <div class="col-xs-12">
            @include('backend.layout.component.input_no_translation',[
                'form_fields'=>[
                    ['type'=>FORM_TYPE_SELECT, 'name' => 'catalog_id', 'list' => $catalogs, 'disabled' => isset($mainData)],
                    ['type'=>FORM_TYPE_TEXT, 'name' => 'code', 'disabled' => isset($mainData), 'required' => true, 'maxlength' => 1, 'class' => 'text-uppercase'],
                    ['type'=>FORM_TYPE_TEXT, 'name' => 'name', 'required' => true],
                    ['type'=>FORM_TYPE_TEXTAREA, 'name' => 'note', 'row_line' => 2],
                ]
            ])
        </div>
    </div>
@endcomponent
