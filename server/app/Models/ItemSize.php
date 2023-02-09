<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class ItemSize extends Model
{
    use HasFactory;

    protected $table = 'item_sizes';

    protected $fillable = [
        'item_category_id',
        'item_person_type_id',
        'value',
        'status',
        'order'
    ];

    protected $casts = ['related_size' => 'array'];

    /**
     * Relationship with itemCategory
     * @return BelongsTo
     */
    public function itemCategory(): BelongsTo
    {
        return $this->belongsTo(ItemCategory::class);
    }

    /**
     * Relationship with ItemPersonType
     * @return BelongsTo
     */
    public function itemPersonType(): BelongsTo
    {
        return $this->belongsTo(ItemPersonType::class);
    }

    /**
     * Relationship with ItemVariant
     * @return HasMany
     */
    public function itemVariants(): HasMany
    {
        return $this->hasMany(ItemVariant::class, 'size_id', 'id');
    }

    /**
     * get activeItem Variant
     * @return HasMany
     */
    public function activeItemVariant(): HasMany
    {
        return $this->hasMany(ItemVariant::class, 'size_id', 'id')->active();
    }

    /**
     * Relationship with ItemStock
     * @return HasMany
     */
    public function itemStocks(): HasMany
    {
        return $this->hasMany(ItemStock::class, 'size_id', 'id');
    }
}
