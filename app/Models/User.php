<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Http\UploadedFile;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Hash;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasFactory, Notifiable, SoftDeletes;

    /**
     * The "booted" method of the model.
     *
     * @return void
     */
    protected static function booted()
    {
        static::created(function ($user) {
            $user->forceFill(
                ['profile_photo' => 'https://ui-avatars.com/api/?name=' . urlencode($user->username) . '&size=512']
            )->save();
        });
    }

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'role_id',
        'username',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * Get the role that owns the user.
     */
    public function role()
    {
        return $this->belongsTo(Role::class);
    }

    /**
     * Get the student associated with the user.
     */
    public function student()
    {
        return $this->hasOne(Student::class);
    }

    /**
     * Get the teacher associated with the user.
     */
    public function teacher()
    {
        return $this->hasOne(Teacher::class);
    }

    /**
     * Check whether user is admin.
     */
    public function isAdmin()
    {
        return $this->role_id == 1;
    }

    /**
     * Check whether user is teacher.
     */
    public function isTeacher()
    {
        return $this->role_id == 2;
    }

    /**
     * Check whether user is student.
     */
    public function isStudent()
    {
        return $this->role_id == 3;
    }

    /**
     * Set the user's password.
     *
     * @param  string  $value
     * @return void
     */
    public function setPasswordAttribute($value)
    {
        $this->attributes['password'] = Hash::needsRehash($value) ? Hash::make($value) : $value;
    }

    /**
     * Update the user's profile photo.
     *
     * @param  \Illuminate\Http\UploadedFile  $photo
     * @return void
     */
    public function updateProfilePhoto(UploadedFile $photo)
    {
        $this->forceFill([
            'profile_photo' => cloudinary()->upload($photo->getRealPath(), [
                'transformation' => [
                    'gravity' => 'auto',
                    'width' => 512,
                    'height' => 512,
                    'crop' => 'crop',
                    'quality' => 'auto',
                    'fetch_format' => 'auto'
                ]
            ])->getSecurePath()
        ])->save();
    }

    /**
     * Update the user's password.
     *
     * @param  string  $password
     * @return void
     */
    public function updatePassword(string $password)
    {
        $this->forceFill([
            'password' => Hash::make($password),
        ])->save();
    }

    /**
     * Mark the user's email as verified.
     *
     * @return void
     */
    public function markEmailAsVerified()
    {
        $this->forceFill([
            'email_verified_at' => now(),
        ])->save();
    }
}
