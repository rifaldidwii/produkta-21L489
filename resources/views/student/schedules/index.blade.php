<x-app-layout>
    <!-- Title -->
    <x-title text="Jadwal">
        <div class="col-lg-6 mt-3 mt-lg-0 text-lg-right">
            <a href="#" class="fullcalendar-btn-prev btn btn-sm btn-neutral">
                <i class="bi bi-chevron-left"></i>
            </a>
            <a href="#" class="fullcalendar-btn-next btn btn-sm btn-neutral">
                <i class="bi bi-chevron-right"></i>
            </a>
            <a href="#" class="btn btn-sm btn-neutral" data-calendar-view="month">Month</a>
            <a href="#" class="btn btn-sm btn-neutral" data-calendar-view="basicWeek">Week</a>
            <a href="#" class="btn btn-sm btn-neutral" data-calendar-view="basicDay">Day</a>
        </div>
    </x-title>

    <!-- Page content -->
    <x-app-card>
        <!-- Card header -->
        <x-slot name="header">
            Kalender Jadwal
        </x-slot>

        <!-- Card body -->
        <div class="card-body p-0">
            <div class="calendar" id="calendar">

            </div>
        </div>
    </x-app-card>

    <div class="container-fluid mt-4">
        <div class="card mb-4">
            <div class="card-header">
                <h3 class="mb-0">Jadwal Mingguan</h3>
            </div>

            <!-- Card body -->
            <div class="card">
                <div class="card-body">
                    <div class="timeline timeline-one-side" data-timeline-content="axis" data-timeline-axis-style="dashed">
                        @foreach ($schedules as $schedule)
                            @if ($schedule->start_time > now() && $schedule->start_time < now()->addDays(7))
                                <div class="timeline-block">
                                    @if ($loop->iteration % 2 == 0)
                                        <span class="timeline-step badge-success">
                                            <i class="bi bi-bell-fill"></i>
                                        </span>
                                    @else
                                        <span class="timeline-step badge-info">
                                            <i class="bi bi-bell-fill"></i>
                                        </span>
                                    @endif
                                    <div class="timeline-content">
                                        <small class="text-muted font-weight-bold">
                                            {{ $schedule->formatted_start_time }}
                                        </small>
                                        <a href="{{ route('student.classrooms.show', $schedule->classroom) }}">
                                            <h5 class="mt-3 mb-0">{{ $schedule->classroom->name }}</h5>
                                        </a>
                                        <div class="mt-3">
                                            @if ($loop->iteration % 2 == 0)
                                                <span class="badge badge-pill badge-success">
                                                    {{ $schedule->classroom->subject->name }}
                                                </span>
                                                <span class="badge badge-pill badge-success">
                                                    {{ $schedule->classroom->subject->grade }}
                                                </span>
                                            @else
                                                <span class="badge badge-pill badge-info">
                                                    {{ $schedule->classroom->subject->name }}
                                                </span>
                                                <span class="badge badge-pill badge-info">
                                                    {{ $schedule->classroom->subject->grade }}
                                                </span>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            @endif
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>

    @foreach ($schedules as $schedule)
        <div class="modal fade" id="modal-show-schedule-{{ $schedule->id }}" tabindex="-1" role="dialog" aria-labelledby="modal-show-schedule-{{ $schedule->id }}" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header align-items-center">
                        <h6 class="modal-title" id="modal-title-default">Detail Data Jadwal</h6>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <ul class="list-group">
                            <li class="list-group-item title"></li>
                            <li class="list-group-item start"></li>
                            <li class="list-group-item end"></li>
                        </ul>
                    </div>
                    <div class="modal-footer">
                        <a href="{{ route('student.classrooms.show', $schedule->classroom) }}" class="btn btn-info">Kelas</a>
                        <button type="button" class="btn btn-link  ml-auto" data-dismiss="modal">Tutup</button>
                    </div>
                </div>
            </div>
        </div>
    @endforeach

    <x-fullcalendar :schedules="$schedules"/>
</x-app-layout>
