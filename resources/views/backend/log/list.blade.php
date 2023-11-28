@extends('backend.layout.master')

@section('title', 'Quản lý nhật ký log')

@section('css')
@stop

@section('js')
    <script>
		const columns = [
			{ data: 'id', name: 'id', title: '#' },
			{ data: 'user', name: 'user_id', title: 'Người dùng' },
			{ data: 'method_label', name: 'method', title: 'Hành động' },
			{ data: 'model_label', name: 'model', title: 'Đối tượng' },
			{ data: 'message', name: 'message', title: 'Tên/Tiêu đề đối tượng'},
			{ data: 'created_at', name: 'created_at', className: 'text-center', title: 'Thời gian' },
			{ data: 'ip', name: 'ip', title: 'Từ IP' }
		];
    </script>
@stop

@component('backend.layout.component.list', ['addNew' => false])
@endcomponent
