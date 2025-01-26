<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <title>ota</title>
    <meta content="width=device-width, initial-scale=1.0, shrink-to-fit=no" name="viewport" />
    @include('admin.layouts.style')
</head>

<body>
    <div class="wrapper">
        <!-- Sidebar -->
        @include('admin.layouts.sidebar')
        <!-- End Sidebar -->

        <div class="main-panel">

            {{-- header --}}
            @include('admin.layouts.header')

            {{-- main content --}}
            <div class="container">
                <div class="page-inner">
                    @yield('content')
                </div>
            </div>

            {{-- footer --}}
            @include('admin.layouts.footer')
        </div>
    </div>
    {{-- script --}}
    @include('admin.layouts.script')
</body>

</html>
