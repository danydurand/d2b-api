<?php

namespace Database\Seeders;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Transport;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TransportSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {

        Transport::factory()
            ->count(10)
            ->create();

    }

}
