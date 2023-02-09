<?php

namespace App\Traits;

use App\Models\SysCity;
use App\Models\SysDistrict;
use App\Models\SysWard;

trait Location
{
    public function locationToText()
    {
        $location = [];
        // if (!empty($this->address)) {
        //     $location[] = $this->address;
        // }
        if ($this->wardName()) {
            $location[] = $this->wardName();
        }
        if ($this->districtName()) {
            $location[] = $this->districtName();
        }
        if ($this->cityName()) {
            $location[] = $this->cityName();
        }
        return implode(', ', $location);
    }

    public function wardName()
    {
        $_name = '';
        if (!empty($this->ward_id)) {
            $ward = SysWard::query()->find($this->ward_id);
            if (!empty($ward)) {
                $_name = $ward->pre . ' ' . $ward->name;
            }
        }
        return $_name;
    }

    public function districtName()
    {
        $_name = '';
        if (!empty($this->district_id)) {
            $district = SysDistrict::query()->find($this->district_id);
            if (!empty($district)) {
                $_name = $district->pre . ' ' . $district->name;
            }
        }
        return $_name;
    }

    public function cityName()
    {
        $_name = '';
        if (!empty($this->city_id)) {
            $city = SysCity::query()->find($this->city_id);
            if (!empty($city)) {
                $_name = $city->pre . ' ' . $city->name;
            }
        }
        return $_name;
    }
}
