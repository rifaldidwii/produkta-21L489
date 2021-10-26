<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Payment extends Model
{
    use HasFactory, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'student_id',
        'amount',
        'description',
        'status'
    ];

    public const METHOD = ['BRIVA', 'BNIVA', 'MANDIRIVA', 'BCAVA'];

    /**
     * Get the receipt associated with the payment.
     */
    public function receipt()
    {
        return $this->hasOne(Receipt::class);
    }

    /**
     * Get the student that owns the payment.
     */
    public function student()
    {
        return $this->belongsTo(Student::class);
    }

    /**
     * Get the payments's formatted ampunt.
     *
     * @return string
     */
    public function getFormattedAmountAttribute()
    {
        return 'Rp. ' . number_format($this->amount);
    }

    /**
     * Get the payment's formatted created at.
     *
     * @return string
     */
    public function getFormattedCreatedAtAttribute()
    {
        return Carbon::parse($this->created_at)->locale('id')->isoFormat('LLLL');
    }

    /**
     * Get the payment's formatted updated at.
     *
     * @return string
     */
    public function getFormattedUpdatedAtAttribute()
    {
        return Carbon::parse($this->updated_at)->locale('id')->isoFormat('LLLL');
    }
}
