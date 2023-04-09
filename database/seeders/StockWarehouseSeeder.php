<?php

namespace Database\Seeders;

use App\Models\StockWarehouse;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class StockWarehouseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        StockWarehouse::factory()
            ->count(20)
            ->create();

    }

}
