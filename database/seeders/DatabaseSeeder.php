<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\CustomerType;
use App\Models\PriceList;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            UserSeeder::class,
            PriceListSeeder::class,
            CustomerTypeSeeder::class,
            SellerSeeder::class,
            CustomerSeeder::class,
            CategorySeeder::class,
            LineSeeder::class,
            SubLineSeeder::class,
        ]);

        // User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
    }
}
