<?php

namespace Database\Seeders;

use App\Models\DocumentCxc;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DocumentCxcSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        DocumentCxc::factory()
            ->count(15)
            ->create();

    }

}
