<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ItemStockPrice extends Model
{
    use HasFactory;

    /**
     * The table associated with the model
     *
     * @var string
     */
    protected $table = 'item_stock_prices';

    protected $fillable = [
        'item_stock_id',
        'old_price',
        'price',
        'created_by',
        'updated_by'
    ];

    /**
     * Relationship with itemStock
     *
     * @return BelongsTo
     */
    public function itemStock(): BelongsTo
    {
        return $this->belongsTo(ItemStock::class);
    }
}
