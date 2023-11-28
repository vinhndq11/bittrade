@extends('backend.layout.master')

@section('title', 'Thêm/Sửa vai trò người dùng')

@section('css')
@endsection

@section('js')
@endsection

@component('backend.layout.component.form', compact('viewFolder', 'mainData'))
    <div class="row">
        <div class="col-xs-12">
            @include('backend.layout.component.input_no_translation',[
                'form_fields'=>[
                    ['type'=>FORM_TYPE_TEXT, 'name' => 'name', 'required' => true],
                    ['type'=>FORM_TYPE_TEXT, 'name' => 'display_name'],
                    ['type'=>FORM_TYPE_TEXT, 'name' => 'description']
                ]
            ])
        </div>
        <div class="col-xs-12">
            <table class="table table-bordered table-hover">
                <thead>
                    <tr>
                        <th style="text-align: center; vertical-align: middle;">#</th>
                        <th style="text-align: left; vertical-align: middle;">Tên quyền</th>
                        <th style="text-align: left; vertical-align: middle;">Tên hiển thị</th>
                        <th style="text-align: center; vertical-align: middle;">...</th>
                    </tr>
                </thead>
                <tbody>
                @foreach($permissions as $item)
                <tr>
                    <td style="text-align: center; vertical-align: middle;">{{ $item->id }}</td>
                    <td style="text-align: left; vertical-align: middle;">{{ $item->name }}</td>
                    <td style="text-align: left; vertical-align: middle;">{{ $item->display_name }}</td>
                    <td style="text-align: center; vertical-align: middle;">
                        <input type="checkbox" aria-label="" class="icheck" {{ in_array($item->id, $grantedPermissions ?? []) ? 'checked' : '' }} name="permissions[{{ $item->id }}]" value="{{ $item->id }}" >
                    </td>
                </tr>
                @endforeach
                </tbody>
                <tfoot>
                <tr>
                    <th style="text-align: center; vertical-align: middle;">#</th>
                    <th style="text-align: left; vertical-align: middle;">Tên quyền</th>
                    <th style="text-align: left; vertical-align: middle;">Tên hiển thị</th>
                    <th style="text-align: center; vertical-align: middle;">...</th>
                </tr>
                </tfoot>
            </table>
        </div>
    </div>
@endcomponent
