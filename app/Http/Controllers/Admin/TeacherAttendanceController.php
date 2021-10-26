<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Attendance;
use App\Models\Teacher;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class TeacherAttendanceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param  \App\Models\Teacher
     * @param  \Illuminate\Http\Request
     * @return \Yajra\DataTables\DataTables|\Illuminate\View\View
     */
    public function index(Teacher $teacher, Request $request)
    {
        if ($request->ajax()) {
            $attendance = Attendance::ofTeacher($teacher)->withDetail()->select('attendances.*');

            return DataTables::of($attendance)
                ->addIndexColumn()
                ->editColumn('created_at', function ($attendance){
                    return  $attendance->formatted_created_at;
                })
                ->filter(function ($attendances) use ($request) {
                    return ($request->days) ? $attendances->interval($request->days) : $attendances;
                })
                ->toJson();
        }

        return view('admin.teachers.attendances.index', compact('teacher'));
    }
}
