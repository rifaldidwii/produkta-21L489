<?php

namespace App\Http\Controllers\Teacher;

use App\Http\Controllers\Controller;
use App\Models\Classroom;
use App\Models\Student;

class ClassroomStudentController extends Controller
{
    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Classroom  $classroom
     * @return \Illuminate\View\View
     */
    public function show(Classroom $classroom, Student $student)
    {
        $this->authorize('view-student', [$classroom, $student]);

        $attendances = $classroom->attendances()->ofStudent($student)->interval(30)->get();

        return view('teacher.classrooms.students.show', compact('attendances', 'student'));
    }
}
