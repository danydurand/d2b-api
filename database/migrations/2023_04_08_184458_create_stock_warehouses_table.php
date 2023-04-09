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

        Schema::create('stock_warehouses', function (Blueprint $table) {
            $table->id();
            $table->foreignId('warehouse_id')->constrained()->on('invoices');
            $table->foreignId('article_id')->constrained()->on('articles');
            $table->decimal('actual_stock', 18, 5);
            $table->decimal('actual_sstock', 18, 5);
            $table->decimal('commited_stock', 18, 5);
            $table->decimal('commited_sstock', 18, 5);
            $table->decimal('to_arrive_stock', 18, 5);
            $table->decimal('to_arrive_sstock', 18, 5);
            $table->decimal('to_dispatch_stock', 18, 5);
            $table->decimal('to_dispatch_sstock', 18, 5);
            $table->char('checked', 1)->nullable();

            $table->boolean('must_be_sync')->default(false);
            $table->dateTime('sync_at')->nullable();
            $table->foreignId('created_by')->constrained()->on('users');
            $table->foreignId('updated_by')->constrained()->on('users');
            $table->timestamps();

            $table->index('warehouse_id');
            $table->index('article_id');
            $table->index('must_be_sync');
            $table->index('created_by');
            $table->index('updated_by');
            $table->unique(['warehouse_id', 'article_id']);

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
        Schema::dropIfExists('stock_warehouses');
    }
};
