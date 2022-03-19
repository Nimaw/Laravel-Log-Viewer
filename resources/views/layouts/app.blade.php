<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>{{ env('APP_NAME') }} | Laravel Log viewer</title>
    <link rel="stylesheet" href="{{ asset('assets/vendor/logviewer/css/materialdesignicons.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendor/logviewer/css/vendor.bundle.base.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendor/logviewer/css/flag-icon.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendor/logviewer/css/style.css') }}">
    @livewireStyles

</head>

<body>
    <div class="container-scroller">
        @include('logviewer::components._sidebar')
        <div class="container-fluid page-body-wrapper">
            @include('logviewer::components._navbar')
            <div class="main-panel">
                <div class="content-wrapper">
                    @yield('content')
                </div>
                @include('logviewer::components._footer')
            </div>
        </div>
    </div>
    <script src="{{ asset('assets/vendor/logviewer/js/vendor.bundle.base.js') }}"></script>
    <script src="{{ asset('assets/vendor/logviewer/js/misc.js') }}"></script>
    <script src="{{ asset('assets/vendor/logviewer/js/dashboard.js') }}"></script>
    @livewireScripts
</body>

</html>
