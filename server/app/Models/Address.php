<?php

namespace App\Models;

use App\Traits\Location;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    use HasFactory, Location;

    const STATUS_ADDRESS_APPLIED = 1;

    protected $table = "addresses";

    protected $fillable = [
        'user_id',
        'name',
        'phone',
        'country_id',
        'city_id',
        'district_id',
        'ward_id',
        'address',
        'status'
    ];

    /**
     * Address default profile
     * @return mixed
     */
    public function scopeActive(): mixed
    {
        return $this->where('status', self::STATUS_ADDRESS_APPLIED);
    }

    /**
     * get shipping address
     * @return string
     */
    public function stringAddress(): string
    {
        return $this->locationToText();
    }
}
