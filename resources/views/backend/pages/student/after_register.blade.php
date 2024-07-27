@extends('frontend.layouts.app')
@section('content')


<!doctype html>
<html lang="en">

<head>

    <title>Education Portal</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    {{-- <meta property="og:image:width" content="500" />
    <meta property="og:image:height" content="500" /> --}}
    @stack('fb-meta-tag')

    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- Bootstrap CSS -->
    @include('frontend.inc.css')
    @stack('custom-css')
</head>

<body class="d-flex flex-column h-100">
    <div class="container sticky-top">
        <nav class="navbar navbar-expand-md navbar-light bg-light rounded py-3" aria-label="Eleventh navbar example">
          <div class="container-fluid">
            <a class="navbar-brand border-0" href="#">DRHCNC</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarsExample09" aria-controls="navbarsExample09" aria-expanded="false" aria-label="Toggle navigation">
              <span class="navbar-toggler-icon"></span>
            </button>
          </div>
        </nav>
      </div>
    <main class="flex-shrink-0" style="min-height: 800px;margin-top:50px">
        <div class="container mt-2">
            <div class="position-relative overflow-hidden p-3  text-center bg-light">
                  <h1 class="display-4 fw-normal">You have successfully registered!</h1>
                  <a href="{{ route('student.dashboard') }}" class="btn btn-info btn-lg d-block mb-2">Go to Dashboard</a>
                  <a class="btn btn-info btn-lg d-block" href="{{ route('logout') }}"
                onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                Logout
            </a>

            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                @csrf
            </form>
                  <small class="w-100 text-danger">(After logout you can login with your registred phone number and password)</small>
            </div>
        </div>
      </main>
    @include('frontend.inc.footer')
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    @include('frontend.inc.js')
    @stack('custom-scripts')
</body>

</html>
