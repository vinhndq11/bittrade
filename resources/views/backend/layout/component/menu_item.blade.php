@if(hasPermissionsOrIsSupperAdmin(array_merge(["create-{$model}", "list-{$model}"], array_map(function ($per) use ($model){ return "{$per}-{$model}"; }, $permission_map ?? []))))
@if(isset($single) || isset($route))
    <li><a href="{{ $route ?? route("admin.{$model}.index") }}"><i class="fa {{ $icon }}"></i> <span>{{ $label ?? trans("{$model}.label") }}</span></a></li>
@else
<li class="treeview">
    <a href="javascript:void(0)">
        <i class="fa {{ $icon }}"></i>
        <span>{{ $label ?? trans("{$model}.label") }}</span>
        <i class="fa fa-angle-left pull-right"></i>
    </a>
    <ul class="treeview-menu">
        @if(hasPermissionsOrIsSupperAdmin(["create-{$model}"]))
            <li><a href="{{route("admin.{$model}.create")}}"><i class="fa fa-plus-circle"></i> {{ trans("{$model}.add") }}</a></li>
        @endif
        @if(hasPermissionsOrIsSupperAdmin(["list-{$model}"]))
            <li><a href="{{route("admin.{$model}.index")}}"><i class="fa fa-list-ul"></i> {{ trans("{$model}.all") }}</a></li>
        @endif
    </ul>
</li>
@endif
@endif
