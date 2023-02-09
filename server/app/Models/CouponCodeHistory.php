<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class CouponCodeHistory extends Model
{
    use HasFactory;

    protected $table = 'coupon_code_history';

    protected $fillable = [
        'user_id',
        'coupon_code_id',
        'coupon_code_event_id',
        'order_details_id'
    ];

    /**
     * @return HasOne
     */
    public function code(): HasOne
    {
        return $this->hasOne(CouponCode::class, 'id', 'coupon_code_id');
    }

    /**
     * @return BelongsTo
     */
    public function customer(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    /**
     * @return BelongsTo
     *
     */
    public function orderDetail(): BelongsTo
    {
        return $this->belongsTo(OrderDetail::class, 'order_details_id', 'id');
    }
}
