<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ShippingFee extends Model
{
    use HasFactory;

    /**
     * Type percent of shipping fee price
     */
    const PERCENT_TYPE = 1;

    /**
     * Type VND of shipping fee price
     */
    const VND_TYPE = 2;

    /**
     * Status active of shipping fee
     */
    const ACTIVE = 1;

    /**
     * Status disable active of shipping fee
     */
    const DISABLE = 0;

    protected $fillable = ['country_id', 'city_id', 'type', 'value', 'status'];

    /**
     * Relationship with city
     *
     * @return BelongsTo
     */
    public function city()
    {
        return $this->belongsTo(SysCity::class, 'city_id', 'id');
    }

    /**
     * Relationship with country
     *
     * @return BelongsTo
     */
    public function country()
    {
        return $this->belongsTo(SysCountry::class, 'country_id', 'id');
    }

    /**
     * Get value show to list shipping fee
     *
     * @return float|string
     */
    public function getNumberFormatValueAttribute(): float|string
    {
        if ($this->type === self::VND_TYPE) {
            return number_format($this->value);
        }
        return floatval($this->value);
    }
}
