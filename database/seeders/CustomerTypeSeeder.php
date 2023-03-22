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

        CustomerType::factory()->create([
            'code' => 'CONTRI',
            'description' => 'CONTRIBUYENTE',
            'price_list_id' => PriceList::find(1),
            'must_be_sync' => false,
            'sync_at' => null,
            'created_by' => User::find(1),
            'updated_by' => User::find(1),
        ]);

        CustomerType::factory()->create([
            'code' => 'NOCONT',
            'description' => 'NO CONTRIBUYENTE',
            'price_list_id' => PriceList::find(2),
            'must_be_sync' => false,
            'sync_at' => null,
            'created_by' => User::find(1),
            'updated_by' => User::find(1),
        ]);

        CustomerType::factory()->create([
            'code' => 'CONTES',
            'description' => 'CONTRIBUYENTE ESPECIAL',
            'price_list_id' => PriceList::find(1),
            'must_be_sync' => false,
            'sync_at' => null,
            'created_by' => User::find(1),
            'updated_by' => User::find(1),
        ]);

        CustomerType::factory()->create([
            'code' => 'AGERET',
            'description' => 'AGENTE DE RETENCION',
            'price_list_id' => PriceList::find(2),
            'must_be_sync' => false,
            'sync_at' => null,
            'created_by' => User::find(1),
            'updated_by' => User::find(1),
        ]);

        // CustomerType::factory()
        //     ->count(5)
        //     ->create();
    }

}
