<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Classroom extends Model
{
    use HasFactory, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'subject_id',
        'semester_id',
        'name',
        'description',
    ];

    /**
     * Get all of the attendances for the classroom.
     */
    public function attendances()
    {
        return $this->hasManyThrough(Attendance::class, Schedule::class);
    }

    /**
     * Get the semester that owns the classroom.
     */
    public function semester()
    {
        return $this->belongsTo(Semester::class);
    }

    /**
     * Get the schedules for the classroom.
     */
    public function schedules()
    {
        return $this->hasMany(Schedule::class);
    }

    /**
     * The students that belong to the classroom.
     */
    public function students()
    {
        return $this->belongsToMany(Student::class);
    }

    /**
     * Get the subject that owns the classroom.
     */
    public function subject()
    {
        return $this->belongsTo(Subject::class);
    }

    /**
     * Scope a query to only include classrooms by active semester.
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeActive($query)
    {
        return $query->where('semester_id', Semester::active()->id);
    }

    /**
     * Scope a query to only include available classrooms by grade.
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @param string $grade
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeAvailable($query, string $grade)
    {
        return $query->active()->with('subject.teacher')
            ->whereHas('subject', function ($query) use ($grade) {
                $query->where('grade', $grade);
            });
    }

    /**
     * Scope a query to only include registered classrooms by student.
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @param  \App\Models\Student  $student
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeRegistered($query, Student $student)
    {
        return $query->active()->with('subject.teacher')
            ->whereHas('students', function ($query) use ($student) {
                $query->where('student_id', $student->id);
            });
    }

    /**
     * Scope a query to only include classrooms by active semester.
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @param  int  $semesterId
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeSemester($query, int $semesterId)
    {
        return $query->where('semester_id', $semesterId);
    }
}
