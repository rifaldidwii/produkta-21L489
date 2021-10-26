<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Collection;

class Schedule extends Model
{
    use HasFactory, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'classroom_id',
        'start_time',
        'end_time',
        'recurrence_times',
        'recurrence_interval',
        'schedule_id',
        'color'
    ];

    public const COLOR = ['#11cdef', '#fb6340', '#f5365c', '#2dce89', '#172b4d', '#0a48b3'];

    /**
     * Get the classroom that own the schedule.
     */
    public function classroom()
    {
        return $this->belongsTo(Classroom::class);
    }

    /**
     * Get the attendances for the schedule.
     */
    public function attendances()
    {
        return $this->hasMany(Attendance::class);
    }

    /**
     * Get the childs for the schedule.
     */
    public function schedules()
    {
        return $this->hasMany(Schedule::class);
    }

    /**
     * Get the parent that own the schedule.
     */
    public function schedule()
    {
        return $this->belongsTo(Schedule::class);
    }

    /**
     * Get the schedule's teacher.
     */
    public function getTeacherAttribute()
    {
        return $this->classroom->subject->teacher;
    }

    /**
     * Get the schedule's formatted start time.
     *
     * @return string
     */
    public function getFormattedStartTimeAttribute()
    {
        return Carbon::parse($this->start_time)->locale('id')->isoFormat('LLLL');
    }

    /**
     * Get the schedule's formatted end time.
     *
     * @return string
     */
    public function getFormattedEndTimeAttribute()
    {
        return Carbon::parse($this->end_time)->locale('id')->isoFormat('LLLL');
    }

    /**
     * Scope a query to only schedules by classroom id.
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @param  \Illuminate\Support\Collection $classroomId
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeForClassrooms($query, Collection $classroomId)
    {
        return $query->with('classroom.subject')->withCount('attendances')->orderBy('start_time')
            ->whereIn('classroom_id', $classroomId);
    }

    /**
     * Scope a query to only include weekly schedules by classroom id.
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @param  \Illuminate\Support\Collection $classroomId
     * @return \Illuminate\Databa   se\Eloquent\Builder
     */
    public function scopeWeekly($query, Collection $classroomId)
    {
        return $query->forClassrooms($classroomId)
            ->whereBetween('start_time', [now(), now()->addWeek()]);
    }
}
