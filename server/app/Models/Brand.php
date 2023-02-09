<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Query\Builder;

class Brand extends Model
{
    use HasFactory;

    protected $table = "brands";

    public static array $statuses = [
        CONST_ENABLE => 'Enable',
        CONST_DISABLE => 'Disable',
    ];

    const CACHE_SUB_NAVBAR = 'SUB-NAVBAR-BRANDS';

    protected $fillable = [
        'name', 'slug', 'order', 'status'
    ];

    /**
     * @param Builder $query
     * @return Builder
     */
    public function scopeActive(Builder $query): Builder
    {
        return $query->where('status', CONST_ENABLE);
    }
}
