@extends('backend.layout.master')

@section('title', 'Vai trò người dùng')

@section('css')
@endsection

@section('js')
    <script>
		const columns = [
			{ data: 'id', name: 'id', },
			{ data: 'name', name: 'name' },
			{ data: 'display_name', name: 'display_name' },
			{ data: 'permission_count', name: 'permission_count', className: 'text-center' },
			{ data: 'description', name: 'description' },
			{ data: 'created_at', name: 'created_at', className: 'text-center' },
			{ data: 'action', name: 'action'}
		];
    </script>
@endsection

@component('backend.layout.component.list')
    <tr>
        <th style="text-align: center; vertical-align: middle;"></th>
        <th style="text-align: left; vertical-align: middle;">Tên vai trò</th>
        <th style="text-align: left; vertical-align: middle;">Tên hiển thị</th>
        <th style="text-align: center; vertical-align: middle;">Số lượng quyền</th>
        <th style="text-align: left; vertical-align: middle;">Mô tả</th>
        <th style="text-align: center; vertical-align: middle;">Ngày tạo</th>
        <th style="text-align: center; vertical-align: middle;">...</th>
    </tr>
@endcomponent
