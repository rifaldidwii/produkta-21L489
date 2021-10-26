<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Student extends Model
{
    use HasFactory, SoftDeletes;

    /**
     * The "booted" method of the model.
     *
     * @return void
     */
    protected static function booted()
    {
        static::created(function ($student) {
            $student->payments()->create([
                'amount' => 250000,
                'description' => 'Pendaftaran Siswa Baru',
            ]);
        });
    }

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
        'school',
        'grade',
        'parent_name',
        'parent_job',
        'parent_phone',
    ];

    public const GRADE = ['1 SD', '2 SD', '3 SD', '4 SD', '5 SD', '6 SD', '7 SMP', '8 SMP', '9 SMP', '10 SMA', '11 SMA', '12 SMA'];

    /**
     * Get all of the student's attendances.
     */
    public function attendances()
    {
        return $this->morphMany(Attendance::class, 'attendanceable');
    }

    /**
     * The classrooms that belong to the student.
     */
    public function classrooms()
    {
        return $this->belongsToMany(Classroom::class);
    }

    /**
     * Get the payments for the student.
     */
    public function payments()
    {
        return $this->hasMany(Payment::class);
    }

    /**
     * Get the user that owns the phone.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the student's age.
     *
     * @return string
     */
    public function getAgeAttribute()
    {
        return Carbon::parse($this->birthdate)->diff(now())->format('%y Tahun');
    }

    /**
     * Scope a query to only include student by classroom.
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @param  \App\Models\Classroom $classroom
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeOfClassroom($query, Classroom $classroom)
    {
        return $query->whereHas('classrooms', function ($query) use ($classroom) {
            $query->where('id', $classroom->id);
        });
    }

    /**
     * Scope a query to count student's classroom.
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeWithCountClassrooms($query)
    {
        return $query->withCount('classrooms');
    }

    /**
     * Scope a query to count student's classroom and attendances.
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
