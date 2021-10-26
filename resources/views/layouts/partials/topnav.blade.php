<!-- Topnav -->
<nav
    class="navbar navbar-top navbar-expand navbar-dark bg-primary border-bottom d-print-none">
    <div class="container-fluid">
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <!-- Navbar links -->
            <ul class="navbar-nav align-items-center ml-md-auto">
                <li class="nav-item d-none d-lg-block d-xl-none">
                    <!-- Sidenav toggler -->
                    <div class="pr-3 sidenav-toggler sidenav-toggler-dark" data-action="sidenav-pin"
                        data-target="#sidenav-main">
                        <div class="sidenav-toggler-inner">
                            <i class="sidenav-toggler-line"></i>
                            <i class="sidenav-toggler-line"></i>
                            <i class="sidenav-toggler-line"></i>
                        </div>
                    </div>
                </li>
                @if (auth()->user()->isStudent())
                    <li class="nav-item dropdown">
                        <a class="nav-link" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="bi bi-bell-fill"></i>
                        </a>
                        <div class="dropdown-menu dropdown-menu-xl dropdown-menu-right py-0 overflow-hidden">
                        <!-- Dropdown header -->
                        <div class="px-3 py-3">
                            <h6 class="text-sm text-muted m-0">Kamu memiliki <strong class="text-primary">{{ auth()->user()->unreadNotifications->count() }}</strong> notifikasi.
                            </h6>
                        </div>
                        <!-- List group -->
                        <div class="list-group list-group-flush">
                            @foreach (auth()->user()->unreadNotifications as $notification)
                                <a href="#" class="list-group-item list-group-item-action">
                                    <div class="row align-items-center">
                                        <div class="col-auto">
                                            <!-- Avatar -->
                                            <img alt="Image placeholder" src="{{ $notification->data['image'] }}"
                                            class="avatar rounded-circle">
                                        </div>
                                        <div class="col ml--2">
                                            <div class="d-flex justify-content-between align-items-center">
                                                <div>
                                                    <h4 class="mb-0 text-sm">{{ $notification->data['sender'] }}</h4>
                                                </div>
                                                <div class="text-right text-muted">
                                                    <small>{{ Carbon\Carbon::parse($notification->created_at)->locale('id')->diffForHumans() }}</small>
                                                </div>
                                            </div>
                                            <p class="text-sm mb-0">{{ $notification->data['message'] }}</p>
                                        </div>
                                    </div>
                                </a>
                            @endforeach
                            @if (auth()->user()->unreadNotifications->count() > 0)
                                <a href="#" class="dropdown-item text-center text-primary font-weight-bold py-3" onclick="event.preventDefault();
                                document.getElementById('update-form').submit();">Tandai sudah dibaca</a>
                                <form id="update-form" action="{{ route('student.notifications.update') }}" method="POST"
                                class="d-none">
                                    @csrf
                                    @method('PUT')
                                </form>
                            @endif
                        </div>
                    </li>
                @endif
                <li class="nav-item dropdown d-xl-none d-lg-none">
                    <a class="nav-link" href="#" role="button" data-toggle="dropdown" aria-haspopup="true"
                        aria-expanded="false">
                        <i class="bi bi-command"></i>
                    </a>
                    <div class="dropdown-menu dropdown-menu-lg dropdown-menu-dark bg-default dropdown-menu-right">
                        <div class="row shortcuts px-4">
                            <a href="{{ route('home') }}" class="col-4 shortcut-item">
                                <span class="shortcut-media avatar rounded-circle bg-gradient-red">
                                    <i class="bi bi-house-door"></i>
                                </span>
                                <small>Home</small>
                            </a>
                            @if (auth()->user()->isAdmin())
                                <a href="{{ route('admin.teachers.index') }}" class="col-4 shortcut-item">
                                    <span class="shortcut-media avatar rounded-circle bg-gradient-orange">
                                        <i class="bi bi-briefcase"></i>
                                    </span>
                                    <small>Guru</small>
                                </a>
                                <a href="{{ route('admin.students.index') }}" class="col-4 shortcut-item">
                                    <span class="shortcut-media avatar rounded-circle bg-gradient-info">
                                        <i class="bi bi-journal-bookmark"></i>
                                    </span>
                                    <small>Siswa</small>
                                </a>
                                <a href="{{ route('admin.subjects.index') }}" class="col-4 shortcut-item">
                                    <span class="shortcut-media avatar rounded-circle bg-gradient-green">
                                        <i class="bi bi-map"></i>
                                    </span>
                                    <small>Mapel</small>
                                </a>
                                <a href="{{ route('admin.classrooms.index') }}" class="col-4 shortcut-item">
                                    <span class="shortcut-media avatar rounded-circle bg-gradient-purple">
                                        <i class="bi bi-bounding-box"></i>
                                    </span>
                                    <small>Kelas</small>
                                </a>
                                <a href="{{ route('admin.payments.index') }}" class="col-4 shortcut-item">
                                    <span class="shortcut-media avatar rounded-circle bg-gradient-yellow">
                                        <i class="bi bi-credit-card"></i>
                                    </span>
                                    <small>Pembayaran</small>
                                </a>
                            @elseif (auth()->user()->isTeacher())
                                <a href="{{ route('teacher.schedules.index') }}" class="col-4 shortcut-item">
                                    <span class="shortcut-media avatar rounded-circle bg-gradient-orange">
                                        <i class="bi bi-calendar-date"></i>
                                    </span>
                                    <small>Jadwal</small>
                                </a>
                                <a href="{{ route('teacher.classrooms.index') }}" class="col-4 shortcut-item">
                                    <span class="shortcut-media avatar rounded-circle bg-gradient-info">
                                        <i class="bi bi-bounding-box"></i>
                                    </span>
                                    <small>Kelas</small>
                                </a>
                            @elseif (auth()->user()->isStudent())
                                <a href="{{ route('student.schedules.index') }}" class="col-4 shortcut-item">
                                    <span class="shortcut-media avatar rounded-circle bg-gradient-orange">
                                        <i class="bi bi-briefcase"></i>
                                    </span>
                                    <small>Jadwal</small>
                                </a>
                                <a href="{{ route('student.classrooms.index') }}" class="col-4 shortcut-item">
                                    <span class="shortcut-media avatar rounded-circle bg-gradient-info">
                                        <i class="bi bi-bounding-box"></i>
                                    </span>
                                    <small>Kelas</small>
                                </a>
                                <a href="{{ route('student.payments.index') }}" class="col-4 shortcut-item">
                                    <span class="shortcut-media avatar rounded-circle bg-gradient-green">
                                        <i class="bi-credit-card"></i>
                                    </span>
                                    <small>Pembayaran</small>
                                </a>
                            @endif
                        </div>
                    </div>
                </li>
            </ul>
            <ul class="navbar-nav align-items-center ml-auto ml-md-0">
                <li class="nav-item dropdown">
                    <a class="nav-link pr-0" href="#" role="button" data-toggle="dropdown" aria-haspopup="true"
                        aria-expanded="false">
                        <div class="media align-items-center">
                            <span class="avatar avatar-sm rounded-circle">
                                <img alt="Image placeholder" src="{{ auth()->user()->profile_photo }}">
                            </span>
                            <div class="media-body ml-2 d-none d-lg-block">
                                <span class="mb-0 text-sm font-weight-bold">{{ auth()->user()->username }}</span>
                            </div>
                        </div>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right">
                        <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logout-modal">
                            <span>Keluar</span>
                        </a>
                    </div>
                </li>
            </ul>
        </div>
    </div>
</nav>
