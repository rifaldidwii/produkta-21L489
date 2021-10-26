<x-app-layout>
    <!-- Title -->
    <div class="header bg-primary pb-6">
        <div class="container-fluid">
            <div class="header-body">
                <div class="row align-items-center py-4">
                    <div class="col-lg-6 col-7">
                        <h6 class="h2 text-white d-inline-block mb-0">Halaman Utama</h6>
                    </div>
                </div>
                <!-- Card stats -->
                <div class="row">
                    <div class="col-xl-3 col-md-6">
                        <div class="card card-stats">
                            <!-- Card body -->
                            <div class="card-body">
                                <div class="row">
                                    <div class="col">
                                        <h5 class="card-title text-uppercase text-muted mb-0">Semester</h5><span
                                            class="h2 font-weight-bold mb-0">{{ $semester->name }}</span>
                                    </div>
                                    <div class="col-auto">
                                        <div class="icon icon-shape bg-gradient-red text-white rounded-circle shadow"><i
                                                class="bi bi-calendar-week"></i></div>
                                    </div>
                                </div>
                                <p class="mt-3 mb-0 text-sm"><span class="text-nowrap">Tahun Ajaran {{ $semester->academic_year }}</span></p>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3 col-md-6">
                        <div class="card card-stats">
                            <!-- Card body -->
                            <div class="card-body">
                                <div class="row">
                                    <div class="col">
                                        <h5 class="card-title text-uppercase text-muted mb-0">Jumlah Siswa</h5><span
                                            class="h2 font-weight-bold mb-0">{{ $students }}</span>
                                    </div>
                                    <div class="col-auto">
                                        <div
                                            class="icon icon-shape bg-gradient-orange text-white rounded-circle shadow">
                                            <i class="bi bi-journal-bookmark"></i></div>
                                    </div>
                                </div>
                                <p class="mt-3 mb-0 text-sm"><span class="text-nowrap">Saat ini</span></p>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3 col-md-6">
                        <div class="card card-stats">
                            <!-- Card body -->
                            <div class="card-body">
                                <div class="row">
                                    <div class="col">
                                        <h5 class="card-title text-uppercase text-muted mb-0">Jumlah Guru</h5><span
                                            class="h2 font-weight-bold mb-0">{{ $teachers }}</span>
                                    </div>
                                    <div class="col-auto">
                                        <div class="icon icon-shape bg-gradient-green text-white rounded-circle shadow">
                                            <i class="bi bi-briefcase"></i></div>
                                    </div>
                                </div>
                                <p class="mt-3 mb-0 text-sm"><span class="text-nowrap">Saat ini</span></p>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3 col-md-6">
                        <div class="card card-stats">
                            <!-- Card body -->
                            <div class="card-body">
                                <div class="row">
                                    <div class="col">
                                        <h5 class="card-title text-uppercase text-muted mb-0">Jumlah Kelas</h5><span
                                            class="h2 font-weight-bold mb-0">{{ $classrooms }}</span>
                                    </div>
                                    <div class="col-auto">
                                        <div class="icon icon-shape bg-gradient-info text-white rounded-circle shadow">
                                            <i class="bi bi-bounding-box"></i></div>
                                    </div>
                                </div>
                                <p class="mt-3 mb-0 text-sm"><span class="text-nowrap">Tersedia</span></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Page content -->
    <div class="container-fluid mt--6 my-6 py-4"></div>
</x-app-layout>
