<?php

namespace Database\Seeders;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Currency;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CurrencySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {

        Currency::factory()->create([
            'code'         => 'VEB',
            'name'         => 'BOLIVAR',
            'must_be_sync' => true,
            'sync_at'      => null,
            'created_by'   => 1,
            'updated_by'   => 1,
        ]);

        Currency::factory()->create([
            'code'         => 'USD',
            'name'         => 'DOLAR AMERICANO',
            'must_be_sync' => true,
            'sync_at'      => null,
            'created_by'   => 1,
            'updated_by'   => 1,
        ]);

        Currency::factory()->create([
            'code'         => 'CAD',
            'name'         => 'DOLAR CANADIENSE',
            'must_be_sync' => true,
            'sync_at'      => null,
            'created_by'   => 1,
            'updated_by'   => 1,
        ]);

        // Currency::factory()
        //     ->count(4)
        //     ->create();

    }

}
