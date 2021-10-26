<?php

namespace App\Http\Controllers\Teacher;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreAttendanceRequest;
use App\Models\Schedule;
use App\Models\Student;
use App\Services\AttendanceService;

class ScheduleAttendanceController extends Controller
{
    /**
     * Show the form for creating a new resource.
     *
     * @param  \App\Models\Schedule  $schedule
     * @return \Illuminate\View\View
     */
    public function create(Schedule $schedule)
    {
        $this->authorize('create-attendance', $schedule);

        $students = Student::ofClassroom($schedule->classroom)->get();

        return view('teacher.attendances.create', compact('schedule', 'students'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Models\Schedule  $schedule
     * @param  \App\Http\Requests\StoreAttendanceRequest  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Schedule $schedule, StoreAttendanceRequest $request)
    {
        $this->authorize('create-attendance', $schedule);

        $attendanceService = new AttendanceService($schedule);

        $status = $attendanceService->getAttendanceStatus($request->latitude, $request->longitude);

        if (substr($status, -9) == 'Luar Area') {
            return redirect()->route('teacher.schedules.index')->with('danger', 'Silahkan ulangi presensi dengan berpindah ke dalam area LKP Ar Risalah');
        }

        auth()->user()->teacher->attendances()->create(
            [
                'schedule_id' => $schedule->id,
                'status' => $status
            ] + $request->validated()
        );

        $attendanceService->fillStudentAttendances($request->students);

        return redirect()->route('teacher.schedules.index')->with('success', 'Data presensi berhasil ditambahkan');
    }
}
