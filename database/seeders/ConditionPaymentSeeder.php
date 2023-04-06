<?php

namespace Database\Seeders;

use App\Models\ConditionPayment;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ConditionPaymentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        ConditionPayment::factory()
            ->count(5)
            ->create();

    }

}
