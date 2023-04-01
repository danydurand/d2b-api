<?php

namespace Database\Seeders;

use App\Models\SubBrand;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SubBrandSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        SubBrand::factory()
            ->count(10)
            ->create();

    }

}
