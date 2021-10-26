<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Attendance extends Model
{
    use HasFactory, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'schedule_id',
        'attendanceable_id',
        'attendanceable_type',
        'latitude',
        'longitude',
        'status',
    ];

    /**
     * Get the parent attendanceable model (teacher or student).
     */
    public function attendanceable()
    {
        return $this->morphTo();
    }

    /**
     * Get the schedule that owns the attendance.
     */
    public function schedule()
    {
        return $this->belongsTo(Schedule::class);
    }

    /**
     * Get the attendance's formatted created at.
     *
     * @return string
     */
    public function getFormattedCreatedAtAttribute()
    {
        return Carbon::parse($this->created_at)->locale('id')->isoFormat('LLLL');
    }

    /**
     * Scope a query to only include attendances by days interval.
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeInterval($query, $days)
    {
        return $query->whereBetween('attendances.created_at', [now()->subDays($days), now()]);
    }

    /**
     * Scope a query to only include students by id.
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @param  \App\Models\Student $student
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeOfStudent($query, Student $student)
    {
        return $query->whereHasMorph('attendanceable', Student::class, function ($query) use ($student) {
            $query->where('id', $student->id)->latest();
        });
    }

    /**
     * Scope a query to only include teacher by id.
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @param  \App\Models\Teacher $teacher
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeOfTeacher($query, Teacher $teacher)
    {
        return $query->whereHasMorph('attendanceable', Teacher::class, function ($query) use ($teacher) {
            $query->where('id', $teacher->id)->latest();
        });
    }

    /**
     * Scope a query to only include teacher by id.
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopewithDetail($query)
    {
        return $query->with('schedule.classroom.subject.teacher');
    }
}
