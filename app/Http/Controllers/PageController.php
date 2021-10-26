<?php

namespace App\Http\Controllers;

use App\Models\Classroom;
use App\Models\Information;
use App\Models\Student;
use App\Models\Teacher;
use Illuminate\Http\Request;

class PageController extends Controller
{
    /**
     * Show the application welcome page.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $classrooms = Classroom::count();

        $information = Information::all();

        $students = Student::count();

        $teachers = Teacher::count();

        return view('welcome', compact('classrooms', 'information', 'students', 'teachers'));
    }
}
