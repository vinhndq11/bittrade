@extends('backend.layout.master')

@section('title','Danh sách người dùng')

@section('css')
@endsection

@section('js')
    <script>
		const columns = [
			{ data: 'DT_RowIndex', title: '#', orderable: false, searchable: false },
			{ data: 'name', name: 'name' },
			{ data: 'email', name: 'email' },
			{ data: 'active', name: 'is_active', className: 'text-center' },
			{ data: 'action', name: 'action' }
		];
    </script>
@endsection

@component('backend.layout.component.list')
    <tr>
        <th style="text-align: center; vertical-align: middle;"></th>
        <th style="text-align: left; vertical-align: middle;">Họ tên</th>
        <th style="text-align: left; vertical-align: middle;">Email</th>
        <th style="text-align: center; vertical-align: middle;">Trạng thái</th>
        <th style="text-align: center; vertical-align: middle;">...</th>
    </tr>
@endcomponent
