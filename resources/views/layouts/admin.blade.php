<!DOCTYPE html>
<html lang="en">
    <head>
        @include('admin.components.style')
    </head>
    <body class="sb-nav-fixed">
        @include('admin.components.topbar')
        <div id="layoutSidenav">
            @include('admin.components.sidebar')
            <div id="layoutSidenav_content">
                @yield('admin_content')
            </div>
        </div>
        @include('admin.components.script')
    </body>
</html>
