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
        PriceList::factory()->create([
            'name' => 'LIST NRO 1',
            'must_be_sync' => false,
            'sync_at' => null,
            'created_by' => User::find(1),
            'updated_by' => User::find(1),
        ]);

        PriceList::factory()->create([
            'name' => 'LIST NRO TWO',
            'must_be_sync' => false,
            'sync_at' => null,
            'created_by' => User::find(2),
            'updated_by' => User::find(2),
        ]);

        PriceList::factory()->create([
            'name' => 'LIST NRO 3',
            'must_be_sync' => false,
            'sync_at' => null,
            'created_by' => User::find(1),
            'updated_by' => User::find(1),
        ]);

        // PriceList::factory()
        //     ->count(5)
        //     ->hasCustomerTypes(2)
        //     ->create();
    }

}
