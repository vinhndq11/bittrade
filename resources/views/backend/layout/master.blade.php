<!DOCTYPE html>
<html lang="vi">
@include('backend.layout.partial.head')
<body class="hold-transition skin-blue sidebar-mini {{isset($sidebar) ? 'sidebar-collapse' : ''}}">
<div class="wrapper">
    @include('backend.layout.partial.header')
    @include('backend.layout.partial.sidebar')
    <div class="content-wrapper">
        <section class="content-header">
            @yield('title', $title ?? '')<small>@yield('subtitle', $subtitle ?? '')</small>
        </section>
        <section class="content">
            <div class="row">
                <div class="col-xs-12">
                    @include('backend.layout.partial.alert')
                </div>
            </div>
            @hasSection('content')
                @yield('content')
            @else
                Có lỗi trong quá trình đọc nội dung...
            @endif
        </section>
    </div>
    <footer class="main-footer">
        <div class="pull-right hidden-xs">
            <b>Version</b> {{env('APP_VERSION')}}
        </div>
        <strong>Developed by ADZ</strong>
    </footer>
</div>

<audio data-v-68cf3fda="" id="notification" preload="auto">
    <source data-v-68cf3fda="" src="audio/notification.mp3" type="audio/mpeg" />
</audio>
@stack('other')

@include('backend.layout.partial.js')
@yield('js')

</body>
</html>
