<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>{{ env('APP_NAME') }} | Laravel Log viewer</title>
    <link rel="stylesheet" href="{{ asset('vendor/logviewer/assets/css/materialdesignicons.min.css') }}">
    <link rel="stylesheet" href="{{ asset('vendor/logviewer/assets/css/flag-icon.min.css') }}">
    <link rel="stylesheet" href="{{ asset('vendor/logviewer/assets/css/style.css') }}">
    @livewireStyles

</head>

<body>
    <div class="container-scroller">
        @include('logviewer::components._sidebar')
        <div class="container-fluid page-body-wrapper">
            {{-- @include('logviewer::components._navbar') --}}
            <div class="main-panel">
                <div class="content-wrapper">
                    @yield('content')
                </div>
                @include('logviewer::components._footer')
            </div>
        </div>
    </div>
    <script src="{{ asset('vendor/logviewer/assets/js/vendor.bundle.base.js') }}"></script>
    <script src="{{ asset('vendor/logviewer/assets/js/misc.js') }}"></script>
    <script src="{{ asset('vendor/logviewer/assets/js/dashboard.js') }}"></script>
    @livewireScripts
</body>

</html>
