<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class ItemPersonType extends Model
{
    use HasFactory;

    protected $table = 'item_person_types';
    protected $fillable = ['code', 'name'];

    const ITEM_PERSON_TYPE_MEN = 1;
    const ITEM_PERSON_TYPE_WOMEN = 2;
    const ITEM_PERSON_TYPE_KID = 3;

    public static array $personTypes = [
        self::ITEM_PERSON_TYPE_MEN => 'men',
        self::ITEM_PERSON_TYPE_WOMEN => 'women',
        self::ITEM_PERSON_TYPE_KID => 'kid'
    ];

    /**
     * Relationship with itemSize
     *
     * @return HasMany
     */
    public function itemSizes(): HasMany
    {
        return $this->hasMany(ItemSize::class);
    }
}
