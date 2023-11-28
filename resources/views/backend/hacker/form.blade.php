@extends('backend.layout.master')

@section('title', 'Thêm/Cập nhật khách (tool hack)')

@section('css')
@endsection

@section('js')
    <script>
        const $user_mode = $('#user_mode');
		$user_mode.change(loadUserMode);
        function loadUserMode() {
			let user_mode = $user_mode.val();
			const $trial_count = $('#trial_count').closest('.form-group');
			const $expired_tool_at = $('#expired_tool_at').closest('.form-group');
			$trial_count.show();
			$expired_tool_at.show();
			if(user_mode === '{{ USER_MODE_UNLIMITED }}'){
				$trial_count.hide();
				$expired_tool_at.hide();
            } else if(user_mode === '{{ USER_MODE_MEMBER }}'){
				$trial_count.hide();
            }
		}
		loadUserMode();
    </script>
@endsection

@component('backend.layout.component.form', compact('viewFolder', 'mainData'))
    <div class="row">
        <div class="col-xs-8">
            @include('backend.layout.component.input_no_translation',[
                'form_fields'=>[
                    ['type'=>FORM_TYPE_TEXT, 'name' => 'name', 'required' => true],
                    ['type'=>FORM_TYPE_EMAIL, 'name' => 'email', 'required' => true],
                    ['type'=>FORM_TYPE_PASSWORD, 'name' => 'password'],
                    ['type'=>FORM_TYPE_TEXT, 'name' => 'ip'],
                    ['type'=>FORM_TYPE_TEXT, 'name' => 'user_agent', 'disabled' => true],
                    ['type'=>FORM_TYPE_TEXTAREA, 'name' => 'note'],
                ]
            ])
        </div>
        <div class="col-xs-4">
            @include('backend.layout.component.input_no_translation',[
                    'form_fields'=>[
                        ['type'=>FORM_TYPE_SELECT, 'name' => 'user_mode', 'list'=> [USER_MODE_TRAIL => trans('member.user_modes.'.USER_MODE_TRAIL), USER_MODE_MEMBER => trans('member.user_modes.'.USER_MODE_MEMBER), USER_MODE_UNLIMITED => trans('member.user_modes.'.USER_MODE_UNLIMITED), ], 'default_value' => USER_MODE_TRAIL],
                        ['type'=>FORM_TYPE_NUMBER, 'name' => 'trial_count', 'default_value' => 0],
                        ['type'=>FORM_TYPE_DATETIME, 'name' => 'expired_tool_at', 'default_value' => now()->setTime(24,59,59)->addDays(7)],
                        ['type'=>FORM_TYPE_SELECT, 'name' => 'is_active', 'list'=> IS_ACTIVE_DEFAULT, 'default_value' => 1],
                        ['type'=>FORM_TYPE_SELECT, 'name' => 'allow_duplicate_ip', 'list'=> [1 => 'Cho phép', 0 => 'Không cho phép'], 'default_value' => 0],
                        ['type'=>FORM_TYPE_IMAGE, 'name' => 'avatar'],
                    ],
                ])
        </div>
    </div>
@endcomponent
