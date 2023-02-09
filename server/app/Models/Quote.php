<?php

namespace App\Models;

use App\Traits\Location;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;

class Quote extends Model
{
    use HasFactory, SoftDeletes, Location;

    const QUOTE_PREFIX = 'QUOTE-';
    const STT_DELETE = -1;
    const STT_DRAFT = 0;
    const STT_PENDING = 1;
    const STT_ORDER = 2;

    protected $fillable = [
        'quote_code',
        'email',
        'customer_id',
        'staff_id',
        'billing_name',
        'billing_address',
        'billing_country_id',
        'billing_city_id',
        'billing_district_id',
        'billing_ward_id',
        'billing_phone',
        'billing_tax_code',
        'shipping_name',
        'shipping_address',
        'shipping_country_id',
        'shipping_city_id',
        'shipping_district_id',
        'shipping_ward_id',
        'shipping_phone',
        'payment_method',
        'payment_method_id',
        'payment_code',
        'payment_fee',
        'payment_fee_type',
        'shipper_id',
        'coupon_id',
        'status',
        'comment',
        'total_price',
        'total',
        'total_shipping',
        'total_discount',
        'created_by',
        'updated_by',
        'branch_id'
    ];

    /**
     * @return HasMany
     */
    public function quoteDetail(): HasMany
    {
        return $this->hasMany(QuoteDetail::class, 'quote_id', 'id');
    }

    /**
     * @return BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    /**
     * @return BelongsTo
     */
    public function customer(): BelongsTo
    {
        return $this->belongsTo(User::class, 'customer_id', 'id');
    }

    /**
     * @return BelongsTo
     */
    public function staff(): BelongsTo
    {
        return $this->belongsTo(User::class, 'staff_id', 'id');
    }

    /**
     * @return BelongsTo
     */
    public function billingCountry(): BelongsTo
    {
        return $this->belongsTo(SysCountry::class, 'billing_country_id', 'id');
    }

    /**
     * @return BelongsTo
     */
    public function billingCity(): BelongsTo
    {
        return $this->belongsTo(SysCity::class, 'billing_city_id', 'id');
    }

    /**
     * @return BelongsTo
     */
    public function billingDistrict(): BelongsTo
    {
        return $this->belongsTo(SysDistrict::class, 'billing_district_id', 'id');
    }

    /**
     * @return BelongsTo
     */
    public function billingWard(): BelongsTo
    {
        return $this->belongsTo(SysWard::class, 'billing_ward_id', 'id');
    }

    /**
     * @return BelongsTo
     */
    public function shippingCountry(): BelongsTo
    {
        return $this->belongsTo(SysCountry::class, 'shipping_country_id', 'id');
    }

    /**
     * @return BelongsTo
     */
    public function shippingCity(): BelongsTo
    {
        return $this->belongsTo(SysCity::class, 'shipping_city_id', 'id');
    }

    /**
     * @return BelongsTo
     */
    public function shippingDistrict(): BelongsTo
    {
        return $this->belongsTo(SysDistrict::class, 'shipping_district_id', 'id');
    }

    /**
     * @return BelongsTo
     */
    public function shippingWard(): BelongsTo
    {
        return $this->belongsTo(SysWard::class, 'shipping_ward_id', 'id');
    }

    /**
     * @return BelongsTo
     */
    public function coupon(): BelongsTo
    {
        return $this->belongsTo(CouponCode::class, 'coupon_id', 'id');
    }

    /**
     * @return BelongsTo
     */
    public function paymentMethod(): BelongsTo
    {
        return $this->belongsTo(PaymentMethod::class, 'payment_method_id', 'id');
    }

    /**
     * @return BelongsTo
     */
    public function createdBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'created_by', 'id');
    }

    /**
     * @return BelongsTo
     */
    public function updatedBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'updated_by', 'id');
    }

    /**
     * @return string
     */
    public function shippingAddress(): string
    {
        $this->address = $this->shipping_address;
        $this->street_id = $this->shipping_street_id;
        $this->ward_id = $this->shipping_ward_id;
        $this->district_id = $this->shipping_district_id;
        $this->city_id = $this->shipping_city_id;
        return $this->locationToText();
    }
}
