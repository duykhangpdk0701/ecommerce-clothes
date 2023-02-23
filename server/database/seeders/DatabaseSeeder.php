<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run(): void
    {
        //seeder for brand
        $this->call(BrandSeeder::class);
        //seeder for address
        $this->call(SysCitySeeder::class);
        $this->call(SysDistrictSeeder::class);
        $this->call(SysWardSeeder::class);
        //seeder for user
        $this->call(RolePermissonSeeder::class);
        $this->call(UserSeeder::class);
        $this->call(UserProfileSeeder::class);
        //seeder for item
        $this->call(ItemPersonTypeSeeder::class);
        $this->call(ItemCategorySeeder::class);
        $this->call(ItemStockStatusSeeder::class);
        //seeder for quotes
        $this->call(PaymentMethodSeeder::class);
    }
}
