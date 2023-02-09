<?php

namespace Database\Seeders;

use App\Models\Brand;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BrandSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return null | bool
     */
    public function run(): null|bool
    {
        if (Brand::count() > 0) {
            return false;
        }
        Brand::factory(2)->create();
        return true;
    }
}
