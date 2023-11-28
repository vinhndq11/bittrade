@extends('backend.layout.master')

@section('title', isset($isProfile) ? 'Cập nhật thông tin cá nhân' : 'Thêm/Sửa thông tin người dùng')

@section('css')
@endsection

@section('js')
    @if(isset($mainData) && getAuthUser()->hasRole(SUPERADMINISTRATOR) && !isset($isProfile))
    <script>
        const updateUrl = '{{ route("admin.$viewFolder.update", $mainData->id) }}';
    </script>
    @endif
@endsection

@section('content')
<div class="nav-tabs-custom">
    <ul class="nav nav-tabs">
        <li class="active text-bold"><a href="#tab_info" data-toggle="tab" aria-expanded="true"><i class="fa fa-info-circle text-muted"></i> Thông tin</a></li>
        @if(isset($mainData) && getAuthUser()->hasRole(SUPERADMINISTRATOR) && !isset($isProfile) && false)
        <li class="pull-right text-bold"><a href="#tab_role" data-toggle="tab" aria-expanded="false"><i class="fa fa-beer text-muted"></i> Vai trò</a></li>
        <li class="pull-right text-bold"><a href="#tab_permission" data-toggle="tab" aria-expanded="false"><i class="fa fa-balance-scale text-muted"></i> Quyền</a></li>
        @endif
    </ul>
    <div class="tab-content">
        <div class="tab-pane active" id="tab_info">
            @include('backend.user.tabs.info')
        </div>
        @if(isset($mainData) && getAuthUser()->hasRole(SUPERADMINISTRATOR) && !isset($isProfile) && false)
        <div class="tab-pane" id="tab_role">
            @include('backend.user.tabs.role')
        </div>
        <div class="tab-pane" id="tab_permission">
            @include('backend.user.tabs.permission')
        </div>
        @endif
    </div>
</div>
@stop
