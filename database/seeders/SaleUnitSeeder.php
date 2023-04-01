<?php

namespace Database\Seeders;

use App\Models\SaleUnit;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SaleUnitSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        SaleUnit::factory()
            ->count(10)
            ->create();

    }

}
