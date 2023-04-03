<?php

namespace Database\Seeders;

use App\Models\PaymentCondition;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PaymentConditionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        PaymentCondition::factory()
            ->count(10)
            ->create();

    }

}
