<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class SysCity extends Model
{
    use HasFactory;

    protected $fillable = ['code', 'name', 'slug', 'geometry', 'center', 'color', 'bounding_box', 'pre', 'order', 'status'];

    /**
     * Relationship with Shipping fees
     *
     * @return HasMany
     */
    public function shoppingFee()
    {
        return $this->hasMany(ShippingFee::class, 'city_id', 'id');
    }

    /**
     * Relationship with district
     *
     * @return HasMany
     */
    public function districts(): HasMany
    {
        return $this->hasMany(SysDistrict::class, 'city_id', 'id');
    }

    /**
     * Relationship with wards
     *
     * @return HasMany
     */
    public function wards(): HasMany
    {
        return $this->hasMany(SysWard::class, 'district_id', 'id');
    }
}
