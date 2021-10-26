<?php

namespace App\Services;

use App\Models\Classroom;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\JsonResponse;

class ClassroomService
{
    private $grade;

    /**
     * Create a new service instance.
     *
     * @return void
     */
    public function __construct($grade)
    {
        $this->grade = $grade;
    }

    /**
     * Get classroom html options for student by grade
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function getClassroomOptions(): JsonResponse
    {
        $classrooms = Classroom::with('subject.teacher')->available($this->grade)->get();

        $html = '';
        foreach ($classrooms as $classroom) {
            $html .= '<option value="' . $classroom->id . '">' . $classroom->name . ' - ' .  $classroom->subject->name . ' : ' . $classroom->subject->teacher->name . '</option>';
        }

        return response()->json(compact('html'));
    }

    /**
     * Get available or registered classroom for student by grade
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getClassroomCollection(): Collection
    {
        auth()->user()->load(['student' => function ($query) {
            $query->withCountClassrooms();
        }]);

        if (auth()->user()->student->classrooms_count != 4) {
            return Classroom::available(auth()->user()->student->grade)->get();
        }

        return Classroom::registered(auth()->user()->student)->get();
    }
}
