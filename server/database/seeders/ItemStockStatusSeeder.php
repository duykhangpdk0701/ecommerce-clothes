<?php

namespace Database\Seeders;

use App\Models\ItemStock;
use App\Models\ItemStockStatus;
use Illuminate\Database\Seeder;

class ItemStockStatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        $stockStatuses = ItemStock::$stockStatuses;

        foreach ($stockStatuses as $key => $value) {
            ItemStockStatus::updateOrCreate(
                [
                    'id' => $key
                ],
                [
                    'name' => $value
                ]
            );
        }
    }
}
