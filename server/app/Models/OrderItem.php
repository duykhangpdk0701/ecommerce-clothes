<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class OrderItem extends Model
{
    use HasFactory;

    protected $table = 'order_items';

    protected $fillable = [
        'order_id',
        'order_status_id',
        'order_detail_id',
        'item_id',
        'item_variant_id',
        'item_stock_id',
        'size_id',
        'color_id',
        'coupon_code_id',
        'item_name',
        'sku',
        'code',
        'size_value',
        'color_name',
        'color_value',
        'price_in',
        'price',
        'quantity',
        'discount',
        'tax',
        'shipping',
        'payment_fee',
        'total',
        'reward',
        'coupon_code_id'
    ];

    /**
     * @return BelongsTo
     */
    public function order(): BelongsTo
    {
        return $this->belongsTo(Order::class);
    }

    /**
     * @return BelongsTo
     */
    public function getOrderDetail(): BelongsTo
    {
        return $this->belongsTo(OrderDetail::class);
    }

    /**
     * @return HasOne
     */
    public function items(): HasOne
    {
        return $this->hasOne(Item::class, 'id', 'item_stock_id');
    }

    /**
     * @return HasOne
     */
    public function supplier(): HasOne
    {
        return $this->hasOne(User::class, 'id', 'supplier_id');
    }

    /**
     * @return BelongsTo
     */
    public function variant(): BelongsTo
    {
        return $this->belongsTo(ItemVariant::class, 'item_variant_id', 'id');
    }

    /**
     * @return BelongsTo
     */
    public function itemStock(): BelongsTo
    {
        return $this->belongsTo(ItemStock::class, 'item_stock_id', 'id');
    }

    /**
     * @return BelongsTo
     */
    public function getOrder(): BelongsTo
    {
        return $this->belongsTo(Order::class, 'order_id', 'id');
    }

    public function ItemSize()
    {
        return $this->belongsTo(ItemSize::class, 'size_id', 'id');
    }

    /**
     * @param $value
     * @return string
     */
    public function getCreatedAtAttribute($value): string
    {
        return date("d/m/Y H:i", strtotime($value));
    }

    /**
     * @param $value
     * @return string
     */
    public function getUpdatedAtAttribute($value): string
    {
        return date("d/m/Y H:i", strtotime($value));
    }

    /**
     * @return HasOne
     */
    public function couponCode(): HasOne
    {
        return $this->hasOne(CouponCode::class, 'id', 'coupon_code_id');
    }

    /**
     * @return string
     */
    public function getTextNewStatus(): string
    {
        $num = intval($this->new_status);
        if ($num === 1) {
            return "New";
        }
        return "Used";
    }

    public function getFullnameAndAttributes($show): string
    {
        $attribute = [];
        $text = '';
        if (!empty($show)) {
            if (in_array('name', $show)) {
                $text += $this->item->name;
            }

            if (in_array('sku', $show)) {
                $attribute[] = $this->sku;
            }

            if (in_array('new_status', $show)) {
                $attribute[] = $this->getTextNewStatus();
            }

            if (in_array('size', $show)) {
                $attribute[] = $this->size_value;
            }

            if (in_array('price', $show)) {
                $attribute[] = $this->price;
            }
        }

        if (!empty($attribute)) {
            $text .= '(' . implode('|', $attribute) . ')';
        }
        return $text;
    }

}
