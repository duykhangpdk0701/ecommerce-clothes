<?php

namespace Database\Seeders;

use App\Models\ItemPersonType;
use App\Models\ItemStock;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class ItemStockSizeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        if (ItemStock::first() && ItemStock::first()->size_id == null) {
            $itemStocks = ItemStock::all();
            foreach ($itemStocks as $itemStock) {
                $itemStock->update([
                    'size_id' => $itemStock->itemVariant->size_id
                ]);
            }
        }
    }
}
