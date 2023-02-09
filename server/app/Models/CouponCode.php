<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Testing\Fluent\Concerns\Has;

class CouponCode extends Model
{
    use HasFactory;

    const TYPE_ONE = 1;
    const TYPE_MANY = 2;

    const AMOUNT_TYPE_PERCENT = 1;
    const AMOUNT_TYPE_PRICE = 2;
    const STATUS_ENABLE = 1;
    const STATUS_DISABLE = 0;

    const CODE_FREESHIP = 'HKPM.VN';
    const CODE_CREPHKPM = 'CREPHKPM';
    const CODE_CONIC30 = 'CONIC30';

    protected $table = 'coupon_codes';
    protected $guarded = ['id'];
    protected $fillable = [
        'code',
        'coupon_code_events_id',
        'status',
        'count',
        'limit',
        'amount',
        'amount_type',
        'created_at',
        'updated_at',
    ];

    /**
     * @return BelongsTo
     */
    public function couponCodeEvents(): BelongsTo
    {
        return $this->belongsTo(CouponCodeEvent::class)->orderBy('created_at', 'desc');
    }

    /**
     * Return the collection of coupon code history associated with the model
     *
     * @return HasMany
     */
    public function couponCodeHistories(): HasMany
    {
        return $this->hasMany(CouponCodeHistory::class, 'coupon_code_id', 'id');
    }

    /**
     * @return BelongsTo
     */
    public function orderDetail(): BelongsTo
    {
        return $this->belongsTo(OrderDetail::class, 'code', 'coupon_code');
    }
}
