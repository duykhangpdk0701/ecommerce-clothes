<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class CouponCodeEvent extends Model
{
    use HasFactory;

    const TYPE_PUBLIC = 1;
    const TYPE_SYSTEM = 2;
    const COUPON_EVENT_ENABLE = 0;
    const COUPON_EVENT_DISABLE = 1;
    protected $table = 'coupon_code_events';
    protected $guarded = ['id'];
    protected $fillable = [
        'name',
        'description',
        'status',
        'type',
        'created_at',
        'created_by',
        'start_date',
        'end_date'
    ];

    /**
     * @param $id
     * @return array|string
     */
    public static function getTypes($id = null): array|string
    {
        $data = [
            self::TYPE_PUBLIC => 'Public',
            self::TYPE_SYSTEM => 'System',
        ];

        if ($id !== null && isset($data[$id])) {
            return $data[$id];
        } else {
            return $data;
        }
    }

    /**
     * @return HasMany
     */
    public function couponCode(): HasMany
    {
        return $this->hasMany(CouponCode::class, 'coupon_code_events_id');
    }
}
