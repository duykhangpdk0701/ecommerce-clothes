<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class ItemVariant extends Model
{
    use HasFactory;

    /**
     * @inheritdoc
     */
    protected $table = 'item_variants';

    protected $fillable = [
        'sku',
        'item_id',
        'size_id',
        'color_id',
        'order',
        'status'
    ];

    protected $appends = ['min_in_stock_price'];

    /**
     * @return bool|int|string
     */
    public function getMinInStockPriceAttribute(): bool|int|string
    {
        if (!$this->relationLoaded('itemStocks')) {
            return false;
        }
        $minPrice = $this->itemStocks->where('stock_status_id', CONST_STOCK_IN_STOCK)->min('price');
        return $minPrice ? number_format($minPrice) : 0;
    }

    /**
     * Relationship with ItemStock
     * @return HasMany
     */
    public function itemStock(): HasMany
    {
        return $this->hasMany(ItemStock::class, 'item_variant_id', 'id');
    }

    /**
     * @return mixed
     */
    public function lowestPriceInStockItemStock(): mixed
    {
        return $this->hasOne(ItemStock::class, 'item_variant_id', 'id')->orderBy('price', 'ASC')->oldest();
    }

    /**
     * @return BelongsTo
     */
    public function item(): BelongsTo
    {
        return $this->belongsTo(Item::class, 'item_id', 'id');
    }

    /**
     * @return BelongsTo
     */
    public function size(): BelongsTo
    {
        return $this->belongsTo(ItemSize::class, 'size_id', 'id');
    }

    /**
     * @return BelongsTo
     */
    public function color(): BelongsTo
    {
        return $this->belongsTo(ItemColor::class, 'color_id', 'id');
    }


    /**
     * @return HasOne
     */
    public function orderItem(): HasOne
    {
        return $this->hasOne(OrderItem::class, 'item_variant_id', 'id');
    }


    /**
     * The latest order sale
     *
     * @return HasOne
     */
    public function latestSale(): HasOne
    {
        return $this->hasOne(OrderItem::class)->where('order_status_id', ORDER_STT_COMPLETED)->latest();
    }

    /**
     * Scope a query to only include active brands.
     *
     * @param Builder $query
     * @return Builder
     */
    public function scopeActive(Builder $query): Builder
    {
        return $query->where('status', CONST_ENABLE);
    }
}
