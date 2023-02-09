<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class SysCountry extends Model
{
    protected $fillable = ['name', 'code'];

    use HasFactory;

    /**
     * Relationship with Shipping fee
     *
     * @return HasMany
     */
    public function shippingFee()
    {
        return $this->hasMany(ShippingFee::class, 'country_id', 'id');
    }
}
