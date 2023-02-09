<?php

namespace Database\Seeders;

use App\Models\ItemPersonType;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class ItemPersonTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        $personTypes = ItemPersonType::$personTypes;

        foreach ($personTypes as $key => $value) {
            ItemPersonType::updateOrCreate(
                [
                    'id' => $key
                ],
                [
                    'code' => $value,
                    'name' => Str::title($value)
                ]
            );
        }
    }
}
