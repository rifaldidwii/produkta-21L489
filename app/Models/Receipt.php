<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Receipt extends Model
{
    use HasFactory, SoftDeletes;

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'order_items' => 'array'
    ];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'payment_id',
        'reference',
        'merchant_ref',
        'payment_selection_type',
        'payment_method',
        'payment_name',
        'customer_name',
        'customer_email',
        'customer_phone',
        'amount',
        'fee_merchant',
        'amount_received',
        'checkout_url',
        'status',
        'paid_time',
        'expired_time',
        'order_items',
    ];

    /**
     * Get the payment that owns the receipt.
     */
    public function payment()
    {
        return $this->belongsTo(Payment::class);
    }

    /**
     * Get the attendance's formatted created at.
     *
     * @return string
     */
    public function getFormattedUpdatedAtAttribute()
    {
        return Carbon::parse($this->updated_at)->locale('id')->isoFormat('LLLL');
    }
}
