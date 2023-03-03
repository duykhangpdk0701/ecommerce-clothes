<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class ItemStock extends Model
{
    use HasFactory;

    const STOCK_IN_STOCK = 1;
    const STOCK_PRE_ORDER = 2;
    const STOCK_OUT_OF_STOCK = 3;
    const STOCK_SOME_DAYS = 4;
    const STOCK_RECEIVING = 5;
    const STOCK_RECEIVED = 6;

    public static array $stockStatuses = [
        self::STOCK_IN_STOCK => 'IN_STOCK',
        self::STOCK_PRE_ORDER => 'PRE_ORDER',
        self::STOCK_OUT_OF_STOCK => 'OUT_OF_STOCK',
        self::STOCK_SOME_DAYS => 'SOME_DAYS',
        self::STOCK_RECEIVING => 'RECEIVING',
        self::STOCK_RECEIVED => "RECEIVED",
    ];

    const STOCK_OUT_TYPE_RETURN = 1;
    const STOCK_OUT_TYPE_SOLD = 2;
    const STOCK_OUT_TYPE_BID_DECLINED = 3;

    const STATUS_APPROVED = 1;
    const STATUS_PENDING_APPROVAL = 0;

    const DUE_DAYS = 1;

    protected $table = 'item_stocks';

    protected $fillable = [
        'item_variant_id',
        'item_id',

        'stock_status_id',

        'code',
        'sku',

        'size_value',
        'size_id',

        'color_value',
        'color_name',
        'color_id',

        'price_in',
        'price',
        'is_sale',
        'old_price',

        'stock_in_date',
        'stock_in_note',
        'stock_in_type',

        'stock_out_date',
        'stock_out_note',
        'stock_out_type',

        'status',
        'created_by'
    ];

    /**
     * Relationship with itemVariant
     *
     * @return BelongsTo
     */
    public function itemVariant(): BelongsTo
    {
        return $this->belongsTo(ItemVariant::class, 'item_variant_id', 'id');
    }

    /**
     * Relationship with item
     *
     * @return BelongsTo
     */
    public function item(): BelongsTo
    {
        return $this->belongsTo(Item::class, 'item_id', 'id');

    }

    /**
     * Return Collection of Price
     *
     * @return HasMany
     */
    public function prices(): HasMany
    {
        return $this->hasMany(ItemStockPrice::class)->latest();
    }

    /**
     * Return the latest price of resource
     *
     * @return HasMany
     */
    public function latestPrice(): HasMany
    {
        return $this->prices()->take(1);
    }

    /**
     *  Return the size
     *
     * @return BelongsTo
     */
    public function itemSize(): BelongsTo
    {
        return $this->belongsTo(ItemSize::class);
    }

    /**
     * Return the color
     *
     * @return BelongsTo
     */
    public function itemColor(): BelongsTo
    {
        return $this->belongsTo(ItemColor::class);
    }

    /**
     * Scope a query to only include in stock stocks.
     */
    public function scopeInStock($query)
    {
        return $query->where('stock_status_id', self::STOCK_IN_STOCK);
    }

    /**
     * Relationship with OrderItem
     * @return HasOne
     */
    public function orderItem(): HasOne
    {
        return $this->hasOne(OrderItem::class, 'item_stock_id', 'id');
    }

    /**
     * @param string $value
     * @return string
     */
    public function getCreateAtAttribute(string $value): string
    {
        return date('d/m/y H:i', strtotime($value));
    }

}
