<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Favicon -->
    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('impact/dashboard/assets/img/brand/apple-touch-icon.png') }}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('impact/dashboard/assets/img/brand/favicon-32x32.png') }}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('impact/dashboard/assets/img/brand/favicon-16x16.png') }}">
    <link rel="manifest" href="{{ asset('impact/dashboard/assets/img/brand/site.webmanifest') }}">
    <meta name="msapplication-TileColor" content="#2b5797">
    <meta name="theme-color" content="#ffffff">

    <!-- Fonts -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700">

    <!-- Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.0/font/bootstrap-icons.css">

    @stack('styles')

    <!-- Front CSS -->
    <link type="text/css" href="{{ asset('impact/dashboard/css/dashboard.css') }}"
        rel="stylesheet">
</head>

<body>
    @include('layouts.partials.sidenav')

    <div class="main-content" id="panel">
        @include('layouts.partials.topnav')

        {{ $slot }}
    </div>

    <div class="modal fade" id="logout-modal" tabindex="-1" role="dialog" aria-labelledby="logout-modal"
        aria-hidden="true">
        <div class="modal-dialog modal-danger modal-dialog-centered modal-" role="document">
            <div class="modal-content bg-gradient-danger">
                <div class="modal-header">
                    <h6 class="modal-title" id="modal-title-notification">Peringatan</h6>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="py-3 text-center">
                        <i class="bi bi-bell-fill" style="font-size: 3rem;"></i>
                        <h4 class="heading mt-4">Apakah anda yakin untuk keluar?</h4>
                        <p>Klik tombol "Keluar" dibawah ini <br> untuk mengakhiri sesi.</p>
                    </div>
                </div>
                <div class="modal-footer">
                    <a class="btn btn-white" href="{{ route('logout') }}" onclick="event.preventDefault();
                        document.getElementById('logout-form').submit();">Keluar</a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST"
                        class="d-none">
                        @csrf
                    </form>
                    <button type="button" class="btn btn-link text-white ml-auto" data-dismiss="modal">Batal</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Core -->
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.min.js"
        integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js"
        integrity="sha256-sCElQ8xaSgoxwbWp0eiXMmGZIRa0z94+ffzzO06BqXs=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/js-cookie@2.2.1/src/js.cookie.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/jquery.scrollbar@0.2.11/jquery.scrollbar.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/jquery-scroll-lock@3.1.3/jquery-scrollLock.min.js"></script>

    @stack('scripts')

    <script src="https://cdn.jsdelivr.net/gh/creativetimofficial/impact-design-system/src/dashboard/assets/js/dashboard.min.js">
    </script>
</body>

</html>
