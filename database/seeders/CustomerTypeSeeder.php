<?php

namespace Database\Seeders;

use App\Models\CustomerType;
use App\Models\PriceList;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CustomerTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {

        CustomerType::factory()
            ->count(5)
            ->create();
    }

}
