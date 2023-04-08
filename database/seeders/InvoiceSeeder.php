<?php

namespace Database\Seeders;

use App\Models\Invoice;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class InvoiceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        Invoice::factory()
            ->count(5)
            ->hasInvoiceLines(5)
            ->create();
        Invoice::factory()
            ->count(6)
            ->hasInvoiceLines(10)
            ->create();
        Invoice::factory()
            ->count(15)
            ->hasInvoiceLines(6)
            ->create();

    }

}
