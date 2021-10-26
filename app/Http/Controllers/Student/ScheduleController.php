<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Http\Resources\ScheduleCollection;
use App\Models\Schedule;

class ScheduleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $schedules = new ScheduleCollection(
            Schedule::forClassrooms(auth()->user()->student->classrooms()->pluck('id'))->get()
        );

        return view('student.schedules.index', compact('schedules'));
    }
}
