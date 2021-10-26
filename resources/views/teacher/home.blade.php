<x-app-layout>
    <!-- Title -->
    <div class="header pb-6 d-flex align-items-center"
        style="min-height: 500px; background-image: url(https://user-images.githubusercontent.com/77373259/111794767-24c42280-88f9-11eb-8d06-43d29fe752cc.jpg); background-size: cover; background-position: center top;">
        <!-- Mask -->
        <span class="mask bg-gradient-primary opacity-8"></span>
        <!-- Header container -->
        <div class="container-fluid d-flex align-items-center">
            <div class="row">
                <div class="col-lg-7 col-md-10">
                    <h1 class="display-2 text-white">Halo {{ auth()->user()->teacher->name }}</h1>
                    <p class="text-white mt-0 mb-5">Ini adalah halaman utama.
                        Silahkan memilih menu yang diinginkan untuk menampilkan data.</p>
                </div>
            </div>
        </div>
    </div>
    <!-- Page content -->
    <div class="container-fluid mt--6">
        <div class="row">
            <div class="col-xl-4 order-xl-2">
                <div class="card card-profile">
                    <img src="https://user-images.githubusercontent.com/77373259/111796644-f47d8380-88fa-11eb-9c6f-3ac7aca24ad8.jpg"
                        alt="Image placeholder" class="card-img-top">
                    <div class="row justify-content-center">
                        <div class="col-lg-3 order-lg-2">
                            <div class="card-profile-image">
                                <img id="preview" src="{{ auth()->user()->profile_photo }}" class="rounded-circle"></a>
                            </div>
                        </div>
                    </div>
                    <div class="card-body pt-7">
                        <div class="text-center">
                            <h5 class="h3">{{ auth()->user()->teacher->name }} | {{ auth()->user()->teacher->age }}</h5>
                            <div class="h5 font-weight-300">
                                <i class="ni location_pin mr-2"></i>
                                {{ auth()->user()->teacher->address }}
                            </div>
                            <div class="h5 mt-4">
                                <i class="ni business_briefcase-24 mr-2"></i>
                                {{ auth()->user()->teacher->field }}
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Progress track -->
                <div class="card">
                    <!-- Card header -->
                    <div class="card-header">
                        <!-- Title -->
                        <h5 class="h3 mb-0">Jadwal</h5>
                    </div>
                    <!-- Card body -->
                    <div class="card-body p-0">
                        <!-- List group -->
                        @foreach($schedules as $schedule)
                            <ul class="list-group list-group-flush" data-toggle="checklist">
                                <li class="checklist-entry list-group-item flex-column align-items-start py-4 px-4">
                                    <div class="checklist-item">
                                        <div class="checklist-info">
                                            <h5 class="checklist-title mb-0">
                                                {{ $schedule->classroom->name }} -
                                                {{ $schedule->classroom->subject->name . ' ' . $schedule->classroom->subject->grade }}
                                            </h5>
                                            <small>{{ $schedule->formatted_start_time }}</small>
                                        </div>
                                    </div>
                                </li>
                            </ul>
                        @endforeach
                    </div>
                </div>
            </div>
            <div class="col-xl-8 order-xl-1">
                <div class="row">
                    <div class="col-lg-6">
                        <div class="card bg-gradient-success border-0">
                            <!-- Card body -->
                            <div class="card-body">
                                <div class="row">
                                    <div class="col">
                                        <h5 class="card-title text-uppercase text-muted mb-0 text-white">Total kelas</h5>
                                        <span class="h2 font-weight-bold mb-0 text-white">
                                            {{ auth()->user()->teacher->classrooms_count }}
                                        </span>
                                    </div>
                                    <div class="col-auto">
                                        <div class="icon icon-shape bg-white text-dark rounded-circle shadow">
                                            <i class="bi bi-hdd-stack-fill"></i>
                                        </div>
                                    </div>
                                </div>
                                <p class="mt-3 mb-0 text-sm">
                                    <span class="text-nowrap text-light">Saat ini</span>
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="card bg-gradient-danger border-0">
                            <!-- Card body -->
                            <div class="card-body">
                                <div class="row">
                                    <div class="col">
                                        <h5 class="card-title text-uppercase text-muted mb-0 text-white">Total Kehadiran </h5>
                                        <span class="h2 font-weight-bold mb-0 text-white">
                                            {{ auth()->user()->teacher->attendances_count }}
                                        </span>
                                    </div>
                                    <div class="col-auto">
                                        <div class="icon icon-shape bg-white text-dark rounded-circle shadow">
                                            <i class="bi bi-cursor-fill"></i>
                                        </div>
                                    </div>
                                </div>
                                <p class="mt-3 mb-0 text-sm">
                                    <span class="text-nowrap text-light">Selama satu bulan terakhir</span>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card" id="profile">
                    <div class="card-header">
                        <div class="row align-items-center">
                            <div class="col-8">
                                <h3 class="mb-0">Edit profil</h3>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                <span class="alert-icon"><i class="bi bi-exclamation-circle-fill"></i></span>
                                <span class="alert-text"><strong>Sukses: </strong>Data berhasil diubah</span>
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                        @endif
                        @if($errors->updateProfileInformation->any())
                            @foreach ($errors->updateProfileInformation->all() as $error)
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                <span class="alert-icon"><i class="bi bi-x-circle-fill"></i></span>
                                <span class="alert-text"><strong>Eror! </strong>{{ $error }}</span>
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            @endforeach
                        @endif
                        @if($errors->updatePassword->any())
                            @foreach ($errors->updatePassword->all() as $error)
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                <span class="alert-icon"><i class="bi bi-x-circle-fill"></i></span>
                                <span class="alert-text"><strong>Eror! </strong>{{ $error }}</span>
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            @endforeach
                        @endif
                        <form method="POST" action="{{ route('user-profile-information.update') }}" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')

                            <h6 class="heading-small text-muted mb-4">Informasi Pengguna</h6>

                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label class="form-control-label" for="name">Nama</label>
                                        <input type="text" id="name" name="name" class="form-control" value="{{ auth()->user()->teacher->name }}">
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label class="form-control-label" for="username">Username</label>
                                        <input type="text" id="username" name="username" class="form-control" value="{{ auth()->user()->username }}">
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <label class="form-control-label" for="email">Email</label>
                                        <input type="email" id="email" name="email" class="form-control" value="{{ auth()->user()->email }}">
                                    </div>
                                </div>
                                <div class="col-lg">
                                    <div class="form-group">
                                        <label class="form-control-label" for="profile_photo">Foto Profil</label>
                                        <input type="file" id="profile_photo" name="profile_photo" class="form-control" onchange="document.getElementById('preview').src = window.URL.createObjectURL(this.files[0])">
                                    </div>
                                </div>
                            </div>

                            <hr class="my-4">

                            <!-- Information -->
                            <h6 class="heading-small text-muted mb-4">Informasi Guru</h6>

                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label class="form-control-label" for="address">Address</label>
                                        <input id="address" name="address" class="form-control" value="{{ auth()->user()->teacher->address }}" type="text">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label class="form-control-label" for="birthplace">Tempat Lahir</label>
                                        <input type="text" id="birthplace" name="birthplace" class="form-control" value="{{ auth()->user()->teacher->birthplace }}">
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label class="form-control-label" for="birthdate">Tanggal Lahir</label>
                                        <input type="datepicker" id="birthdate" name="birthdate" class="form-control datepicker" data-date-format="yyyy-mm-dd" value="{{ auth()->user()->teacher->birthdate }}">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label class="form-control-label" for="phone">Telepon</label>
                                        <input type="text" id="phone" name="phone" class="form-control" value="{{ auth()->user()->teacher->phone }}">
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label class="form-control-label" for="field">Bidang</label>
                                        <input type="text" id="field" name="field" class="form-control" value="{{ auth()->user()->teacher->field }}">
                                    </div>
                                </div>
                            </div>
                            <button class="btn btn-default" type="submit">Simpan</button>
                        </form>

                        <hr class="my-4">

                        <h6 class="heading-small text-muted mb-4">Ubah Password</h6>

                        <form method="POST" action="{{ route('user-password.update') }}">
                            @csrf
                            @method('PUT')

                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <label class="form-control-label" for="current_password">Password Lama</label>
                                        <input type="password" id="current_password" name="current_password" class="form-control"
                                            placeholder="Password Lama">
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label class="form-control-label" for="password">Password Baru</label>
                                        <input type="password" id="password" name="password" class="form-control"
                                            placeholder="Password Lama">
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label class="form-control-label" for="password_confirmation">Konfirmasi Password</label>
                                        <input type="password" id="password_confirmation" name="password_confirmation" class="form-control"
                                            placeholder="Konfirmasi Password">
                                    </div>
                                </div>
                            </div>
                            <button class="btn btn-default" type="submit">Ubah</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <x-datepicker/>
</x-app-layout>
