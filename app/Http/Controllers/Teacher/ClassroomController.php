<?php

namespace App\Http\Controllers\Teacher;

use App\Http\Controllers\Controller;
use App\Models\Classroom;

class ClassroomController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $classrooms = auth()->user()->load(['teacher' => function ($query) {
            $query->with(['classrooms' => function ($query) {
                $query->with('subject')->active();
            }]);
        }]);

        return view('teacher.classrooms.index', compact('classrooms'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Classroom  $classroom
     * @return \Illuminate\View\View
     */
    public function show(Classroom $classroom)
    {
        $this->authorize('view-classroom', $classroom);

        $classroom->load('subject', 'semester' ,'students');

        $attendances = $classroom->attendances()->ofTeacher(auth()->user()->teacher)->interval(30)->get();

        return view('teacher.classrooms.show', compact('classroom', 'attendances'));
    }
}
