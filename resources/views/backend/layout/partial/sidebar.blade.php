<aside class="main-sidebar">
    <section class="sidebar">
        <div class="user-panel">
            <div class="pull-left image">
                <img src="img/user.png" class="img-circle" alt="User Image">
            </div>
            <div class="pull-left info">
                <p style="text-transform: capitalize">{{ getAuthUser()->name }}</p>
                <a href="javascript:void(0)"><i class="fa fa-circle text-success"></i> Trực tuyến</a>
            </div>
        </div>
        <ul class="sidebar-menu" data-widget="tree">
            @include('backend.layout.component.menu_item', ['icon' => 'fa fa-dashboard text-green', 'model' => 'dashboard', 'single' => true])
            @include('backend.layout.component.menu_item', ['icon' => 'fa fa-line-chart text-blue', 'model' => 'analytic', 'single' => true])
            @if(hasRoleSuperAdminAndEtc([ADMINISTRATOR]))
                <li class="header">HỆ THỐNG</li>
                @include('backend.layout.component.menu_item', ['icon' => 'fa-user text-yellow', 'model' => 'user'])
                @include('backend.layout.component.menu_item', ['icon' => 'fa-history text-maroon', 'model' => 'log', 'single' => true])
                @include('backend.layout.component.menu_item', ['icon' => 'fa fa-cog text-lime', 'model' => 'setting', 'single' => true, 'route' => route("admin.setting.index"), 'label' => 'Cài đặt', 'permission_map' => ['general']])
                @include('backend.layout.component.menu_item', ['icon' => 'fa fa-trophy text-fuchsia', 'model' => 'reward', 'single' => true, 'route' => route("admin.reward.index"), 'label' => 'Giải thưởng', 'permission_map' => ['general']])
                @include('backend.layout.component.menu_item', ['icon' => 'fa fa-percent text-aqua', 'model' => 'commission', 'single' => true, 'route' => route("admin.commission.index"), 'label' => 'Hoa hồng', 'permission_map' => ['general']])
                @include('backend.layout.component.menu_item', ['icon' => 'fa fa-picture-o text-teal', 'model' => 'commission', 'single' => true, 'route' => route("admin.asset.index"), 'label' => 'Hình ảnh', 'permission_map' => ['general']])
                @include('backend.layout.component.menu_item', ['icon' => 'fa fa-envelope-o text-light-blue', 'model' => 'commission', 'single' => true, 'route' => route("admin.template.index"), 'label' => 'Mẫu email', 'permission_map' => ['general']])
            @endif
            <li class="header">KHÁCH HÀNG</li>
            @include('backend.layout.component.menu_item', ['icon' => 'fa-users text-green', 'model' => 'member', 'single' => true])
            @include('backend.layout.component.menu_item', ['icon' => 'fa-user-secret text-orange', 'model' => 'hacker', 'single' => true])
            @include('backend.layout.component.menu_item', ['icon' => 'fa-exchange text-red', 'model' => 'member_transaction', 'single' => true])
        </ul>
    </section>
</aside>
