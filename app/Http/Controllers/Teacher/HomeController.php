<?php

namespace App\Http\Controllers\Teacher;

use App\Http\Controllers\Controller;
use App\Models\Schedule;

class HomeController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        auth()->user()->load(['teacher' => function ($query) {
            $query->withCountClassrooms()->withCountAttendances();
        }]);

        $schedules = Schedule::weekly(auth()->user()->teacher->classrooms()->pluck('classrooms.id'))->get();

        return view('teacher.home', compact('schedules'));
    }
}
