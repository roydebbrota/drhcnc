
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>drhcnc</title>
    <link rel="icon" href="{{ asset('/frontend/img/logo.ico') }}" type="image/x-icon">
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    @stack('fb-meta-tag')

    <meta name="csrf-token" content="{{ csrf_token() }}">


    <!-- Bootstrap core CSS -->
    @include('backend.inc.css')
    @stack('custom-css')

    <style>
      .bd-placeholder-img {
        font-size: 1.125rem;
        text-anchor: middle;
        -webkit-user-select: none;
        -moz-user-select: none;
        user-select: none;
      }

      @media (min-width: 768px) {
        .bd-placeholder-img-lg {
          font-size: 3.5rem;
        }
      }
    </style>


  </head>
  <body>
    @include('backend.inc.header')


<div class="container-fluid">
  <div class="row">
        <main class="col-12">
        @yield('backend_content')
    </main>
  </div>
</div>


@include('backend.inc.js')
@stack('custom-scripts')
@include('sweetalert::alert')

      {{-- <script src="https://cdn.jsdelivr.net/npm/feather-icons@4.28.0/dist/feather.min.js" integrity="sha384-uO3SXW5IuS1ZpFPKugNNWqTZRRglnUJK6UAZ/gxOX80nxEkN9NcGZTftn6RzhGWE" crossorigin="anonymous"></script><script src="https://cdn.jsdelivr.net/npm/chart.js@2.9.4/dist/Chart.min.js" integrity="sha384-zNy6FEbO50N+Cg5wap8IKA4M/ZnLJgzc6w2NqACZaK0u0FXfOWRRJOnQtpZun8ha" crossorigin="anonymous"></script><script src="dashboard.js"></script> --}}
  </body>
</html>

