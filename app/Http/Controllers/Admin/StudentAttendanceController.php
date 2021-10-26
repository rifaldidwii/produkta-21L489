<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Attendance;
use App\Models\Student;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class StudentAttendanceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param  \App\Models\Student
     * @param  \Illuminate\Http\Request
     * @return \Yajra\DataTables\DataTables|\Illuminate\View\View
     */
    public function index(Student $student, Request $request)
    {
        if ($request->ajax()) {
            $attendance = Attendance::ofStudent($student)->withDetail()->select('attendances.*');

            return DataTables::of($attendance)
                ->addIndexColumn()
                ->editColumn('created_at', function ($attendance) {
                    return $attendance->formatted_created_at;
                })
                ->editColumn('latitude', function ($attendance) {
                    return $attendance->latitude ?? '- ';
                })
                ->editColumn('longitude', function ($attendance) {
                    return $attendance->longitude ?? '- ';
                })
                ->filter(function ($attendances) use ($request) {
                    return ($request->days) ? $attendances->interval($request->days) : $attendances;
                })
                ->toJson();
        }

        return view('admin.students.attendances.index', compact('student'));
    }
}
