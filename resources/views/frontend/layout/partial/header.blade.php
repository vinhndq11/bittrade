<header class="navbar navbar-expand navbar-default flex-column flex-md-row bd-navbar">
    <a class="navbar-brand mr-0 mr-md-2" href="{{ route('frontend.home.get') }}" aria-label="">
        <img src="img/logo.png" alt="" class="logo" >
    </a>
    <div class="navbar-nav-scroll navbar-nav flex-row ml-md-auto d-md-flex">
        <ul class="navbar-nav bd-navbar-nav flex-row">
            <li class="nav-item">
                <a class="nav-link {{ request()->is(trans('route.check_warranty')) ? 'active' : '' }}" href="{{ route('frontend.warranty.check.get') }}">Tra cứu bảo hành</a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ request()->is(trans('route.register_warranty')) ? 'active' : '' }}" href="{{ route('frontend.warranty.register.get', ['code' => request('code')]) }}">Đăng ký bảo hành</a>
            </li>
        </ul>
    </div>
</header>
