<?php

namespace App\Services;

use App\Models\Subject;
use Illuminate\Support\Collection;

class SubjectService
{
    private $teacherId, $count;
    private $name, $grade;

    /**
     * Create a new service instance.
     *
     * @return void
     */
    public function __construct(int $count, int $teacherId, array $name, array $grade)
    {
        $this->count = $count;
        $this->teacherId = $teacherId;
        $this->name = $name;
        $this->grade = $grade;
    }

    /**
     * Remove duplicate subject entry
     *
     * @return Illuminate\Support\Collection
     */
    public function sanitizeDuplicateSubjects(): Collection
    {
        $collection = collect();

        for ($i = 0; $i < (int) $this->count; $i++) {
            $collection->push([
                'teacher_id' => $this->teacherId,
                'name' => $this->name[$i],
                'grade' => $this->grade[$i],
            ]);
        }

        $unique = $collection->unique(function ($item) {
            $item['name'].$item['grade'];
        });

        $filtered = $unique->reject(function ($value) {
            $subject = Subject::where('teacher_id', $value['teacher_id'])
                ->where('name', $value['name'])
                ->where('grade', $value['grade'])
                ->get();

            return $subject->count() == 1;
        });

        return $filtered;
    }
}
