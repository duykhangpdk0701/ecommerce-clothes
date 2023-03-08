<?php

namespace App\Models;

use App\Traits\Location;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Order extends Model
{
    use HasFactory, Location;

    protected $table = 'orders';
    const ORDER_INVOICE_CODE_PREFIX = 'ECOMMERCE-';
    protected $fillable = [
        'order_code',
        'shipper_id',
        'customer_id',
        // 'billing_name',
        // 'billing_address',
        // 'billing_country_id',
        // 'billing_city_id',
        // 'billing_district_id',
        // 'billing_ward_id',
        // 'billing_phone',
        'shipping_name',
        'shipping_address',
        'shipping_country_id',
        'shipping_city_id',
        'shipping_district_id',
        'shipping_ward_id',
        'shipping_phone',
        'payment_method',
        'payment_method_id',
        // 'payment_fee',
        // 'payment_fee_type',
        'comment',
        'coupon_id',
        'ip',
        'forwarded_ip',
        'user_agent',
        'accept_language',
        // 'created_by',
        // 'updated_by',
        'total',
        // 'grand_total',
        // 'original_total',
        'total_price',
        'total_discount',
        'total_shipping',
        'total_payment_fee',
        'total_cancel',
        'order_status_id',
        'note',
        'uuid'
    ];

    /**
     * Relationship With PaymentMethod
     * @return HasOne
     */
    public function paymentMethod(): HasOne
    {
        return $this->hasOne(PaymentMethod::class, 'id', 'payment_method_id');
    }

    /**
     * Relationship with OrderStatus
     * @return HasOne
     */
    public function orderStatus(): HasOne
    {
        return $this->hasOne(OrderStatus::class, 'id', 'order_status_id');
    }

    public function couponCode(): HasOne
    {
        return $this->hasOne(CouponCode::class, 'id', 'coupon_id');
    }

    /**
     * @return HasMany
     */
    public function getOrderItems(): HasMany
    {
        return $this->hasMany(OrderItem::class, 'order_id', 'id');
    }

    /**
     * @return HasOne
     */
    public function getOrderDetail(): HasOne
    {
        return $this->hasOne(OrderDetail::class, 'order_id', 'id');
    }

    /**
     * @return BelongsTo
     */
    public function getOrderStatus(): BelongsTo
    {
        return $this->belongsTo(OrderStatus::class, 'order_status_id');
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
    public function customer(): BelongsTo
    {
        return $this->belongsTo(User::class, 'customer_id', 'id');
    }

    /**
     * @return HasMany
     */
    public function orderItems(): HasMany
    {
        return $this->hasMany(OrderItem::class, 'order_id', 'id');
    }

    /**
     * @return HasMany
     */
    public function orderDetails(): HasMany
    {
        return $this->hasMany(OrderDetail::class);
    }

    /**
     * @param string|null $value
     * @return string
     */
    public function getCreatedAtAttribute(string|null $value): string
    {
        return date('d/m/Y', strtotime($value));
    }

    /**
     * @param string|null $value
     * @return string
     */
    public function getUpdatedAtAttribute(string|null $value): string
    {
        return date('d/m/Y', strtotime($value));
    }

    /**
     * Get shipping Address
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

    /**
     * Get billing Address
     * @return string
     */
    public function billingAddress(): string
    {
        $this->address = $this->billing_address;
        $this->street_id = $this->billing_street_id;
        $this->ward_id = $this->billing_ward_id;
        $this->district_id = $this->billing_district_id;
        $this->city_id = $this->billing_city_id;
        return $this->locationToText();
    }
}
