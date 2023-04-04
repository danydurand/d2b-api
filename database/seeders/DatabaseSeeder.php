<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
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
            ColourSeeder::class,
            OriginSeeder::class,
            ArticleTypeSeeder::class,
            ProviderSeeder::class,
            SaleUnitSeeder::class,
            BusinessSeeder::class,
            BrandSeeder::class,
            SubBrandSeeder::class,
            ArticleSeeder::class,
            PaymentConditionSeeder::class,
            CurrencySeeder::class,
            TransportSeeder::class,
            OrderSeeder::class,
            BranchSeeder::class,
        ]);

        // User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
    }
}
