<nav class="sidenav navbar navbar-vertical fixed-left navbar-expand-xs navbar-light bg-white d-print-none" id="sidenav-main">
    <div class="scrollbar-inner">
        <!-- Brand -->
        <div class="sidenav-header d-flex align-items-center">
            <a class="navbar-brand" href="{{ route('home') }}">
                <img src="https://res.cloudinary.com/lkp-ar-risalah/image/upload/v1622704689/rsz_logo_vlgqiv_pfo0vk.png"
                    height="40" class="navbar-brand-img" alt="...">
            </a>
            <span class="nav-link-text">LKP Ar Risalah</span>
            <div class="ml-auto">
                <!-- Sidenav toggler -->
                <div class="sidenav-toggler d-none d-xl-block" data-action="sidenav-unpin" data-target="#sidenav-main">
                    <div class="sidenav-toggler-inner">
                        <i class="sidenav-toggler-line"></i>
                        <i class="sidenav-toggler-line"></i>
                        <i class="sidenav-toggler-line"></i>
                    </div>
                </div>
            </div>
        </div>
        <div class="navbar-inner">
            <!-- Collapse -->
            <div class="collapse navbar-collapse" id="sidenav-collapse-main">
                <!-- Nav items -->
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('home') }}">
                            <i class="bi bi-house-door text-primary"></i>
                            <span class="nav-link-text">Halaman Utama</span>
                        </a>
                    </li>
                    @if(auth()->user()->isAdmin())
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('admin.teachers.index') }}">
                                <i class="bi bi-briefcase text-orange"></i>
                                <span class="nav-link-text">Guru</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('admin.students.index') }}">
                                <i class="bi bi-journal-bookmark text-info"></i>
                                <span class="nav-link-text">Siswa</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('admin.subjects.index') }}">
                                <i class="bi bi-book text-primary"></i>
                                <span class="nav-link-text">Mapel</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('admin.classrooms.index') }}">
                                <i class="bi bi-bounding-box text-pink"></i>
                                <span class="nav-link-text">Kelas</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('admin.payments.index') }}">
                                <i class="bi bi-credit-card text-success"></i>
                                <span class="nav-link-text">Pembayaran</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('admin.semesters.index') }}">
                                <i class="bi bi-calendar-week text-default"></i>
                                <span class="nav-link-text">Semester</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('admin.information.index') }}">
                                <i class="bi bi-list-check text-primary"></i>
                                <span class="nav-link-text">Informasi</span>
                            </a>
                        </li>
                    @elseif(auth()->user()->isTeacher())
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('teacher.schedules.index') }}">
                                <i class="bi bi-calendar-date text-orange"></i>
                                <span class="nav-link-text">Jadwal</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('teacher.classrooms.index') }}">
                                <i class="bi bi-bounding-box text-pink"></i>
                                <span class="nav-link-text">Kelas</span>
                            </a>
                        </li>
                    @elseif(auth()->user()->isStudent())
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('student.schedules.index') }}">
                                <i class="bi bi-calendar-date text-orange"></i>
                                <span class="nav-link-text">Jadwal</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('student.classrooms.index') }}">
                                <i class="bi bi-bounding-box text-pink"></i>
                                <span class="nav-link-text">Kelas</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('student.payments.index') }}">
                                <i class="bi bi-credit-card text-success"></i>
                                <span class="nav-link-text">Pembayaran</span>
                            </a>
                        </li>
                    @endif
                </ul>
            </div>
        </div>
    </div>
</nav>
