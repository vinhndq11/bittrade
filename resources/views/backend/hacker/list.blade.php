@extends('backend.layout.master')

@section('title', 'Quản lý khách (tool hack)')

@section('css')
@endsection

@section('js')
    <script>
		const columns = [
			{ data: 'DT_RowIndex', title: '#', orderable: false, searchable: false },
			{ data: 'name', name: 'name', title: 'Tên', orderable: false, render: (data, type, row) => data ? data : `#${row.username}` },
			{ data: 'email', name: 'email', title: 'Email' },
			{ data: 'ip', name: 'ip', title: 'IP đăng nhập cuối' },
			{ data: 'created_at', name: 'created_at', title: 'Tạo lúc', className: 'text-center' },
			{ data: 'active', name: 'is_active', title: 'Trạng thái', className: 'text-center' },
			{ data: 'action', name: 'action', title: '...' },
		];
    </script>
@endsection

@component('backend.layout.component.list')
@endcomponent
