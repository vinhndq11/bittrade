<div class="box box-{{$viewFolder}}">
    {{ Form()::open(['url' => isset($mainData) ? route("admin.$viewFolder.show", $mainData->id) : route("admin.$viewFolder.store"), 'method' => isset($mainData) ? 'PUT' : 'POST', 'enctype'=>'multipart/form-data', 'spellcheck'=>'false']) }}
    <div class="box-header with-border">
        <div class="row">
            <div class="col-md-12">
                @if(!isset($mainData))
                    <button class="btn btn-primary" name="save" value="{{route("admin.$viewFolder.create")}}" type="submit"><i class="fa fa-plus"></i> Lưu</button>
                @else
                    <button class="btn btn-primary" name="save" value="{{route("admin.$viewFolder.index")}}" type="submit"><i class="fa fa-check"></i> Lưu </button>
                @endif
                <a class="btn btn-danger" href="{{route("admin.$viewFolder.index")}}"><i class="fa fa-close"></i> Trở về danh sách</a>
            </div>
        </div>
    </div>
    <div class="box-body">
        <div class="row">
            <div class="col-sm-{{ isset($isProfile) ? '12' : '8' }} col-xs-12">
                @include('backend.layout.component.input_no_translation',[
                    'form_fields'=>[
                        ['type'=>FORM_TYPE_HIDDEN, 'name' => 'is_profile', 'default_value' => !!isset($isProfile)],
                        ['type'=>FORM_TYPE_TEXT, 'name' => 'name', 'required'=>true],
                        ['type'=>FORM_TYPE_PASSWORD, 'name' => 'password'],
                        ['type'=>FORM_TYPE_EMAIL, 'name' => 'email', 'required'=>true],
                    ]
                ])
            </div>
            @if(!isset($isProfile))
            <div class="col-xs-12 col-sm-4 col-md-4 col-lg-4">
                @include('backend.layout.component.input_no_translation',[
                    'form_fields'=>[
                        ['type'=>FORM_TYPE_SELECT, 'name' => 'is_active', 'list'=> IS_ACTIVE_DEFAULT, 'block' => isset($isProfile)],
                    ]
                ])
            </div>
            @endif
        </div>
    </div>
    {{ Form()::close() }}
</div>
