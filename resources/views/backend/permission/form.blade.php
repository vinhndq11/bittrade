@extends('backend.layout.master')

@section('title', 'Thêm/Sửa quyền người dùng')

@section('css')
@endsection

@section('js')
@endsection

@component('backend.layout.component.form', compact('viewFolder', 'mainData'))
    <div class="row">
        <div class="col-xs-12">
            @include('backend.layout.component.input_no_translation',[
                'form_fields'=>[
                    ['type'=>FORM_TYPE_TEXT, 'name' => 'name' ,'disabled' => true],
                    ['type'=>FORM_TYPE_TEXT, 'name' => 'display_name'],
                    ['type'=>FORM_TYPE_TEXT, 'name' => 'description']
                ]
            ])
        </div>
    </div>
@endcomponent
