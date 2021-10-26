<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Favicon -->
    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('impact/front/assets/img/favicon/apple-touch-icon.png') }}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('impact/front/assets/img/favicon/favicon-32x32.png') }}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('impact/front/assets/img/favicon/favicon-16x16.png') }}">
    <link rel="manifest" href="{{ asset('impact/front/assets/img/favicon/site.webmanifest') }}">
    <meta name="msapplication-TileColor" content="#2b5797">
    <meta name="theme-color" content="#ffffff">

    <!-- Fontawesome -->
    <link type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css"
        rel="stylesheet">

    <!-- Front CSS -->
    <link type="text/css" href="{{ asset('impact/front/css/front.css') }}" rel="stylesheet">
</head>

<body>
    <header class="header-global">
        <nav id="navbar-main"
            class="navbar navbar-main navbar-expand-lg headroom py-lg-3 px-lg-6 navbar-light navbar-theme-primary">
            <div class="container">
                <a class="navbar-brand @@logo_classes" href="#">
                    <img class="navbar-brand-light common"
                        src="https://res.cloudinary.com/lkp-ar-risalah/image/upload/v1622704689/rsz_logo_vlgqiv_pfo0vk.png"
                        height="35" alt="...">
                </a>
                <span class="nav-link-text"><strong>LKP Ar Risalah</strong></span>
                <div class="navbar-collapse collapse" id="navbar_global">
                    <div class="navbar-collapse-header">
                        <div class="row">
                            <div class="col-6 collapse-brand">
                                <a href="#">
                                    <img src="https://res.cloudinary.com/lkp-ar-risalah/image/upload/v1622704689/rsz_logo_vlgqiv_pfo0vk.png"
                                        height="35" alt="Logo Impact"></a>
                            </div>
                            <div class="col-6 collapse-close">
                                <a href="#navbar_global" role="button" class="fas fa-times" data-toggle="collapse"
                                    data-target="#navbar_global" aria-controls="navbar_global" aria-expanded="false"
                                    aria-label="Toggle navigation">
                                </a>
                            </div>
                        </div>
                    </div>
                    <ul class="navbar-nav navbar-nav-hover justify-content-center">
                        <li class="nav-item d-lg-none">
                            @guest
                                <a href="{{ route('register') }}" class="nav-link">Daftar</a>
                            @endguest
                            @auth
                                <a href="{{ route('home') }}" class="nav-link">Halaman Utama</a>
                            @endauth
                        </li>
                    </ul>
                </div>
                <div class="d-none d-lg-block @@cta_button_classes">
                    @guest
                        <a href="{{ route('register') }}" class="btn btn-md btn-secondary animate-up-2">
                            <i class="fas fa-pencil-alt mr-2"></i>Daftar
                        </a>
                    @endguest
                    @auth
                        <a href="{{ route('home') }}" class="btn btn-md btn-secondary animate-up-2">
                            <i class="fas fa-home mr-2"></i>Halaman Utama
                        </a>
                    @endauth
                </div>
                <div class="d-flex d-lg-none align-items-center">
                    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbar_global"
                        aria-controls="navbar_global" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                </div>
            </div>
        </nav>
    </header>
    <main>
        <section class="section-header pb-4 pb-lg-8 bg-soft">
            <div class="container">
                <div class="row justify-content-between align-items-center">
                    <div class="col-12 col-md-6 order-2 order-lg-1"><img
                            src="{{ asset('impact/front/assets/img/illustrations/hero-illustration.svg') }}"
                            alt="">
                    </div>
                    <div class="col-12 col-md-5 order-1 order-lg-2">
                        <h1 class="display-3 mb-3">Sistem Informasi Bimbingan Belajar</h1>
                        <p class="lead">Sistem Informasi Bimbingan Belajar ini akan membantu kamu untuk mulai belajar di LKP Ar Risalah</p>
                        <div class="mt-4">
                            @guest()
                                <a href="{{ route('login') }}"
                                    class="btn btn-primary d-flex flex-column mb-5 mb-lg-0">Masuk sekarang</a>
                            @endguest
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <section class="section section-md pt-6">
            <div class="container">
                <div class="row justify-content-center mb-3 mb-md-5">
                    <div class="col-12 col-md-8 text-center">
                        <h2 class="h1 font-weight-bolder mb-4">LKP Ar Risalah</h2>
                        <p class="lead">{!! $information->firstWhere('name', 'Deskripsi')->description !!}</p>
                    </div>
                </div>
                <div class="row row-grid align-items-center mb-3 mb-md-5">
                    <div class="col-12 col-md-5">
                        <h2 class="font-weight-bolder mb-4">Tentang kami</h2>
                        <p class="lead">
                            {!! $information->firstWhere('name', 'Tentang Kami')->description !!}
                        </p>
                    </div>
                    <div class="col-12 col-md-6 ml-md-auto">
                        <img src="{{ asset('impact/front/assets/img/illustrations/feature-illustration.svg') }}"
                            alt="">
                    </div>
                </div>
                <div class="row row-grid align-items-center mb-3 mb-md-5">
                    <div class="col-12 col-md-5 order-md-2">
                        <h2 class="font-weight-bolder mb-4">Visi Misi</h2>
                        <p class="lead">{!! $information->firstWhere('name', 'Visi')->description !!}</p>
                        <p class="lead">{!! $information->firstWhere('name', 'Misi')->description !!}</p>
                    </div>
                    <div class="col-12 col-md-6 mr-lg-auto">
                        <img src="{{ asset('impact/front/assets/img/illustrations/feature-illustration-2.svg') }}" alt="">
                    </div>
                </div>
                <div class="row">
                    <div class="col-12 col-md-6 col-lg-4 mb-2">
                        <div class="card border-light p-4">
                            <div class="card-body">
                                <h2 class="display-2 mb-2">{{ $students }}</h2><span>Siswa Aktif</span>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-md-6 col-lg-4 mb-2">
                        <div class="card border-light p-4">
                            <div class="card-body">
                                <h2 class="display-2 mb-2">{{ $teachers }}</h2><span>Tenaga Pengajar</span>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-md-6 col-lg-4 mb-2">
                        <div class="card border-light p-4">
                            <div class="card-body">
                                <h2 class="display-2 mb-2">{{ $classrooms }}</h2><span>Kelas Tersedia</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <section class="section section-md bg-soft">
            <div class="container">
                <div class="row justify-content-center mb-3 mb-md-5">
                    <div class="col-12 col-md-8 text-center">
                        <h2 class="h1 font-weight-bolder mb-4">Galeri</h2>
                        <p class="lead">Lingkungan belajar mengajar di LKP Ar Risalah.</p>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12 col-md-6 col-lg-4 mb-4">
                        <div class="card shadow-soft border-light">
                            <div class="card-header p-0">
                                <img src="{{ $information->where('name', 'Foto')->values()[0]->description }}"
                                    class="card-img-top rounded-top" alt="image">
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-md-6 col-lg-4 mb-4">
                        <div class="card shadow-soft border-light">
                            <div class="card-header p-0">
                                <img src="{{ $information->where('name', 'Foto')->values()[1]->description }}"
                                    class="card-img-top rounded-top" alt="image">
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-md-6 col-lg-4 mb-4">
                        <div class="card shadow-soft border-light">
                            <div class="card-header p-0">
                                <img src="{{ $information->where('name', 'Foto')->values()[2]->description }}"
                                    class="card-img-top rounded-top" alt="image">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <section class="section section-md bg-primary text-center text-white">
            <div class="container">
                <div class="row justify-content-center mb-2 mb-lg-4">
                    <div class="col-12">
                        <h1 class="display-3 mb-4 mb-lg-4">Bimbingan Belajar dengan Fasilitas Lengkap.</h1>
                        <div class="row text-white">
                            <div class="col-12 col-lg-4 px-md-0 mb-4 mb-lg-0">
                                <div class="card-body text-center bg-primary border-right border-default py-4">
                                    <h2 class="font-weight-bold">
                                        @php
                                            $text = $information->where('name', 'Fasilitas')->values()[0]->description;
                                            $title = explode(' ', $text);
                                        @endphp
                                        <h2 class="font-weight-bold">
                                            <span class="h1 mr-2">{{ $title[0] }}</span>
                                        </h2>
                                        <span class="h5 font-weight-normal">{{ str_replace($title[0], '', $text) }}</span>
                                    </h2>
                                </div>
                            </div>
                            <div class="col-12 col-lg-4 px-md-0 mb-4 mb-lg-0">
                                <div class="card-body text-center bg-primary border-right border-default py-4">
                                    <h2 class="font-weight-bold">
                                        @php
                                            $text = $information->where('name', 'Fasilitas')->values()[1]->description;
                                            $title = explode(' ', $text);
                                        @endphp
                                        <h2 class="font-weight-bold">
                                            <span class="h1 mr-2">{{ $title[0] }}</span>
                                        </h2>
                                        <span class="h5 font-weight-normal">{{ str_replace($title[0], '', $text) }}</span>
                                    </h2>
                                </div>
                            </div>
                            <div class="col-12 col-lg-4 px-md-0">
                                <div class="card-body text-center bg-primary py-4">
                                    <h2 class="font-weight-bold">
                                        @php
                                            $text = $information->where('name', 'Fasilitas')->values()[2]->description;
                                            $title = explode(' ', $text);
                                        @endphp
                                        <h2 class="font-weight-bold">
                                            <span class="h1 mr-2">{{ $title[0] }}</span>
                                        </h2>
                                        <span class="h5 font-weight-normal">{{ str_replace($title[0], '', $text) }}</span>
                                    </h2>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <section class="section section-md">
            <div class="container">
                <div class="row justify-content-center mb-4 mb-lg-6">
                    <div class="col-12 col-md-8 text-center">
                        <h1 class="h1 font-weight-bolder mb-4">Direkomendasikan oleh banyak alumni LKP Ar Risalah</h1>
                        <p class="lead">Apa pendapat mereka tentang LKP Ar Risalah?</p>
                    </div>
                </div>
                <div class="row mb-lg-4">
                    <div class="col-12 col-lg-6">
                        <div class="customer-testimonial d-flex mb-5">
                            <img src="https://ui-avatars.com/api/?name=AR&size=512"
                                class="image image-sm mr-3 rounded-circle shadow" alt="">
                            <div class="content bg-soft shadow-soft border border-light rounded position-relative p-4">
                                {!! $information->where('name', 'Testimoni')->values()[0]->description !!}
                            </div>
                        </div>
                        <div class="customer-testimonial d-flex mb-5"><img
                                src="https://ui-avatars.com/api/?name=CD&size=512"
                                class="image image-sm mr-3 rounded-circle shadow" alt="">
                            <div class="content bg-soft shadow-soft border border-light rounded position-relative p-4">
                                {!! $information->where('name', 'Testimoni')->values()[1]->description !!}
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-lg-6 pt-lg-6">
                        <div class="customer-testimonial d-flex mb-5"><img
                                src="https://ui-avatars.com/api/?name=EF&size=512"
                                class="image image-sm mr-3 rounded-circle shadow" alt="">
                            <div class="content bg-soft shadow-soft border border-light rounded position-relative p-4">
                                {!! $information->where('name', 'Testimoni')->values()[2]->description !!}
                            </div>
                        </div>
                        <div class="customer-testimonial d-flex mb-5"><img
                                src="https://ui-avatars.com/api/?name=GH&size=512"
                                class="image image-sm mr-3 rounded-circle shadow" alt="">
                            <div class="content bg-soft shadow-soft border border-light rounded position-relative p-4">
                                {!! $information->where('name', 'Testimoni')->values()[3]->description !!}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <section class="section section-md pb-5 bg-soft">
            <div class="container">
                <div class="row">
                    <div class="col-12 text-center">
                        <h2 class="mb-4">Mari bergabung dengan LKP Ar Risalah</h2>
                        <p class="lead mb-5">Bersama lebih dari <span class="font-weight-bolder">100+</span> siswa</p>
                    </div>
                    <div class="col-12 text-center">
                        <a href="{{ route('register') }}" class="btn btn-secondary animate-up-2">
                            <span class="mr-2"><i class="fas fa-hand-pointer"></i></span>Registrasi Siswa Baru
                        </a>
                    </div>
                </div>
            </div>
        </section>
        <footer class="footer section pt-6 pt-md-8 pt-lg-10 pb-3 bg-primary text-white overflow-hidden">
            <div class="pattern pattern-soft top">
            </div>
            <div class="container">
                <div class="row">
                    <div class="col pb-4 mb-md-0">
                        <div class="d-flex text-center justify-content-center align-items-center">
                            <p class="font-weight-normal mb-0">
                                Sistem Informasi Bimbingan Belajar LKP Ar Risalah
                                <span class="current-year"></span>
                        </div>
                    </div>
                </div>
            </div>
        </footer>
    </main>

    <!-- Core -->
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.min.js"
        integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js"
        integrity="sha256-sCElQ8xaSgoxwbWp0eiXMmGZIRa0z94+ffzzO06BqXs=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/headroom.js@0.12.0/dist/headroom.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/jarallax@1.12.5/dist/jarallax.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/smooth-scroll@16.1.3/dist/smooth-scroll.polyfills.min.js"></script>

    <!-- Impact JS -->
    <script src="https://cdn.jsdelivr.net/gh/creativetimofficial/impact-design-system/src/front/assets/js/front.js">
    </script>
</body>

</html>
