<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Models\Schedule;
use App\Models\Student;

class HomeController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        auth()->user()->load(['student' => function ($query) {
            $query->withCountClassrooms()->withCountAttendances();
        }]);

        $grades = Student::GRADE;

        $schedules = Schedule::weekly(auth()->user()->student->classrooms()->pluck('id'))->get();

        return view('student.home', compact('grades', 'schedules'));
    }
}
