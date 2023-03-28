<?php

namespace Database\Seeders;

use App\Models\PriceList;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PriceListSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        PriceList::factory()
            ->count(5)
            // ->hasCustomerTypes(2)
            ->create();
    }

}
