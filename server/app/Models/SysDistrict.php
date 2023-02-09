<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class SysDistrict extends Model
{
    use HasFactory;

    /**
     * Relationship with Shipping fees
     *
     * @return BelongsTo
     */
    public function city(): BelongsTo
    {
        return $this->belongsTo(SysCity::class, 'city_id', 'id');
    }

    /**
     * Relationship with Shipping fees
     *
     * @return HasMany
     */

    public function ward(): HasMany
    {
        return $this->hasMany(SysWard::class, 'district_id', 'id');
    }
}
