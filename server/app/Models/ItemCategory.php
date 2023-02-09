<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Spatie\Translatable\HasTranslations;

class ItemCategory extends Model
{
    use HasFactory, HasTranslations;

    protected $table = 'item_categories';

    const CACHE_SUB_NAVBAR = 'SUB_NAVBAR_CATEGORIES';

    protected $fillable = ['parent_id', 'name', 'slug', 'description', 'status', 'order'];

    protected $translatable = ['name'];

    /**
     * Children Relationship
     *
     * @return HasMany
     */
    public function children(): HasMany
    {
        return $this->hasMany(ItemCategory::class, 'parent_id', 'id');
    }

    /**
     * Children Relationship
     *
     * @return BelongsTo
     */
    public function parrent(): BelongsTo
    {
        return $this->belongsTo(ItemCategory::class, 'parent_id', 'id');
    }

    /**
     * Item Relationship
     *
     * @return BelongsToMany
     */
    public function items(): BelongsToMany
    {
        return $this->belongsToMany(Item::class);
    }

    /**
     * Size Relationship
     *
     * @return HasMany
     */
    public function sizes(): HasMany
    {
        return $this->hasMany(ItemSize::class, 'item_category_id', 'id');
    }

    /**
     * Scope a query to only include active categories.
     *
     * @param Builder $query
     * @return Builder
     */
    public function scopeActive(Builder $query): Builder
    {
        return $this->where('status', CONST_ENABLE);
    }

    /**
     * Check current category is parent
     *
     * @return bool
     **/
    public function isParent(): bool
    {
        if ($this->parent_id == null) {
            return true;
        }
        return false;
    }
}
