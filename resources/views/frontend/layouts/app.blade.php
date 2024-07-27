<!doctype html>
<html lang="en">

<head>

    <title>drhcnc</title>
    <link rel="icon" href="{{ asset('/frontend/img/logo.ico') }}" type="image/x-icon">
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    @stack('fb-meta-tag')

    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- Bootstrap CSS -->
    @include('frontend.inc.css')
    @stack('custom-css')
</head>

<body class="d-flex flex-column h-100">
    @include('frontend.inc.header')
    <main class="flex-shrink-0" style="min-height: 800px;margin-top:50px">
        @yield('content')
      </main>
    @include('frontend.inc.footer')
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    @include('frontend.inc.js')
    @stack('custom-scripts')
</body>

</html>
