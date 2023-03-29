<?php

namespace Database\Seeders;

use App\Models\SubLine;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SubLineSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        SubLine::factory()
            ->count(10)
            ->create();

    }

}
