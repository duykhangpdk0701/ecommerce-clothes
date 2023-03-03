<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class ItemColor extends Model
{
    use HasFactory;

    protected $table = 'item_colors';

    protected $fillable = ['name', 'value', 'order'];

    /**
     * RelationShip with Item variant
     * @return HasMany
     */

    public function itemVariants(): HasMany
    {
        return $this->hasMany(ItemVariant::class, 'color_id', 'id');
    }

    /**
     * Get active variant
     * @return HasMany
     */

    public function activeVariantItem(): HasMany
    {
        return $this->hasMany(ItemVariant::class, 'color_id', 'id')->active();
    }

    /**
     * Relationship with ItemStock
     * @return HasMany
     */

    public function itemStocks(): HasMany
    {
        return $this->hasMany(ItemStock::class, 'color_id', 'id');
    }
}
