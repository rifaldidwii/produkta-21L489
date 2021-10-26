<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Models\Classroom;
use App\Services\ClassroomService;

class ClassroomController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        if (auth()->user()->student->payments()->first()->status == 'Belum Dibayar') {
            return redirect()->route('student.payments.index')->with('warning', 'Silahkan melakukan pembayaran terlebih dahulu');
        }

        if (!auth()->user()->student->grade) {
            return redirect()->route('student.home');
        }

        $classrooms = (new ClassroomService(auth()->user()->student->grade))->getClassroomCollection();

        return view('student.classrooms.index', compact('classrooms'));
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

        $classroom->load('subject.teacher', 'schedules');

        $attendances = $classroom->attendances()->ofStudent(auth()->user()->student)->interval(30)->get();

        return view('student.classrooms.show', compact('classroom', 'attendances'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Models\Classroom  $classroom
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Classroom $classroom)
    {
        $this->authorize('update-classroom', $classroom);

        auth()->user()->student->classrooms()->attach($classroom->id);

        return redirect()->route('student.classrooms.index');
    }
}
