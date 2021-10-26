<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Classroom;
use App\Models\Semester;
use App\Models\Student;
use App\Models\Teacher;

class HomeController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return  \Illuminate\View\View
     */
    public function index()
    {
        $classrooms = Classroom::count();

        $students = Student::count();

        $semester = Semester::active();

        $teachers = Teacher::count();

        return view('admin.home', compact('classrooms', 'students', 'semester', 'teachers'));
    }
}
