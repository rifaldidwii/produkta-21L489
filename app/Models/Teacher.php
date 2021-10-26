<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Teacher extends Model
{
    use HasFactory, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id',
        'name',
        'birthplace',
        'birthdate',
        'phone',
        'address',
        'field',
    ];

    /**
     * Get all of the teacher's attendances.
     */
    public function attendances()
    {
        return $this->morphMany(Attendance::class, 'attendanceable');
    }

    /**
     * Get the user that owns the phone.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get all of the classrooms for the teacher.
     */
    public function classrooms()
    {
        return $this->hasManyThrough(Classroom::class, Subject::class);
    }

    /**
     * Get the subjects for the teacher.
     */
    public function subjects()
    {
        return $this->hasMany(Subject::class);
    }

    /**
     * Get the teacher's age.
     *
     * @return string
     */
    public function getAgeAttribute()
    {
        return Carbon::parse($this->birthdate)->diff(now())->format('%y Tahun');
    }

    /**
     * Scope a query to count teacher's classroom.
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeWithCountClassrooms($query)
    {
        return $query->withCount('classrooms');
    }

    /**
     * Scope a query to count teacher's classroom and attendances.
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeWithCountAttendances($query)
    {
        return $query->withCount([
            'attendances' => function ($query) {
                $query->whereBetween('created_at', [now()->subMonth()->startOfMonth(), now()->subMonth()->endOfMonth()]);
            }
        ]);
    }
}
