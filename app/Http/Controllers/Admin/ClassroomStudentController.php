<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Classroom;
use App\Models\Student;

class ClassroomStudentController extends Controller
{
    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Models\Classroom  $classroom
     * @param  \App\Models\Student  $student
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Classroom $classroom, Student $student)
    {
        $classroom->students()->attach($student);

        return redirect()->route('admin.classrooms.show', $classroom);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Classroom  $classroom
     * @param  \App\Models\Student  $student
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Classroom $classroom, Student $student)
    {
        $attendances = $classroom->attendances()->ofStudent($student);

        if ($attendances->count() > 1) {
            return redirect()->route('admin.classrooms.index')->with('danger', 'Data gagal dihapus, siswa masih memiliki presensi');
        }

        $classroom->students()->detach($student);

        return redirect()->route('admin.classrooms.show', $classroom);
    }
}
