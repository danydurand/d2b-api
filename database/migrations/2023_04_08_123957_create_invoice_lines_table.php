<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::disableForeignKeyConstraints();

        Schema::create('invoice_lines', function (Blueprint $table) {
            $table->id();
            $table->foreignId('invoice_id')->constrained()->on('invoices');
            $table->integer('line_number');
            $table->char('origin_document_type', 1);
            $table->integer('origin_line_number');
            $table->foreignId('article_id')->constrained()->on('articles');
            $table->foreignId('warehouse_id')->constrained()->on('warehouses');
            $table->decimal('sub_total', 18, 5);
            $table->decimal('qty', 18, 5);
            $table->decimal('qty_secondary_unit', 18, 5);
            $table->decimal('pending', 18, 5);
            $table->string('sale_unit', 6);
            $table->decimal('sale_price', 18, 5);
            $table->decimal('net_line', 18, 5);
            $table->string('discounts', 15)->nullable();
            $table->char('tax_type', 1)->nullable();
            $table->decimal('average_unit_cost', 18, 5)->nullable();
            $table->decimal('last_unit_cost', 18, 5)->nullable();
            $table->decimal('average_unit_cost_oc', 18, 5)->nullable();
            $table->decimal('last_unit_cost_oc', 18, 5)->nullable();
            $table->decimal('pay_back_amount', 18, 5)->nullable();
            $table->decimal('pay_back_total', 18, 5)->nullable();
            $table->decimal('sale_price_oc', 18, 5)->nullable();
            $table->string('article_generic_description', 60)->nullable();
            $table->string('comments', 100)->nullable();
            $table->decimal('total_units', 18, 5)->nullable();
            $table->decimal('liqour_tax_amount', 18, 5)->nullable();
            $table->string('lot_number', 20)->nullable();
            $table->dateTime('lot_date')->nullable();
            $table->decimal('aux01', 18, 5)->nullable();
            $table->string('aux02', 30)->nullable();

            $table->boolean('must_be_sync')->default(false);
            $table->dateTime('sync_at')->nullable();
            $table->foreignId('created_by')->constrained()->on('users');
            $table->foreignId('updated_by')->constrained()->on('users');
            $table->timestamps();

            $table->index('invoice_id');
            $table->index('article_id');
            $table->index('warehouse_id');
            $table->index('must_be_sync');
            $table->index('created_by');
            $table->index('updated_by');

            $table->engine = 'InnoDB';
            $table->charset = 'utf8mb4';
            $table->collation = 'utf8mb4_unicode_ci';
        });

        Schema::enableForeignKeyConstraints();
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('invoice_lines');
    }
};
