<?php

namespace Database\Seeders;

use App\Models\ItemCategory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ItemCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        if (ItemCategory::count() > 0) {
            return;
        }

        ItemCategory::factory(2)->create()->each(function ($category) {
            ItemCategory::factory(3)->create(['parent_id' => $category->id]);
        });
    }
}
