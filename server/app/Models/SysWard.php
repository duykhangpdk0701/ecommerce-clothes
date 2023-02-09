<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class SysWard extends Model
{
    use HasFactory;

    /**
     * Relationship with Shipping fees
     *
     * @return BelongsTo
     */
    public function cities(): BelongsTo
    {
        return $this->belongsTo(SysCity::class, 'city_id', 'id');
    }

    /**
     * Relationship with district
     *
     * @return BelongsTo
     */
    public function district(): BelongsTo
    {
        return $this->belongsTo(SysDistrict::class, 'district_id', 'id');
    }
}
