@extends('backend.layout.master')

@section('title', 'Quyền người dùng')

@section('css')
@endsection

@section('js')
    <script>
		const columns = [
			{ data: 'id', name: 'id', },
			{ data: 'name', name: 'name' },
			{ data: 'display_name', name: 'display_name' },
			{ data: 'description', name: 'description' },
			{ data: 'created_at', name: 'created_at', className: 'text-center' },
			{ data: 'action', name: 'action'}
		];
    </script>
@endsection

@component('backend.layout.component.list', ['addNew' => false])
    <tr>
        <th style="text-align: center; vertical-align: middle;"></th>
        <th style="text-align: left; vertical-align: middle;">Tên quyền</th>
        <th style="text-align: left; vertical-align: middle;">Tên hiển thị</th>
        <th style="text-align: left; vertical-align: middle;">Mô tả</th>
        <th style="text-align: center; vertical-align: middle;">Ngày tạo</th>
        <th style="text-align: center; vertical-align: middle;">...</th>
    </tr>
@endcomponent
