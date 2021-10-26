<?php

namespace Database\Seeders;

use App\Models\Classroom;
use App\Models\Student;
use Illuminate\Database\Seeder;

class ClassroomStudentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $students = Student::all();
        $classrooms = Classroom::with('subject')->get();

        foreach ($students as $student) {
            foreach ($classrooms as $classroom) {
                if ($student->grade == $classroom->subject->grade)
                    $student->classrooms()->attach($classroom->id);
            }
        }
    }
}
